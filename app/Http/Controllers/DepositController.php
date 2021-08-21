<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Binance\API;

class DepositController extends Controller
{
    public function index(){

        $api_key = 'sbtMmBOt1oIFbvy8sy2Wq4FOswpykenDxXlodjhaU6e7ON7rmGSneVNxyxwic9zq';
        $secret_key =  'LcCJiuQ4KXZayQT7FIGAb9Oy1uzysyrYCzcOAfR30fuDgE8WevgYCM4MZnj6dB2o';
        $api = new API($api_key, $secret_key);
        return $api->balances();
    }

    public function create(){

    }

    public function update(){

    }

    public function store(){
        
        
    }
}
