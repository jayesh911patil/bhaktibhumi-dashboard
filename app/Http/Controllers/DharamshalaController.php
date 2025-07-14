<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DharamshalaController extends Controller
{
    public function Dharamshala()
    {
        return view('dharamshala.dharamshala');
    }

    public function Adddharamshala()
    {
        return view('dharamshala.add-dharamshala');
    }
}
