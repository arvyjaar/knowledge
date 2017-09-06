@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.document.title')</h3>
    @can('document_create')
    <p>
        <a href="{{ route('admin.documents.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('document_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.documents.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.documents.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($documents) > 0 ? 'datatable' : '' }} @can('document_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('document_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                        <th>@lang('quickadmin.document.fields.file')</th>
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
                                @can('document_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
                                <td field-key='file'> @foreach($document->getMedia('file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
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
                            <td colspan="16">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('document_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.documents.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection