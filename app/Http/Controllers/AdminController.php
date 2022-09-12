<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    public function produtos()
    {
        // return view('admin.posts', compact('posts'));
        $produtos = Produto::orderBy('id', 'desc')->get();
        // $produtos = [];
        return view('admin.produtos', compact('produtos'));
    }

    public function produtos_add(Request $request)
    {
        try {
            $params = $request->all();
            if (!isset($params['cores'])) {
                $request->session()->flash('error', 'Campo Cores é obrigatório');
                $params['cores'] = ["Sem cor"];
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

    // public function posts_add_tinymce_data(Request $request)
    // {
    //     $file = $request->file('file');
    //     $nameFile = rand(0, 1000) . $file->getClientOriginalName();
    //     $path = url("/uploads/") . '/' . $nameFile;
    //     $imgpath = $file->move(public_path("/uploads/"), $nameFile);
    //     $fileNameToStore = $path;

    //     return json_encode(['location' => $fileNameToStore]);
    // }

    public function produto_edit(Request $request)
    {
        // $post_id = $request->id;
        // $post = Post::find($post_id);
        // // dd($post);

        // if (isset($request->image)) {
        //     $image = $post->image;

        //     if (file_exists('.' . $image)) {
        //         unlink('.' . $image);
        //     }

        //     $file = $request->file('image');
        //     $nameFile = rand(0, 1000) . $file->getClientOriginalName();
        //     $path = '/uploads/' . $nameFile;
        //     $file->move(public_path("/uploads/"), $nameFile);
        //     $post->image = $path;
        // }

        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->date = $request->date;
        // $post->txt = $request->txt;

        // $post->save();
        // return redirect()->route('admin_posts');
    }

    public function produto_search(Request $request)
    {
        // $query = Post::select('title', 'date', 'description', 'image', 'txt', 'id')->orderBy('id', 'desc');

        // if ($request['title'] != null) {
        //     $query->where('title', 'like', '%' . $request['title']);
        // }
        // if ($request['date'] != null) {
        //     $query->whereDate('date', '=', $request['date']);
        // }

        // return view('admin.posts', [
        //     'posts' => $query->get(),
        //     'paramstitle' => $request['title'],
        //     'paramsdate' => $request['date'],
        // ]);
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
