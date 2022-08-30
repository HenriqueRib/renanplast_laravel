<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function home()
    {
        // $produtos = Produto::orderBy('id', 'desc')->limit(3)->get();
        return view('site.home');
        // return view('site.home', compact('posts'));
    }

    public function construcao()
    {
        return view('site.construcao');
    }

    public function sobre()
    {
        return view('site.sobre');
    }

    public function produtos()
    {
        return view('site.produtos');
    }

    public function contato()
    {
        return view('site.contato');
    }
}
