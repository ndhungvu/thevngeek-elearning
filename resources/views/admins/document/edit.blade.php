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
                @if ($document)
                    <!-- form start -->
                    {{
                        Form::open([
                            'route' => ['admin.document.update', $document->id],
                            'method' => 'PUT',
                            'id' => 'document_form',
                            'enctype' => 'multipart/form-data',
                        ])
                    }}
                        <div class="box-body">
                            <div class="form-group">
                                {{
                                    Form::text('name', $document->name, [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => $lang['placeholder']['name'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('alias', $document->alias, [
                                        'class' => 'form-control',
                                        'id' => 'alias',
                                        'placeholder' => $lang['placeholder']['alias'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('description', $document->description, [
                                        'class' => 'form-control',
                                        'id' => 'description',
                                        'placeholder' => $lang['placeholder']['description'],
                                    ])
                                }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('file', $lang['placeholder']['file']) }}
                                @if ($document->file)
                                    <a href="{{ route('download', ['file' => $document->file]) }}">
                                        {{ $document->file }}
                                    </a>
                                @endif
                                {{
                                    Form::file('file', [
                                        'class' => 'form-control',
                                        'id' => 'file',
                                    ])
                                }}
                            </div>

                            <div class="form-group">
                                {{
                                    Form::text('link', $document->link, [
                                        'class' => 'form-control',
                                        'id' => 'link',
                                        'placeholder' => $lang['placeholder']['link'],
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
                            <a href="{{ route('admin.document.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                        </div>
                    {{ Form::close() }}
                @endif
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
