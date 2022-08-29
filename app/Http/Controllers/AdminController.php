<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Throwable;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
    // public function posts()
    // {
    //     $posts = Post::orderBy('id', 'desc')->get();
    //     return view('admin.posts', compact('posts'));
    // }

    // public function posts_add(Request $request)
    // {
    //     $post = Post::create($request->all());

    //     $file = $request->file('image');
    //     $nameFile = rand(0, 1000) . $file->getClientOriginalName();
    //     $path = '/uploads/' . $nameFile;
    //     $file->move(public_path("/uploads/"), $nameFile);

    //     $post->image = $path;
    //     $post->save();
    //     return redirect()->route('admin_posts');
    // }

    // public function posts_add_tinymce_data(Request $request)
    // {
    //     $file = $request->file('file');
    //     $nameFile = rand(0, 1000) . $file->getClientOriginalName();
    //     $path = url("/uploads/") . '/' . $nameFile;
    //     $imgpath = $file->move(public_path("/uploads/"), $nameFile);
    //     $fileNameToStore = $path;

    //     return json_encode(['location' => $fileNameToStore]);
    // }

    // public function post_edit(Request $request)
    // {
    //     $post_id = $request->id;
    //     $post = Post::find($post_id);
    //     // dd($post);

    //     if (isset($request->image)) {
    //         $image = $post->image;

    //         if (file_exists('.' . $image)) {
    //             unlink('.' . $image);
    //         }

    //         $file = $request->file('image');
    //         $nameFile = rand(0, 1000) . $file->getClientOriginalName();
    //         $path = '/uploads/' . $nameFile;
    //         $file->move(public_path("/uploads/"), $nameFile);
    //         $post->image = $path;
    //     }

    //     $post->title = $request->title;
    //     $post->description = $request->description;
    //     $post->date = $request->date;
    //     $post->txt = $request->txt;

    //     $post->save();
    //     return redirect()->route('admin_posts');
    // }

    // public function post_search(Request $request)
    // {
    //     $query = Post::select('title', 'date', 'description', 'image', 'txt', 'id')->orderBy('id', 'desc');

    //     if ($request['title'] != null) {
    //         $query->where('title', 'like', '%' . $request['title']);
    //     }
    //     if ($request['date'] != null) {
    //         $query->whereDate('date', '=', $request['date']);
    //     }

    //     return view('admin.posts', [
    //         'posts' => $query->get(),
    //         'paramstitle' => $request['title'],
    //         'paramsdate' => $request['date'],
    //     ]);
    // }

    // public function post_delete(Request $request)
    // {
    //     $post = Post::find($request->id);

    //     $image = $post->image;
    //     if (isset($image)) {
    //         if (file_exists('.' . $image)) {
    //             unlink('.' . $image);
    //         }
    //     }

    //     $post->delete();
    //     return redirect()->route('admin_posts');
    // }

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
