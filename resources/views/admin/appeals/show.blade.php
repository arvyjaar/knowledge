@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.appeal.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.description')</th>
                            <td field-key='description'>{!! $appeal->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.report')</th>
                            <td field-key='report'>{!! $appeal->report !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.appellant')</th>
                            <td field-key='appellant'>{{ $appeal->appellant }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.date')</th>
                            <td field-key='date'>{{ $appeal->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.tags')</th>
                            <td field-key='tags'>
                                @foreach ($appeal->tags as $singleTags)
                                    <span class="label label-info label-many">{{ $singleTags->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.reason')</th>
                            <td field-key='reason'>
                                @foreach ($appeal->reason as $singleReason)
                                    <span class="label label-info label-many">{{ $singleReason->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.appeal.fields.court-decision')</th>
                            <td field-key='court_decision'>{{ $appeal->court_decision->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.appeals.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
