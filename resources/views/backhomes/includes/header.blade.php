<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        <span class="text-md">
            后台管理
        </span>
    </div>
    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
            <span class="text-primary">后台管理</span>
        </div>
        <form role="search" class="navbar-form-custom" method="post" action="#">
            <div class="form-group vhide">
                <input type="text" placeholder="搜索关键字" class="form-control" name="search">
            </div>
        </form>
        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">个人资料</a>
                    </li>
                    <li>
                        <a href="/auth/logout">退出登录</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li>
                    <a href="/">
                        <i class="pe-7s-upload pe-7s-home"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="pe-7s-user"></i>
                    </a>
                    <ul class="dropdown-menu hdropdown notification animated flipInX">
                        <li>
                            {{\Auth::user()->name}} , 你好！
                        </li>
                        <li>
                            <a href="/backhome/user/edit/{!! \Auth::user()->id !!}">
                                修改密码
                            </a>
                        </li>
                        <li>
                            <a href="/auth/logout">
                                退出登录
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
</div>