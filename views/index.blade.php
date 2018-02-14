@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Выберите категории для выгрузки</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['route' => 'admin.hotline.create']) !!}
            <!-- Select multiple-->
            <div class="form-group">
                <label class="control-label">Выберите категорию *</label>
                <select name="product_category[]" multiple size="10" class="form-control">
                    <option value="" ></option>
                    @if($categories->count())
                        @include('hotline::tamplate.option', [
                            'categories' => $categories,
                            'prefix' => '',
                            'old' => old('product_category')
                        ])
                    @endif
                </select>
                @if($errors->has('product_category'))
                    <div class="alert-error">
                        {{ $errors->first('product_category') }}
                    </div>
                @endif
            </div>

            <!-- select -->
            <div class="form-group">
                <label class="control-label">Гарантия</label>
                <select name="product_war" class="form-control">
                    <option value="">Не указывать</option>
                    @if(count($guaranties))
                        @foreach($guaranties as $number_month => $text)
                            <option value="{{ $number_month }}"
                                    @if(old('product_war') && old('product_war') == $number_month)
                                        selected
                                    @endif
                                    >
                                {{ $text }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if($errors->first('product_war'))
                    <div class="alert-error">
                        {{ $errors->first('product_war') }}
                    </div>
                @endif
            </div>

            {{--
            <div class="form-group">
                <label class="control-label">Наличие *</label>
                <br />
                <label>
                    <input type="radio"
                           name="product_qty"
                           value="yes"
                           class="flat-red"
                           checked
                            @if(old('product_qty') && old('product_qty') == 'yes')
                                checked
                            @endif

                           />
                    Указывать
                </label>
                <br />
                <label>
                    <input type="radio"
                           name="product_qty"
                           value="no"
                           class="flat-red"

                           @if(old('product_qty') && old('product_qty') == 'no')
                                checked
                            @endif
                           >
                    Не указывать
                </label>
                @if($errors->first('product_qty'))
                    <div class="alert-error">
                        {{ $errors->first('product_qty') }}
                    </div>
                @endif
            </div>
            --}}


            <div class="form-group">
                <button class="btn btn-success">Создать</button>
            </div>
       {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        @if(File::exists(public_path('hotline.xml')))
        <a href="/public/hotline.xml" download class="btn btn-success" target="_blank">Скачать файл</a>
        @endif
    </div>

</div>


@endsection