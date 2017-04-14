@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('general.label.detail')</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="w-200">@lang('general.label.name')</td>
                                <td>{!! $article->name !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.alias')</td>
                                <td>{!! $article->alias !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.description')</td>
                                <td>{!! $article->description !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.content')</td>
                                <td>{!! $article->content !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.image')</td>
                                <td>
                                    <img src="{!! $article->getImageUrl($article->image) !!}" alt=""  class="img-rounded w-200-h-150">
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.count_share')</td>
                                <td>{!! $article->count_shate !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.status')</td>
                                <td>{!! App\Article::TYPE_STATUS[$article->status]  !!}</td>
                            </tr>
                            @if(!empty($article->is_sesson))
                            <tr>
                                <td>@lang('general.label.lesson')</td>
                                <td>@lang('general.label.yes')</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.time_tracking')</td>
                                <td>{!! $article->time_tracking !!}</td>
                            </tr>
                            @else
                            <tr>
                                <td>@lang('general.label.lesson')</td>
                                <td>@lang('general.label.no')</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{!! route('admin.article.index') !!}" class="btn btn-default">@lang('general.btn.back')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
