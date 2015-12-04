@extends('wap.layouts.base')
@section('pagetitle', '话题分享')
@section('content')
<div id="topic_share">
		
	<div class="topic-main">
		<div class="top">
			<div class="head">
				<div class="left"><img src="{{url('./statics/images/wap/topic-headimg.png')}}" alt=""></div>
				<div class="right">
					<p>Merryqueen</p>
					<p><i class="ico ico-clock"></i>13天前</p>
				</div>
			</div>
			<h2 class="title"><span class="cl-success">#一个人去旅行#</span>这里漂亮又干净啊啊啊，都不想走了</h2>
			<div class="img-list">
				<img src="{{url('./statics/images/wap/topic-img-1.png')}}" alt="">
				<img src="{{url('./statics/images/wap/topic-img-1.png')}}" alt="">
			</div>
			<div class="location"><i class="ico ico-location"></i><p>广东省惠州市惠城区江北云山西路二号凯宾斯基酒店江北云山西路二号凯宾斯基酒店(江北18号小区) </p></div>
			<div class="xiziquan-download">
				<div class="content">
					<p>Funny</p>
					<p>同城人都在玩</p>
			    </div>
				<div class="btn-download"><button data-href="http://xizi.com">立即下载</button><i class="ico ico-close" id="xzq-close"></i></div>
			</div>
		</div>
		<div class="center">
			<div class="left"><i class="ico ico-support"></i><span>赞</span></div>
			<div class="right">
				<span><img src="{{url('./statics/images/wap/topic-img-5.png')}}" alt="Loading"></span>
				<span><img src="{{url('./statics/images/wap/topic-img-2.png')}}" alt="Loading"></span>
				<span><img src="{{url('./statics/images/wap/topic-img-3.png')}}" alt="Loading"></span>
				<span><img src="{{url('./statics/images/wap/topic-img-4.png')}}" alt="Loading"></span>
				<span><img src="{{url('./statics/images/wap/topic-img-1.png')}}" alt="Loading"></span>
				<span>28</span>
			</div>
		</div>
		<div class="bottom">
			<ul>
				<li>
					<div class="left"><span class="head-img"><img src="{{url('./statics/images/wap/topic-img-1.png')}}" alt=""></span></div>
					<div class="right">
						<p class="title">婶婶爱着你<span class="time">15:28</span></p>
						<div class="content">
							<p>哇，好漂亮，这是哪里啊</p>
						</div>
					</div>
				</li>
				<li>
					<div class="left"><span class="head-img"><img src="{{url('./statics/images/wap/topic-img-3.png')}}" alt=""></span></div>
					<div class="right">
						<p class="title">小逗比<span class="time">15:28</span></p>
						<div class="content">
							<p>很不错</p>
						</div>
					</div>
				</li>
				<li>
					<div class="left"><span class="head-img"><img src="{{url('./statics/images/wap/topic-img-2.png')}}" alt=""></span></div>
					<div class="right">
						<p class="title">Jerry<span class="time">15:28</span></p>
						<div class="content">
							<p><span class="cl-success">回复 婶婶爱着你:</span>这是哪里啊？这是哪里啊？这是哪里啊？这是哪里啊？这是哪里啊？</p>
						</div>
					</div>
				</li>
				<li>
					<div class="left"><span class="head-img"><img src="{{url('./statics/images/wap/topic-img-5.png')}}" alt=""></span></div>
					<div class="right">
						<p class="title">gary<span class="time">15:28</span></p>
						<div class="content">
							<p>又去浪了~~</p>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>

</div>
@stop
@section('pagejs')
<script>
	Do('topic-share.js',function(){
		console.log('topic-share is run');
	})
</script>
@stop
