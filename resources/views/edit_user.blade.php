@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit_user.css') }}">
@endsection

@section('content')
    <div id="content-main">
        <div class="contact-us">
            <div class="label-choice">
                <div class="label-register">
                    <h2>@lang('user.update')</h2>
                </div>
            </div>
            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" id="form-candidate"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <label for="name">@lang('register.fullname')<em>&#x2a;</em>
                    @error('name')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="name" name="name" value="{{ $user->name }}" required="" type="text" />
                <label for="email">@lang('register.email')<em>&#x2a;</em>
                    @error('email')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input id="email" name="email" value="{{ $user->email }}" required="" type="email" />
                @if (Auth::user()->role_id == config('user.candidate'))
                    <label for="cv">
                        @lang('user.cv')
                        @error('cv')
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                        @enderror
                    </label>
                    <input type="file" id="cv" name="cv">
                @endif
                <label for="avatar">
                    @lang('user.avatar')
                    @error('avatar')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <input type="file" id="avatar" name="avatar">
                <label for="introduce">@lang('register.introduce')<em>&#x2a;</em>
                    @error('introduce')
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}</span>
                    @enderror
                </label>
                <textarea class="ckeditor" id="introduce" name="introduce" required="" rows="4">
                                {!!  $user->introduce !!}
                            </textarea>
                @if (Auth::user()->role_id == config('user.candidate'))
                    <div class="tag">
                        <tr>
                            <td class="">
                                <div>@lang('job.skill')</div>
                            </td>
                            <td>
                                <table class="tag-table">
                                    <tbody>
                                        @foreach ($skills as $skill)
                                            <tr class="unread checked">
                                                <td class="hidden-xs">
                                                    <input type="checkbox" class="input-checkbox" checked="true"
                                                        name="tag[]" value="{{ $skill->id }}" class="checkbox">
                                                </td>
                                                <td class="hidden-xs">
                                                    {{ $skill->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($skillsNotBelongTo as $skill)
                                            <tr class="unread checked">
                                                <td class="hidden-xs">
                                                    <input type="checkbox" class="input-checkbox" name="tag[]"
                                                        value="{{ $skill->id }}" class="checkbox">
                                                </td>
                                                <td class="hidden-xs">
                                                    {{ $skill->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <div>@lang('job.language')</div>
                            </td>
                            <td>
                                <table class="tag-table">
                                    <tbody>
                                        @foreach ($langs as $lang)
                                            <tr class="unread checked">
                                                <td class="hidden-xs">
                                                    <input type="checkbox" class="input-checkbox" name="tag[]"
                                                        checked="true" value="{{ $lang->id }}" class="checkbox">
                                                </td>
                                                <td class="hidden-xs">
                                                    {{ $lang->name }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach ($langsNotBelongTo as $lang)
                                            <tr class="unread checked">
                                                <td class="hidden-xs">
                                                    <input type="checkbox" class="input-checkbox" name="tag[]"
                                                        value="{{ $lang->id }}" class="checkbox">
                                                </td>
                                                <td class="hidden-xs">
                                                    {{ $lang->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <div>@lang('job.working_time')</div>
                            </td>
                            <td>
                                <table class="tag-table">
                                    <tbody>
                                        @foreach ($workingTimes as $workingTime)
                                            <tr class="unread checked">
                                                <td class="hidden-xs">
                                                    <input type="checkbox" class="input-checkbox" name="tag[]"
                                                        checked="true" value="{{ $workingTime->id }}" class="checkbox">
                                                </td>
                                                <td class="hidden-xs">
                                                    {{ $workingTime->name }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach ($workingTimesNotBelongTo as $working)
                                            <tr class="unread checked">
                                                <td class="hidden-xs">
                                                    <input type="checkbox" class="input-checkbox" name="tag[]"
                                                        value="{{ $working->id }}" class="checkbox">
                                                </td>
                                                <td class="hidden-xs">
                                                    {{ $working->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </div>
                @endif
                <button id="employer-button">@lang('user.update')</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/register.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/style.js') }}"></script>
@endsection
