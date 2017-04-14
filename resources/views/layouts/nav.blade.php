<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-color:#158cba">
    <div class="container" id="nav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">小官の网</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/posts">文章列表</a></li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">又拍云<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="hide"><a href="/upfilelist">又拍云列表</a></li>
                            <li><a href="/upimg">上传文件</a></li>
                            <li class="hide"><a href="/upueditor">又拍云UEditor百度上传</a></li>
                            <li><a href="/upfiledel">文件删除</a></li>
                        </ul>
                    </li>
                    <li><a href="/posts/create">添加文章</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li><a href="#">注册</a></li>
                    <li><a href="/auth/login">登录</a></li>
                @endif
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!!Auth::user()->name!!}<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/backhome">后台管理</a></li>
                            <li><a href="/auth/logout">退出登录</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="key" id="key" class="form-control" placeholder="关键字">
                </div>
                <button type="botton" id="search" class="btn btn-default">搜索</button>
                <script>
                    //搜索
                    $('#search').click(function(){
                        var key = $('#key').val();
                        //根据筛选条件拼接当前URL
                        var url = getUrl();
                        if(key==''){
                            window.location.href = url['url'];
                        }else{
                            if(url['key']!=key){
                                url['key']=key;
                            }
                            changeUrl(url);
                        }
                    });
                </script>
            </form>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>