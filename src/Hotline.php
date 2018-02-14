<?php

namespace Softce\Hotline;

class Hotline{

    private $categories = null;
    private $ids = [];

    public function __construct($categories){
        $this->categories = $categories;
    }

    public function setIdsCategory(array $array){
        $this->ids = $array;
    }


    private function array_key_exists_recursive($key, $arr)
    {
        if (array_key_exists($key, $arr)) {
            return true;
        }
        foreach ($arr as $value) {
            if (is_array($value)) {
                return $this->array_key_exists_recursive($key, $value);
            }
        }
        return false;
    }

}