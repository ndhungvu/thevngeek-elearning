@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    @include('layouts.error')
                    <h3 class="box-title">{{ $lang['edit'] }}</h3>
                </div>
                <!-- /.box-header -->
                @if ($category)
                    <!-- form start -->
                    {{
                        Form::open([
                            'route' => ['admin.category.update', $category->id],
                            'method' => 'PUT',
                            'id' => 'category_form',
                            'enctype' => 'multipart/form-data',
                        ])
                    }}
                        <div class="box-body">
                            <div class="form-group">
                                {{
                                    Form::text('name', $category->name, [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => $lang['placeholder']['name'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::textarea('description', $category->description, [
                                        'class' => 'form-control',
                                        'id' => 'description',
                                        'placeholder' => $lang['placeholder']['description'],
                                    ])
                                }}
                            </div>

                            @if ($category->image)
                                <div class="form-group">
                                    <img src="{{ $category->getImageUrl($category->image) }}" width="50px" height="50px">
                                </div>
                            @endif

                            <div class="form-group">
                                {{
                                    Form::file('image', [
                                        'class' => 'form-control',
                                        'id' => 'image',
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::select('parent', $categories, $category->parent, [
                                        'class' => 'form-control',
                                        'id' => 'parent',
                                        'placeholder' => $lang['placeholder']['parent'],
                                    ])
                                 }}
                            </div>
                        </div>
                    <!-- /.box-body -->
                        <div class="box-footer">
                            {{
                                Form::submit($lang['button']['save'], [
                                    'class' => 'btn btn-primary'
                                ])
                            }}
                            <a href="{{ route('admin.category.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                        </div>
                    {{ Form::close() }}
                @endif
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
