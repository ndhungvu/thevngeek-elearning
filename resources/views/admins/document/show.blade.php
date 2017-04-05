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
                                <td class="w-200">{{ $lang['info']['user'] }}</td>
                                <td>{{ $document->user->nickname }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['name'] }}</td>
                                <td>{{ $document->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['alias'] }}</td>
                                <td>{{ $document->alias }}</td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['description'] }}</td>
                                <td>{{ $document->description }}</td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['file'] }}</td>
                                <td>
                                    @if ($document->file)
                                        <a href="{{ route('download', ['file' => $document->file]) }}">
                                            {{ $document->file }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['link'] }}</td>
                                <td>
                                    <a href="{{ $document->link }}" target="_blank">{{ $document->link }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ $lang['info']['status'] }}</td>
                                <td>{{ $document->getStatus($document->status) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.document.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
