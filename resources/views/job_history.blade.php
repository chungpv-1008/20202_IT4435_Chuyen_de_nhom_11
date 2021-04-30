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
                                        @lang('job.history')
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
                                                    <div class="col-md-6 single_right">
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
                                                    <div class="col-md-6 single_right">
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
                                                <div class="clearfix"></div>
                                                <ul class="top-btns">
                                                    <li>
                                                        <form action="{{ route('list_candidate', ['id' => $job->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class="fa fa-users btn">
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('jobs.edit', ['job' => $job]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class="fa fa-pencil btn">
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('jobs.destroy', ['job' => $job]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button data-confirm="@lang('job.delete_job')" type="submit"
                                                                class="fa fa-trash-o btn button-confirm">
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
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

@section('script')
    <script src="{{ asset('js/job_history.js') }}"></script>
@endsection
