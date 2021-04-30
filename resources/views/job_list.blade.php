@extends('layouts.app')

@section('content')
    @include('layouts.search')
    <div class="container">
        <div class="single">
            <div class="col-md-9 col-md-offset-1 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" id="approved_job" class="active">
                                <a href="" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                                    aria-expanded="true">@lang('admin.approved_job')</a>
                            </li>
                            <li role="presentation" id="unapproved_job">
                                <a href="" role="tab" id="profile-tab" data-toggle="tab"
                                    aria-controls="profile">@lang('admin.unapproved_job')</a>
                            </li>
                        </ul>
                        <div id="approved_job_list" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                @foreach ($approveJobs as $job)
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
                                                        {{ $job->company_id }}
                                                    </p>
                                                    <p>
                                                        <b>@lang('job.tag'): </b>
                                                        @foreach ($job->tags as $tag)
                                                            <button class="tag">{{ $tag->name }}</button>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="col-md-5 single_right">
                                                    <p>
                                                        <b>@lang('job.exp'): </b>
                                                        {{ $job->experience }}
                                                    </p>
                                                    <p>
                                                        <b>@lang('job.salary'): </b>
                                                        {{ $job->salary }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                        <div id="unapproved_job_list" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                @foreach ($unapproveJobs as $job)
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
                                                        {{ $job->company_id }}
                                                    </p>
                                                    <p>
                                                        <b>@lang('job.tag'): </b>
                                                        @foreach ($job->tags as $tag)
                                                            <button class="tag">{{ $tag->name }}</button>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="col-md-5 single_right">
                                                    <p>
                                                        <b>@lang('job.exp'): </b>
                                                        {{ $job->experience }}
                                                    </p>
                                                    <p>
                                                        <b>@lang('job.salary'): </b>
                                                        {{ $job->salary }}
                                                    </p>
                                                </div>
                                                <div class="col-md-2 single_right">
                                                    <a
                                                        href="{{ route('approve_job', ['id' => $job->id]) }}">@lang('admin.approve')</a>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/list_job.js') }}"></script>
@endsection
