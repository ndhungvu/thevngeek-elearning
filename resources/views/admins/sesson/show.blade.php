@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Sesson</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="w-200">@lang('general.label.name')</td>
                                <td>{!! $sesson->name !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.alias')</td>
                                <td>{!! $sesson->alias !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.description')</td>
                                <td>{!! $sesson->description !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.content')</td>
                                <td>{!! $sesson->content !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.image')</td>
                                <td>
                                    <img src="{!! $sesson->getImageUrl($sesson->image) !!}" alt=""  class="img-rounded w-200-h-150">
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.count_share')</td>
                                <td>{!! $sesson->count_share !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.status')</td>
                                <td>{!! App\Article::TYPE_STATUS[$sesson->status]  !!}</td>
                            </tr>
                             <tr>
                                <td>Time tracking</td>
                                <td>{!! $sesson->time_tracking !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('general.label.blog')</td>
                                <td>
                                @if($sesson->is_blog)
                                    @lang('general.label.yes')
                                @else
                                    @lang('general.label.no')
                                @endif
                                </td>
                            </tr>                           
                        </tbody>
    
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{!! route('admin.sesson.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection