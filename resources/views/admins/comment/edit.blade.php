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
                @if ($comment)
                    <!-- form start -->
                    {{
                        Form::open([
                            'route' => ['admin.comment.update', $comment->id],
                            'method' => 'PUT',
                            'id' => 'comment_form',
                        ])
                    }}
                        <div class="box-body">
                            <div class="form-group">
                                {{
                                    Form::textarea('content', $comment->content, [
                                        'class' => 'form-control',
                                        'id' => 'content',
                                        'placeholder' => $lang['placeholder']['content'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type', $lang['placeholder']['type']) }}
                                {{
                                    Form::label('type', $lang['info']['article'], [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('type', 1, ($comment->type == 1)) }}
                                {{
                                    Form::label('type', $lang['info']['document'], [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('type', 2, ($comment->type == 2)) }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::select('object_id', ($comment->type == 1) ? $articles : $documents, $object['id'], [
                                        'class' => 'form-control',
                                        'id' => 'object_id',
                                        'placeholder' => $lang['placeholder']['object'],
                                    ])
                                 }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('status', $lang['placeholder']['status']) }}
                                {{
                                    Form::label('status', $lang['info']['waiting'], [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('status', 1, ($comment->status == 1)) }}
                                {{
                                    Form::label('status', $lang['info']['public'], [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('status', 2, ($comment->status == 2)) }}
                                {{
                                    Form::label('status', $lang['info']['cancel'], [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('status', 3, ($comment->status == 3)) }}
                            </div>
                        </div>
                    <!-- /.box-body -->
                        <div class="box-footer">
                            {{
                                Form::submit($lang['button']['save'], [
                                    'class' => 'btn btn-primary'
                                ])
                            }}
                            <a href="{{ route('admin.comment.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                        </div>
                    {{ Form::close() }}
                @endif
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
