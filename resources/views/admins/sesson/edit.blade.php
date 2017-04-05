@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Sesson</h3>
                </div>
                {{ Form::open(['route' => ['admin.sesson.update', $sesson->id],'method' => 'PUT','id' => 'frmArticle', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tiêu đề<span class="required">*</span></label>
                            <div class="col-sm-10">
                                {{ Form::text('name', $sesson->name, ['class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Mô tả', ['class'=> 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::textarea('description', $sesson->description, ['class'=>'form-control', 'rows' => 3]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('content', $sesson->content, ['class'=>'form-control jsTextarea', 'id' => 'textarea', 'rows' => 5]) }}
                            </div>
                        </div>
                        <?php $arrCategories = $sesson->ObjectCategories->pluck('category_id')->toArray();?>
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">Categories</label>
                            <div class="col-sm-10">
                                @if(!empty($trees))
                                <ul class="treeview">
                                    @foreach($trees as $key => $tree)
                                    <li class="col-sm-6">
                                        <input type="checkbox" name="categories[]" id="{!! $tree['id'] !!}" value="{!! $tree['id'] !!}" {!! !empty($arrCategories) && in_array($tree['id'].'', $arrCategories, true) ? 'checked = "checked"' : '' !!}>
                                        <label for="tall" class="{!! !empty($arrCategories) && in_array($tree['id'].'', $arrCategories, true) ? 'checked' : 'unchecked' !!}">{!! $tree['name'] !!}</label>
                                        @if(!empty($tree['parents']))
                                        <ul>
                                            <?php $trees_1 = $tree['parents'];?>
                                            @foreach($trees_1 as $key_1 => $tree_1)
                                            <li>
                                                <input type="checkbox" name="categories[]" id="{!! $tree_1['id'] !!}" value="{!! $tree_1['id'] !!}" {!! !empty($arrCategories) && in_array($tree_1['id'].'', $arrCategories, true) ? 'checked = "checked"' : '' !!}>
                                                <label for="tall-2" class="{!! !empty($arrCategories) && in_array($tree_1['id'].'', $arrCategories, true) ? 'checked' : 'unchecked' !!}">{!! $tree_1['name'] !!}</label>
                                                @if(!empty($tree_1['parents']))
                                                <ul>
                                                    <?php $trees_2 = $tree_1['parents'];?>
                                                    @foreach($trees_2 as $key_2 => $tree_2)
                                                    <li>
                                                         <input type="checkbox" name="categories[]" id="{!! $tree_2['id'] !!}" value="{!! $tree_2['id'] !!}" {!! !empty($arrCategories) && in_array($tree_2['id'].'', $arrCategories, true) ? 'checked = "checked"' : '' !!}>
                                                         <label for="tall-2-1" class="{!! !empty($arrCategories) && in_array($tree_2['id'].'', $arrCategories, true) ? 'checked' : 'unchecked' !!}">{!! $tree_2['name'] !!}</label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('Image', 'Image', ['class'=> 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                <img src="{!! $sesson->getImageUrl($sesson->image) !!}" alt=""  class="img-rounded w-200-h-150">
                                {{ Form::file('image', ['id' => 'image','class' => 'p-t-10'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('is_blog', '1', $sesson->is_blog) }} Blog</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {!! !empty($sesson->is_sesson) ? '' : 'jsDisabled' !!} jsTimeTracking">
                            <label for="time_tracking" class="col-sm-2 control-label">Thời gian làm bài<span class="required">*</span></label>
                            <div class="col-sm-3">
                                {{ Form::text('time_tracking', $sesson->time_tracking, ['class'=>'form-control', 'min' => 0]) }}
                            </div>                           
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Trạng thái</label>
                            <div class="col-sm-3">
                                {{ Form::select('status', App\Article::TYPE_STATUS, $sesson->status, ['placeholder' => '---Choice---','class'=>'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="f-right">
                            <a href="{!! route('admin.sesson.index') !!}" class="btn btn-default">Hủy</a>
                            {{ Form::submit('Lưu',['class'=>'btn btn-primary']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{ Html::script('assets/admin/js/validate/article.js', ['type' => 'text/javascript']) }}
@endsection
