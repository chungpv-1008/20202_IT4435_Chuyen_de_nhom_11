@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/user.css') }}" rel='stylesheet' type='text/css' />
@endsection
@section('content')
    <div class="container-1">
        <div class="profile-header">
            <div class="profile-img">
                <img src="{{ asset($user->image->url) }}" width="200" alt="@lang('user.profile_image')" />
            </div>
            <div class="profile-nav-info">
                <h3 class="user-name">{{ $user->name }}</h3>
            </div>
            <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-message"></span>
                </div>
            </div>
        </div>

        <div class="main-bd">
            <div class="left-side">
                <div class="profile-side">
                    <p class="user-mail"><i class="fa fa-envelope"></i>{{ $user->email }}</p>
                    @if ($user->role_id === config('user.candidate'))
                        <div class="profile-btn">
                            <button class="chatbtn" id="chatBtn"><a class="fa fa-download" href="{{ asset($user->cv) }}"
                                    download="cv">@lang('job.download')</a></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="right-side">
                <div class="profile-body">
                    <div class="profile-posts tab">
                        <h1>@lang('job.introduce')</h1>
                        <div class="introduce">
                            {!! $user->introduce !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
