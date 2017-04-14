@extends('backhome')

@section('title', '后台首页')

@section('keywords', '关键词')

@section('description', '描述')

@section('style')
    <style>
        .hpanel{
            width:18%;
            float:left;
            margin-right: 2%;
        }
    </style>
@endsection

@section('content')

    <div id="wrapper">

        <div class="content animate-panel">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hpanel">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3 class="m-b-xs">内容管理</h3>
                                <div class="m">
                                    <i class="pe-7s-note2 fa-5x"></i>
                                </div>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" aria-expanded="false">快捷操作 <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="/backhome/post">内容列表</a></li>
                                        <li><a href="/backhome/post/create">添加内容</a></li>
                                        <li><a href="/backhome/category">栏目管理</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hpanel">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3 class="m-b-xs">权限管理</h3>
                                <div class="m">
                                    <i class="pe-7s-id fa-5x"></i>
                                </div>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" aria-expanded="false">快捷操作 <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="/backhome/user">管理员</a></li>
                                        <li><a href="/backhome/role">角色</a></li>
                                        <li><a href="/backhome/permission">权限</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hpanel">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3 class="m-b-xs">用户管理</h3>
                                <div class="m">
                                    <i class="pe-7s-users fa-5x"></i>
                                </div>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" aria-expanded="false">快捷操作 <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">用户列表</a></li>
                                        <li><a href="#">用户添加</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hpanel hidden">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3 class="m-b-xs">图片管理</h3>
                                <div class="m">
                                    <i class="pe-7s-graph2 fa-5x"></i>
                                </div>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" aria-expanded="false">快捷操作 <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">图片列表</a></li>
                                        <li><a href="#">图片上传</a></li>
                                        <li><a href="#">图片类型设置</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">又拍云设置</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hpanel hidden">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3 class="m-b-xs">系统管理</h3>
                                <div class="m">
                                    <i class="pe-7s-config fa-5x"></i>
                                </div>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" aria-expanded="false">快捷操作 <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">系统设置</a></li>
                                        <li><a href="#">更新历史</a></li>
                                        <li><a href="#">使用帮助</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">关于作者</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    
@endsection

@section('script')
    <script>
        //菜单定位
        $('#home').parent().children('li').removeClass();
        $('#home').addClass('active');
    </script>
@endsection
