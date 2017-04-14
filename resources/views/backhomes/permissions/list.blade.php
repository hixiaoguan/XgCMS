@extends('backhome')

@section('title', '权限列表')

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
                                <a href="/backhome/permission">{!! $location !!}</a>
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
                @if(count($permissionEdit)>0)
                    <div class="col-md-3 animate-panel" data-child="edit" data-effect="fadeInRight">
                        <div class="hpanel edit" style="border:2px solid #3498db;">
                            <div class="panel-heading hbuilt" style="background:#3498db;color:#fff;">
                                编辑权限
                            </div>
                            <div class="panel-body">
                                @else
                                    <div class="col-md-3">
                                        <div class="hpanel">
                                            <div class="panel-heading hbuilt">
                                                添加权限
                                            </div>
                                            <div class="panel-body">
                                                @endif
                                                <form method="POST" class="p-xxs" name="form_create" class="form-horizontal" id="form_create" action="{!! $action !!}" accept-charset="UTF-8" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}

                                                    @if(count($permissionEdit)>0)
                                                        <input type="hidden" name="id" id="id" value="{!! $permissionEdit->id !!}"/>
                                                    @endif

                                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                        <label class="control-label">权限名称</label>
                                                        <input type="text" class="form-control" name="name" value="@if(count($permissionEdit)>0){!! $permissionEdit->name !!}@else{!!old('name')!!}@endif">
                                                    </div>

                                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                                        <label class="control-label">权限别名</label>
                                                        <input type="slug" class="form-control" name="slug" value="@if(count($permissionEdit)>0){!! $permissionEdit->slug !!}@else{!!old('slug')!!}@endif">
                                                    </div>

                                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                        <label class="control-label">权限描述</label>
                                                        <input type="description" class="form-control" name="description" value="@if(count($permissionEdit)>0){!! $permissionEdit->description !!}@else{!!old('description')!!}@endif">
                                                    </div>

                                                    <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                                        <label class="control-label">权限列表</label>
                                                        <select class="form-control" name="level" id="level" style="width: 100%">
                                                            @if(count($permissionEdit)>0)
                                                                <option @if($permissionEdit->level==1) selected @endif value="1">会员权限</option>
                                                                <option @if($permissionEdit->level==2) selected @endif value="2">管理员权限</option>
                                                            @else
                                                                <option @if(old('level')==1) selected @endif value="1">会员权限</option>
                                                                <option @if(old('level')==2) selected @endif value="2">管理员权限</option>
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="form-group text-center">
                                                        <button class="btn btn-primary" id="submit" type="submit">
                                                            @if(count($permissionEdit)>0)
                                                                保存编辑
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
                                                        <input type="text" class="form-control input-sm" placeholder="权限名" value="{!! $key !!}" name="key" id="key">
                                        <span class="input-group-btn">
                                            <button type="button" id="search" class="btn btn-sm btn-info">搜索</button>
                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive bg-white border-left border-right">
                                                @if(count($permission)>0)
                                                    <table class="table table-hover table-mailbox m-n">
                                                        <tbody>
                                                        <tr class="active">
                                                            <th style="width:10%;" class="text-center">ID</th>
                                                            <th style="width:15%;">权限</th>
                                                            <th style="width:15%;">别名</th>
                                                            <th style="width:25%">描述</th>
                                                            <th style="width:20%">分类</th>
                                                            <th style="width:15%;" class="text-center">操作</th>
                                                        </tr>
                                                        @foreach ($permission as $r)
                                                            <tr @if(count($permissionEdit)>0 && $permissionEdit->id == $r->id) style="background: #3498db; color:#fff;" @endif>
                                                                <td class="text-center">{!!$r->id!!}</td>
                                                                <td>{!!$r->name!!}</td>
                                                                <td>{!!$r->slug!!}</td>
                                                                <td>{!!$r->description!!}</td>
                                                                <td>{!!$r->level==1?'会员权限':'管理员权限'!!}</td>
                                                                <td class="text-center">
                                                                    <div class="tooltip-demo p-r-xs">
                                                                        <a href="/backhome/permission/?id={!!$r->id!!}" class="btn btn-xs btn-info @if(count($permissionEdit)>0 && $permissionEdit->id == $r->id) hidden @endif" data-toggle="tooltip" data-placement="top" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
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
                                                {!! $permission->appends(['key' => $key])->render() !!}
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
                        //权限删除
                        function del(id){
                            swalAlert(id,'删除','/backhome/permission/destroy');
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
                                megTxt = '权限添加成功！';
                                status = 'success';
                            }
                            else if(meg == 'add_Error'){
                                megTxt = '权限添加失败！';
                                status = 'error';
                            }
                            else if(meg == 'edit_Success'){
                                megTxt = '权限编辑成功！';
                                status = 'success';
                            }
                            else if(meg == 'edit_Error'){
                                megTxt = '权限编辑失败！';
                                status = 'error';
                            }
                            else if(meg == 'del_Success'){
                                megTxt = '权限删除成功！';
                                status = 'success';
                            }
                            else if(meg == 'del_Error'){
                                megTxt = '权限删除失败！';
                                status = 'error';
                            }
                            var urlhash ='';
                            simpleAlert(megTxt,status,urlhash);
                        }
                        //菜单定位
                        menu('#permission');
                    </script>
@endsection
