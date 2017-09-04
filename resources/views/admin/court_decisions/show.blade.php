@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.court-decision.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.court-decision.fields.title')</th>
                            <td field-key='title'>{{ $court_decision->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#appeal" aria-controls="appeal" role="tab" data-toggle="tab">Appeal</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="appeal">
<table class="table table-bordered table-striped {{ count($appeals) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.appeal.fields.description')</th>
                        <th>@lang('quickadmin.appeal.fields.report')</th>
                        <th>@lang('quickadmin.appeal.fields.appellant')</th>
                        <th>@lang('quickadmin.appeal.fields.date')</th>
                        <th>@lang('quickadmin.appeal.fields.tags')</th>
                        <th>@lang('quickadmin.appeal.fields.reason')</th>
                        <th>@lang('quickadmin.appeal.fields.court-decision')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($appeals) > 0)
            @foreach ($appeals as $appeal)
                <tr data-entry-id="{{ $appeal->id }}">
                    <td field-key='description'>{!! $appeal->description !!}</td>
                                <td field-key='report'>{!! $appeal->report !!}</td>
                                <td field-key='appellant'>{{ $appeal->appellant }}</td>
                                <td field-key='date'>{{ $appeal->date }}</td>
                                <td field-key='tags'>
                                    @foreach ($appeal->tags as $singleTags)
                                        <span class="label label-info label-many">{{ $singleTags->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='reason'>
                                    @foreach ($appeal->reason as $singleReason)
                                        <span class="label label-info label-many">{{ $singleReason->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='court_decision'>{{ $appeal->court_decision->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('appeal_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.appeals.restore', $appeal->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('appeal_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.appeals.perma_del', $appeal->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('appeal_view')
                                    <a href="{{ route('admin.appeals.show',[$appeal->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('appeal_edit')
                                    <a href="{{ route('admin.appeals.edit',[$appeal->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('appeal_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.appeals.destroy', $appeal->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.court_decisions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
