@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    @include('layouts.error')
                    <h3 class="box-title">{{ $lang['create'] }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{
                    Form::open([
                        'route' => 'admin.category.store',
                        'method' => 'POST',
                        'id' => 'category_form',
                        'enctype' => 'multipart/form-data',
                    ])
                }}
                    <div class="box-body">
                        <div class="form-group">
                            {{
                                Form::text('name', old('name'), [
                                    'class' => 'form-control',
                                    'id' => 'name',
                                    'placeholder' => $lang['placeholder']['name'],
                                ])
                            }}
                        </div>
                        <div class="form-group">
                            {{
                                Form::textarea('description', old('description'), [
                                    'class' => 'form-control',
                                    'id' => 'description',
                                    'placeholder' => $lang['placeholder']['description'],
                                ])
                            }}
                        </div>
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
                                Form::select('parent', $categories, null, [
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
                        {{
                            Form::button($lang['button']['add_new'], [
                                'type' => 'submit',
                                'name' => 'btnSubmitNew',
                                'value' => 1,
                                'class' => 'btn btn-primary'
                            ])
                        }}
                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
