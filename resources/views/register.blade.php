@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div id="content-main">
        <div class="contact-us">
            <div class="label-choice">
                <div class="label-register">
                    <h2>@lang('register.register')</h2>
                </div>
                <div class="choice">
                    <div class="employer">
                        <input id="employer" name="choice-register" value="employer" type="radio">
                        <label for="employer">@lang('register.employer')</label>
                    </div>
                    <div class="candidate">
                        <input id="candidate" name="choice-register" checked="true" value="candidate" type="radio">
                        <label for="candidate">@lang('register.candidate')</label>
                    </div>
                </div>
            </div>
            <form action="{{ route('register') }}" method="POST" id="form-candidate">
                @csrf
                <label for="name">@lang('register.fullname')<em>&#x2a;</em>
                    @error('name')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="name" name="name" required="" type="text" />
                <label for="email">@lang('register.email')<em>&#x2a;</em>
                    @error('email')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="email" name="email" required="" type="email" />
                <label for="password">@lang('register.password')<em>&#x2a;</em>
                    @error('password')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="password" name="password" required="" type="password" />
                <label for="password_confirmation">@lang('register.confirm_password')<em>&#x2a;</em></label>
                <input id="password_confirmation" name="password_confirmation" required="" type="password" />
                <button id="candidate-button">@lang('register.register')</button>
            </form>
            <form action="{{ route('employer.register') }}" method="POST" id="form-employer">
                @csrf
                <label for="name">@lang('register.fullname')<em>&#x2a;</em>
                    @error('name')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="name" name="name" required="" type="text" />
                <label for="email">@lang('register.email')<em>&#x2a;</em>
                    @error('email')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="email" name="email" required="" type="email" />
                <label for="password">@lang('register.password')<em>&#x2a;</em>
                    @error('password')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="password" name="password" required="" type="password" />
                <label for="password_confirmation">@lang('register.confirm_password')<em>&#x2a;</em></label>
                <input id="password_confirmation" name="password_confirmation" required="" type="password" />
                <label for="name-company">@lang('register.name_company')<em>&#x2a;</em>
                    @error('name-company')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="name-company" name="name-company" required="" type="text" />
                <label for="address">@lang('register.address')<em>&#x2a;</em>
                    @error('address')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="address" name="address" required="" type="text" />
                <label for="link-website">@lang('register.link_website')<em>&#x2a;</em>
                    @error('link-website')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="link-website" name="link-website" required="" type="text" />
                <label for="introduce-company">@lang('register.introduce_company')<em>&#x2a;</em>
                    @error('introduce-company')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <textarea class="ckeditor" id="introduce-company" name="introduce-company" required="" rows="4"></textarea>
                <button id="employer-button">@lang('register.register')</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/register.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/style.js') }}"></script>
@endsection
