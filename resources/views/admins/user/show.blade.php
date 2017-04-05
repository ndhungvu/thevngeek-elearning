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
                                <td class="w-200">{{ $lang['info']['fullname'] }}</td>
                                <td>{{ $user->fullname }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['nickname'] }}</td>
                                <td>{{ $user->nickname }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['email'] }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['phone'] }}</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['facebook_link'] }}</td>
                                <td>{{ $user->facebook_link }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['linkedin_link'] }}</td>
                                <td>{{ $user->linkedin_link }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['github_link'] }}</td>
                                <td>{{ $user->github_link }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['stackoverflow_link'] }}</td>
                                <td>{{ $user->stackoverflow_link }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['status'] }}</td>
                                <td>{{ $user->getStatus($user->status) }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['rank'] }}</td>
                                <td>{{ $user->getRank($user->rank) }}</td>
                            </tr>
                            <tr>
                                <td class="w-200">{{ $lang['info']['role'] }}</td>
                                <td>{{ $user->getRole($user->role) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="f-right">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
