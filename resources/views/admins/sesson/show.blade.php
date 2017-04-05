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
                                <td class="w-200">Name</td>
                                <td>{!! $sesson->name !!}</td>
                            </tr>
                            <tr>
                                <td>Alias</td>
                                <td>{!! $sesson->alias !!}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{!! $sesson->description !!}</td>
                            </tr>
                            <tr>
                                <td>Content</td>
                                <td>{!! $sesson->content !!}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>
                                    <img src="{!! $sesson->getImageUrl($sesson->image) !!}" alt=""  class="img-rounded w-200-h-150">
                                </td>
                            </tr>
                            <tr>
                                <td>Count shate</td>
                                <td>{!! $sesson->count_shate !!}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{!! App\Article::TYPE_STATUS[$sesson->status]  !!}</td>
                            </tr>
                            @if(!empty($sesson->is_sesson))
                            <tr>
                                <td>Is Sessong</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>Time tracking</td>
                                <td>{!! $sesson->time_tracking !!}</td>
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
                        <a href="{!! route('admin.sesson.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection