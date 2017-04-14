@extends('backhome')

@section('title', '内容编辑')

@section('keywords', '关键词')

@section('description', '描述')
@section('style')
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/tagsinput/dist/jquery.tagsinput.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/backhome/vendor/select2-3.5.2/select2.css" />
    <link rel="stylesheet" media="all" type="text/css" href="/assets/backhome/vendor/datetimepicker_cn/css/jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="/assets/backhome/vendor/datetimepicker_cn/css/jquery-ui-timepicker-addon.css" />
    <style>
        .form-group .select2-choices{
            border: 1px solid #ddd;
        }
        .form-group .tagsinput{
            border: 1px solid #ddd;
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
                                <span>编辑内容</span>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        编辑内容
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
            <form method="POST" name="form_create" class="form-horizontal" id="form_create" action="/backhome/post/update" accept-charset="UTF-8" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input name="user_id" type="hidden" value="{!!Auth::user()->id!!}"/>
                <input name="id" type="hidden" value="{!! $edit->id !!}"/>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="hpanel">
                            <div class="panel-body">
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label class="col-sm-1 control-label">标题</label>
                                    <div class="col-sm-11">
                                        <input class="form-control" name="title" type="text" id="title" value="{!!count($errors)>0?old('title'):$edit->title!!}"/>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label class="col-sm-1 control-label">摘要</label>
                                    <div class="col-sm-11">
                                        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{!!count($errors)>0?old('description'):$edit->description!!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                                    <label class="col-sm-1 control-label">外链</label>
                                    <div class="col-sm-11">
                                        <textarea class="form-control" name="link" cols="50" rows="2" id="link">{!!count($errors)>0?old('link'):$edit->link!!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <label class="col-sm-1 control-label">内容</label>
                                    <div class="col-sm-11">
                                        <textarea name="body" id="body">
                                            {!!count($errors)>0?old('body'):$edit->body!!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="hpanel">
                            <div class="panel-body">
                                <div class="m-l m-r">
                                    <div class="form-group">
                                        <div class="upImg">
                                            <input type="hidden" name="tempImg" id="tempImg" value="{!!count($errors)>0?old('tempImg'):$edit->thumbnail!!}"/>
                                            @if($edit->thumbnail!='')
                                                <img src="{!!count($errors)>0?old('tempImg'):$edit->thumbnail!!}" width="100%" class="thumbnail no-margins">
                                            @else
                                                <img src="{!!count($errors)>0?old('tempImg'):'/assets/images/defaultImg.png'!!}" width="100%" class="thumbnail no-margins">
                                            @endif
                                            <input type="file" name="thumbnail[]" id="thumbnail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">栏目</label>
                                        <select class="form-control" name="cateid" id="cateid" style="width: 100%">
                                            <option value="0" @if($edit->cateid == 0) selected @endif>顶级栏目</option>
                                            @foreach($category as $c)
                                                <option value="{!!$c->cateid!!}" @if($edit->cateid == $c->cateid || old('cateid') == $c->cateid) selected @endif>{!!$c->name!!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">关键字 (输入完后回车即可)</label>
                                        <input class="form-control" name="keywords" type="text" id="keywords" value="{!!count($errors)>0?old('keywords'):$edit->keywords!!}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">排序 (大的在前)</label>
                                        <input class="form-control" name="order" type="text" id="order" value="{!!count($errors)>0?old('order'):date('Y-m-d H:i:s',$edit->order)!!}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">类型</label>
                                        <select class="form-control" name="type" id="type" style="width: 100%">
                                            <option value="1" @if($edit->type=='1' || old('type') == '1') selected @endif>默认</option>
                                            <option value="2" @if($edit->type=='2' || old('type') == '2') selected @endif>外链</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">属性</label>
                                        <input type="hidden" name="flag" id="flag" value="" />
                                        <select class="js-source-states" multiple="multiple" style="width: 100%">
                                            <option value="c">推荐</option>
                                            <option value="t">置顶</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>


        </div>

        <footer class="footer text-center">
                <button class="btn btn-primary" id="submit" type="button">保存</button>
        </footer>

    </div>
@endsection
@section('script')
    <!--tagsinput-->
    <script type="text/javascript" src="/assets/backhome/vendor/tagsinput/dist/jquery.tagsinput.min.js"></script>
    <!--ueditor-->
    <script type='text/javascript' src='/assets/backhome/vendor/ueditor/ueditor.config.js'></script>
    <script type='text/javascript' src='/assets/backhome/vendor/ueditor/ueditor.all.js'></script>
    <script type="text/javascript" src="/assets/backhome/vendor/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/select2-3.5.2/select2.min.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui-timepicker-zh-CN.js"></script>
    <script type="text/javascript" src="/assets/backhome/vendor/datetimepicker_cn/js/jquery-ui-sliderAccess.js"></script>
    <script>
        //菜单定位
        menu('#con');
        //类型
        @if($edit->type=='2' || old('type')=='2')
            $('#link').closest('.form-group').removeClass('vhide');
            $('#body').closest('.form-group').addClass('vhide');
        @else
            $('#body').closest('.form-group').removeClass('vhide');
            $('#link').closest('.form-group').addClass('vhide');
        @endif
        $('#type').change(function(){
            if($(this).val()==1){
                $('#body').closest('.form-group').removeClass('vhide');
                $('#link').closest('.form-group').addClass('vhide');
            }else{
                $('#link').closest('.form-group').removeClass('vhide');
                $('#body').closest('.form-group').addClass('vhide');
            }
        });
        //时间选择
        $('#order').datetimepicker({
            timeFormat: 'HH:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
        });
        //属性，类型下拉选择

        var rec = '';
        var tops = '';
        var flag ='';
        var flags = [];
        if({!!$edit->rec!!}==1){
            rec = 'c';
            flag = rec;
            flags[0] = rec;
        }
        if({!!$edit->top!!}==1){
            tops = 't';
            if(flag!=''){
                flag = flag+","+tops;
                flags[1] = tops;
            }
        }
        if('{!!old('flag')!!}'.indexOf('c')>-1){
            rec = 'c';
            flag = rec;
            flags[0] = rec;
        }
        if('{!!old('flag')!!}'.indexOf('t')>-1){
            tops = 't';
            if(flag!=''){
                flag = flag+","+tops;
                flags[1] = tops;
            }
        }

        $(".js-source-states").select2();
        $(".js-source-states").val(flags).trigger("change");
        $("#flag").val(flag);
        $(".js-source-states").change(function(){
            $("#flag").val($(this).val());
        });
        //关键字-可以用此方法监听更改 onChange: function(elem, elem_tags) {console.log('c',$(this).val());}
        $('#keywords').tagsInput({
            width: 'auto'
        });
        //缩略图
        $('#thumbnail').on('change', function(event) {
            event.preventDefault();
            var f = event.target.files[0];
            var src = window.URL.createObjectURL(f);
            $('.upImg img').attr('src',src);
            $('#tempImg').val(src);
        });
        //上传文件控件宽高设置
        $(".upImg input").width($(".upImg img").width());
        $(".upImg input").height($(".upImg img").height());
        //提交表单
        $('#submit').click(function(){
            $('form').submit();
        });
        //集成UEditor
        var editor = UE.getEditor('body', {
            toolbars: [
                [
                    'fullscreen',
                    'source',
                    'undo',
                    'redo',
                    'bold',
                    'italic',
                    'underline',
                    'blockquote',
                    'removeformat',
                    'fontsize',
                    'forecolor',
                    'backcolor',
                    'simpleupload',
                    'insertimage',
                    'link',
                    'unlink',
                    'justifyleft',
                    'justifycenter',
                    'justifyright',
                    'indent',
                    'inserttable',
                    'insertorderedlist',
                    'insertunorderedlist'
                ]
            ],
            initialFrameHeight:325,
            initialFrameWidth:'100%',
            autoHeightEnabled: true,
            autoFloatEnabled: true
        });
        editor.ready(function() {
            editor.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>
@endsection
