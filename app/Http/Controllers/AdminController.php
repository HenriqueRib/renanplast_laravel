<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FotoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function check_admin()
    {
        return redirect()->route('admin_index');
    }
    public function index()
    {
        return view('admin.index');
    }

    // Produto
    public function produtos_principais()
    {
        $produtos = Produto::orderBy('id', 'desc')->where('principal', '=', '1')->with(['foto_produto'])->get();

        foreach ($produtos as $p) {
            $p->cores = explode(", ", $p->cores);
        }

        $pagina =  "Produtos Principais";
        $pagina_filtro = "Filtro Todos Produtos";

        return view('admin.produtos', compact('produtos', 'pagina', 'pagina_filtro'));
    }

    public function produtos()
    {
        $produtos = Produto::orderBy('id', 'desc')->with(['foto_produto'])->get();

        foreach ($produtos as $p) {
            $p->cores = explode(", ", $p->cores);
        }

        $pagina =  "Todos Produtos";
        $pagina_filtro = "Filtro Produtos Principais";

        return view('admin.produtos', compact('produtos', 'pagina', 'pagina_filtro'));
    }

    public function produtos_add(Request $request)
    {
        try {
            $params = $request->all();
            if (!isset($params['cores'])) {
                $request->session()->flash('error', 'Campo Cores é obrigatório');
                $params['cores'] = ["Sem cor"];
            }
            if (!isset($params['principal'])) {
                $params['principal'] = 0; //Não
            }
            if (!isset($params['estoque'])) {
                $request->session()->flash('error', 'Campo Estoque é obrigatório');
                return redirect()->back()->withInput();
            }
            if (!isset($params['ativo'])) {
                $request->session()->flash('error', 'Campo Ativo é obrigatório');
                return redirect()->back()->withInput();
            }
            $params['cores'] = implode(", ", $params['cores']);
            // dd($params);
            $produto = Produto::create($params);
            $file = $request->file('image');
            $nameFile = rand(0, 1000) . $file->getClientOriginalName();
            $path = "/uploads/produtos/" . $produto->id . "/" . $nameFile;
            $file->move(public_path("/uploads/produtos/" . $produto->id . "/"), $nameFile);
            $produto->image = $path;
            $produto->save();
            $request->session()->flash('status', 'Seu produto foi cadastrado com sucesso.');

            try {

                if ($request->hasFile('imagem_produto')) {
                    foreach ($request->file('imagem_produto') as $f) {
                        $foto_produto = new FotoProduto();
                        $file = $f;
                        $nameFile = rand(0, 1000) . $file->getClientOriginalName();
                        $path = "/uploads/produtos/" . $produto->id . "/" . $nameFile;
                        $file->move(public_path("/uploads/produtos/" . $produto->id . "/"), $nameFile);

                        $foto_produto->imagem_produto = $path;
                        $foto_produto->id_produto = $produto->id;
                        $foto_produto->save();
                    }
                }
                $request->session()->flash('status', 'As fotos do produto foi cadastrado com sucesso.');
            } catch (Exception $e) {
                $request->session()->flash('error', 'O correu um erro ao salvar as imagens do produtos. Tente adicionar na aba de Fotos de produtos.');
                return redirect()->route('admin_produtos');
            }

            $request->session()->flash('status', 'Seu produto foi cadastrado com sucesso.');
            return redirect()->route('admin_produtos');
        } catch (Exception $e) {
            // dd($e);
            $request->session()->flash('error', 'O correu um erro. Tente novamente mais tarde.');
            Log::debug("Erro ao adicionar produto", [
                'request' => $request->all(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'erro' => $e->getMessage(),
            ]);
            return redirect()->back();
        }
    }

    public function produto_edit(Request $request)
    {
        $params  = $request->all();
        // dd($params);
        if (!isset($params['cores'])) {
            $request->session()->flash('error', 'Campo cores é obrigatória');
            return redirect()->back();
        }
        if (!isset($params['principal'])) {
            $request->session()->flash('error', 'Campo principal é obrigatória');
            return redirect()->back();
        }
        if (!isset($params['estoque'])) {
            $request->session()->flash('error', 'Campo Estoque é obrigatório');
            return redirect()->back()->withInput();
        }
        if (!isset($params['ativo'])) {
            $request->session()->flash('error', 'Campo Ativo é obrigatório');
            return redirect()->back()->withInput();
        }

        try {
            $produto = Produto::find($request->id);
            // dd($produto);

            if (isset($request->image)) {
                $image = $produto->image;
                if (file_exists('.' . $image)) {
                    unlink('.' . $image);
                }
                $file = $request->file('image');
                $nameFile = rand(0, 1000) . $file->getClientOriginalName();

                $path = "/uploads/produtos/" . $produto->id . "/" . $nameFile;
                $file->move(public_path("/uploads/produtos/" . $produto->id . "/"), $nameFile);
                $produto->image = $path;
            }

            $produto->cores = implode(", ", $params['cores']);
            $produto->nome = $request->nome;
            $produto->descricao = $request->descricao;
            $produto->modo = $request->modo;
            $produto->medidas = $request->medidas;
            $produto->lote = $request->lote;
            $produto->serie = $request->serie;
            $produto->preco = $request->preco;
            $produto->estoque = $request->estoque;
            $produto->ativo = $request->ativo;
            $produto->cores = $request->cores;
            $produto->observacao = $request->observacao;
            $produto->principal = $request->principal;
            $produto->save();

            try {
                if ($request->hasFile('imagem_produto')) {
                    foreach ($request->file('imagem_produto') as $f) {
                        $foto_produto = new FotoProduto();
                        $file = $f;
                        $nameFile = rand(0, 1000) . $file->getClientOriginalName();
                        $path = "/uploads/produtos/" . $produto->id . "/" . $nameFile;
                        $file->move(public_path("/uploads/produtos/" . $produto->id . "/"), $nameFile);

                        $foto_produto->imagem_produto = $path;
                        $foto_produto->id_produto = $produto->id;
                        $foto_produto->save();
                    }
                }
                // $request->session()->flash('status', 'As fotos do produto foi cadastrado com sucesso.');
            } catch (Exception $e) {
                $request->session()->flash('error', 'O correu um erro ao salvar as imagens do produtos. Tente adicionar na aba de Fotos de produtos.');
                return redirect()->route('admin_produtos');
            }


            $request->session()->flash('status', 'Seu produto foi editado com sucesso.');
            return redirect()->route('admin_produtos');
        } catch (Exception $e) {
            // dd($e);
            $request->session()->flash('error', 'O correu um erro. Tente novamente mais tarde.');
            Log::debug("Erro ao editar produto", [
                'request' => $request->all(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'erro' => $e->getMessage(),
            ]);
            return redirect()->back();
        }
    }

    public function produto_search(Request $request)
    {

        $pagina =  "Todos Produtos";
        $pagina_filtro = "Filtro Produtos Principais";

        try {

            $query = Produto::select('*')->orderBy('id', 'desc');
            if ($request['nome'] != null) {
                $query->where('nome', 'like', '%' . $request['nome'] . '%');
            }

            $posts = $query->paginate(9);
            foreach ($posts as $p) {
                $p->cores = explode(", ", $p->cores);
            }

            return view('admin.produtos', [
                'produtos' => $posts,
                'paramsnome' => $request['nome'],
                'paramsprincipal' => $request['principal'],
                'paramsativo' => $request['ativo'],
                'pagina' =>  $pagina,
                'pagina_filtro' => $pagina_filtro,
            ]);
        } catch (Exception $e) {
            // dd($e);
            $request->session()->flash('error', 'O correu um erro. Tente novamente mais tarde.');
            Log::debug("Erro ao pesquisar produto", [
                'request' => $request->all(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'erro' => $e->getMessage(),
            ]);
            return redirect()->back();
        }
    }

    public function produto_delete(Request $request)
    {
        try {
            $produto = Produto::find($request->id);
            $image = $produto->image;
            if (isset($image)) {
                if (file_exists('.' . $image)) {
                    unlink('.' . $image);
                }
            }
            $foto = FotoProduto::orderBy('id', 'desc')->where('id_produto', $produto->id)->get();
            if ($foto->count() > 0) {
                foreach ($foto as $f) {
                    $foto_apagar = FotoProduto::find($f->id);
                    if (file_exists('.' . $foto_apagar->imagem_produto)) {
                        unlink('.' . $foto_apagar->imagem_produto);
                    }
                    $foto_apagar->delete();
                }
            }
            $produto->delete();
            $request->session()->flash('status', "O produto $produto->nome foi deletado com sucesso.");
            return redirect()->route('admin_produtos');
        } catch (Exception $e) {
            $request->session()->flash('error', 'O correu um erro. Tente novamente mais tarde.');
            Log::debug("Erro ao Deletar o produto", [
                'request' => $request->all(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'erro' => $e->getMessage(),
            ]);
            return redirect()->back();
        }
    }

    //Fim produtos

    public function administradores()
    {
        // $users = User::all();
        $users = User::orderBy('id', 'desc')->paginate(15);
        $total_representante = 0;
        foreach ($users as $user) {
            switch ($user->level) {
                case 0:
                    $user->tipo = "Sem atribuição";
                    break;
                case 1:
                    $user->tipo = "Administrador";
                    break;
            }
        }

        return view('admin.administradores', compact('users'));
    }


    public function user_search(Request $request)
    {
        $query = User::select('*')->orderBy('id', 'desc');

        if ($request['name'] != null) {
            $query->where('name', 'like', '%' . $request['name'] . '%');
        }
        if ($request['email'] != null) {
            $query->where('email', 'like', '%' . $request['email'] . '%');
        }

        return view('admin.administradores', [
            'users' => $query->paginate(15),
            'paramsname' => $request['name'],
            'paramsemail' => $request['email'],
        ]);
    }

    public function admin_add(Request $request)
    {
        $user = User::find($request->id);
        $user->level = 1;
        $user->save();
        return redirect()->route('admin_administradores');
    }

    public function admin_remove(Request $request)
    {
        $user = User::find($request->id);
        $user->level = 0;
        $user->save();
        return redirect()->route('admin_administradores');
    }

    public function user_delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('admin_administradores');
    }

    public function user_edit(Request $request)
    {
        try {
            $user = User::find($request->idUserSenha);
            $user->password = Hash::make($request->password);
            $user->save();
            $request->session()->flash('status', 'Senha alterada com sucesso.');
            return redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('error', 'Aconteceu algum erro. Tente novamente mais tarde.');
            return redirect()->back();
        }
    }
}
