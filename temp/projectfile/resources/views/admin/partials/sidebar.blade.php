<!-- Navigation -->
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            <!-- <a href="../index.html">
                <img src="../images/profile.jpg" class="img-circle m-b" alt="logo">
            </a> -->

            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase">Admin</span>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="../#" data-toggle="dropdown">
                        <small class="text-muted">设置<b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="../contacts.html">Contacts</a></li>
                        <li><a href="../profile.html">Profile</a></li>
                        <li><a href="../analytics.html">Analytics</a></li>
                        <li class="divider"></li>
                        <li><a href="../login.html">退出</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav" id="side-menu">
            <li class="active">
                <a href="#"><span class="nav-label">用户</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ action('Admin\User\UserController@getLists') }}">用户列表</a></li>
                    <li><a href="{{ action('Admin\User\UserController@getRecommendUserLists') }}">推荐用户</a></li>
                    <li><a href="{{ action('Admin\User\UserController@getLockUserLists') }}">用户禁言</a></li>
                    <li><a href="{{ action('Admin\User\UserController@getWhiteUserLists') }}">白名单</a></li>
                    <li>
                        <a href="{{ action('Admin\User\UserController@getDoyenLists') }}"><span class="nav-label">达人管理</span> </a>
                        <ul class="nav nav-third-level">
                            <li><a href="list_master_cate">达人分类列表</a></li>
                            <li><a href="{{ action('Admin\User\UserController@getDoyenLists') }}">达人列表</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">设置</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{action('Admin\Systemsetting\SystemsettingController@getGlobalSettings')}}">全局设置</a></li>
                    <li><a href="{{action('Admin\Systemsetting\SystemsettingController@getCategories')}}">大类设置</a></li>
                    <li><a href="{{action('Admin\Systemsetting\SystemsettingController@getLocationLists')}}">区域设置</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">广告</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{action('Admin\Advert\AdvertController@getAdvertPositions')}}">广告位</a></li>
                    <li><a href="{{action('Admin\Advert\AdvertController@getAdvertLists')}}">广告</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">话题</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{action('Admin\Topic\AuditingController@getIndex')}}">话题审核</a></li>
                    <li><a href="{{action('Admin\Topic\ManageController@getIndex')}}">话题管理</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">内容</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{action('Admin\Posts\PostsAuditingController@getIndex')}}">内容审核</a></li>
                    <li><a href="{{action('Admin\Posts\ReviewAuditingController@getIndex')}}">回复审核</a></li>
                    <li><a href="{{action('Admin\Posts\SensitiveController@getIndex')}}">敏感词管理</a></li>
                    <li><a href="{{action('Admin\Posts\PostsReportController@getIndex')}}">内容举报</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
