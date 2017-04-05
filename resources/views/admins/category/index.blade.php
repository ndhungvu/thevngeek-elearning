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
                        'route' => 'admin.category.index',
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
                                        'input' => $searchLang['input']['category']
                                    ]),
                                ])
                            }}
                        </div>
                        {{
                            Form::label('keyword', $searchLang['parent'], [
                                'class' => 'col-sm-2 control-label'
                            ])
                        }}
                        <div class="col-sm-4">
                            {{
                                Form::select('parent', $parentSearch, isset($searchInput['parent']) ? $searchInput['parent'] : null, [
                                    'class'=>'form-control',
                                    'placeholder' => trans('admin/search.placeholder.choice', [
                                        'choice' => $searchLang['choice']['parent']
                                    ]),
                                ])
                            }}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">
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
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                        <button class="btn btn-danger m-left-3" onclick="deleteMultiple('removeMultipleCategory[]')">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if (! count($categories))
                        @include('layouts.message', $notify)
                    @else
                        <table id="category_table" class="table table-hover table-bordered">
                            <tr class="tr-head">
                                <th class="text-center w-20"></th>
                                @foreach ($lang['table_head'] as $key => $head)
                                    <th class="text-center {{ $lang['table_head_width'][$key] }}">
                                        {{ $head }}
                                    </th>
                                @endforeach
                                <th class="text-center w-150"></th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr id="{{ $category->id }}">
                                    <td class="text-center">
                                        {{ Form::checkbox('removeMultipleCategory[]', $category->id, null) }}
                                    </td>
                                    <td class="text-center">{{ $loop->iteration + ($categories->currentPage() - 1)* 10 }}</td>
                                    <td class="text-center">
                                        {!! str_search_limit($category->name, 30, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! str_search_limit($category->description, 20, isset($searchInput['keyword']) ? $searchInput['keyword'] : null) !!}
                                    </td>
                                    <td class="text-center">
                                        @if ($category->image)
                                            <img src="{{ $category->getImageUrl($category->image) }}" width="50px" height="50px">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($parents->has($category->id))
                                            <a href="{{ route('admin.category.show', ['id' => $parents->get($category->id)['id']]) }}">
                                                {{ $parents->get($category->id)['name'] }}
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{
                                            Form::open([
                                                'route' => ['admin.category.destroy', $category->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirmDelete("' . __('message.confirm.delete', ['item' => $itemMessage]) . '")',
                                            ])
                                        }}
                                            <a href="{{ route('admin.category.show', ['id' => $category->id]) }}" class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-primary btn-xs">
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

                        {{ isset($linkFilter) ? $linkFilter : $categories->links() }}
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
