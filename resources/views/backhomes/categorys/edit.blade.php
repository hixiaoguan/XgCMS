@extends('backhome')

@section('title', '栏目编辑')

@section('keywords', '关键词')

@section('description', '描述')
@section('style')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/sweetalert/lib/sweet-alert.css" />
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/tagsinput/dist/jquery.tagsinput.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/select2-3.5.2/select2.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/assets/backhome/vendor/datetimepicker_cn/css/jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="/assets/backhome/vendor/datetimepicker_cn/css/jquery-ui-timepicker-addon.css" />
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
                            <li class="active">
                                <span>编辑栏目</span>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        编辑栏目
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
                    <div class="col-md-12">
                        <div class="hpanel">
                            <div class="panel-body">
                                <form method="POST" class="p-xxs" name="form_create" class="form-horizontal" id="form_create" action="/backhome/category/update" accept-charset="UTF-8" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="hidden" id="cateid" name="cateid" value="{!!$edit->cateid!!}"/>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">名称</label>
                                        <input class="form-control tags" name="name" type="text" id="name" value="{{count($errors)>0?old('name'):$edit->name}}"/>
                                    </div>
                                    <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                                        <label class="control-label">别名</label>
                                        <input class="form-control tags" name="alias" type="text" id="alias" value="{{count($errors)>0?old('alias'):$edit->alias}}"/>
                                        <small>“别名”是在URL中使用的别称。通常使用小写，只能包含字母，数字和连字符（-）。</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('parentid') ? ' has-error' : '' }}">
                                        <label class="control-label">父级</label>
                                        <select class="form-control" name="parentid" id="parentid" style="width: 100%">
                                            <option value="0">无</option>
                                            @foreach($category as $c)
                                                <option @if($c->cateid==$edit->parentid || $c->cateid == old('parentid')) selected @endif value="{!!$c->cateid!!}">
                                                    {!!$c->name!!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                                        <label class="control-label">关键字 (输入完后回车即可)</label>
                                        <input class="form-control tags" name="keywords" type="text" id="keywords" value="{{count($errors)>0?old('keywords'):$edit->keywords}}"/>
                                    </div>
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label class="control-label">描述</label>
                                        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{{count($errors)>0?old('description'):$edit->description}}</textarea>
                                    </div>
                                    <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                        <label class="control-label">排序 (时间较晚的在前)</label>
                                        <input class="form-control" name="order" type="text" id="order" value="{!!count($errors)>0?old('order'):date('Y-m-d H:i:s',$edit->order)!!}"/>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" id="submit" type="submit">保存</button>
                                    </div>
                                </form>
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
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui-timepicker-zh-CN.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui-sliderAccess.js"></script>
    <script>
        //关键字-可以用此方法监听更改 onChange: function(elem, elem_tags) {console.log('c',$(this).val());}
        $('#keywords').tagsInput({
            width: 'auto'
        });
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
        //时间选择
        $('#order').datetimepicker({
            timeFormat: 'HH:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
        });
        //菜单定位
        $('#con').parent().children('li').removeClass();
        $('#con').addClass('active');
        $('#con > ul > li > a').each(function(){
            if($(this).attr('href')==window.location.pathname){
                $(this).parent().siblings().removeClass();
                $(this).parent().addClass('active');
            }
        });
    </script>
@endsection
