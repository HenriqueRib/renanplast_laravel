<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function home()
    {
        $produtos = Produto::orderBy('id', 'desc')->where('principal', '=', 0)->where('ativo', '=', 'Sim')->limit(3)->get();
        $produtos_principais = Produto::orderBy('id', 'desc')->where('principal', '=', 1)->where('ativo', '=', 'Sim')->limit(3)->get();

        return view('site.home', compact('produtos', 'produtos_principais'));
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
        $produtos = Produto::orderBy('id', 'desc')->where('principal', '=', 0)->where('ativo', '=', 'Sim')->paginate(3);

        $produtos_principais = Produto::orderBy('id', 'desc')->where('principal', '=', 1)->where('ativo', '=', 'Sim')->paginate(3);

        return view('site.produtos', compact('produtos', 'produtos_principais'));
        // return view('site.produtos');
    }
    public function produto($id)
    {
        $produto = Produto::where('id', $id)->with(['foto_produto'])->first();
        return view('site.produto', compact('produto'));
    }

    public function contato()
    {
        return view('site.contato');
    }
}
