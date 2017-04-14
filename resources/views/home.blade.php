@extends('layout')

@section('title', '首页')

@section('content')
    <div class="jumbotron" style="margin:.8rem auto 1.5rem;background: url('https://up.xiaoguan.net/posts/201701/YA9QuIe7EdUbAKY6XvCw.jpg') no-repeat; background-size: cover; color:#fff;">
        <h1 style="text-shadow:0 10px 5px rgba(0, 0, 0, .5)">不求人,自己动手，丰衣足食！^^</h1>
        <p style="text-shadow:0 3px 5px rgba(0, 0, 0, .5)">码农自留地~</p>
        <p><a class="btn btn-primary btn-lg">Let's Go!</a></p>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">关于我</h3>
                </div>
                <div class="panel-body" style="line-height: 2rem">
                    <div class="text-center m-b">
                        <img src="https://up.xiaoguan.net/posts/201701/0NCaU7SNATqbYLty2omv.png" style="width: 50%;" alt="小官" class="img-circle img-thumbnail">
                    </div>
                    小官，男，80后<br/>
                    职业：码农(前端开发)<br/>
                    工作：掌控传媒<br/>
                    愿景：财务自由~<br/>
                    爱好：赚钱 -- 老婆说，银行卡里不足500W,我的爱好只能是赚钱！<br/>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            @if(count($post) > 0)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">最新文章</h3>
                    </div>
                    <div class="panel-body" style="line-height: 2rem">
                        @foreach ($post as $p)
                            <article class="post page" style="border-top:none; border-bottom: 1px dashed #ddd; padding-top: 20px;">
                                <section class="post-content">
                                    <div class="media">
                                        <a class="media-left media-middle" href="/posts/show/{!!$p->id!!}">
                                            <img src="{!!$p->thumbnail!!}" alt="..." style="width: 150px" class="thumbnail">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a class="media-left media-middle" href="/posts/show/{!!$p->id!!}">
                                                    {!!$p->title!!} - {!! $p->updated_at->format('Y-m-d h:m:s') !!}
                                                </a>
                                            </h4>
                                            <div class="text-base">
                                                {!!$p->description!!}
                                            </div>
                                            @if(Auth::check())
                                                <div style="margin-top: 5px;">
                                                    <a href="/posts/edit/{!!$p->id!!}" class="btn btn-sm btn-success">编辑</a>
                                                    <a href="#" class="btn btn-sm btn-danger" onclick="openDelModal({!!$p->id!!})">删除</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </section>
                            </article>
                        @endforeach
                        <div class="text-center">
                            {!! $post->render() !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">暂无数据</h3>
                    </div>
                    <div class="panel-body text-center">
                        <a href="/posts/create" class="btn btn-primary">添加</a>
                    </div>
                </div>
            @endif
            <!-- modal -->
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">提示：</h4>
                        </div>
                        <div class="modal-body">
                            <span id="meg"></span>
                            <span id="delid" style="display:none"></span>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal" onclick="del()">确定</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                //获取URL参数
                function GetQueryString(name){
                    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                    var r = window.location.search.substr(1).match(reg);
                    if(r!=null)return  unescape(r[2]); return null;
                }
                if(GetQueryString('meg')!=''){
                    if(GetQueryString('meg')=='add_Success'){
                        openAddEditModal('文章添加成功!');
                    }
                    else if(GetQueryString('meg')=='add_Error'){
                        openAddEditModal('文章添加失败!');
                    }
                    else if(GetQueryString('meg')=='edit_Success'){
                        openAddEditModal('文章编辑成功!');
                    }
                    else if(GetQueryString('meg')=='edit_Error'){
                        openAddEditModal('文章编辑失败!');
                    }
                }
                //删除警告模态框
                function openDelModal(id){
                    $('#meg').html('确定要删除吗？');
                    $('#delid').html(id);
                    //打开模态框
                    $('.bs-example-modal-sm').modal('show');
                }
                function del(){
                    var delid = $("#delid").html();
                    location.href='/posts/destroy/'+delid;
                }
                //添加成功提示
                function openAddEditModal(meg){
                    $('#meg').html(meg);
                    $('.modal-footer').remove();
                    //打开模态框
                    $('.bs-example-modal-sm').modal('show');
                    //两秒关闭模态框
                    setTimeout(function(){$('.bs-example-modal-sm').modal('hide');location.href='/posts'},2000);
                }
            </script>
            <!-- /modal -->
        </div>
    </div>
@endsection


