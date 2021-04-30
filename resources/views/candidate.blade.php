@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="row">
                <div class="col-sm-4 follow_left">
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
                                    <a href="">{{ $job->title }}</a>
                                </h6>
                                <span class="meta">{{ $job->company->address }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 follow_left">
                    <h4>@lang('job.list_apply')</h4>
                    <div class="follow_jobs">
                        @foreach ($users as $user)
                            <div class="featured"></div>
                            <a href="{{ route('users.show', ['user' => $user]) }} ">
                                <img src="{{ asset($user->image->url) }}" alt="" class="img-circle">
                                <div class="title my-title">
                                    <div class="user" >
                                        <h5>{{ $user->name }}</h5>
                                        @if ($user->pivot->status == config('job_config.accepted'))
                                            <p>@lang('job.accepted')</p>
                                        @elseif ($user->pivot->status == config('job_config.rejected'))
                                            <p>@lang('job.rejected')</p>
                                        @endif
                                    </div>
                                    <div>
                                        @if ($user->pivot->status == config('job_config.waiting'))
                                            <form action="{{ route('accept_reject', ['user_id' => $user->id, 'job_id' => $job->id, 'status' => config('job_config.accepted')]) }}" method="POST">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-warning" ><p>@lang('job.accept')</p>
                                                </button>
                                            </form>
                                            <form action="{{ route('accept_reject', ['user_id' => $user->id, 'job_id' => $job->id, 'status' => config('job_config.rejected')]) }}" method="POST">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-primary"><p>@lang('job.reject')</p>
                                                </button>
                                            </form>
                                        @endif
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
