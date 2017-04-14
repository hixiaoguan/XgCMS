@extends('onepage')

@section('title', '后台登录')

@section('keywords', '关键词')

@section('description', '描述')

@section('content')
    <div class="color-line"></div>

    <div class="back-link">
        <a href="/" class="btn btn-primary">返回首页</a>
    </div>
    <div class="login-container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>用户登录</h3>
                    <small>努力到无能为力，拼搏到感动自己！撸起袖子加油干！</small>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">用户名</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                    <input type="hidden" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">登录</button>
                            <a class="btn btn-default btn-block" href="/auth/register">注册</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="http://www.xiaoguan.net">XiaoGuan.Net</a>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script>
        $('#name').bind('input propertychange', function() {
            $('#email').val($(this).val()+'@'+'{!!env("SUPER_DOMAIN")!!}');
        });
    </script>
@endsection
