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
                                <td class="w-200">{{ $lang['info']['name'] }}</td>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['description'] }}</td>
                                <td>{{ $category->description }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['image'] }}</td>
                                <td>
                                    <img src="{{ $category->getImageUrl($category->image) }}">
                                </td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['parent'] }}</td>
                                <td>
                                    @if ($parent)
                                        <i>{{ $lang['info']['parent'] }}</i>
                                        <p>{{ $lang['info']['name'] . ':'  . $parent->name }}</p>
                                        @if ($parent->description)
                                            <p>{{ $lang['info']['description'] . ':' . $parent->description }}</p>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
