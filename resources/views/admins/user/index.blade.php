@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!--Search-->
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
                        'route' => 'admin.user.index',
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
                        <div class="col-sm-10">
                            {{
                                Form::text('keyword', isset($searchInput['keyword']) ? $searchInput['keyword'] : '', [
                                    'class' => 'form-control',
                                    'placeholder' => trans('admin/search.placeholder.input', [
                                        'input' => $searchLang['input']['user']
                                    ]),
                                ])
                            }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{
                            Form::label('rank', $searchLang['rank'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-4">
                            {{
                                Form::select('rank', $lang['rank'], isset($searchInput['rank']) ? $searchInput['rank'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['rank']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('role', $searchLang['role'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-4">
                            {{
                                Form::select('role', $lang['role'], isset($searchInput['role']) ? $searchInput['role'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['role']
                                    ]),
                                ])
                            }}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-default">
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
            <!--End search-->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $lang['list'] }}</h3>
                    <div class="f-right">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                        <button class="btn btn-danger m-left-3" onclick="deleteMultiple('removeMultipleUser[]')">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if (! count($users))
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
                            @foreach ($users as $user)
                                <tr id="{{ $user->id }}">
                                    <td class="text-center">
                                        {{ Form::checkbox('removeMultipleUser[]', $user->id, null) }}
                                    </td>
                                    <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1)* 10 }}</td>
                                    <td class="text-center">
                                        {!! str_search_limit($user->nickname, 30, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! str_search_limit($user->email, 50, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! str_search_limit($user->phone, 20, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        {{ str_limit($user->getRank($user->rank), 20) }}
                                    </td>
                                    <td class="text-center">
                                        {{ str_limit($user->getRole($user->role), 20) }}
                                    </td>
                                    <td class="text-center w-150">
                                        @if ($user->role == 1)
                                            <a href="{{ route('admin.user.show', ['id' => $user->id]) }}" class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                        @else
                                            {{
                                                Form::open([
                                                    'route' => ['admin.user.destroy', $user->id],
                                                    'method' => 'DELETE',
                                                    'onsubmit' => 'return confirmDelete("' . __('message.confirm.delete', ['item' => $itemMessage]) . '")',
                                                ])
                                            }}
                                                <a href="{{ route('admin.user.show', ['id' => $user->id]) }}" class="btn btn-success btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-xs">
                                                    <i class="fa fa-fw fa-pencil"></i>
                                                </a>
                                            {{
                                                Form::button('<i class="fa fa-fw fa-trash-o"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs'
                                                ])
                                            }}
                                            {{ Form::close() }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ isset($linkFilter) ? $linkFilter : $users->links() }}
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
