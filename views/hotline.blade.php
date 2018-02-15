<?php '<?xml version="1.0" encoding="UTF-8" ?>
'; ?>
<price>
    <date>{{ date('Y-m-d H:i') }}</date>
    <firmName>{{ config('app.name') }}</firmName>
    <firmId>{{ $magazine_key }}</firmId>

    @if($rate > 1)
    <rate>{{ $rate }}</rate>
    @endif

    <categories>
        @if($categories)
        @foreach($categories as $category)
        <category>
            <id>{{ $category->id }}</id>
            @if($category->parent_id)
            <parentId>{{ $category->parent_id }}</parentId>
            @endif
            <name>{{ $category->name }}</name>
        </category>
        @endforeach
        @endif
    </categories>
    <items>
        @if($categories)
        @foreach($categories as $category)
        <?php
        $products = $category->products()->chunk(100, function($products) use ($category, $rate, $availability, $guaranty) {
            if (count($products)) {
                foreach ($products as $product) {
                    $name_producer = $product->attributeValue()->wherePivot('attribute_id', 5)->first();
                    ?>
                    <item>
                        <id>{{ $product->id }}</id>
                        <categoryId>{{ $category->id }}</categoryId>
                        <code>{{ $product->sku }}</code>
                        {{--<barcode>48607830</barcode>--}}
                        <vendor>@if(!is_null($name_producer)) {{ $name_producer->name }}  @endif</vendor>
                        <name>{{ $product->name }}</name>
                        <description>{{ htmlentities($product->description) }}</description>
                        <url>{{ route('product.view', [$product->slug]) }}</url>
                        <?php $main_image = $product->images()->where('is_main_image', '1')->first(); ?>
                        <image>{{ env('APP_URL').$main_image->path->relativePath }}</image>
                        <priceRUAH>{{ MultipleCurrency::setRate()->price($product->price_discount) }}</priceRUAH>

                        @if($product->price_discount < $product->price)
                        <oldprice>{{ MultipleCurrency::setRate()->price($product->price) }}</oldprice>
                        @endif

                        @if($rate > 1)
                        <priceRUSD>{{ MultipleCurrency::price($product->price)}}</priceRUSD>
                        @endif

                        <stock>{{ $availability[$product->in_stock] }}</stock>

                        @if($guaranty)
                        <guarantee>{{ $guaranty }}</guarantee>
                        @endif
                        {{--
                        <param name="Страна изготовления">Украина</param>
                        <param name="Оригинальность">Оригинал</param>
                        <condition>1</condition>
                        <custom>1</custom>
                        --}}
                    </item>
                    <?
                }
            }
        });
        ?>
        @endforeach
        @endif
    </items>
</price>