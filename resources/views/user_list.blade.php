@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single">
        <div class="row">
            <div class="col-sm-2 follow_left">
            </div>
            <div class="col-sm-8 follow_left">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="" id="employer" role="tab" data-toggle="tab">@lang('admin.employer')</a>
                    </li>
                    <li role="presentation">
                        <a href="" role="" id="candidate" data-toggle="tab">@lang('admin.candidate')</a>
                    </li>
                </ul>
                <div class="follow_jobs" id='employer_list'>
                    @foreach ($employers as $employer)
                        <a href="{{ route('users.show', ['user' => $employer]) }}">
                            <img src="{{ asset($employer->image->url) }}" alt="" class="img-circle">
                            <div class="title my-title">
                                <div class="user" >
                                    <h5>{{ $employer->name }}</h5>
                                    @switch ($employer->status)
                                        @case (config('user.block'))
                                            <p>@lang('user.blocked')</p>
                                            @break
                                        @case (config('user.unconfirmed'))
                                            <p>@lang('user.unapprove')</p>
                                            @break
                                        @default
                                            <p>@lang('user.active')</p>
                                    @endswitch
                                </div>
                                <div>
                                    @switch ($employer->status)
                                        @case (config('user.block'))
                                            <form action="{{ route('update_user', ['id' => $employer->id, 'status' => config('user.confirmed')]) }}" method="GET">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-primary"><p>@lang('user.unblock')</p>
                                                </button>
                                            </form>
                                            @break
                                        @case (config('user.unconfirmed'))
                                            <form action="{{ route('update_user', ['id' => $employer->id, 'status' => config('user.confirmed')]) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">
                                                    <p>@lang('user.approve')</p>
                                                </button>
                                            </form>
                                            <form action="{{ route('update_user', ['id' => $employer->id, 'status' => config('user.block')]) }}" method="GET">
                                                @csrf
                                                <button data-confirm="@lang('job.block_confirm')" type="submit" class="btn btn-danger button-confirm">
                                                    <p>@lang('user.block')</p>
                                                </button>
                                            </form>
                                            @break
                                        @default
                                            <form action="{{ route('update_user', ['id' => $employer->id, 'status' => config('user.block')]) }}" method="GET">
                                                @csrf
                                                <button data-confirm="@lang('job.block_confirm')" type="submit" class="btn btn-danger button-confirm">
                                                    <p>@lang('user.block')</p>
                                                </button>
                                            </form>
                                    @endswitch
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="follow_jobs" id='candidate_list'>
                    @foreach ($candidates as $candidate)
                        <a href="{{ route('users.show', ['user' => $candidate]) }}">
                            <img src="{{ asset($candidate->image->url) }}" alt="" class="img-circle">
                            <div class="title my-title" >
                                <div class="user" >
                                    <h5>{{ $candidate->name }}</h5>
                                    @switch ($candidate->status)
                                        @case (config('user.block'))
                                            <p>@lang('user.blocked')</p>
                                            @break
                                        @case (config('user.unconfirmed'))
                                            <p>@lang('user.unapprove')</p>
                                            @break
                                        @default
                                            <p>@lang('user.active')</p>
                                    @endswitch
                                </div>
                                <div>
                                    @switch ($candidate->status)
                                    @case (config('user.block'))
                                    <form action="{{ route('update_user', ['id' => $candidate->id, 'status' => config('user.confirmed')]) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <p>@lang('user.unblock')</p>
                                        </button>
                                    </form>
                                    @break
                                    @default
                                    <form action="{{ route('update_user', ['id' => $candidate->id, 'status' => config('user.block')]) }}" method="GET">
                                        @csrf
                                        <button data-confirm="@lang('job.block_confirm')" type="submit" class="btn btn-danger button-confirm">
                                            <p>@lang('user.block')</p>
                                        </button>
                                    </form>
                                    @endswitch
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/list_user.js') }}"></script>
@endsection
