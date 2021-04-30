@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="row">
                <div class="col-md-1 single_right"></div>
                <div class="col-md-7 single_right">
                    <div class="tab_grid">
                        <div class="jobs-item with-thumb">
                            <div class="thumb">
                                <a href="">
                                    <img src="{{ asset($images->url) }}" alt="" />
                                </a>
                            </div>
                            <div class="jobs_right">
                                <div class="date_desc">
                                    <h3 class="title">{{ $company->name }}</h3>
                                    <h5 class="meta">{{ $company->address }}</h5>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 single_right">
                                <p>
                                <h3>@lang('company.introduce'):</h3>
                                {!! $company->introduce !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 single_right"></div>
                <div class="col-md-3 ">
                    <div class="single">
                        <div class="col_3">
                            <h3>@lang('company.job_company')</h3>
                            <ul class="list_1">
                                @foreach ($company->jobs as $job)
                                    <li><a href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ $job->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection
