/**
* created at 2015-11-23
* Do.js 文档 http://kejun.github.io/Do/
**/

Do.add('xz_uploader', {
    path: STATICS_PATH+'/scripts/xz_uploader.js',
    type: 'js',
    requires: [
      STATICS_PATH+'/vendor/webuploader/webuploader.min.js',
      STATICS_PATH+'/vendor/webuploader/webuploader.css'
   ]
});

Do.add('editable',{
    path: STATICS_PATH+'/vendor/xeditable/bootstrap3-editable/js/bootstrap-editable.min.js',
    type: 'js',
    requires: [
      STATICS_PATH+'/vendor/xeditable/bootstrap3-editable/css/bootstrap-editable.css'
   ]
});

Do.add('toastr',{
    path: STATICS_PATH+'/vendor/toastr/build/toastr.min.js',
    type: 'js',
    requires: [
      STATICS_PATH+'/vendor/toastr/build/toastr.min.css'
   ]
})

Do.add('picbox',{
    path: STATICS_PATH+'/vendor/picbox/js/picbox.js',
    type: 'js',
    requires: [
      STATICS_PATH+'/vendor/picbox/js/jquery-migrate-1.2.1.min.js',
      STATICS_PATH+'/vendor/picbox/css/picbox.css'
   ]
})

Do.add('dataTable',{
    path: STATICS_PATH+'/vendor/datatables_plugins/integration/bootstrap/3/dataTables.bootstrap.min.js',
    type: 'js',
    requires: [
      STATICS_PATH+'/vendor/datatables/media/js/jquery.dataTables.min.js',
      STATICS_PATH+'/vendor/datatables_plugins/integration/bootstrap/3/dataTables.bootstrap.css'
   ]
})
Do.add('jquery-flot',{
    path: STATICS_PATH+'/vendor/jquery-flot/jquery.flot.js',
    type: 'js',
   //  requires: [
   //    STATICS_PATH+'/vendor/jquery-flot/jquery.flot.resize.js',
   //    STATICS_PATH+'/vendor/jquery-flot/jquery.flot.pie.js'
   // ]
})

Do.add('daterangepicker',{
    path: STATICS_PATH+'/vendor/bootstrap-daterangepicker/daterangepicker.js',
    type: 'js',
    requires: [
      STATICS_PATH+'/vendor/bootstrap-daterangepicker/moment.js',
      STATICS_PATH+'/vendor/bootstrap-daterangepicker/daterangepicker.css'
   ]
})


Do.ready(function(){
   //DO SOMETHING...
   // console.log('dojs ready..');
});
