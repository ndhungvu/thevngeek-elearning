@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Questions Sesson</h3>
                </div>
                <div class="box-body">
                    {{ Form::open(['method' => 'POST','id' => 'frmQuestion', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                    <div class="questions"></div>
                    <div class="box-footer col-xs-12">
                        <a href="javascript:void(0);" class="btn btn-warning jsAddQuestion">Thêm câu hỏi</a>
                        <div class="f-right">
                            <a href="{!! route('admin.sesson.index') !!}" class="btn btn-default">Hủy</a>
                            {{ Form::submit('Lưu',['class'=>'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    {{ Html::script('assets/admin/js/question.js', ['type' => 'text/javascript']) }}
    <script type="text/javascript">
     $(document).ready(function() {
        
     })
    </script>
@endsection
