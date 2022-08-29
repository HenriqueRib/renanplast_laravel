<?php

namespace App\Http\Controllers;

use App\Models\Representante;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        DB::beginTransaction();
        try {
            if ($params['password'] != $params['password_confirmation']) {
                DB::rollback();
                $request->session()->flash('error', 'Os campos de senha precisam ser iguais.');
                return redirect()->back();
            }

            if (User::where('email', $params['email'])->count() > 0) {

                DB::rollback();
                $request->session()->flash('error', 'Este e-mail já foi registrado.');
                return redirect()->back();
            }

            $params['password'] = Hash::make($params['password']);
            $user = User::create($params);
            $user->level = 0;
            $user->email_verified_at = Carbon::now();
            $user->save();
            DB::commit();
            $request->session()->flash('ok', 'Conta criada com sucesso. Peça a um administrador para lhe dar permissões.');
            return redirect('/login');
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            $request->session()->flash('error', 'Ocorreu um erro, tente novamente mais tarde.');
            return redirect()->back();
        }
    }

    public function create_user(Request $request)
    {
        $params = $request->all();

        DB::beginTransaction();
        try {

            if (User::where('email', $params['email'])->count() > 0) {
                // verifica se não existe e-mail que já esteja deletado
                if (!User::where('email', $params['email'])->where('deleted_at', null)->count() == 0) {
                    DB::rollback();
                    $request->session()->flash('error', 'Já existe um usuário com este e-mail já cadastrado.');
                    return redirect()->back();
                }
            }
            $params['password'] = Hash::make(123456);
            $user = User::create($params);
            $user->level = $params['level'];
            $user->email_verified_at = Carbon::now();
            $user->save();

            DB::commit();
            $request->session()->flash(
                'status',
                'Lembre-se de avisar o usuário que para acessar o sistema ele deverá usar o E-mail e que sua senha inicial é: 123456'
            );
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Ocorreu um erro, tente novamente mais tarde. ');
            return redirect()->back();
        }
    }

    public function configuracao()
    {
        $users = Auth::user();

        return view('admin.configuracao', compact('users'));
    }

    public function configuracao_edit(Request $request)
    {
        try {

            $user = User::find($request->id);

            if ($request->name) {
                $user->name = $request->name;
            }

            if ($request->email) {
                if (User::where('email', $request['email'])->count() > 0) {
                    // verifica se não existe e-mail que já esteja deletado
                    if (User::where('email', $request['email'])->where('deleted_at', null)->count() == 0) {
                        DB::rollback();
                        $request->session()->flash('error', 'Já existe um usuário com este e-mail já cadastrado.');
                        return redirect()->back();
                    }
                }
                $user->email = $request->email;
            }

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            if ($request->file('image')) {
                $file = $request->file('image');
                $nameFile = $file->getClientOriginalName();
                $file->move(public_path("uploads/" . $request->id . "/"), $nameFile);
                $user->image = "uploads/" . $request->id . "/" . $nameFile;
            }

            if ($request->file('banner_image')) {
                $filebanner = $request->file('banner_image');
                $nameFile = $filebanner->getClientOriginalName();
                $filebanner->move(public_path("uploads/" . $request->id . "/"), $nameFile);
                $user->banner_image = "uploads/" . $request->id . "/" . $nameFile;
            }

            $user->save();
            $request->session()->flash('status', 'Suas informações foram alteradas.');
            return redirect()->back();
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Ocorreu um erro, tente novamente mais tarde. ');
            return redirect()->back();
        }
    }
}
