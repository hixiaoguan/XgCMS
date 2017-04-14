@extends('layout')

@section('title', '页面标题')

@section('content')
<article class="post page">
    <section class="post-content">
        <h2>{!!$post->title!!}</h2>
        <div class="text-left">
             <p>
                {!!$post->body!!}
             </p>
        </div>
        @if(Auth::check())
            <div>
                <a href="/posts/edit/{!!$post->id!!}" class="btn btn-sm btn-success">编辑</a>
                <a href="#" class="btn btn-sm btn-danger" onclick="openDelModal({!!$post->id!!})">删除</a>
            </div>
        @endif
        <!-- Delect modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">提示：</h4>
                    </div>
                    <div class="modal-body">
                        <span id="meg"></span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="del({!!$post->id!!})">确定</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            //删除警告模态框
            function openDelModal(id){
                $('#meg').html('确定要删除吗？');
                //打开模态框
                $('.bs-example-modal-sm').modal('show');
            }
            function del(delid){
                location.href='/posts/destroy/'+delid;
                //关闭模态框
                $('.bs-example-modal-sm').modal('hide');
            }
        </script>
        <!-- /Delect modal -->
    </section>
</article>
@endsection