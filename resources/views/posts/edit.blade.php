@extends('layout')
@section('title', '编辑文章')
@section('content')
<article class="post page">
    <section class="post-content">
        <script type='text/javascript' src='/assets/backhome/vendor/ueditor/ueditor.config.js'></script>
        <script type='text/javascript' src='/assets/backhome/vendor/ueditor/ueditor.all.js'></script>
        <script type="text/javascript" src="/assets/backhome/vendor/ueditor/lang/zh-cn/zh-cn.js"></script>
        <form method="POST" name="form_edit" id="form_edit" action="/posts/update" accept-charset="UTF-8" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input name="user_id" type="hidden" value="{!! Auth::user()->id !!}"/>
            <input name="id" type="hidden" value="{!! $edit->id !!}"/>
            <div class="form-group">
                <label for="title" style="margin-top: 15px;">标题:</label>
                <input class="form-control" name="title" type="text" id="title" value="{!! $edit->title !!}"/>
                <label for="keywords" style="margin-top: 15px;">关键字:</label>
                <input class="form-control" name="keywords" type="text" id="keywords" value="{!! $edit->keywords !!}"/>
                <label for="description" style="margin-top: 15px;">摘要:</label>
                <textarea class="form-control" name="description" cols="50" rows="3" id="description">{!! $edit->description !!}</textarea>
                <label for="thumbnail">缩略图:</label>
                <div class="upImg">
                    @if($edit->thumbnail!='')
                        <img src="{!! $edit->thumbnail !!}" width="120" class="thumbnail">
                    @else
                        <img src="/assets/images/defaultImg.png" width="120" class="thumbnail">
                    @endif
                    <input type="file" name="thumbnail[]" id="thumbnail" >
                </div>
                <label for="order">排序:(数字越大越靠前)</label>
                <input class="form-control" name="order" type="text" id="order" value="{!! $edit->order !!}"/>
                <label for="content" style="margin-top: 15px;">内容:</label>
                <textarea name="body" id="body">{!! $edit->body !!}</textarea>
                <div style="margin-top: 15px;">
                    <input class="btn btn-primary form-control" type="submit" value="提交"/>
                </div>
            </div>
        </form>
    </section>
</article>
<!-- edit modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span id="meg"></span>
            </div>
        </div>
    </div>
</div>
<script>
    //缩略图片上传显示
    $('#thumbnail').on('change', function(event) {
        event.preventDefault();
        var f = event.target.files[0];
        var src = window.URL.createObjectURL(f);
        $('.upImg img').attr('src',src);
    });
    //添加成功模态框
    function openModal(meg){
        $('#meg').html(meg);
        //打开模态框
        $('.bs-example-modal-sm').modal('show');
        //三秒关闭模态框
        setTimeout(function(){$('.bs-example-modal-sm').modal('hide')},3000);
    }
    //UEditor 编辑器集成
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
        initialFrameHeight:200,
        autoHeightEnabled: true,
        autoFloatEnabled: true
    });
    editor.ready(function() {
        editor.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
</script>
<!-- /edit modal -->
@endsection