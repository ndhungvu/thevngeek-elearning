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
                @if ($user)
                    <!-- form start -->
                    {{
                        Form::open([
                            'route' => ['admin.user.update', $user->id],
                            'method' => 'PUT',
                            'id' => 'user_form',
                            'enctype' => 'multipart/form-data',
                        ])
                    }}
                        <div class="box-body">
                            <div class="form-group">
                                {{
                                    Form::text('fullname', $user->fullname, [
                                        'class' => 'form-control',
                                        'id' => 'fullname',
                                        'placeholder' => $lang['placeholder']['fullname'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('nickname', $user->nickname, [
                                        'class' => 'form-control',
                                        'id' => 'nickname',
                                        'placeholder' => $lang['placeholder']['nickname'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('email', $user->email, [
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'placeholder' => $lang['placeholder']['email'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('phone', $user->phone, [
                                        'class' => 'form-control',
                                        'id' => 'phone',
                                        'placeholder' => $lang['placeholder']['phone'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('facebook_link', $user->facebook_link, [
                                        'class' => 'form-control',
                                        'id' => 'facebook_link',
                                        'placeholder' => $lang['placeholder']['facebook_link'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('linkedin_link', $user->linkedin_link, [
                                        'class' => 'form-control',
                                        'id' => 'linkedin_link',
                                        'placeholder' => $lang['placeholder']['linkedin_link'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('github_link', $user->github_link, [
                                        'class' => 'form-control',
                                        'id' => 'github_link',
                                        'placeholder' => $lang['placeholder']['github_link'],
                                    ])
                                }}
                            </div>
                            <div class="form-group">
                                {{
                                    Form::text('stackoverflow_link', $user->stackoverflow_link, [
                                        'class' => 'form-control',
                                        'id' => 'stackoverflow_link',
                                        'placeholder' => $lang['placeholder']['stackoverflow_link'],
                                    ])
                                }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('status', $lang['placeholder']['status']) }}
                                {{
                                    Form::label('status', '', [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('status', 1, $user->status) }}
                                {{
                                    Form::label('status', '', [
                                        'class' => 'radio-inline'
                                    ])
                                }}
                                {{ Form::radio('status', 0, ! $user->status) }}
                            </div>
                        </div>
                    <!-- /.box-body -->
                        <div class="box-footer">
                            {{
                                Form::submit($lang['button']['save'], [
                                    'class' => 'btn btn-primary'
                                ])
                            }}
                            <a href="{{ route('admin.user.index') }}" class="btn btn-default">{{ $lang['button']['back'] }}</a>
                        </div>
                    {{ Form::close() }}
                @endif
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
