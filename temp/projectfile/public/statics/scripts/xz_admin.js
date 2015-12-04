var xzui = xzui || {};


$(function(){

   //日期范围选择
   $('.input-daterange').datepicker({
      language: 'zh-CN',
      format: 'yyyy-mm-dd'
    });

    Do('daterangepicker',function(){

      $('input[name="daterange"]').daterangepicker({
         opens : "right", //日期选择框的弹出位置
         format: "YYYY-MM-DD",
         separator: " - ",
         startDate: moment().startOf("month"),
         endDate: moment(),
         //   minDate: "2012-01-01",
         //   maxDate: "2012-12-30",
         ranges : {
            //"最近1小时": [moment().subtract("hours",1), moment()],
            "今日": [moment().startOf("day"), moment().startOf("day")],
            "昨日": [moment().subtract("days", 1).startOf("day"), moment().subtract("days", 1).endOf("day")],
            "最近7日": [moment().subtract("days", 6), moment()],
            "最近30日": [moment().subtract("days", 29), moment()]
         },
         locale: {
            applyLabel: "确定",
            cancelLabel: "取消",
            fromLabel: "开始日期",
            toLabel: "截止日期",
            customRangeLabel: "自定义",
            daysOfWeek: ["日", "一", "二", "三", "四", "五", "六"],
            monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            firstDay: 1
         }
      });

   });

    //图片处理
    $("img").error(function() {
      $(this).attr("src", IMG_PATH + "/iconfont-404.png");
      $(this).css({
         background:'#fff;'
      });
    });

   $(document).on('click','[data-toggle="ajax_update"]',function(){
      var $button = $(this);
      var request_url = $button.data('href');
      var current_status = $button.data('status');
      var status_text = $button.data('text').split(',');
      var status_vals = $button.data('status-vals') || ['0','1'];
      var classes = $button.data('classes') || 'btn-warning btn-default';

      $.getJSON(request_url,{status:current_status},function(data){
         if(data.status == 1){
            $button.toggleClass(classes);
            $button.toggleAttr('data-status',status_vals);
            $button.toggleText(status_text[0], status_text[1]);
         }
      });
   });




});
   //表单验证
   //form元素需要“.html5Form”，提交按钮“.js-submit”,按钮类型最好不用submit
   $(".html5Form").attr('novalidate','novalidate');
   $(".html5Form .js-submit").on('click',function(){
      var $form=$(this).closest('.html5Form');
      if($.html5Validate.isAllpass($form)){
          $form.trigger('submit');
      }
      return false;
   })