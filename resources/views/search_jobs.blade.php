@extends('layouts.app')

@section('content')
    @include('layouts.search')
    <div class="container">
        <div class="single">
            <div class="col-md-9 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                @foreach ($jobs as $job)
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
                                            @if (Auth::check() && Auth::user()->role_id === config('user.candidate'))
                                                <div class="col-md-2 single_right">
                                                    <form action="{{ route('apply', ['id' => $job->id]) }}" method="POST">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">
                                                            @lang('job.apply')
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="clearfix"> </div>
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
