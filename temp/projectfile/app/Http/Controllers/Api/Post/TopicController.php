<?php

namespace App\Http\Controllers\Api\Post;

use Cache;
use Validator;
use App\Helper\Image;
use App\Helper\SensitiveHandle;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Model\Topics;
use App\Model\TopicFollows;
use App\Http\Controllers\Api\ApiBaseController;

class TopicController extends ApiBaseController {

	/**
	 * 创建话题
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postCreateTopic(Request $request) {

		$this->user->checkLogin();
		if ($this->user->is_ban()) {
			return response()->api([], 10002, trans('messages.creating.topic.banned'));
		}

		$arguments = ['title' ,'description'];

		$validator = Validator::make($request->all(), [
			'title' => 'required|between:1,10|unique:topics|regex:/[\w\s\x{4e00}-\x{9fa5}]+$/u',
			'description' => 'required|between:1,30'
		], [
			'title.required' => trans('messages.topic.title.required'),
			'title.between' => trans('messages.topic.title.between'),
			'title.unique' => trans('messages.topic.title.unique'),
			'title.regex' => trans('messages.topic.title.regex'),
			'description.required' => trans('messages.topic.description.required'),
			'description.between' => trans('messages.topic.description.between'),
		]);

		if ($error = $validator->errors()->first()) {
			return response()->api([], 10001, $error);
		}

		// 输入参数
		foreach ($arguments as $argument) {
			if ($request->input($argument)) {
				$topics[$argument] = $request->input($argument);
			}
		}

		// 敏感词处理
		$sensitive_handle = new SensitiveHandle();

		foreach (['title', 'description'] as $attribute) {
			$sensitive_check_result = $sensitive_handle->check($topics[$attribute]);
			if ($sensitive_check_result <> 0) {
				return response()->api([], 10003, trans('messages.topic.'.$attribute.'.sensitive'));
			}
		}

		$topics['creator_uid'] = $this->user->uid;

		// 白名单处理
		if ($this->user->is_white()) {
			$topics['is_checked'] = 1;
		}

		$result = Topics::create($topics);

		if ($result) {
			Redis::rpush('topic_for_check', $result->id);
			return response()->api([]);
		} else {
			return response()->api([], 10023, trans('messages.failed.to.create.topic'));
		}

	}

	/**
	 * 修改话题
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postEditTopic(Request $request) {

		$this->user->checkLogin();
		if ($this->user->is_ban()) {
			return response()->api([], 10002, trans('messages.editing.topic.banned'));
		}

		$arguments = ['topic_id' ,'description'];

		$validator = Validator::make($request->all(), [
			'topic_id' => 'required|numeric',
			'description' => 'required|between:1,30'
		], [
			'topic_id.required' => trans('messages.topic.id.required'),
			'topic_id.numeric' => trans('messages.topic.id.between'),
			'description.required' => trans('messages.topic.description.required'),
			'description.between' => trans('messages.topic.description.between'),
		]);
		
		foreach ($arguments as $argument) {
			if ($request->input($argument)) {
				$topic[$argument] = $request->input($argument);
			}
		}

		$topic = Topics::find($topic['topic_id']);
		$topic->description = $description;
		$topic->save();

		return response()->api([]);

	}

	/**
	 * 话题详情
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postTopicDetail(Request $request) {

		$topic_id = $request->input('topic_id');

		$validator = Validator::make($request->all(), [
			'topic_id' => 'required|numeric|exists:topics,id',
		], [
			'topic_id.exists' => trans('messages.topic.id.exists'),
			'topic_id.required' => trans('messages.topic.id.required'),
			'topic_id.numeric' => trans('messages.topic.id.numeric'),
		]);

		if ($error = $validator->errors()->first()) {
			return response()->api([], 10001, $error);
		}

		$topic = Topics::find($topic_id)->toArray();
		$topic['cover_img'] = Image::makeImage($topic['cover_img']);

        $username = Cache::tags(['user:'.$topic['creator_uid']])->get();
        if (empty($username)) {
            $userinfo = User::find($topic['creator_uid'])->toArray();
            Cache::tags(['user:'.$topic['creator_uid']])->put('username', $userinfo['username']);
        }
        $topic['creator_username'] = $userinfo['username'];

		if ($topic) {
			return response()->api($topic);
		} else {
			return response()->api([], 10014, trans('messages.failed.to.get.topic'));
		}

	}

	/**
	 * 关注话题列表
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postGetFollowTopics() {

		$this->user->checkLogin();

		$user_follows_model = new TopicFollows;
		$user_follows_result = $user_follows_model->with('Topics')->where('uid', $this->user->uid)->get()->toArray();

		foreach ($user_follows_result as $key => $user_follow) {
			$user_follows[$key]['topic_id'] = $user_follow['topic_id'];
			$user_follows[$key]['title'] = $user_follow['topics']['title'];
			$user_follows[$key]['description'] = $user_follow['topics']['description'];
			$user_follows[$key]['cover_img'] = Image::makeImage($user_follow['topics']['cover_img']);
			$user_follows[$key]['unread_count'] = $user_follow['unread_count'];
			$user_follows[$key]['follow_count'] = $user_follow['topics']['follow_count'];
			$user_follows[$key]['create_at'] = $user_follow['topics']['created_at'];
		}

		if (empty($user_follows)) {
			return response()->api([]);
		} else {
			return response()->api($user_follows);
		}

	}

	/**
	 * 关注话题
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postFollowTopic(Request $request) {

		$this->user->checkLogin();

		$user_follow['topic_id'] = $request->input('topic_id');

		$validator = Validator::make($request->all(), [
			'topic_id' => 'required|numeric|exists:topics,id',
		], [
			'topic_id.exists' => trans('messages.topic.id.exists'),
			'topic_id.required' => trans('messages.topic.id.required'),
			'topic_id.numeric' => trans('messages.topic.id.numeric'),
		]);

		if ($error = $validator->errors()->first()) {
			return response()->api([], 10001, $error);
		}

		// 检查是否已关注
		$result = TopicFollows::where('uid', $this->user->uid)->where('topic_id', $user_follow['topic_id'])->get()->toArray();

		if ($result) {
			return response()->api([], 10027, trans('messages.followed.topic'));
		}

		$user_follow['uid'] = $this->user->uid;

		$result = TopicFollows::create($user_follow);

		if ($result) {
			Redis::hincrby('topic_follow_count', $user_follow['topic_id'], 1);
			return response()->api([]);
		} else {
			return response()->api([], 10022, trans('messages.failed.to.follow.topic'));
		}

	}

	/**
	 * 取消关注话题
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postUnfollowTopic(Request $request) {

		$this->user->checkLogin();

		$user_follow['topic_id'] = $request->input('topic_id');

		$result = TopicFollows::where('uid', $this->user->uid)->where('topic_id', $user_follow['topic_id'])->get()->toArray();

		if (empty($result)) {
			return response()->api([], 10023, trans('messages.topic.havent.followed'));
		}

		$result = TopicFollows::where('uid', $this->user->uid)->where('topic_id', $user_follow['topic_id'])->delete();

		if ($result) {
			Redis::hincrby('topic_follow_count', $user_follow['topic_id'], -1);
			return response()->api([]);
		} else {
			return response()->api([], 10024, trans('messages.failed.to.unfollow.topic'));
		}
 
	}

	/**
	 * 搜索话题话题
	 * @param Request $request 请求参数
	 * @return String JSON
	 */
	public function postSearchTopics(Request $request) {

		$title = $request->input('title');
		// TODO 搜索引擎接入

		$result =  Topics::get()->toArray();

		foreach ($result as $key => $topic) {
			$search_result[$key]['topic_id'] = $topic['id'];
			$search_result[$key]['title'] = $topic['title'];
			$search_result[$key]['description'] = $topic['description'];
			$search_result[$key]['cover_img'] = Image::makeImage($topic['cover_img']);
			$search_result[$key]['follow_count'] = $topic['follow_count'];
			$search_result[$key]['create_at'] = $topic['created_at'];
		}

		if (empty($search_result)) {
			return response()->api([]);
		} else {
			return response()->api($search_result);
		}

	}

}