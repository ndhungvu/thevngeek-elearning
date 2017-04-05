<?php $route_name = \Request::route()->getName();?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src={{ asset("assets/admin/dist/img/user2-160x160.jpg") }} class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $adminLang['info']['name'] }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{ $adminLang['info']['status'] }}</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="treeview {!! $route_name == 'admin.user.index' || $route_name == 'admin.user.create' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>
                        {{ trans('admin/master.sidebar.item', ['item' => $adminLang['items']['user']]) }}
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $route_name == 'admin.user.index' ? 'active' : '' !!}">
                        <a href="{!! route('admin.user.index') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['list'] }}
                        </a>
                    </li>
                    <li class="{!! $route_name == 'admin.user.create' ? 'active' : '' !!}">
                        <a href="{!! route('admin.user.create') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['create'] }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {!! $route_name == 'admin.category.index' || $route_name == 'admin.category.create' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-align-justify"></i>
                    <span>
                        {{ trans('admin/master.sidebar.item', ['item' => $adminLang['items']['category']]) }}
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $route_name == 'admin.category.index' ? 'active' : '' !!}">
                        <a href="{!! route('admin.category.index') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['list'] }}
                        </a>
                    </li>
                    <li class="{!! $route_name == 'admin.category.create' ? 'active' : '' !!}">
                        <a href="{!! route('admin.category.create') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['create'] }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {!! $route_name == 'admin.article.index' || $route_name == 'admin.article.create' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>
                        {{ trans('admin/master.sidebar.item', ['item' => $adminLang['items']['article']]) }}
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $route_name == 'admin.article.index' ? 'active' : '' !!}">
                        <a href="{!! route('admin.article.index') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['list'] }}
                        </a>
                    </li>
                    <li class="{!! $route_name == 'admin.article.create' ? 'active' : '' !!}">
                        <a href="{!! route('admin.article.create') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['create'] }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {!! $route_name == 'admin.sesson.index' || $route_name == 'admin.sesson.create' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>
                        sesson
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $route_name == 'admin.sesson.index' ? 'active' : '' !!}">
                        <a href="{!! route('admin.sesson.index') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['list'] }}
                        </a>
                    </li>
                    <li class="{!! $route_name == 'admin.sesson.create' ? 'active' : '' !!}">
                        <a href="{!! route('admin.sesson.create') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['create'] }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {!! $route_name == 'admin.document.index' || $route_name == 'admin.document.create' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>
                        {{ trans('admin/master.sidebar.item', ['item' => $adminLang['items']['document']]) }}
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $route_name == 'admin.document.index' ? 'active' : '' !!}">
                        <a href="{!! route('admin.document.index') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['list'] }}
                        </a>
                    </li>
                    <li class="{!! $route_name == 'admin.document.create' ? 'active' : '' !!}">
                        <a href="{!! route('admin.document.create') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['create'] }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {!! $route_name == 'admin.comment.index' || $route_name == 'admin.comment.create' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-commenting"></i>
                    <span>
                        {{ trans('admin/master.sidebar.item', ['item' => $adminLang['items']['comment']]) }}
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $route_name == 'admin.comment.index' ? 'active' : '' !!}">
                        <a href="{!! route('admin.comment.index') !!}">
                            <i class="fa fa-circle-o"></i> {{ $adminLang['sidebar']['list'] }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>