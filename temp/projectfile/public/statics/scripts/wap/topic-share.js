// document.querySelector('html').setAttribute('id', 'topic_share');    //添加大选择器
$('#xzq-close').on('touchstart',function(e){
	$(this).parents('.xiziquan-download').remove();
	e.stopPropagation();
});