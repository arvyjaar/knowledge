@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.comment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.comment.fields.question')</th>
                            <td field-key='question'>{{ $comment->question->question or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.comment.fields.name')</th>
                            <td field-key='name'>{{ $comment->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.comment.fields.email')</th>
                            <td field-key='email'>{{ $comment->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.comment.fields.text')</th>
                            <td field-key='text'>{!! $comment->text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.comment.fields.file')</th>
                            <td field-key='file'>@if($comment->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $comment->file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.comments.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
