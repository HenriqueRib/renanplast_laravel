<?php

namespace App\Http\Controllers;

use App\Models\FotoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class FotoProdutoController extends Controller
{
    public function galeria()
    {
        $fotos = FotoProduto::orderBy('id', 'desc')->with(['produto'])->get();
        return view('admin.galeria', compact('fotos'));
    }

    public function gallery_search(Request $request)
    {
        $paramspesquisa = $request->pesquisa;
        try {
            $query = Produto::select('*')->orderBy('id', 'desc');
            if ($request['pesquisa'] != null) {
                $query->where('nome', 'like', '%' . $request['pesquisa'] . '%');
            }
            $empresa = $query->get();
            $fotos = FotoProduto::orderBy('id', 'desc')->where('id_produto', $empresa[0]->id)->with(['produto'])->get();
            return view('admin.galeria', compact('fotos', 'paramspesquisa'));
        } catch (\Throwable $th) {
            $fotos = [];
            return view('admin.galeria', compact('fotos', 'paramspesquisa'));
        }
    }

    public function galeria_add(Request $request)
    {
        // $request->associate // Precisa do id do produto para fazer a associação da imagem ao produto
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $f) {
                $foto_produto = new FotoProduto();
                $file = $f;
                $nameFile = rand(0, 1000) . $file->getClientOriginalName();
                $path = "/uploads/produtos/" . $request->associate . "/" . $nameFile;
                $file->move(public_path("/uploads/produtos/" . $request->associate . "/"), $nameFile);

                $foto_produto->imagem_produto = $path;
                $foto_produto->id_produto = $request->associate;
                $foto_produto->save();
            }
        }

        return redirect()->route('admin_galeria');
    }

    public function galeria_edit(Request $request)
    {
        try {
            $foto_produto = FotoProduto::find($request->id);

            if (isset($request->image)) {
                $image = $foto_produto->imagem_produto;

                if (file_exists('.' . $image)) {
                    unlink('.' . $image);
                }

                $file = $request->file('image');
                $nameFile = rand(0, 1000) . $file->getClientOriginalName();
                $path = "/uploads/produtos/" . $foto_produto->id_produto . "/" . $nameFile;
                $file->move(public_path("/uploads/produtos/" . $foto_produto->id_produto . "/"), $nameFile);

                $foto_produto->imagem_produto = $path;
            }

            $foto_produto->save();
            $request->session()->flash('status', 'Foto Alterada com sucesso.');
            return redirect()->route('admin_galeria');
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'O correu um erro. Tente novamente mais tarde.');
            return redirect()->route('admin_galeria');
        }
    }

    public function galeria_delete(Request $request)
    {
        try {
            $foto = FotoProduto::find($request->id);

            if (file_exists('.' . $foto->url)) {
                unlink('.' . $foto->url);
            }

            $foto->delete();
            $request->session()->flash('status', 'Foto deletada com sucesso.');
            return redirect()->route('admin_galeria');
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'O correu um erro. Tente novamente mais tarde.');
            return redirect()->route('admin_galeria');
        }
    }
}
