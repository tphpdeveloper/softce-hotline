@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Настройки Hotline</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                    {!! Form::open(['route' => 'admin.hotline.change_settings']) !!}
                        <div class="form-group">
                            {!! Form::label('private_key', 'Приватный ключ магазина на Hotline') !!}
                            {!! Form::text('hotline_magazine_key', (old('hotline_magazine_key') ? old('hotline_magazine_key') : $hotline_magazine_key) , ['class' => 'form-control', 'id' => 'private_key', 'required' => '']) !!}
                        </div>
                        @if($errors->has('hotline_magazine_key'))
                        <div class="alert alert-error">
                            {{ $errors->first('hotline_magazine_key') }}
                        </div>
                        @endif
                        <div class="form-group">
                            {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
                        </div>
                    {!! Form::close() !!}
                    </div>
                <!-- /.row -->
            </div>

        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->


@endsection