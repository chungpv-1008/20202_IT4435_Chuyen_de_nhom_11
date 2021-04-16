<!DOCTYPE HTML>
<html>

<head>
    <title>@lang('home.title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel='stylesheet'
        type='text/css' />
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('bower_components/lato-font/css/lato-font.min.css') }}">
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet" type='text/css'>
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset(config('user.logo')) }}"
                        alt="" /></a>
            </div>
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @if (!Auth::check())
                        <li>
                            <a href="{{ route('jobs.index') }}">@lang('home.listjobs')</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">@lang('home.login')</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">@lang('home.register')</a>
                        </li>
                    @elseif (Auth::user()->role_id === config('user.employer'))
                        <li>
                            <a href="{{ route('jobs.index') }}">@lang('home.listjobs')</a>
                        </li>
                        <li>
                            <a class="" type="button" data-toggle="dropdown">@lang('home.profile_user')
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a
                                        href="{{ route('users.show', ['user' => Auth::user()->id]) }}">@lang('layout.view_profile')</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">@lang('layout.edit_profile')</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="" type="button" data-toggle="dropdown">@lang('home.profile_company')
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu my-drop-down-menu ">
                                <li>
                                    <a
                                        href="{{ route('companies.show', ['company' => Auth::user()->company->id]) }}">@lang('layout.view_company')</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('companies.edit', ['company' => Auth::user()->company->id]) }}">@lang('layout.edit_company')</a>
                                </li>
                                <li>
                                    <a href="{{ route('history') }}">@lang('layout.list_job_created')</a>
                                </li>
                                <li>
                                    <a href="{{ route('jobs.create') }}">@lang('layout.create_job')</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <input id="logout-input" type="submit" value="@lang('home.logout')">
                                </form>
                            </a>
                        </li>
                    @elseif (Auth::user()->role_id === config('user.admin'))
                        <li>
                            <a href="{{ route('list_user') }}">@lang('home.admin_user')</a>
                        </li>
                        <li>
                            <a href="{{ route('list_job') }}">@lang('home.listjobs')</a>
                        </li>
                        <li>
                            <a href="">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <input id="logout-input" type="submit" value="@lang('home.logout')">
                                </form>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('jobs.index') }}">@lang('home.listjobs')</a>
                        </li>
                        <li>
                            <a class="" type="button" data-toggle="dropdown">@lang('home.profile_user')
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu my-drop-down-menu">
                                <li>
                                    <a
                                        href="{{ route('users.show', ['user' => Auth::user()->id]) }}">@lang('layout.view_profile')</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">@lang('layout.edit_profile')</a>
                                </li>
                                <li>
                                    <a href="{{ route('show_apply_list') }}">@lang('layout.show_apply_list')</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <input id="logout-input" type="submit" value="@lang('home.logout')">
                                </form>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </nav>
    @yield('content')
    <div class="footer">
        <div class="container">
            <div class="col-sm-1 grid_3">
            </div>
            <div class="col-sm-2 grid_3">
                <h4>@lang('home.seeking')</h4>
                <ul class="f_list">
                    <li>
                        <a href="#">
                            <i class="fa fa-facebook-square tw3">&nbsp;</i>
                        </a>

                        <a href="#">
                            <i class="fa fa-twitter-square tw3">&nbsp;</i>
                        </a>
                        <a href="#">
                            <i class="fa fa-google-plus-square tw3"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="fa fa-phone"> {{ config('user.phone') }}</i></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="fa fa-envelope"> {{ config('user.email') }}</i></span>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <div class="col-sm-2 grid_3">
                <h4>@lang('home.employer')</h4>
                <div class="footer-list">
                    <ul>
                        <li>
                            <a href="{{ route('login') }}">
                                <p>@lang('home.login')</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.create') }}">
                                <p>@lang('home.post_job')</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>@lang('home.how_it_work')</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-2 grid_3">
                <h4>@lang('home.candidate')</h4>
                <div class="footer-list">
                    <ul>
                        <li>
                            <a href="{{ route('login') }}">
                                <p>@lang('home.login')</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index') }}">
                                <p>@lang('home.find_job')</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>@lang('home.how_it_work')</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 grid_3">
                <h4>@lang('home.signup_email')</h4>
                <form>
                    <input type="text" class="form-control" placeholder="@lang('home.email')">
                    <button type="button" class="btn red">@lang('home.subcribe')</button>
                </form>
            </div>
            <div class="col-sm-2 grid_3">
                <ul>
                    <li class="dropdown my-drop-down">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <p><i class="fa fa-globe"></i>
                                @if (App::isLocale(Config::get('user.en')))
                                    @lang('home.english')
                                @else
                                    @lang('home.vietnamese')
                                @endif
                            </p>
                        </a>
                        <ul class="dropdown-menu my-drop-down-menu">
                            <li>
                                <a href="{{ route('change-language', ['locale' => Config::get('user.en')]) }}">
                                    @lang('home.english')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('change-language', ['locale' => Config::get('user.vi')]) }}">
                                    @lang('home.vietnamese')
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    @yield('script')
</body>

</html>
