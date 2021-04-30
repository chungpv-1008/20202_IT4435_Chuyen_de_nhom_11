@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="row">
                <div class="col-md-1 single_right">
                </div>
                <div class="col-md-9 single_right">
                    <div class="but_list">
                        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                                        aria-expanded="true">
                                        @lang('job.apply')
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                    @foreach ($jobs as $job)
                                        <div class="tab_grid">
                                            <div class="jobs-item with-thumb" href="">
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
                                                        <span class="meta">{{ $job->company->address }}</span>
                                                    </div>
                                                    <div class="clearfix"> </div>
                                                    <br>
                                                    <div class="col-md-5 single_right">
                                                        <p>
                                                            <b>@lang('job.company'): </b>
                                                            {{ $job->company->name }}
                                                        </p>
                                                        <span class="flex">
                                                            <p><b>@lang('job.tag'): </b></p>
                                                            @foreach ($job->tags as $tag)
                                                                <form action="{{ route('job_by_tag', ['id' => $tag->id]) }}"
                                                                    method="GET">
                                                                    @csrf
                                                                    <p>
                                                                        &nbsp;
                                                                        <button class="tag">{{ $tag->name }}</button>
                                                                    </p>
                                                                </form>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4 single_right">
                                                        <p>
                                                            <b>@lang('job.exp'): </b>
                                                            {{ $job->experience }}
                                                        </p>
                                                        <p>
                                                            <b>@lang('job.salary'): </b>{{ $job->salary }}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3 single_right">
                                                        @if ($job->pivot->status == config('job_config.waiting'))
                                                            <li class="dropdown my-drop-down">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <font class="apply-status">@lang('job.waiting')</font>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="{{ route('cancel_apply', ['id' => $job->id]) }}">
                                                                            <font class="apply-status">@lang('job.cancel_apply')</font>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        @elseif ($job->pivot->status == config('job_config.accepted'))
                                                            <font class="apply-status">@lang('job.accepted')</font>
                                                        @else
                                                            <font class="apply-status">@lang('job.rejected')</font>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
