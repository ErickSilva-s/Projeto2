<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliverymanController extends Controller
{
    public function index()
    {
        return view('deliveryman.index');

    }
}
