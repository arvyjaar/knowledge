@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.tag.title')</h3>
    @can('tag_create')
    <p>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tags) > 0 ? 'datatable' : '' }} @can('tag_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('tag_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.tag.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($tags) > 0)
                        @foreach ($tags as $tag)
                            <tr data-entry-id="{{ $tag->id }}">
                                @can('tag_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $tag->title }}</td>
                                                                <td>
                                    @can('tag_view')
                                    <a href="{{ route('admin.tags.show',[$tag->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('tag_edit')
                                    <a href="{{ route('admin.tags.edit',[$tag->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('tag_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tags.destroy', $tag->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('tag_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.tags.mass_destroy') }}';
        @endcan

    </script>
@endsection