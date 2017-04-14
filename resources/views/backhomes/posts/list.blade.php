@extends('backhome')

@section('title', '内容列表')

@section('keywords', '关键词')

@section('description', '描述')
@section('style')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/tagsinput/dist/jquery.tagsinput.min.css" />
    <link rel="stylesheet" href="/assets/backhome/vendor/sweetalert/lib/sweet-alert.css" />
    <link rel="stylesheet" href="/assets/backhome/vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" />
    <style>
        #post-list td{
            vertical-align:middle;
        }
    </style>
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
                                <a href="/backhome/post">内容管理</a>
                            </li>
                            <li class="active">
                                <span>内容列表</span>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        内容列表
                    </span>
                </div>
            </div>
        </div>
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="hpanel">
                        <div class="panel-heading hbuilt">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="p-xxs">
                                        <a href="/backhome/post/create" class="btn btn-info btn-sm" type="button">
                                            <i class="fa fa-plus"></i>
                                            <span class="bold">添加</span>
                                        </a>
                                        @if($status==1)
                                            <button onclick="check(getChecks())" class="btn btn-success btn-sm test" type="button">
                                                <i class="fa fa-check"></i>
                                                <span class="bold">审核</span>
                                            </button>
                                        @endif
                                        @if($status==1 || $status==0)
                                            <button onclick="del(getChecks())" class="btn btn-danger btn-sm" type="button">
                                                <i class="fa fa-trash-o"></i>
                                                <span class="bold">删除</span>
                                            </button>
                                        @endif
                                        @if($status==2)
                                            <button onclick="revert(getChecks())" class="btn btn-primary btn-sm" type="button">
                                                <i class="fa fa-mail-reply-all"></i>
                                                <span class="bold">还原</span>
                                            </button>
                                            <button onclick="bye(getChecks())" class="btn btn-danger btn-sm" type="button">
                                                <i class="fa fa-times-circle"></i>
                                                <span class="bold">清除</span>
                                            </button>
                                        @endif
                                        @if($post->currentPage()!=1)
                                            <a href="{!! $post->previousPageUrl() !!}" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i></a>
                                        @else
                                            <button class="btn btn-default btn-sm" disabled><i class="fa fa-arrow-left"></i></button>
                                        @endif
                                        @if($post->currentPage() < $post->lastPage())
                                            <a href="{!! $post->nextPageUrl() !!}" class="btn btn-default btn-sm"><i class="fa fa-arrow-right"></i></a>
                                        @else
                                            <button class="btn btn-default btn-sm" disabled><i class="fa fa-arrow-right"></i></button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="font-normal p-xxs">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="true">
                                                    @if($status=='1')
                                                        待审
                                                    @elseif($status=='2')
                                                        回收站
                                                    @elseif($status=='3')
                                                        置顶的
                                                    @elseif($status=='4')
                                                        推荐的
                                                    @elseif($status=='all')
                                                        全部
                                                    @else
                                                        筛选
                                                    @endif
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:status('0')">正常</a></li>
                                                    <li><a href="javascript:status('1')">待审</a></li>
                                                    <li><a href="javascript:status('2')">回收站</a></li>
                                                    <li><a href="javascript:status('3')">置顶的</a></li>
                                                    <li><a href="javascript:status('4')">推荐的</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="javascript:status('all')">全部</a></li>
                                                </ul>
                                            </div>
                                            <input type="text" name="key" id="key" class="form-control input-sm" value="{!! $key !!}" placeholder="请输入搜索关键字">
                                    <span class="input-group-btn">
                                        <button type="button" id="search" class="btn btn-sm btn-info">搜索</button>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white">
                            <div class="table-responsive table-bordered">
                                @if(count($post) > 0)
                                <table class="table table-hover table-mailbox no-margins border-bottom" id="post-list">
                                    <tbody>
                                    <tr class="active">
                                        <th style="width:3%">
                                            <div class="checkbox checkbox-single checkbox-success">
                                                <input type="checkbox" id="btnCheckAll">
                                                <label></label>
                                            </div>
                                        </th>
                                        <th style="width: 5%">ID</th>
                                        <th style="width: 27%">标题</th>
                                        <th style="width: 10%;">栏目</th>
                                        <th style="width: 15%;" class="text-center">标记</th>
                                        <th style="width: 10%;">作者</th>
                                        <th style="width: 10%;">时间</th>
                                        <th style="width: 20%;" class="text-center">操作</th>
                                    </tr>
                                    @foreach ($post as $p)
                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-single checkbox-success">
                                                    <input type="checkbox" name="chkItem" value="{!!$p->id!!}">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td>{!!$p->id!!}</td>
                                            <td>
                                                <a class="media-left media-middle" href="/backhome/post/show/{!!$p->id!!}">
                                                    {!!$p->title!!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="media-left media-middle" href="/backhome/post?cateid={{$p->cateid}}">
                                                    {{\App\Models\Category::getCateName($p->cateid)}}
                                                </a>
                                            </td>
                                            <td class="text-center tooltip-demo">
                                                @if($p->thumbnail!='')
                                                    <button class="btn btn-default btn-xs" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="<img width='100%' src='{!!$p->thumbnail!!}'/>">
                                                        <i class="fa fa-image"></i>
                                                    </button>
                                                @endif
                                                @if($p->type==2)
                                                    <button class="btn btn-default btn-xs" type="button" data-toggle="tooltip" data-placement="top" data-original-title="链接：{{$p->link}}">
                                                        <i class="fa fa-link"></i>
                                                    </button>
                                                @endif
                                                @if($p->top==1)
                                                    <button class="btn btn-default btn-xs" type="button" data-toggle="tooltip" data-placement="top" data-original-title="置顶的">
                                                        <i class="fa fa-arrow-up"></i>
                                                    </button>
                                                @endif
                                                @if($p->rec==1)
                                                    <button class="btn btn-default btn-xs" type="button"  data-toggle="tooltip" data-placement="top" data-original-title="推荐的">
                                                        <i class="fa fa-star"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="media-left media-middle" href="/backhome/post?userid={{$p->user_id}}">
                                                {{\App\Models\User::getUserName($p->user_id)}}
                                                </a>
                                            </td>
                                            <td class="tooltip-demo">
                                                <span data-toggle="tooltip" data-placement="top" data-original-title="{{ $p->created_at->toDateTimeString() }}">{{ $p->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="tooltip-demo p-r-xs">
                                                @if(Auth::check())
                                                    <a href="/backhome/post/show/{!!$p->id!!}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" data-original-title="查看"><i class="fa fa-eye"></i></a>
                                                        <a href="javascript:up({{$p->id}})" class="btn btn-xs btn-primary2" data-toggle="tooltip" data-placement="top" data-original-title="向上"><i class="fa fa-level-up"></i></a>
                                                        <a href="javascript:down({{$p->id}})" class="btn btn-xs btn-danger2" data-toggle="tooltip" data-placement="top" data-original-title="向下"><i class="fa fa-level-down"></i></a>
                                                        <a href="/backhome/post/edit/{!!$p->id!!}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
                                                        @if($p->status==1)
                                                        <a href="javascript:check({{$p->id}})" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" data-original-title="审核"><i class="fa fa-check"></i></a>
                                                        @endif
                                                        @if($p->status!=2)
                                                        <a href="javascript:del({{$p->id}})" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
                                                        @endif
                                                        @if($p->status==2)
                                                            <a href="javascript:bye({{$p->id}})" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="fa fa-times-circle"></i></a>
                                                        @endif
                                                        @if($p->status==2)
                                                        <a href="javascript:revert({{$p->id}})" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="还原"><i class="fa fa-mail-reply-all"></i></a>
                                                        @endif
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="hpanel m-l-md m-r-md m-t-md">
                                        <div class="panel-body text-center">
                                            没有数据！
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Footer-->
        <footer class="footer text-center">
            {!! $post->appends(['key' => $key,'status' => $status,'cateid' => $cateid,'userid' => $userid])->render() !!}
        </footer>

    </div>
@endsection
@section('script')
    <script src="/assets/backhome/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script>
        //根据状态筛选
        function status(n){
            //根据筛选条件拼接当前URL
            var url = getUrl();
            if(url['status']!=n){
                url['status']=n;
            }
            changeUrl(url);
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
                changeUrl(url);
            }
        });
        //向上一条
        function up(id){
            $.ajax({
                type: "post",
                url: '/backhome/post/up',
                data:{'id':id,'_token':$('meta[name=_token]').attr('content')},
                dataType: "json",
                success: function(data) {
                    if(data.code == '200'){
                        window.location.reload();
                    }else{
                        swal({
                            title: "已是第一条!",
                            text: "",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },error: function(){
                    swal({
                        title: "排序失败!",
                        text: "",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        //向下一条
        function down(id){
            $.ajax({
                type: "post",
                url: '/backhome/post/down',
                data:{'id':id,'_token':$('meta[name=_token]').attr('content')},
                dataType: "json",
                success: function(data) {
                    if(data.code == '200'){
                        window.location.reload();
                    }else{
                        swal({
                            title: "已是最后一条!",
                            text: "",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },error: function(){
                    swal({
                        title: "排序失败!",
                        text: "",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        //清空回收站，彻底删除
        function bye(ids){
            swalAlert(ids,'清空','/backhome/post/destroy');
        }
        //删除
        function del(ids){
            swalAlert(ids,'删除','/backhome/post/del');
        }
        //还原
        function revert(ids){
            swalAlert(ids,'还原','/backhome/post/revert');
        }
        //审核
        function check(ids){
            swalAlert(ids,'审核','/backhome/post/check');
        }
        //监听回车键
        $('#key').bind('keyup', function(event) {
            if (event.keyCode == "13") {
                //回车执行查询
                $('#search').click();
            }
        });
        //菜单定位
        menu('#con');
    </script>
@endsection