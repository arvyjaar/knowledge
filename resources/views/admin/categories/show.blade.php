@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.category.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.category.fields.category')</th>
                            <td field-key='category'>{{ $category->category }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.category.fields.description')</th>
                            <td field-key='description'>{!! $category->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.category.fields.department')</th>
                            <td field-key='department'>{{ $category->department->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#question" aria-controls="question" role="tab" data-toggle="tab">Question</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="question">
<table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.question.fields.question')</th>
                        <th>@lang('quickadmin.question.fields.answer')</th>
                        <th>@lang('quickadmin.question.fields.file')</th>
                        <th>@lang('quickadmin.question.fields.approved')</th>
                        <th>@lang('quickadmin.question.fields.author')</th>
                        <th>@lang('quickadmin.question.fields.category')</th>
                        <th>@lang('quickadmin.question.fields.department')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <tr data-entry-id="{{ $question->id }}">
                    <td field-key='question'>{!! $question->question !!}</td>
                                <td field-key='answer'>{!! $question->answer !!}</td>
                                <td field-key='file'>@if($question->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $question->file) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='approved'>{{ Form::checkbox("approved", 1, $question->approved == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='author'>{{ $question->author }}</td>
                                <td field-key='category'>{{ $question->category->category or '' }}</td>
                                <td field-key='department'>{{ $question->department->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('question_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.questions.restore', $question->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('question_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.questions.perma_del', $question->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('question_view')
                                    <a href="{{ route('admin.questions.show',[$question->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('question_edit')
                                    <a href="{{ route('admin.questions.edit',[$question->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('question_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.questions.destroy', $question->id])) !!}
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

            <a href="{{ route('admin.categories.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
