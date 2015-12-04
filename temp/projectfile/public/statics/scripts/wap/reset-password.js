var URLS = {
   resetpasswordone:PUBLIC_PATH+"wap/user/resetpasswordone?device_id=123&token=af6fd88255ce353a3402d721b0b3d749:1448591095.3456",

   sendmessage:"http://newapp.xizi.com/wap/user/sendmessage?device_id=123123&token=f88e959b41d5c98d4624d3cee76d6489%3A1448524027.7123",

   resetpasswordtwo:PUBLIC_PATH+"wap/user/resetpasswordtwo?device_id=123&token=af6fd88255ce353a3402d721b0b3d749:1448591095.3456"
}

/*
one：mobile、mobile_random_code
two：password、re_password
*/

$(function(){

   //验证码
   var sign=false;
   var url='';
   $('#getCode').click(function(){
      //获取验证码
      var $tel=$('#tel');
      var m=/^1[3|4|5|7|8][0-9]\d{8}$/;
      if(!m.test($tel.val())){
         xzmui.tips('请填写正确的手机号码');
         return false;
      };

      var self=$(this);

      if (!sign) {

         $.ajax({
            type: "POST",
            url: URLS.sendmessage+'&mobile='+$tel.val(),
            data: {mobile:$tel.val()},
            dataType: "jsonp",
            success: function(data){
               sign=true;
               // var data={code:100,msg:{mcode:12345}};
               if (parseInt(data.code)==100) {
                  $('#code').attr("data-type",'/'+data.msg.mcode+'/');
                  xzmui.tips('获取成功！');
                  self.addClass('btn-disabled');
                  var _second=60;
                  var timer=setInterval(function(){
                     self.text(_second+'s'+'后重发');
                     _second--;
                     if (_second==0){
                        sign=false;
                        self.removeClass('btn-disabled').text('获取验证码');
                        clearInterval(timer);
                     };
                  }, 1000);
               }else{
                  xzmui.tips(data.msg);
                  sign=false;
               }
            }
         });

      };

   });

   xzmui.validform(".form", {
      beforeSubmit: function(form, params){
         var params = '&mobile='+params.mobile+'&mobile_random_code='+params.mobile_random_code;
         $.post(URLS.resetpasswordone+params, params, function(data){
            if(data.code == 100){

            }
         },'json');

         return false;
      }
   });

});
