var popup=function(opts){
  var defaults={
    css:{
      mainColor:'#FFC600',
      bgColor:'#fff',
      borderColor:'#fff'
    },
    title:'投票成功',
    content:['恭喜您为您支持的作品投上一票','支持的作品投上一票'],
    buttonText:'快去花积分，赢取奖励吧！',
    text:'',
    href:'#'
  };
  this.opts=$.extend(defaults,opts);
  this.opts.text=this.opts.content[0];
  for (var i = 1; i < this.opts.content.length; i++) {
    this.opts.text+='<br>'+this.opts.content[i];
  };
};
popup.prototype={
  init:function(){
    this.tpl='<div class="shadow"></div>'+
            '<div class="popup" id="popup" style="background:'+this.opts.css.bgColor+'">'+
            '<div class="title" style="color:'+this.opts.css.bgColor+';border-color:'+this.opts.css.borderColor+'">'+this.opts.title+'</div>'+
            '<div class="content" style="color:'+this.opts.css.mainColor+'">'+this.opts.text+'</div>'+
            '<a href="'+this.opts.href+'" class="ui-btn ui-btn-warning" style="background:'+this.opts.css.mainColor+';color:'+this.opts.css.bgColor+'">'+this.opts.buttonText+'</a>'+
          '</div>';
    $('body').append(this.tpl);
    this.shadow=$('.shadow');
    this.popup=$('#popup');
    return this.close();
    return this.show();
  },
  close:function(){
    var _=this;
    this.shadow.click(function(){
      _.popup.remove();
      _.shadow.css({'opacity':0});
      setTimeout(function(){
        _.shadow.remove();
      },800);
    });
  },
  show:function(opts){
    this.opts=$.extend(this.opts,opts);
    return this.init();
  }
};
