@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.appeal.title')</h3>
    @can('appeal_create')
    <p>
        <a href="{{ route('admin.appeals.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('appeal_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.appeals.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.appeals.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($appeals) > 0 ? 'datatable' : '' }} @can('appeal_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('appeal_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('appeal_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('appeal_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.appeals.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection