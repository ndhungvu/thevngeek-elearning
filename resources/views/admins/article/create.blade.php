@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Create Article</h3>
                </div>
                {{ Form::open(['route' => 'admin.article.store','method' => 'POST','id' => 'frmArticle', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tiêu đề<span class="required">*</span></label>
                            <div class="col-sm-10">
                                {{ Form::text('name', '', ['class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Mô tả', ['class'=> 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::textarea('description', '', ['class'=>'form-control', 'rows' => 3]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('content', '', ['class'=>'form-control jsTextarea', 'id' => 'textarea', 'rows' => 5]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">Categories</label>
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
                            {{ Form::label('Image', 'Image', ['class'=> 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::file('image', ['id' => 'image'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('is_sesson', '1', '',['class' => 'jsSesson']) }} Sesson</label>
                                </div>
                            </div>
                        </div>
                        <div class="jsDisabled jsTimeTracking">
                            <label for="time_tracking" class="col-sm-2 control-label">Thời gian làm bài<span class="required">*</span></label>
                            <div class="col-sm-3">
                                {{ Form::text('time_tracking', 0, ['class'=>'form-control', 'min' => 0]) }}
                            </div>
                           
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="f-right">
                            <a href="{!! route('admin.article.index') !!}" class="btn btn-default">Hủy</a>
                            {{ Form::submit('Lưu',['class'=>'btn btn-primary']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.jsSesson').on('click', function() {
                if($(this).is(':checked'))
                {
                    $('.jsTimeTracking').removeClass('jsDisabled');
                }else {
                    $('.jsTimeTracking').addClass('jsDisabled');
                }
            });
        });
        $('#treeCategoires').multiselect({           
            enableCollapsibleOptGroups: true,
            enableClickableOptGroups: true,
            enableFiltering: true,
            includeSelectAllOption: true,
            maxHeight: 500,
            /*onChange: function(option, checked) {
                alert(option.length + ' options ' + (checked ? 'selected' : 'deselected'));
            }*/
        });
    </script>


    {{ Html::script('assets/admin/js/validate/article.js', ['type' => 'text/javascript']) }}
@endsection
