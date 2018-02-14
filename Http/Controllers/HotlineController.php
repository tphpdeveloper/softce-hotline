<?php


namespace Softce\Hotline\Http\Controllers;

use Illuminate\Routing\Controller;
use Softce\Hotline\Hotline;
use Mage2\Ecommerce\Models\Database\Category;
use Softce\Hotline\Http\Requests\CreateHotlineRequest;
use Illuminate\Support\Collection;
use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Models\Database\ConfigurationCurrency;
use Mage2\Ecommerce\Models\Database\Availability;
use File;

class HotlineController extends Controller
{
    private $guaranties = null;

    public function __construct(){
        $this->guaranties = Collection::make([
            '6' => '6 месяцев',
            '12' => '12 месяцев',
            '24' => '24 месяца',
            '36' => '36 месяцев',
            '48' => '48 месяцев',
            '60' => '60 месяцев',
        ]);
    }

    public function show(){

        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('hotline::index', [
            'categories' => $categories,
            'guaranties' => $this->guaranties
        ]);
    }


    public function create(CreateHotlineRequest $request){

        $magazine_key = (new Configuration)->hotline_magazine_key;
        if(is_null($magazine_key)) {
            return redirect()->back()->with('errorText', 'В настройках не указан ключ магазина из сервиса Hotline')->withInput();
        }

        //get selected categories
        $categories = Category::whereIn('id', $request->product_category)->get();

        //get rate the site
        $current_currency = ConfigurationCurrency::where('main', '1')->first();

        //get availability data
        $availability = Availability::query()->pluck('name', 'id')->toArray();

//        dd($request->all());


        $hotline_template = view('hotline::hotline', [
            'magazine_key' => $magazine_key,
            'categories' => $categories,
            'rate' => $current_currency->rate,
            'guaranty' => (is_null($request->product_war) ? null : $this->guaranties[$request->product_war]),
            'availability' => $availability
        ])->render();

        $name_file = 'hotline.xml';
        $bytes_written = File::put(public_path('/'.$name_file), $hotline_template);

        if ($bytes_written === false){
            return redirect()->back()->with('errorText', 'Ошибка записи в файл '.$name_file);
        }
        return redirect()->back()->with('notificationText', 'Файл '.$name_file.' успешно создан');
    }
}