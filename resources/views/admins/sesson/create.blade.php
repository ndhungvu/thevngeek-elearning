@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('general.label.create_new')</h3>
                </div>
                {{ Form::open(['route' => 'admin.sesson.store','method' => 'POST','id' => 'frmArticle', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('general.label.name')<span class="required">*</span></label>
                            <div class="col-sm-10">
                                {{ Form::text('name', '', ['class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('general.label.description')</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('description', '', ['class'=>'form-control', 'rows' => 3, 'maxlength' => 255]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('general.label.content')<span class="required">*</span></label>
                            <div class="col-sm-10">
                                {{ Form::textarea('content', '', ['class'=>'form-control jsTextarea', 'id' => 'textarea', 'rows' => 5]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('general.label.category')</label>
                            <div class="col-sm-10">
                                @if(!empty($trees))
                                <ul class="treeview">
                                    @foreach($trees as $key => $tree)
                                    <li class="col-sm-6">
                                        <input type="checkbox" name="categories[]" id="{!! $tree['id'] !!}" value="{!! $tree['id'] !!}">
                                        <label for="tall" class="unchecked">{!! $tree['name'] !!}</label>
                                        @if(!empty($tree['parents']))
                                        <ul>
                                            <?php $trees_1 = $tree['parents'];?>
                                            @foreach($trees_1 as $key_1 => $tree_1)
                                            <li>
                                                <input type="checkbox" name="categories[]" id="{!! $tree_1['id'] !!}" value="{!! $tree_1['id'] !!}">
                                                <label for="tall-2" class="unchecked">{!! $tree_1['name'] !!}</label>
                                                @if(!empty($tree_1['parents']))
                                                <ul>
                                                    <?php $trees_2 = $tree_1['parents'];?>
                                                    @foreach($trees_2 as $key_2 => $tree_2)
                                                    <li>
                                                         <input type="checkbox" name="categories[]" id="{!! $tree_2['id'] !!}" value="{!! $tree_2['id'] !!}">
                                                         <label for="tall-2-1" class="unchecked">{!! $tree_2['name'] !!}</label>
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
                            <label class="col-sm-2 control-label">@lang('general.label.image')</label>
                            <div class="col-sm-10">
                                {{ Form::file('image', ['id' => 'image'])}}
                            </div>
                        </div>                        
                        <div class="jsTimeTracking">
                            <label class="col-sm-2 control-label">@lang('general.label.time_tracking')<span class="required">*</span></label>
                            <div class="col-sm-3">
                                {{ Form::text('time_tracking', '', ['class'=>'form-control', 'min' => 0]) }}
                            </div>
                           
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('is_blog', '1', '',['class' => 'jsBlog']) }} @lang('general.label.blog')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="f-right">
                            <a href="{!! route('admin.sesson.index') !!}" class="btn btn-default">@lang('general.btn.back')</a>
                            <input class="btn btn-primary" type="submit" value="@lang('general.btn.save')">
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{ Html::script('assets/admin/js/validate/article.js', ['type' => 'text/javascript']) }}
@endsection
