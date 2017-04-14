@extends('layout')
@section('title', '又拍云单图&多图上传')
@section('content')
    <form action="/upimgAction" method="post" enctype="multipart/form-data" role="form">
        {!! csrf_field() !!}
        <h1 id="overview" class="page-header">又拍云单图&多图上传</h1>
        <div class="form-group">
            <label for="exampleInputFile">图片上传</label>
            <input  type="file" name="myfile[]" multiple id="exampleInputFile">
        </div>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
@endsection