@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.court-decision.title')</h3>
    @can('court_decision_create')
    <p>
        <a href="{{ route('admin.court_decisions.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($court_decisions) > 0 ? 'datatable' : '' }} @can('court_decision_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('court_decision_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.court-decision.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($court_decisions) > 0)
                        @foreach ($court_decisions as $court_decision)
                            <tr data-entry-id="{{ $court_decision->id }}">
                                @can('court_decision_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $court_decision->title }}</td>
                                                                <td>
                                    @can('court_decision_view')
                                    <a href="{{ route('admin.court_decisions.show',[$court_decision->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('court_decision_edit')
                                    <a href="{{ route('admin.court_decisions.edit',[$court_decision->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('court_decision_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.court_decisions.destroy', $court_decision->id])) !!}
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
        @can('court_decision_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.court_decisions.mass_destroy') }}';
        @endcan

    </script>
@endsection