@extends('layouts.app')

@section('content')
    @include('layouts.search')
    <div class="container">
        <div class="grid_1">
            <h3>@lang('home.label')</h3>
            <ul id="flexiselDemo3">
                <li><img src="images/c1.gif" class="img-responsive" /></li>
                <li><img src="images/c2.gif" class="img-responsive" /></li>
                <li><img src="images/c3.gif" class="img-responsive" /></li>
                <li><img src="images/c4.gif" class="img-responsive" /></li>
                <li><img src="images/c5.gif" class="img-responsive" /></li>
                <li><img src="images/c6.gif" class="img-responsive" /></li>
            </ul>
        </div>
        <div class="single">
            <div class="col-md-3">
                <div class="col_3">
                    <h3>@lang('login.newjob')</h3>
                    <ul class="list_1">
                        @foreach ($newJobs as $job)
                            <li><a href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ $job->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" id="all-job">
                                <a href="" role="tab" id="profile-tab" data-toggle="tab"
                                    aria-controls="profile">@lang('home.all')</a>
                            </li>
                            @if (isset($suitableJobs))
                                <li role="presentation" id="suitable-job">
                                    <a href="" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                                        aria-expanded="true">@lang('home.suitable')</a>
                                </li>
                            @endif
                        </ul>
                        @if (isset($suitableJobs))
                            <div id="suitable-job-list" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" aria-labelledby="home-tab">
                                    @foreach ($suitableJobs as $job)
                                        <div class="tab_grid">
                                            <div class="jobs-item with-thumb">
                                                <div class="thumb">
                                                    <a
                                                        href="{{ route('companies.show', ['company' => $job->company_id]) }}">
                                                        <img src="{{ asset($job->url) }}" class="img-responsive" alt="" />
                                                    </a>
                                                </div>
                                                <div class="jobs_right">
                                                    <div class="date">{{ $job->created_at->format('d') }}
                                                        <span>{{ $job->created_at->format('M') }}</span>
                                                    </div>
                                                    <div class="date_desc">
                                                        <h6 class="title">
                                                            <a
                                                                href="{{ route('jobs.show', ['job' => $job]) }}">{{ $job->title }}</a>
                                                        </h6>
                                                        <p>{{ $job->company->address }}</p>
                                                        <span class="meta"></span>
                                                    </div>
                                                    <div class="clearfix"> </div>
                                                    <br>
                                                    <div class="col-md-5 single_right">
                                                        <p>
                                                            <b>@lang('job.company'): </b>
                                                            {{ $job->company->name }}
                                                        </p>
                                                        <p>
                                                            <b>@lang('job.tag'): </b>
                                                            @foreach ($job->tags as $tag)
                                                                <button class="tag">{{ $tag->name }}</button>
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 single_right">
                                                        <p>
                                                            <b>@lang('job.exp'): </b>
                                                            {{ $job->experience }}
                                                        </p>
                                                        <p>
                                                            <b>@lang('job.salary'): </b>
                                                            {{ $job->salary }}
                                                        </p>
                                                    </div>
                                                    @if (Auth::check() && Auth::user()->role_id === config('user.candidate'))
                                                        <div class="col-md-3 single_right">
                                                            @if ($appliedJobs->contains($job))
                                                                <li class="dropdown my-drop-down">
                                                                    <a href="#" class="dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        <font class="apply-status">@lang('job.waiting')
                                                                        </font>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('cancel_apply', ['id' => $job->id]) }}">
                                                                                <font class="apply-status">
                                                                                    @lang('job.cancel_apply')
                                                                                </font>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            @else
                                                                <form action="{{ route('apply', ['id' => $job->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('patch')
                                                                    <button type="submit" class="btn btn-default">
                                                                        @lang('job.apply')
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div id="all-job-list" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                @foreach ($allJobs as $job)
                                    <div class="tab_grid">
                                        <div class="jobs-item with-thumb">
                                            <div class="thumb">
                                                <a href="{{ route('companies.show', ['company' => $job->company_id]) }}">
                                                    <img src="{{ asset($job->url) }}" class="img-responsive" alt="" />
                                                </a>
                                            </div>
                                            <div class="jobs_right">
                                                <div class="date">{{ $job->created_at->format('d') }}
                                                    <span>{{ $job->created_at->format('M') }}</span>
                                                </div>
                                                <div class="date_desc">
                                                    <h6 class="title">
                                                        <a
                                                            href="{{ route('jobs.show', ['job' => $job]) }}">{{ $job->title }}</a>
                                                    </h6>
                                                    <p>{{ $job->company->address }}</p>
                                                    <span class="meta"></span>
                                                </div>
                                                <div class="clearfix"> </div>
                                                <br>
                                                <div class="col-md-5 single_right">
                                                    <p>
                                                        <b>@lang('job.company'): </b>
                                                        {{ $job->company->name }}
                                                    </p>
                                                    <p>
                                                        <b>@lang('job.tag'): </b>
                                                        @foreach ($job->tags as $tag)
                                                            <button class="tag">{{ $tag->name }}</button>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="col-md-4 single_right">
                                                    <p>
                                                        <b>@lang('job.exp'): </b>
                                                        {{ $job->experience }}
                                                    </p>
                                                    <p>
                                                        <b>@lang('job.salary'): </b>
                                                        {{ $job->salary }}
                                                    </p>
                                                </div>
                                                @if (Auth::check() && Auth::user()->role_id === config('user.candidate'))
                                                    <div class="col-md-3 single_right">
                                                        @if ($appliedJobs->contains($job))
                                                            <li class="dropdown my-drop-down">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <font class="apply-status">@lang('job.waiting')</font>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('cancel_apply', ['id' => $job->id]) }}">
                                                                            <font class="apply-status">
                                                                                @lang('job.cancel_apply')
                                                                            </font>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <form action="{{ route('apply', ['id' => $job->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('patch')
                                                                <button type="submit" class="btn btn-default">
                                                                    @lang('job.apply')
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                <center>{{ $allJobs->links() }}</center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/flexisel/js/jquery.flexisel.js') }}"></script>
    <script src="{{ asset('js/suitable_job.js') }}"></script>
@endsection
