@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="col-md-4">
                <div class="col_3">
                    <h3>@lang('login.newjob')</h3>
                    <ul class="list_1">
                        @foreach ($jobs as $job)
                            <li><a href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ $job->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8 single_right">
                <div class="login-form-section">
                    <div class="login-content">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="section-title">
                                <h3>@lang('login.login-title')</h3>
                            </div>
                            <div class="textbox-wrap">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                    <input type="text" name="email" required="required" class="form-control"
                                        placeholder="@lang('login.email')">
                                </div>
                            </div>
                            <div class="textbox-wrap">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                    <input type="password" name="password" required="required" class="form-control "
                                        placeholder="@lang('login.password')">
                                </div>
                            </div>
                            <div class="forgot">
                                <div class="login-check">
                                    <label class="checkbox1"><input type="checkbox" name="remember" checked=""><i>
                                        </i>@lang('login.rememberme')</label>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="login-btn">
                                <input type="submit" value="@lang('login.login')">
                            </div>
                        </form>
                        <div class="login-bottom">
                            <p>@lang('login.social-title')</p>
                            <div class="social-icons">
                                <div class="button">
                                    <a class="tw" href="#"> <i class="fa fa-twitter tw2">
                                        </i><span>@lang('login.twitter')</span>
                                        <div class="clearfix"> </div>
                                    </a>
                                    <a class="fa" href="#"> <i class="fa fa-facebook tw2">
                                        </i><span>@lang('login.facebook')</span>
                                        <div class="clearfix"> </div>
                                    </a>
                                    <a class="go" href="#"><i class="fa fa-google-plus tw2">
                                        </i><span>@lang('login.google')</span>
                                        <div class="clearfix"> </div>
                                    </a>
                                    <div class="clearfix"> </div>
                                </div>
                                <h4>@lang('login.question')<a href="">@lang('login.register')</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection
