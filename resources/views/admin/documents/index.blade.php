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
            <table class="table table-bordered table-striped ajaxTable @can('document_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('document_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.document.fields.nr')</th>
                        <th>@lang('quickadmin.document.fields.title')</th>
                        <th>@lang('quickadmin.document.fields.signed')</th>
                        <th>@lang('quickadmin.document.fields.valid-from')</th>
                        <th>@lang('quickadmin.document.fields.valid-till')</th>
                        <th>@lang('quickadmin.document.fields.organisation')</th>
                        <th>@lang('quickadmin.document.fields.category')</th>
                        <th>@lang('quickadmin.document.fields.file')</th>
                        <th>@lang('quickadmin.document.fields.changed')</th>
                        <th>@lang('quickadmin.document.fields.title')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('document_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.documents.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.documents.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [
                @can('document_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan
                {data: 'nr', name: 'nr'},
                {data: 'title', name: 'title'},
                {data: 'signed', name: 'signed'},
                {data: 'valid_from', name: 'valid_from'},
                {data: 'valid_till', name: 'valid_till'},
                {data: 'organisation.title', name: 'organisation.title'},
                {data: 'category.title', name: 'category.title'},
                {data: 'file', name: 'file'},
                {data: 'changed.nr', name: 'changed.nr'},
                {data: 'changed.title', name: 'changed.title'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection