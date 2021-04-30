@extends('layouts.app')

@section('content')
    @include('layouts.search')
    <div class="container">
        <div class="single">
            <div class="col-md-10 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                @foreach ($companies as $company)
                                    <div class="jobs-item with-thumb">
                                        <div class="thumb">
                                            <a href="{{ route('companies.show', ['company' => $company->id]) }}">
                                                <img src="{{ asset($company->url) }}" class="img-responsive" alt="" />
                                            </a>
                                        </div>
                                        <div class="jobs_right">
                                            <div class="date_desc">
                                                <h6 class="title">
                                                    <a
                                                        href="{{ route('companies.show', ['company' => $company->id]) }}">{{ $company->name }}</a>
                                                </h6>
                                                <p>{{ $company->address }}</p>
                                                <span class="meta"></span>
                                            </div>
                                            <div class="clearfix"> </div>
                                            <br>
                                            <div class="col-md-6 single_right">
                                                <p>
                                                    <b>@lang('job.contact'): </b>
                                                    {{ $company->user->name }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 single_right">
                                                <p>
                                                    <b>@lang('job.email'): </b>
                                                    {{ $company->user->email }}
                                                </p>
                                            </div>
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
