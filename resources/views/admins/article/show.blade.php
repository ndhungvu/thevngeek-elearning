@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Article</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="w-200">Name</td>
                                <td>{!! $article->name !!}</td>
                            </tr>
                            <tr>
                                <td>Alias</td>
                                <td>{!! $article->alias !!}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{!! $article->description !!}</td>
                            </tr>
                            <tr>
                                <td>Content</td>
                                <td>{!! $article->content !!}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>
                                    <img src="{!! $article->getImageUrl($article->image) !!}" alt=""  class="img-rounded w-200-h-150">
                                </td>
                            </tr>
                            <tr>
                                <td>Count shate</td>
                                <td>{!! $article->count_shate !!}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{!! App\Article::TYPE_STATUS[$article->status]  !!}</td>
                            </tr>
                            @if(!empty($article->is_sesson))
                            <tr>
                                <td>Is Sessong</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>Time tracking</td>
                                <td>{!! $article->time_tracking !!}</td>
                            </tr>
                            @else
                            <tr>
                                <td>Is Sessong</td>
                                <td>No</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{!! route('admin.article.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
