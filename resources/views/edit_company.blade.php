@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit_company.css') }}">
@endsection

@section('content')
    <div id="a">
        <div class="contact-us">
            <div class="label-choice">
                <div class="label-register">
                    <h2>@lang('company.update')</h2>
                </div>
            </div>
            <form action="{{ route('companies.update', ['company' => $company->id]) }}" method="POST" id="form-candidate"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <label for="name">@lang('company.name')<em>&#x2a;</em>
                    @error('name')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="name" name="name" value="{{ $company->name }}" required="" type="text" />
                <label for="address">@lang('company.address')<em>&#x2a;</em>
                    @error('address')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="address" name="address" value="{{ $company->address }}" required="" type="text" />
                <label for="website">@lang('company.website')<em>&#x2a;</em>
                    @error('website')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="website" name="website" value="{{ $company->website }}" required="" type="text" />
                <label for="avatar">
                    @lang('company.avatar')
                    @error('avatar')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input type="file" name="avatar" id="avatar">
                <label for="introduce">@lang('company.introduce')<em>&#x2a;</em>
                    @error('introduce')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <textarea class="ckeditor" id="introduce" name="introduce" required="" rows="4">
                    {!! $company->introduce !!}
                </textarea>
                <button id="employer-button">@lang('company.update')</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/register.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/style.js') }}"></script>
@endsection
