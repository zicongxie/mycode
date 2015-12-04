@extends('wap.layouts.base')
@section('pagetitle', '找回密码(1/2)')
@section('content')
   <form action="" class="ui-form form fn-form">
      <ul class="ui-list">
         <li class="ui-list-item">
            <div class="ui-form-controls"><input type="text" name="mobile" id="tel" placeholder="输入手机号码" class="ui-input-text" data-type="phone" data-null="请输入手机号码" data-error="手机号码格式错误"></div>
         </li>
         <li class="ui-list-item code-list-item">
            <div class="ui-form-controls"><input type="text" name="mobile_random_code" placeholder="输入验证码" class="ui-input-text" data-type="*" data-null="请输入验证码" data-error="验证码格式错误" id="code"></div>
            <button type="button" class="ui-btn btn-getcode" id="getCode" >获取验证码</button>
         </li>
      </ul>
      <div class="btn-wrap">
         <button type="submit" class="ui-btn ui-btn-warning">下一步</button>
      </div>
   </form>
@stop

@section('pagejs')
<script>
Do('reset-password.js',function(){
   console.log('loaded.');
});
</script>
@stop
