@extends('backhome')

@section('title', '栏目管理')

@section('keywords', '关键词')

@section('description', '描述')
@section('style')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/sweetalert/lib/sweet-alert.css" />
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/tagsinput/dist/jquery.tagsinput.min.css" />
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
                                <a href="/backhome/category">栏目管理</a>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        栏目管理
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
                            <div class="panel-heading hbuilt">
                                添加栏目
                            </div>
                            <div class="panel-body">
                                <form method="POST" class="p-xxs" name="form_create" class="form-horizontal" id="form_create" action="/backhome/category/store" accept-charset="UTF-8" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">名称</label>
                                        <input class="form-control tags" name="name" type="text" id="name" value="{!! old('name') !!}"/>
                                    </div>
                                    <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                                        <label class="control-label">别名</label>
                                        <input class="form-control tags" name="alias" type="text" id="alias" value="{!! old('alias') !!}"/>
                                    </div>
                                    <div class="form-group{{ $errors->has('parentid') ? ' has-error' : '' }}">
                                        <label class="control-label">父级</label>
                                        <select class="form-control" name="parentid" id="parentid" style="width: 100%">
                                            <option value="0">无</option>
                                            @foreach($categoryList as $cl)
                                                <option value="{!!$cl->cateid!!}" @if(old('parentid')==$cl->cateid) selected @endif>
                                                    {!!$cl->name!!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                                        <label class="control-label">关键字 (输入完后回车即可)</label>
                                        <input class="form-control tags" name="keywords" type="text" id="keywords" value="{!! old('keywords') !!}"/>
                                    </div>
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label class="control-label">描述</label>
                                        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{!! old('description') !!}</textarea>
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
                                        <input type="text" class="form-control input-sm" placeholder="类别名" value="{!! $key !!}" name="key" id="key">
                                        <span class="input-group-btn">
                                            <button type="button" id="search" class="btn btn-sm btn-info">搜索</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive bg-white border-left border-right">
                                @if(count($category)>0)
                                <table class="table table-hover table-mailbox m-n">
                                    <tbody>
                                    <tr class="active">
                                        <th style="width:8%;" class="text-center">ID</th>
                                        <th style="width:15%;">分类名</th>
                                        <th style="width:30%">分类描述</th>
                                        <th style="width:10%" class="text-center">父类ID</th>
                                        <th style="width:15%" class="text-center">前台显示</th>
                                        <th style="width:22%;" class="text-center">操作</th>
                                    </tr>
                                    @foreach ($category as $c)
                                    <tr>
                                        <td class="text-center">{!!$c->cateid!!}</td>
                                        <td>{!!$c->name!!}</td>
                                        <td>{!!$c->description!!}</td>
                                        <td class="text-center">
                                            @if($c->parentid==0)
                                                无
                                            @else
                                            {!!$c->parentid!!}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($c->disabled==0)
                                                <button class="btn btn-xs btn-default" onclick="set_disable({!!$c->cateid!!},0)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-xs btn-default" onclick="set_disable({!!$c->cateid!!},1)">
                                                    <i class="fa fa-eye-slash text-danger"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="tooltip-demo p-r-xs">
                                                <a href="/backhome/category/edit/{!!$c->cateid!!}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:up({{$c->cateid}})" class="btn btn-xs btn-primary2" data-toggle="tooltip" data-placement="top" data-original-title="向上"><i class="fa fa-level-up"></i></a>
                                                <a href="javascript:down({{$c->cateid}})" class="btn btn-xs btn-danger2" data-toggle="tooltip" data-placement="top" data-original-title="向下"><i class="fa fa-level-down"></i></a>
                                                <a href="javascript:del({!!$c->cateid!!})" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
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
                                {!! $category->appends(['key' => $key])->render() !!}
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
    <script type="text/javascript" src="/assets/backhome/vendor/tagsinput/dist/jquery.tagsinput.min.js"></script>
    <script src="/assets/backhome/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script>
        //设置显示状态
        function set_disable(id,n){
            $.ajax({
                type: "post",
                url: '/backhome/category/disabled',
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
            swalAlert(id,'删除','/backhome/category/destroy');
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
        //关键字-可以用此方法监听更改 onChange: function(elem, elem_tags) {console.log('c',$(this).val());}
        $('#keywords').tagsInput({
            width: 'auto'
        });
        $('#keywords_tagsinput').removeAttr('style').css({'height':'86px','width':'auto','border-color':'#ddd'});
        //添加成功提示
        var meg = GetQueryString('meg');
        if(meg == 'add_Success'){
            swal({
                title: "分类添加成功!",
                text: "",
                type: "success",
                timer: 2000,
                showConfirmButton: false
            },function(){
                var url = getUrl();
                window.location.href = url['url'];
            });
        }
        //向上一条
        function up(cateid){
            $.ajax({
                type: "post",
                url: '/backhome/category/up',
                data:{'cateid':cateid,'_token':$('meta[name=_token]').attr('content')},
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
        function down(cateid){
            $.ajax({
                type: "post",
                url: '/backhome/category/down',
                data:{'cateid':cateid,'_token':$('meta[name=_token]').attr('content')},
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
        //菜单定位
        $('#con').parent().children('li').removeClass();
        $('#con').addClass('active');
        $('#con > ul > li > a').each(function(){
            if($(this).attr('href')==window.location.pathname){
                $(this).parent().siblings().removeClass();
                $(this).parent().addClass('active');
            }
        });
        $('#con > ul > li > a').each(function(){
            if($(this).attr('href')==window.location.pathname){
                $(this).parent().siblings().removeClass();
                $(this).parent().addClass('active');
            }
        });
    </script>
@endsection
