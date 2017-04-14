@extends('layout')
@section('title', '又拍云-文件列表')
@section('content')
    <h1 id="overview" class="page-header">文件列表</h1>
    @if(count($filelist) > 0)
        <div class="row upfilelist">
            @foreach ($filelist as $list)
                @if (strpos($list['name'],'.jpg') == false && strpos($list['name'],'.jpeg') == false && strpos($list['name'],'.png') == false && strpos($list['name'],'.gif') == false)
                @else
                    <div class="col-xs-6 col-md-4 img-thumbnail">
                        <a href="{!! $pathstr !!}{!! $path !!}{!!$list['name']!!}" target="_blank">
                            <img src="{!! $pathstr !!}{!! $path !!}{!!$list['name']!!}"/>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">暂无内容</h3>
            </div>
            <div class="panel-body text-center">
                <a href="/upimg" class="btn btn-primary">添加文件</a>
            </div>
        </div>
    @endif
    <script>
        window.onload = function(){
            var box = $('.upfilelist div');
            box.css({'maxHeight':'20rem','minHeight':'20rem','marginTop':'1rem','textAlign':'center','overflow':'hidden'});
            box.each(function(){
                var box_w = $(this).width();
                var img_w = $(this).find('img').width();
                var box_h = $(this).height();
                var img_h = $(this).find('img').height();
                //高度超出
                if(img_h > box_h){
                    $(this).find('img').css('height',box_h);
                }
            });
        }
    </script>
@endsection