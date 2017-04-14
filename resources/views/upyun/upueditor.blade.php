@extends('layout')
@section('title', '又拍云-UEditor')
@section('content')
    <script type='text/javascript' src='/assets/backhome/vendor/ueditor/ueditor.config.js'></script>
    <script type='text/javascript' src='/assets/backhome/vendor/ueditor/ueditor.all.js'></script>
    <script type="text/javascript" src="/assets/backhome/vendor/ueditor/lang/zh-cn/zh-cn.js"></script>
    <form>
        {!! csrf_field() !!}
        <h1 id="overview" class="page-header">又拍云UEditor上传</h1>
        <textarea name="upfile" id="myEditor"></textarea>
        <div class="text-center" style="margin-top: 15px;">
            <button type="submit" class="btn btn-success">提交</button>
        </div>
    </form>
    <script type='text/javascript'>
        var editor = new UE.ui.Editor();
        editor.render('myEditor');
        editor.ready(function() {
            editor.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>
@endsection