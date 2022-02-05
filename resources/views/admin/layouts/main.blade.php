@extends('layouts.main')

@section('title')
{{!empty($title)?$title:env('APP_NAME')}}
@endsection

@section('main_css')
    @yield('custom_css')
    <style type="text/css">
        .top_message{
            position: absolute;
        }
    </style>
@endsection

@section('main_content')

<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('admin-dashboard')}}">
            <span class="align-middle">{{env('APP_NAME')}} Admin</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Admin
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin-dashboard')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>


            <!-- <li class="sidebar-header">
                Management
            </li> -->
            

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin-standard-list')}}">
                    <i class="fas fa-graduation-cap"></i> <span class="align-middle">Standard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#create" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Questions</span>
                </a>
                <ul id="create" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/admin/question-create">Create</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/admin/question-list">List</a></li>
                </ul>
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

        {{-- <form class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
                <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
                <button class="btn" type="button">
                    <i class="align-middle" data-feather="search"></i>
                </button>
            </div>
        </form> --}}

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                {{-- <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="bell"></i>
                            <span class="indicator">4</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="alertsDropdown">
                        <div class="dropdown-menu-header">
                            4 New Notifications
                        </div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-danger" data-feather="alert-circle"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">Update completed</div>
                                        <div class="text-muted small mt-1">Restart server 12 to complete the
                                            update.</div>
                                        <div class="text-muted small mt-1">30m ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-warning" data-feather="bell"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">Lorem ipsum</div>
                                        <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                            hendrerit et.</div>
                                        <div class="text-muted small mt-1">2h ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-primary" data-feather="home"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">Login from 192.186.1.8</div>
                                        <div class="text-muted small mt-1">5h ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-success" data-feather="user-plus"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">New connection</div>
                                        <div class="text-muted small mt-1">Christina accepted your request.
                                        </div>
                                        <div class="text-muted small mt-1">14h ago</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="#" class="text-muted">Show all notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                        data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="message-square"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">
                            <div class="position-relative">
                                4 New Messages
                            </div>
                        </div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="img/avatars/avatar-5.jpg"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">Vanessa Tucker</div>
                                        <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                            tortor.</div>
                                        <div class="text-muted small mt-1">15m ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="img/avatars/avatar-2.jpg"
                                            class="avatar img-fluid rounded-circle" alt="William Harris">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">William Harris</div>
                                        <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                            vitae.</div>
                                        <div class="text-muted small mt-1">2h ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="img/avatars/avatar-4.jpg"
                                            class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">Christina Mason</div>
                                        <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                        </div>
                                        <div class="text-muted small mt-1">4h ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="img/avatars/avatar-3.jpg"
                                            class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">Sharon Lessman</div>
                                        <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                            posuere ac, mattis non.</div>
                                        <div class="text-muted small mt-1">5h ago</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="#" class="text-muted">Show all messages</a>
                        </div>
                    </div>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        {{-- <img src="/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="{{Auth::guard('admin')->user()->fullName()}}" />  --}}
                            <span class="text-dark">{{Auth::guard('admin')->user()->fullName()}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('admin-profile')}}"><i class="align-middle me-1"
                                data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="{{route('admin-change-password')}}"><i class="align-middle me-1"
                                data-feather="lock"></i> Change Password</a>
                        <a class="dropdown-item" href=""><i class="align-middle me-1"
                                data-feather="settings"></i> Settings</a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin-logout')}}"><i class="align-middle me-1"
                                data-feather="log-out"></i> Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">
        @include('includes.top_message')
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row text-muted">
                <div class="col-12 text-center">
                    <p class="mb-0">
                        <a href="index.html" class="text-muted"><strong>{{env('APP_NAME')}} Admin</strong></a> &copy;
                    </p>
                </div>
                {{-- <div class="col-6 text-end">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-muted" href="#">Support</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-muted" href="#">Help Center</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-muted" href="#">Privacy</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-muted" href="#">Terms</a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </footer>
</div>
@endsection


@section('main_js')
    @yield('custom_js')
@endsection