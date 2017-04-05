@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $lang['detail'] }}</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="w-200">{{ $lang['info']['content'] }}</td>
                                <td>{{ $comment->content }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['type'] }}</td>
                                <td>{{ $comment->getType($comment->type) }}</td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['object'] }}</td>
                                <td>
                                    @if ($comment->type == 1)
                                        <a href="{{ route('admin.article.show', ['id' => $object['id']]) }}">
                                            {{ $object['name']}}
                                        </a>
                                    @else
                                        <a href="{{ route('admin.document.show', ['id' => $object['id']]) }}">
                                            {{ $object['name']}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['status'] }}</td>
                                <td>{{ $comment->getStatus($comment->status) }}</td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['user'] }}</td>
                                <td>
                                    <a href="{{ route('admin.user.show', ['id' => $comment->user->id]) }}">
                                        {{ str_limit($comment->user->nickname, 20) }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.comment.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
