@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $searchLang['search'] }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                {{
                    Form::open([
                        'route' => 'admin.comment.index',
                        'method' => 'GET',
                        'class'=>'form-horizontal',
                        'id' => 'search_form'
                    ])
                }}
                <div class="box-body">
                    <div class="form-group">
                        {{
                            Form::label('keyword', $searchLang['keyword'], [
                                'class' => 'col-sm-1 control-label'
                            ])
                        }}
                        <div class="col-sm-3">
                            {{
                                Form::text('keyword', isset($searchInput['keyword']) ? $searchInput['keyword'] : '', [
                                    'class' => 'form-control',
                                    'placeholder' => trans('admin/search.placeholder.input', [
                                        'input' => $searchLang['input']['comment']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('type', $searchLang['type'], [
                                'class' => 'col-sm-1 control-label'
                            ])
                        }}
                        <div class="col-sm-2">
                            {{
                                Form::select('type', $lang['type'], isset($searchInput['type']) ? $searchInput['type'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['type']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('status', $searchLang['status'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-3">
                            {{
                                Form::select('status', $lang['status'], isset($searchInput['status']) ? $searchInput['status'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['status']
                                    ]),
                                ])
                            }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{
                            Form::label('article', $searchLang['article'], [
                                'class' => 'col-sm-1 control-label'
                            ])
                        }}
                        <div class="col-sm-3">
                            {{
                                Form::select('article', $articleAll, isset($searchInput['article_id']) ? $searchInput['article_id'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['article']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('document', $searchLang['document'], [
                                'class' => 'col-sm-1 control-label'
                            ])
                        }}
                        <div class="col-sm-2">
                            {{
                                Form::select('document', $documentAll, isset($searchInput['document_id']) ? $searchInput['document_id'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['document']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('user', $searchLang['user'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-3">
                            {{
                                Form::select('userAll', $users, isset($searchInput['user_id']) ? $searchInput['user_id'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['user']
                                    ]),
                                ])
                            }}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.comment.index') }}" class="btn btn-default">
                            {{ $searchLang['btn']['cancel'] }}
                        </a>
                        {{
                            Form::submit($searchLang['btn']['search'], [
                                'class' => 'btn btn-info'
                            ])
                        }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $lang['list'] }}</h3>
                    <div class="f-right">
                        <button class="btn btn-danger m-left-3" onclick="deleteMultiple('removeMultipleComment[]')">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if (! count($comments))
                        @include('layouts.message', $notify)
                    @else
                        <table class="table table-hover table-bordered">
                            <tr class="tr-head">
                                <th class="text-center w-20"></th>
                                @foreach ($lang['table_head'] as $key => $head)
                                    <th class="text-center {{ $lang['table_head_width'][$key] }}">
                                        {{ $head }}
                                    </th>
                                @endforeach
                                <th class="text-center w-150"></th>
                            </tr>
                            @foreach ($comments as $comment)
                                <tr id="{{ $comment->id }}">
                                    <td class="text-center">
                                        {{ Form::checkbox('removeMultipleComment[]', $comment->id, null) }}
                                    </td>
                                    <td class="text-center">{{ $loop->iteration + ($comments->currentPage() - 1)* 10 }}</td>
                                    <td class="text-center">
                                        {!! str_search_limit($comment->content, 30, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.show', ['id' => $comment->user->id]) }}">
                                            {{ str_limit($comment->user->nickname, 20) }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ str_limit($comment->getType($comment->type), 20) }}</td>
                                    <td class="text-center">
                                        @if ($comment->type == 1)
                                            @if (isset($articles[$comment->object_id]) && $articles[$comment->object_id])
                                                <a href="{{ route('admin.article.show', ['id' => $comment->object_id]) }}">
                                                    {{ str_limit($articles[$comment->object_id], 20) }}
                                                </a>
                                            @endif
                                        @else
                                            @if (isset($documents[$comment->object_id]) && $documents[$comment->object_id])
                                                <a href="{{ route('admin.document.show', ['id' => $comment->object_id]) }}">
                                                    {{ str_limit($documents[$comment->object_id], 20) }}
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">{{ str_limit($comment->getStatus($comment->status), 20) }}</td>
                                    <td class="text-center">
                                        {{
                                            Form::open([
                                                'route' => ['admin.comment.destroy', $comment->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirmDelete("' . __('message.confirm.delete', ['item' => $itemMessage]) . '")',
                                            ])
                                        }}
                                            <a href="{{ route('admin.comment.show', ['id' => $comment->id]) }}" class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.comment.edit', ['id' => $comment->id]) }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            {{
                                                Form::button('<i class="fa fa-fw fa-trash-o"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs'
                                                ])
                                            }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ isset($linkFilter) ? $linkFilter : $comments->links() }}
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
