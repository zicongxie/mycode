<?php

namespace App\Http\Controllers\Api\Post;

use Cache;
use Validator;
use App\Helper\Image;
use App\Helper\SensitiveHandle;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Model\Posts;
use App\Model\User;
use App\Model\Topics;
use App\Model\TopicFollows;
use App\Http\Controllers\Api\ApiBaseController;

class PostController extends ApiBaseController {

	/**
	 * 发PO
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postPost(Request $request) {
		
		$this->user->checkLogin();
		if ($this->user->is_ban()) {
			return response()->api([], 10002, trans('messages.post_banned'));
		}

		$arguments = ['topic_id' ,'activity_id' ,'content' ,'location_prov' ,'location_city' ,'location_dist' ,'location_text' ,'longitude' ,'latitude' ,'images' ,'device_info'];

		$validator = Validator::make($request->all(), [
			'topic_id' => 'required|numeric',
			'activity_id' => 'numeric,exists:activity',
			'content' => 'required|between:1,1000',
			'location_prov' => 'digits_between:1,6',
			'location_city' => 'digits_between:1,6',
			'location_dist' => 'digits_between:1,6',
			'location_text' => 'max:48',
		], [
			'topic_id.required' => trans('messages.topic.id.required'),
			'topic_id.numeric' => trans('messages.topic.id.numeric'),
			'activity_id.numeric' => trans('messages.activity.id.numeric'),
			'content.required' => trans('messages.post.content.required'),
			'content.between' => trans('messages.post.content.between')
		]);

		if ($error = $validator->errors()->first()) {
			return response()->api([], 10001, $error);
		}

		// 输入参数
		foreach ($arguments as $argument) {
			if ($request->input($argument)) {
				$post[$argument] = $request->input($argument);
			}
		}

		// 敏感词处理
		$sensitive_handle = new SensitiveHandle();
		$sensitive_check_result = $sensitive_handle->check($post['content']);
		if ($sensitive_check_result === -1) {
			return response()->api([], 10003, trans('messages.post.content.sensitive'));
		}

		$post['author_uid'] = $this->user->uid;

		// 白名单处理
		if ($this->user->is_white()) {
			$post['is_checked'] = 1;
		}

		$result = Posts::create($post);

		if ($result) {
			if ($sensitive_check_result === 1) {
				$sensitive_handle->saveContent(2, $result->id, $this->user->uid);
			}
			Redis::rpush('post_for_check', $result->id);
			Redis::hincrby('topic_unread_count', $post['topic_id'], 1);
			return response()->api([]);
		} else {
			return response()->api([], 10013, trans('messages.failed.to.post'));
		}

	}

	/**
	 * POST详情
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postPostDetail(Request $request) {

		$post_id = $request->input('post_id');

		$validator = Validator::make($request->all(), [
			'post_id' => 'required|numeric|exists:posts,id',
		], [
			'post_id.exists' => trans('messages.post.id.exists'),
			'post_id.required' => trans('messages.post.id.required'),
			'post_id.numeric' => trans('messages.post.id.numeric'),
		]);

		if ($error = $validator->errors()->first()) {
			return response()->api([], 10001, $error);
		}

		$post = Posts::with('Topics')->find($post_id);

		if ($post) {
			return response()->api($post);
		} else {
			return response()->api([], 10014, trans('messages.failed.to.get.post'));
		}

	}

	/**
	 * 话题PO列表
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postGetPostListByTopic(Request $request) {

		$topic_id = $request->input('topic_id');

		$validator = Validator::make($request->all(), [
			'topic_id' => 'required|numeric|exists:topics,id',
		], [
			'topic_id.required' => trans('messages.topic.id.required'),
			'topic_id.numeric' => trans('messages.topic.id.numeric'),
			'topic_id.exists' => trans('messages.topic.id.exists'),
		]);

		if ($error = $validator->errors()->first()) {
			return response()->api([], 10001, $error);
		}

		$post_list_result = Posts::where('topic_id', $topic_id)->whereNotInt('is_checked', [-1])->orderby('id', 'DESC')->get();

		foreach ($post_list_result as $key => &$post) {

			// 拉取用户名缓存
			$username = Cache::tags(['user:'.$post['author_uid']])->get('username');
			if (empty($username)) {
				$username = User::find($post['author_uid'])->username;
				Cache::tags(['user:'.$post['author_uid']])->put('username', $username);
			}
			// 拉取话题缓存
			$topic_title = Cache::tags(['topic:'.$post['topic_id']])->get('title');
			if (empty($topic)) {
				$topic_title = Topics::find($post['topic_id'])->title;
				Cache::tags(['topic:'.$post['topic_id']])->put('title', $topic_title);
			}
			// 替换那些需要换的东西
			$post['topic_title'] = $topic_title;
			$post['author_username'] = $username;
			$post['images'] = Image::makeImage($post['images']);

		}

		unset($key, $post);

		// 关注话题未读数清零
		$topic_follow = TopicFollows::where('uid', 1)->where('topic_id', $topic_id)->get()->first();
		
		if ($topic_follow->toArray()) {
			$topic_follow->unread_count = 0;
			$topic_follow->save();
		}

		return response()->api($post_list_result);

	}

	/**
	 * 关注PO列表
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postGetPostListByFollow(Request $request) {

		$this->user->checkLogin();

		$user_follows = TopicFollows::where('uid', $this->user->uid)->get()->toArray();
		foreach ($user_follows as $user_follow) {
			$topic_ids[] = $user_follow['topic_id'];
		}

		$post_list = Posts::whereIn('topic_id', $topic_ids)->whereNotInt('is_checked', [-1])->orderby('id', 'DESC')->get()->toArray();

		return response()->api($post_list);

	}

	/**
	 * 点赞
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postLike(Request $request) {

		$this->user->checkLogin();
		if ($this->user->is_ban()) {
			return response()->api([], 10002, trans('messages.like.banned'));
		}

		$post_id = $request->input('post_id');

		$result = Posts::find($post_id);

		if (empty($result)) {
			return response()->api([], 10010, trans('messages.nonexistent.post'));
		}

		$result = Redis::zscore('post_like:'.$post_id, $this->user->uid);

		if ($result) {
			return response()->api([], 10011, trans('messages.liked.post'));
		} else {
			$result = Redis::zadd('post_like:'.$post_id, time(), $this->user->uid);
			Redis::hincrby('post_like_count', $post_id, 1);
			return response()->api([]);
		}

	}

	/**
	 * 取消赞
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postUnlike(Request $request) {

		$this->user->checkLogin();

		$post_id = $request->input('post_id');

		$result = Posts::find($post_id);

		if (empty($result)) {
			return response()->api([], 10010, trans('messages.nonexistent.post'));
		}

		$result = Redis::zscore('post_like:'.$post_id, $this->user->uid);

		if ($result) {
			$result = Redis::zrem('post_like:'.$post_id, $this->user->uid);
			Redis::hincrby('post_like_count', $post_id, -1);
			return response()->api([]);
		} else {
			return response()->api([], 10012, trans('messages.post.havent.liked'));
		}

	}

}