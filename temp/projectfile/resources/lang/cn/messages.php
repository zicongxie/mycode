<?php

return [

	// POST
    'post.banned' => '禁止发PO',
    'empty.post.id' => '请选择PO',
    'nonexistent.post' => '该PO不存在',
    'liked.post' => '已赞过该PO',
    'post.havent.liked' => '没有赞过该PO',
    'like.banned' => '禁止赞',
    'failed.to.post' => '发PO失败',
    'failed.to.get.post' => '获取PO失败',

    // 话题
    'followed.topic' => '已关注该话题',
    'failed.to.follow.topic' => '关注话题失败',
    'topic.havent.followed' => '未关注该话题',
    'failed.to.unfollow.topic' => '取消关注话题失败',
    'creating.topic.banned' => '禁止创建话题',
    'editing.topic.banned' => '禁止编辑话题',
    'failed.to.create.topic' => '创建话题失败',
    'failed.to.get.topic' => '获取话题失败',

    // 评论
    'failed.to.review' => '发表评论失败',
    'review.banned' => '禁止评论',

    // 验证类提示
    'topic.title.required' => '请填写话题名称',
    'topic.title.between' => '话题名称长度应在:max个字符以内',
    'topic.title.unique' => '该话题已存在',
    'topic.description.required' => '请填写话题描述',
    'topic.description.between' => '标题描述长度应在:max个字符以内',
    'topic.title.sensitive' => '话题名称包含敏感词',
    'topic.description.sensitive' => '话题描述包含敏感词',

    'post.id.required' => '请选择PO',
    'post.id.exists' => '该PO不存在',
    'post.id.numeric' => 'PO的ID必须为数字',
    'reply.uid.numeric' => '回复UID必须为数字',
    'reply.uid.exists' => '回复UID不存在',
    'review.content.required' => '请填写回复内容',
    'review.content.between' => '回复内容应在:max个字符以内',
    'review.content.sensitive' => '回复内容包含敏感词',

    'topic.id.required' => '请选择话题',
    'topic.id.exists' => '该话题不存在',
    'topic.id.numeric' => '话题ID必须为数字',
    'activity.id.numeric' => '活动ID必须为数字',
    'post.content.required' => '请填写PO内容',
    'post.content.between' => '内容应在:max字符以内',
    'post.content.sensitive' => 'PO内容包含敏感词'

];