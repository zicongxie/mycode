<?php

namespace App\Http\Controllers\Api\Post;

use Cache;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Helper\SensitiveHandle;
use App\Model\Reviews;
use App\Model\User;
use App\Http\Controllers\Api\ApiBaseController;

class ReviewController extends ApiBaseController {

    /**
     * 评论列表
     * @param Request $request 请求参数
     * @return String JSON
     */
    public function postGetReviews(Request $request) {

        $post_id = $request->input('post_id');

        $reviews_result = Reviews::where('post_id', $post_id)->whereNotIn('is_checked', [-1])->get()->toArray();

        foreach ($reviews_result as $key => &$review) {

            $username = Cache::tags(['user:'.$review['author_uid']])->get('username');

            if (empty($username)) {
                $userinfo = User::find($review['author_uid'])->toArray();
                Cache::tags(['user:'.$review['author_uid']])->put('username', $userinfo['username']);
            }
            $review['author_username'] = $userinfo['username'];

            $username = Cache::tags(['user:'.$review['reply_uid']])->get();
            if (empty($username)) {
                $userinfo = User::find($review['reply_uid'])->toArray();
                Cache::tags(['user:'.$review['reply_uid']])->put('username', $userinfo['username']);
            }
            $review['reply_username'] = $userinfo['username'];

        }

        return response()->api($reviews);

    }

    /**
     * 发表评论
     * @param Request $request 请求参数
     * @return String JSON
     */
    public function postPostReview(Request $request) {

        $this->user->checkLogin();
        if ($this->user->is_ban()) {
            return response()->api([], 10002, trans('messages.review.banned'));
        }

        $arguments = ['post_id' ,'reply_uid', 'content'];

        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'reply_uid' => 'numeric|exists:user,uid',
            'content' => 'required|between:1,1000',
        ], [
            'post_id.required' => trans('messages.post.id.required'),
            'post_id.exists' => trans('messages.post.id.exists'),
            'reply_uid.numeric' => trans('messages.reply.uid.numeric'),
            'reply_uid.exists' => trans('messages.reply.uid.exists'),
            'content.required' => trans('messages.review.content.required'),
            'content.between' => trans('messages.review.content.between')
        ]);

        if ($error = $validator->errors()->first()) {
            return response()->api([], 10001, $error);
        }

        // 输入参数
        foreach ($arguments as $argument) {
            if ($request->input($argument)) {
                $review[$argument] = $request->input($argument);
            }
        }

        // 敏感词处理
        $sensitive_handle = new SensitiveHandle($review['content']);
        $sensitive_check_result = $sensitive_handle->check();
        if ($sensitive_check_result === -1) {
            return response()->api([], 10003, trans('messages.review.sensitive'));
        }

        $review['author_uid'] = $this->user->uid;

        // 白名单处理
        if ($this->user->is_white()) {
            $review['is_checked'] = 1;
        }

        $result = Reviews::create($review);

        if ($result) {
            if ($sensitive_check_result === 1) {
                $sensitive_handle->saveContent(1, $result->id, $this->user->uid);
            }
            Redis::rpush('review_for_check', $result->id);
            return response()->api([]);
        } else {
            return response()->api([], 10031, trans('messages.failed.to.review'));
        }

    }

}