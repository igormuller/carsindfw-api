<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrokerController extends Controller
{
    public function detail(Request $request)
    {
        $broker = $request->attributes->get('broker');
        return ['name' => $broker->name];
    }
}
