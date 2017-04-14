@extends('backhome')

@section('title', '管理员信息修改')

@section('keywords', '关键词')

@section('description', '描述')
@section('style')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/sweetalert/lib/sweet-alert.css" />
@endsection
@section('content')
    <div id="wrapper">

        <div class="small-header transition">
            <div class="hpanel">
                <div class="panel-body">
                    <div id="hbreadcrumb" class="pull-right">
                        <ol class="hbreadcrumb breadcrumb">
                            <li><a href="/backhome">控制台</a></li>
                            <li>
                                <a href="/backhome/user">管理员管理</a>
                            </li>
                            <li class="active">
                                <span>管理员信息修改</span>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        管理员信息修改
                    </span>
                </div>
            </div>
        </div>

        <div class="content">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="hpanel">
                        <div class="panel-body">
                            <form method="POST" class="p-xxs" name="form_create" class="form-horizontal" id="form_create" action="/backhome/user/update" accept-charset="UTF-8" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" id="id" value="{!!$edit->id!!}"/>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label">名称</label>
                                    <input type="text" class="form-control" name="name" value="{{count($errors)>0?old('name'):$edit->name}}">
                                </div>

                                <div class="form-group hidden{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label">邮箱</label>
                                    <input type="email" class="form-control" name="email" value="{{count($errors)>0?old('email'):$edit->email}}">
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="control-label">密码</label>
                                    <input type="password" class="form-control" name="password" value="{{count($errors)>0?old('password'):$edit->password}}">
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-primary" id="submit" type="submit">保存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="hpanel">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">角色设置</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">权限设置</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                        <form class="form-horizontal" name="form_attachRoles" id="form_attachRoles" role="form" method="POST" action="{{ url('/backhome/user/storeRoles') }}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="user_id" id="user_id" value="{!! $admin->id !!}"/>
                                            <div class="checkbox">
                                                @foreach ($roles as $r)
                                                    <label class="m-t-sm">
                                                        <input type="checkbox" @if(\App\Models\User::isHasRole($getRoles,$r->id)==1) checked @endif name="roles[]" value="{!! $r->id !!}"> {!! $r->description !!}
                                                    </label>
                                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                                @endforeach
                                            </div>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="button" class="btn btn-info" onclick="subRole()">
                                                        <i class="fa fa-btn fa-save"></i> 保存角色设置
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <form class="form-horizontal" name="form_attachPermissions" id="form_attachPermissions" role="form" method="POST" action="{{ url('/backhome/user/storePermissions') }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="user_id" id="user_id" value="{!! $admin->id !!}"/>
                                        <div class="checkbox">
                                            @foreach ($permissions as $p)
                                                <label class="m-t">
                                                    <input type="checkbox" @if(\App\Models\User::isHasPermission($getPermissions,$p->id)==1) checked @endif name="permissions[]" value="{!! $p->id !!}"> {!! $p->description !!}
                                                </label>
                                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                            @endforeach
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="button" class="btn btn-info" onclick="subPermission()">
                                                    <i class="fa fa-btn fa-save"></i> 保存权限设置
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <footer class="footer text-center">

        </footer>

    </div>
@endsection
@section('script')
    <!--tagsinput-->
    <script src="/assets/backhome/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script>
        //添加成功提示
        var meg = GetQueryString('meg');
        if(meg != null){
            var megTxt = '';
            var status = 'success';
            if(meg == 'edit_Success'){
                megTxt = '管理员编辑成功！';
                status = 'success';
            }
            if(meg == 'attach_Roles_Success'){
                megTxt = '管理员角色设置成功！';
                status = 'success';
            }
            else if(meg == 'attach_Roles_Error'){
                megTxt = '管理员角色设置失败！';
                status = 'error';
            }
            else if(meg == 'attach_Permission_Success'){
                megTxt = '管理员权限设置成功！';
                status = 'success';
            }
            else if(meg == 'attach_Permission_Error'){
                megTxt = '管理员权限设置失败！';
                status = 'error';
            }
            var urlhash ='';
            simpleAlert(megTxt,status,urlhash);
        }
        //角色表单提交
        function subRole(){
            $('#form_attachRoles').submit();
        }
        //权限表单提交
        function subPermission(){
            $('#form_attachPermissions').submit();
        }
        //菜单定位
        menu('#permission');

    </script>
@endsection
