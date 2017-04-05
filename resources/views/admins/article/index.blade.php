@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!--Search-->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tìm Kiếm</h3>
                </div>
                {{ Form::open(['method' => 'GET', 'class'=>'form-horizontal', 'id' => 'frmSearch']) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Từ khóa</label>
                            <div class="col-sm-4">
                                {{ Form::text('keyword', '', ['class' => 'form-control', 'placeholder' => 'Tiêu đề, Mô tả, Nội dung']) }}
                            </div>
                            <label class="col-sm-2 control-label">Trạng thái</label>
                            <div class="col-sm-4">
                                {{ Form::select('status', App\Article::TYPE_STATUS, null, ['placeholder' => '---Choice---','class'=>'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="f-right">
                            <a href="{!! route('admin.article.index') !!}" class="btn btn-default">Hủy</a>
                            <button type="submit" class="btn btn-info ">Tìm Kiếm</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <!--End search-->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List articles</h3>
                    <div class="f-right">
                        <a href="{{ route('admin.article.create') }}" class="btn btn-primary">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                        <a href="#" class="btn btn-danger m-left-3">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th class="text-center w-100">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center w-100">Image</th>
                            <th class="text-center w-300">Author</th>
                            <th class="text-center w-100">Status</th>
                            <th class="text-center w-150">Function</th>
                        </tr>
                        @if(!empty($articles))
                            <?php
                            $numberRow = $articles->total();
                            $currentPage = $articles->currentPage();
                            ?>
                            @foreach ($articles as $key => $article)
                                <tr>
                                    <td class="text-center">{!! ($key +1) + ($currentPage - 1)*App\Article::LIMIT !!}</td>
                                    <td>{{ str_limit($article->name, 30) }}</td>
                                    <td>{{ ($article->description) ? str_limit($article->description, 50) : '' }}</td>
                                    <td class="text-center">
                                        @if ($article->image)
                                            <img src="{{ $article->getImageUrl($article->image) }}" width="50px" height="50px">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#">
                                            {{ str_limit($article->user->fullname, 20) }}
                                        </a>
                                    </td>
                                    <td class="text-center">{!! App\Article::TYPE_STATUS[$article->status]  !!}</td>
                                    <td class="text-center">                                        
                                        {{ Form::open(['route' => ['admin.article.destroy', $article->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . __('message.confirm.delete') . '")',]) }}
                                            <a href="{{ route('admin.article.show', ['id' => $article->id]) }}" class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.article.edit', ['id' => $article->id]) }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            {{ Form::button('<i class="fa fa-fw fa-trash-o"></i>', ['type' => 'submit','class' => 'btn btn-danger btn-xs'])}}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">No Results</td>
                            </tr>
                        @endif
                    </table>
                    <!-- Paginations -->
                    {{ $articles->links() }}
                    <!-- End Paginations -->
                </div>
            </div>
        </div>
    </div>
@endsection
