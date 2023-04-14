<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait CommonTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function pr($var ) {
        echo "<pre>";
        print_r($var);
        echo "<pre>";
        exit();
    }

}
