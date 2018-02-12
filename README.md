# Work with module create hotline xml file

**1.**
```php
//write to composer.json
"require": {
    ...
    "softce/hotline" : "dev-master"
}

"autoload": {
    ... ,

    "sr-4": {
        ... ,

        "Softce\\Hotline\\" : "vendor/softce/hotline/"
    }
}
```


**2.**
```php
//in console write

composer update
```


**3.**
```php
//in service provider config/app

'providers' => [
    ... ,
    Softce\Hotline\HotlineServiceProvider::class,
]
```


**4.**
```php

//write to file modules\mage2\ecommerce\src\AdminMenu\Provider.php in group Export


$hotline = new AdminMenu();
$hotline->key('export_hotline')
        ->label('Експорт товаров для Hotline')
        ->route('admin.hotline.create')
        ->icon('fa-arrow-right');
$exportMenu->subMenu('export_hotline', $hotline);
```

