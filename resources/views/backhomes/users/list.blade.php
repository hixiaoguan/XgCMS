@extends('backhome')

@section('title', $isadmin!=1?'用户管理':'管理员管理')

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
                                @if($isadmin!=1)
                                <a href="/backhome/user">用户管理</a>
                                @else
                                <a href="/backhome/user?isadmin=1">管理员管理</a>
                                @endif
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        @if($isadmin!=1)
                            用户管理
                        @else
                            管理员管理
                        @endif
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
                <div class="col-md-3">
                    <div class="hpanel">
                        <div class="panel-body">
                            <form method="POST" class="p-xxs" name="form_create" class="form-horizontal" id="form_create" action="/backhome/user/store" accept-charset="UTF-8" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="isadmin" id="isadmin" value="{{$isadmin}}"/>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label">名称</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                </div>

                                <div class="form-group hidden{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label">邮箱</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="control-label">密码</label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label class="control-label">重复</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-primary" id="submit" type="submit">保存</button>
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
                                    <input type="text" class="form-control input-sm" placeholder="管理员名" value="{!! $key !!}" name="key" id="key">
                                        <span class="input-group-btn">
                                            <button type="button" id="search" class="btn btn-sm btn-info">搜索</button>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive bg-white border-left border-right">
                            @if(count($user)>0)
                                <table class="table table-hover table-mailbox m-n">
                                    <tbody>
                                    <tr class="active">
                                        <th style="width:10%;" class="text-center">ID</th>
                                        <th style="width:15%;">管理员</th>
                                        <th style="width:30%">Email</th>
                                        <th style="width:15%" class="text-center">状态</th>
                                        <th style="width:15%;" class="text-center">操作</th>
                                    </tr>
                                    @foreach ($user as $u)
                                        <tr>
                                            <td class="text-center">{!!$u->id!!}</td>
                                            <td>{!!$u->name!!}</td>
                                            <td>{!!$u->email!!}</td>
                                            <td class="text-center">
                                                @if($u->disabled==0)
                                                    <button class="btn btn-xs btn-default" onclick="set_disable({!!$u->id!!},0)">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-xs btn-default" onclick="set_disable({!!$u->id!!},1)">
                                                        <i class="fa fa-eye-slash text-danger"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="tooltip-demo p-r-xs">
                                                    <a href="/backhome/user/edit/{!!$u->id!!}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:del({!!$u->id!!})" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
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
                            {!! $user->appends(['key' => $key])->render() !!}
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
        //用户名输入自动拼接邮件后缀
        $('#name').bind('input propertychange', function() {
            $('#email').val($(this).val()+'@'+'{!!env("SUPER_DOMAIN")!!}');
        });
        //设置显示状态
        function set_disable(id,n){
            $.ajax({
                type: "post",
                url: '/backhome/user/disabled',
                data:{'id':id,'disabled':n,'_token':$('meta[name=_token]').attr('content')},
                dataType: "json",
                success: function(data) {
                    window.location.reload();
                    //console.log(data);
                },error: function(data){
                    window.location.reload();
                    console.log(data);
                }
            });
        }
        //用户删除
        function del(id){
            swalAlert(id,'删除','/backhome/user/destroy');
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
        var where = '#user';
        var opMeg = '用户';
        var urlhash ='';
        var opMeg = '用户';
        @if($isadmin==1)
            opMeg = '管理员';
            urlhash ='/backhome/admin?isadmin=1';
        @endif
        var meg = GetQueryString('meg');
        if(meg != null){
            var megTxt = '';
            var status = 'success';
            if(meg == 'add_Success'){
                megTxt = opMeg+'添加成功！';
                status = 'success';
            }
            else if(meg == 'add_Error'){
                megTxt = opMeg+'添加失败！';
                status = 'error';
            }
            simpleAlert(megTxt,status,urlhash);
        }
        //菜单定位
        menu(where);
    </script>
@endsection
