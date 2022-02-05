@extends('layouts.main')

@section('title')
{{!empty($title)?$title:env('APP_NAME')}}
@endsection


@section('main_css')
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('main_content')

<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        
        <a class="sidebar-brand text-center" href="{{route('user-dashboard')}}">
            <span class="align-middle">@include('includes.logo')</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Admin
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{route('user-dashboard')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>


            <li class="sidebar-header">
                Management
            </li>
            {{-- <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">UI
                        Elements</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Alerts</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-buttons.html">Buttons</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-cards.html">Cards</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-general.html">General</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-grid.html">Grid</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-typography.html">Typography</a>
                    </li>
                </ul>
            </li> --}}


        </ul>
    </div>
</nav>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle d-flex">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        {{-- <img src="/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="{{Auth::user()->fullName()}}" />  --}}
                            <span class="text-dark">{{Auth::user()->fullName()}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('user-profile')}}"><i class="align-middle me-1"
                                data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="{{route('user-change-password')}}"><i class="align-middle me-1"
                                data-feather="lock"></i> Change Password</a>
                        <a class="dropdown-item" href=""><i class="align-middle me-1"
                                data-feather="settings"></i> Settings</a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('user-logout')}}"><i class="align-middle me-1"
                                data-feather="log-out"></i> Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">
            <h2 class="mb-3">{{$page_title}}</h2>
            @yield('content')

        </div>
    </main>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row text-muted">
                <div class="col-12 text-center">
                    <p class="mb-0">
                        <a href="index.html" class="text-muted"><strong>{{env('APP_NAME')}}</strong></a> &copy;
                    </p>
                </div>
                
            </div>
        </div>
    </footer>
</div>
@endsection


@section('main_js')
    @yield('custom_js')
@endsection