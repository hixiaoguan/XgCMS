@extends('backhome')

@section('title', '角色列表')

@section('keywords', '关键词')

@section('description', '描述')
@section('style')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/sweetalert/lib/sweet-alert.css" />
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/select2-3.5.2/select2.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/assets/backhome/vendor/datetimepicker_cn/css/jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="/assets/backhome/vendor/datetimepicker_cn/css/jquery-ui-timepicker-addon.css" />
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
                                <a href="/backhome/role">{!! $location !!}</a>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        {!! $location !!}
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
            @if(count($roleEdit)>0)
            <div class="col-md-3 animate-panel" data-child="edit" data-effect="fadeInRight">
                <div class="hpanel edit" style="border:2px solid #3498db;">
                    <div class="panel-heading hbuilt" style="background:#3498db;color:#fff;">
                        编辑角色
                    </div>
                <div class="panel-body">
            @else
            <div class="col-md-3">
                <div class="hpanel">
                    <div class="panel-heading hbuilt">
                        添加角色
                    </div>
                <div class="panel-body">
            @endif
                            <form method="POST" class="p-xxs" name="form_create" class="form-horizontal" id="form_create" action="{!! $action !!}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {!! csrf_field() !!}

                                @if(count($roleEdit)>0)
                                    <input type="hidden" name="id" id="id" value="{!! $roleEdit->id !!}"/>
                                @endif

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label">角色名称</label>
                                    <input type="text" class="form-control" name="name" value="@if(count($roleEdit)>0){!! $roleEdit->name !!}@else{!!old('name')!!}@endif">
                                </div>

                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    <label class="control-label">角色别名</label>
                                    <input type="slug" class="form-control" name="slug" value="@if(count($roleEdit)>0){!! $roleEdit->slug !!}@else{!!old('slug')!!}@endif">
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label class="control-label">角色描述</label>
                                    <input type="description" class="form-control" name="description" value="@if(count($roleEdit)>0){!! $roleEdit->description !!}@else{!!old('description')!!}@endif">
                                </div>

                                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label class="control-label">角色级别</label>
                                    <select class="form-control" name="level" id="level" style="width: 100%">
                                        @if(count($roleEdit)>0)
                                            <option @if($roleEdit->level==1) selected @endif value="1">会员角色</option>
                                            <option @if($roleEdit->level==2) selected @endif value="2">管理员角色</option>
                                        @else
                                            <option @if(old('level')==1) selected @endif value="1">会员角色</option>
                                            <option @if(old('level')==2) selected @endif value="2">管理员角色</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" id="submit" type="submit">
                                        @if(count($roleEdit)>0)
                                            保存
                                        @else
                                            添加
                                        @endif
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="hpanel">
                        <div class="panel-heading hbuilt">
                            <div class="text-center p-xs font-normal">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" placeholder="角色名" value="{!! $key !!}" name="key" id="key">
                                        <span class="input-group-btn">
                                            <button type="button" id="search" class="btn btn-sm btn-info">搜索</button>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive bg-white border-left border-right">
                            @if(count($role)>0)
                                <table class="table table-hover table-mailbox m-n">
                                    <tbody>
                                    <tr class="active">
                                        <th style="width:10%;" class="text-center">ID</th>
                                        <th style="width:15%;">角色</th>
                                        <th style="width:15%;">别名</th>
                                        <th style="width:25%">描述</th>
                                        <th style="width:20%" class="text-center">类型</th>
                                        <th style="width:15%;" class="text-center">操作</th>
                                    </tr>
                                    @foreach ($role as $r)
                                        <tr @if(count($roleEdit)>0 && $roleEdit->id == $r->id) style="background: #3498db; color:#fff;" @endif>
                                            <td class="text-center">{!!$r->id!!}</td>
                                            <td>{!!$r->name!!}</td>
                                            <td>{!!$r->slug!!}</td>
                                            <td>{!!$r->description!!}</td>
                                            <td class="text-center">{!!$r->level==1?'会员角色':'管理员角色'!!}</td>
                                            <td class="text-center">
                                                <div class="tooltip-demo p-r-xs">
                                                        <a href="/backhome/role/?id={!!$r->id!!}" class="btn btn-xs btn-info @if(count($roleEdit)>0 && $roleEdit->id == $r->id) hidden @endif" data-toggle="tooltip" data-placement="top" data-original-title="编辑"><i class="fa fa-pencil"></i></a>

                                                    <a href="javascript:setPermissions({!!$r->id!!})" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" data-original-title="赋予权限"><i class="fa fa-plus"></i></a>
                                                    <a href="javascript:del({!!$r->id!!})" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="hpanel m-l-md m-r-md">
                                    <div class="panel-body text-center">
                                        没有数据！
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="panel-footer text-center" style="border-top:1px solid #ddd;">
                            {!! $role->appends(['key' => $key])->render() !!}
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <footer class="footer text-center">

        </footer>

        <!--Permission Modal-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header text-left" style="padding:15px">
                        <h5>权限设置</h5>
                    </div>
                    <div class="modal-body">
                        <div class="checkbox">
                            @foreach ($permissions as $p)
                                <label class="m-t">
                                    <input type="checkbox" name="permissions[]" value="{!! $p->id !!}"> {!! $p->description !!}
                                </label>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" id="permissionForm">保存</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/Permission Modal-->


    </div>
