@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.organisation.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.organisation.fields.title')</th>
                            <td field-key='title'>{{ $organisation->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#document" aria-controls="document" role="tab" data-toggle="tab">Document</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="document">
<table class="table table-bordered table-striped {{ count($documents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.document.fields.nr')</th>
                        <th>@lang('quickadmin.document.fields.title')</th>
                        <th>@lang('quickadmin.document.fields.description')</th>
                        <th>@lang('quickadmin.document.fields.signed')</th>
                        <th>@lang('quickadmin.document.fields.valid-from')</th>
                        <th>@lang('quickadmin.document.fields.valid-till')</th>
                        <th>@lang('quickadmin.document.fields.category')</th>
                        <th>@lang('quickadmin.document.fields.organisation')</th>
                        <th>@lang('quickadmin.document.fields.department')</th>
                        <th>@lang('quickadmin.document.fields.changed')</th>
                        <th>@lang('quickadmin.document.fields.title')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($documents) > 0)
            @foreach ($documents as $document)
                <tr data-entry-id="{{ $document->id }}">
                    <td field-key='nr'>{{ $document->nr }}</td>
                                <td field-key='title'>{!! $document->title !!}</td>
                                <td field-key='description'>{!! $document->description !!}</td>
                                <td field-key='signed'>{{ $document->signed }}</td>
                                <td field-key='valid_from'>{{ $document->valid_from }}</td>
                                <td field-key='valid_till'>{{ $document->valid_till }}</td>
                                <td field-key='category'>{{ $document->category->title or '' }}</td>
                                <td field-key='organisation'>{{ $document->organisation->title or '' }}</td>
                                <td field-key='department'>{{ $document->department->title or '' }}</td>
                                <td field-key='changed'>{{ $document->changed->nr or '' }}</td>
<td field-key='title'>{!! isset($document->changed) ? $document->changed->title : '' !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('document_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.documents.restore', $document->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('document_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.documents.perma_del', $document->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('document_view')
                                    <a href="{{ route('admin.documents.show',[$document->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('document_edit')
                                    <a href="{{ route('admin.documents.edit',[$document->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('document_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.documents.destroy', $document->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.organisations.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
