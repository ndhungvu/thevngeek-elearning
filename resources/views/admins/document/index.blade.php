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
                        'route' => 'admin.document.index',
                        'method' => 'GET',
                        'class'=>'form-horizontal',
                        'id' => 'search_form'
                    ])
                }}
                <div class="box-body">
                    <div class="form-group">
                        {{
                            Form::label('keyword', $searchLang['keyword'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-4">
                            {{
                                Form::text('keyword', isset($searchInput['keyword']) ? $searchInput['keyword'] : '', [
                                    'class' => 'form-control',
                                    'placeholder' => trans('admin/search.placeholder.input', [
                                        'input' => $searchLang['input']['document']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('status', $searchLang['status'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-4">
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
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.document.index') }}" class="btn btn-default">
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
                        <a href="{{ route('admin.document.create') }}" class="btn btn-primary">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                        <button class="btn btn-danger m-left-3" onclick="deleteMultiple('removeMultipleDocument[]')">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if (! count($documents))
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
                            @foreach ($documents as $document)
                                <tr id="{{ $document->id }}">
                                    <td class="text-center">
                                        {{ Form::checkbox('removeMultipleDocument[]', $document->id, null) }}
                                    </td>
                                    <td class="text-center">{{ $loop->iteration + ($documents->currentPage() - 1)* 10 }}</td>
                                    <td class="text-center">
                                        {!! str_search_limit($document->name, 20, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        @if ($document->file)
                                            <a href="{{ route('download', ['file' => $document->file]) }}">
                                                {!! str_search_limit($document->file, 30, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                            </a>
                                        @else
                                            <a href="{{ $document->link }}" target="_blank">
                                                {!! str_search_limit($document->link, 30, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ str_limit($document->getStatus($document->status), 20) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.show', ['id' => $document->user->id]) }}">
                                            {!! str_search_limit($document->user->nickname, 20, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                        </a>
                                    </td>
                                    <td>
                                        {{
                                            Form::open([
                                                'route' => ['admin.document.destroy', $document->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirmDelete("' . __('message.confirm.delete', ['item' => $itemMessage]) . '")',
                                            ])
                                        }}
                                            <a href="{{ route('admin.document.show', ['id' => $document->id]) }}" class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.document.edit', ['id' => $document->id]) }}" class="btn btn-primary btn-xs">
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

                        {{ isset($linkFilter) ? $linkFilter : $documents->links() }}
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
