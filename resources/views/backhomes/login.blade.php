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
                    <h3>后台管理登录</h3>
                    <small>努力到无能为力，拼搏到感动自己！撸起袖子加油干！</small>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">用户名</label>
                                <input type="text" placeholder="example@qq.com" title="请输入用户名" required="" value="" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">密码</label>
                                <input type="password" title="请输入密码" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                            </div>
                            <button class="btn btn-success btn-block">登录</button>
                            <a class="btn btn-default btn-block" href="#">注册</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <strong>小官の网</strong> - 简约清爽的管理后台 <br/> &copy; 2016
                <a href="http://www.xiaoguan.net">XiaoGuan.Net</a>
            </div>
        </div>
    </div>
@endsection
