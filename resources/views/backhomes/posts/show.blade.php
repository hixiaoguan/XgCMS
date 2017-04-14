@extends('backhome')

@section('title', '内容详情')

@section('keywords', '关键词')

@section('description', '描述')

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
                                <span>内容详情</span>
                            </li>
                        </ol>
                    </div>
                    <span class="text-md m-b-xs">
                        内容详情
                    </span>
                </div>
            </div>
        </div>
        <div class="content content-boxed">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hpanel blog-article-box">
                        <div class="panel-heading" style="padding: 30px 0 10px;">
                            <h4>{{$show->title}}</h4>
                            <small class="m-md text-left text-sm p-sm disb h-bg-blight b-r">
                                {{$show->description}}
                            </small>
                            <div class="text-muted">
                                作者: <span class="font-bold">{{$user->name}}</span>
                                {{$show->created_at}}
                            </div>
                        </div>
                        <div class="panel-body">
                            @if($show->thumbnail!='')
                            <div class="defaultImg img-full">
                                <img src="{!!$show->thumbnail!!}" alt="{!!$show->title!!}" />
                            </div>
                            @endif
                            <div class="content img-full">
                                @if($show->type==1)
                                    {!!$show->body!!}
                                @else
                                    外链：<a href="{!!$show->link!!}" target="_blank">{!!$show->link!!}</a>
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer tooltip-demo">
                            @if($nextPage!=null)
                                <a href="/backhome/post/show/{!!$nextPage!!}" class="pull-right"  data-toggle="tooltip" data-placement="top" data-original-title="下一条">
                                    <i class="pe-7s-angle-right-circle text-md"> </i>
                                </a>
                            @else
                                <span class="pull-right">
                                    当前为最后一条
                                </span>
                            @endif
                            @if($prePage!=null)
                                <a class="pull-left" href="/backhome/post/show/{!!$prePage!!}"  data-toggle="tooltip" data-placement="top" data-original-title="上一条">
                                    <i class="pe-7s-angle-left-circle text-md"> </i>
                                </a>
                            @else
                                <span>
                                    当前为第一条
                                </span>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        //菜单定位
        menu('#con');
    </script>
@endsection
