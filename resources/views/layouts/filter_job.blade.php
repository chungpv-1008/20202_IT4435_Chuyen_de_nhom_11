<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
    @foreach ($jobs as $job)
        <div class="tab_grid">
            <div class="jobs-item with-thumb">
                <div class="thumb">
                    <a href="{{ route('companies.show', ['company' => $job->company_id]) }}">
                        <img src="{{ asset($job->url) }}" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="jobs_right">
                    <div class="date">
                        {{ $job->created_at->format('d') }}<span>{{ $job->created_at->format('M') }}</span>
                    </div>
                    <div class="date_desc">
                        <h6 class="title">
                            <a href="">{{ $job->title }}</a>
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
                                <form action="{{ route('job_by_tag', ['id' => $tag->id]) }}" method="GET">
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
                                            <a href="{{ route('cancel_apply', ['id' => $job->id]) }}">
                                                <font class="apply-status">
                                                    @lang('job.cancel_apply')
                                                </font>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <form action="{{ route('apply', ['id' => $job->id]) }}" method="POST">
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
