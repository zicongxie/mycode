@foreach($list as $info)
    Topic：{{$info->title}} -> user：{{$info->user->username}} -> categores：{{$info->cate->title}}
    <br>
@endforeach
<?php echo $list->render(); ?>