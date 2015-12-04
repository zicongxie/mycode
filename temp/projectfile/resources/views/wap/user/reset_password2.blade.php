@extends('wap.layouts.base')
@section('pagetitle', '找回密码(2/2)')
@section('content')
<form action="" class="ui-form form fn-form">
   <ul class="ui-list">
      <li class="ui-list-item">
         <div class="ui-form-controls"><input type="password" name="code" placeholder="新密码" class="ui-input-text" data-type="*" data-null="请输入密码" data-error="密码格式错误"></div>
      </li>
      <li class="ui-list-item">
         <div class="ui-form-controls"><input type="password" name="recode" placeholder="确认新密码" class="ui-input-text" data-type="*" data-null="请输入确认密码" data-error="密码格式错误"></div>
      </li>
   </ul>
   <div class="btn-wrap">
      <button type="submit" class="ui-btn ui-btn-warning">重置密码</button>
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
