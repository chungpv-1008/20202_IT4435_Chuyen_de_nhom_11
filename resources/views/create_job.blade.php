@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="form-container">
                <h2>@lang('job.create')</h2>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-9">
                        <form action="{{ route('jobs.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-3 control-lable" for="title">@lang('job.title')</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control input-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-3 control-lable" for="experience">@lang('job.exp')</label>
                                    <div class="col-md-9">
                                        <input type="text" name="experience" class="form-control input-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-3 control-lable" for="salary">@lang('job.salary')</label>
                                    <div class="col-md-9">
                                        <input type="text" name="salary" class="form-control input-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-3 control-lable" for="tags">@lang('job.tag')</label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <tr>
                                                <td class="table-text">
                                                    <div>@lang('job.skill')</div>
                                                </td>
                                                <td>
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($skills as $skill)
                                                                <tr class="unread checked">
                                                                    <td class="hidden-xs">
                                                                        <input type="checkbox" name="tag[]"
                                                                            value="{{ $skill->id }}" class="checkbox">
                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        {{ $skill->name }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </div>
                                        <div class="col-md-2">
                                            <tr>
                                                <td class="table-text">
                                                    <div>@lang('job.language')</div>
                                                </td>
                                                <td>
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($langs as $lang)
                                                                <tr class="unread checked">
                                                                    <td class="hidden-xs">
                                                                        <input type="checkbox" name="tag[]"
                                                                            value="{{ $lang->id }}" class="checkbox">
                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        {{ $lang->name }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </div>
                                        <div class="col-md-2">
                                            <tr>
                                                <td class="table-text">
                                                    <div>@lang('job.working_time')</div>
                                                </td>
                                                <td>
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($workingTimes as $workingTime)
                                                                <tr class="unread checked">
                                                                    <td class="hidden-xs">
                                                                        <input type="checkbox" name="tag[]"
                                                                            value="{{ $workingTime->id }}" class="checkbox">
                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        {{ $workingTime->name }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-3 control-lable" for="description">@lang('job.description')</label>
                                    <div class="col-md-9">
                                        <textarea cols="77" rows="6" id="demo" class="ckeditor"
                                            name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-actions floatRight">
                                    <input type="hidden" name="status" value="0">
                                    <input type="hidden" name="company_id" value="{{ $id }}">
                                    <input type="submit" value="@lang('job.create')" class="btn btn-primary btn-sm">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
@endsection
