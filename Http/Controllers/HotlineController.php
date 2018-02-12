<?php


namespace Softce\Hotline\Http\Controllers;

use Illuminate\Routing\Controller;
use Softce\Hotline\Hotline;
use Mage2\Ecommerce\Models\Database\Category;


class HotlineController extends Controller
{

    public function create(){
//        $hotline = new Hotline(Category::all());
//        return $hotline->create();
        return view('hotline::index');
    }
}