@endsection
@section('script')
    <!--tagsinput-->
    <script src="/assets/backhome/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script>
        //角色删除
        function del(id){
            swalAlert(id,'删除','/backhome/role/destroy');
        }
        //赋予权限
        function setPermissions(id){
            //清掉所有
            $("input[type='checkbox']").each(function(){
                $(this)[0]["checked"]=false;
            });
            //ajax 请求该角色所有权限
            $.ajax({
                type:"post",
                url:"/backhome/role/getPermissions",
                data:{'id':id,'_token':$('meta[name=_token]').attr('content')},
                dataType:"json",
                success: function(data){
                    if(data.length>0){
                        var getPermissions = data;
                        //把等于指定id的权限选中
                        function checkedBox(id){
                            $("input[type='checkbox']").each(function(){
                                if($(this)[0].value==id){
                                    $(this)[0]["checked"]=true;
                                }
                            });
                        }
                        for(var i=0; i<getPermissions.length;i++){
                            //将当前id赋值给
                            checkedBox(getPermissions[i].id);
                        }

                    }
                }
            });
            $('#myModal').modal();
            //modal 点击保存后
            $('#permissionForm').on('click',
            function() {
                var isCheckeds = new Array();
                for(var i=0; i<$("input[type='checkbox']").length; i++){
                    if($("input[type='checkbox']")[i]["checked"]==true){
                        isCheckeds.push($("input[type='checkbox']")[i].value);
                    }
                }
                //console.log(id,isCheckeds);
                $.ajax({
                    type:"post",
                    url:"/backhome/role/storePermissionsForRole",
                    data:{'role_id':id,'permissions':isCheckeds,'_token':$('meta[name=_token]').attr('content')},
                    dataType:"json",
                    success: function(data){
                        var url = getUrl();
                        if(data==1){
                            window.location.href = url['url']+'?meg=save_Permissions_Success';
                        }else{
                            window.location.href = url['url']+'?meg=save_Permissions_Error';
                        }
                    }
                });
            });
        }
        //搜索
        $('#search').click(function(){
            var key = $('#key').val();
            //根据筛选条件拼接当前URL
            var url = getUrl();
            if(key==''){
                window.location.href = url['url'];
            }else{
                if(url['key']!=key){
                    url['key']=key;
                }
                window.location.href = url['url']+'?key='+url['key'];
            }
        });
        //监听回车键
        $('#key').bind('keyup', function(event) {
            if (event.keyCode == "13") {
                //回车执行查询
                $('#search').click();
            }
        });

        //添加成功提示
        var meg = GetQueryString('meg');
        if(meg != null){
            var megTxt = '';
            var status = 'success';
            if(meg == 'add_Success'){
                megTxt = '角色添加成功！';
                status = 'success';
            }
            else if(meg == 'add_Error'){
                megTxt = '角色添加失败！';
                status = 'error';
            }
            else if(meg == 'edit_Success'){
                megTxt = '角色编辑成功！';
                status = 'success';
            }
            else if(meg == 'edit_Error'){
                megTxt = '角色编辑失败！';
                status = 'error';
            }
            else if(meg == 'del_Success'){
                megTxt = '角色删除成功！';
                status = 'success';
            }
            else if(meg == 'del_Error'){
                megTxt = '角色删除失败！';
                status = 'error';
            }
            else if(meg == 'save_Permissions_Success'){
                megTxt = '角色权限设置成功！';
                status = 'success';
            }
            else if(meg == 'save_Permissions_Error'){
                megTxt = '角色权限设置失败！';
                status = 'error';
            }
            var urlhash ='';
            simpleAlert(megTxt,status,urlhash);
        }
        //菜单定位
        menu('#permission');
    </script>
@endsection
