@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.question.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.question.fields.question')</th>
                            <td field-key='question'>{!! $question->question !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question.fields.answer')</th>
                            <td field-key='answer'>{!! $question->answer !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question.fields.file')</th>
                            <td field-key='file's> @foreach($question->getMedia('file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $question->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question.fields.author')</th>
                            <td field-key='author'>{{ $question->author }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question.fields.category')</th>
                            <td field-key='category'>{{ $question->category->category or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question.fields.department')</th>
                            <td field-key='department'>{{ $question->department->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">Comment</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="comment">
<table class="table table-bordered table-striped {{ count($comments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.comment.fields.question')</th>
                        <th>@lang('quickadmin.comment.fields.name')</th>
                        <th>@lang('quickadmin.comment.fields.email')</th>
                        <th>@lang('quickadmin.comment.fields.text')</th>
                        <th>@lang('quickadmin.comment.fields.file')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($comments) > 0)
            @foreach ($comments as $comment)
                <tr data-entry-id="{{ $comment->id }}">
                    <td field-key='question'>{{ $comment->question->question or '' }}</td>
                                <td field-key='name'>{{ $comment->name }}</td>
                                <td field-key='email'>{{ $comment->email }}</td>
                                <td field-key='text'>{!! $comment->text !!}</td>
                                <td field-key='file'>@if($comment->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $comment->file) }}" target="_blank">Download file</a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('comment_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.comments.restore', $comment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('comment_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.comments.perma_del', $comment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('comment_view')
                                    <a href="{{ route('admin.comments.show',[$comment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('comment_edit')
                                    <a href="{{ route('admin.comments.edit',[$comment->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('comment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.comments.destroy', $comment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.questions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
