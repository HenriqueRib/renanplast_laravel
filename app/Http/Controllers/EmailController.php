<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
// use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function contatoEmail(Request $request)
    {
        //   Log::debug('contatoEmail', ['res' => $arr]);
        $params = $request->all();
        if (!isset($params["email"])) {
            $request->session()->flash('error', "Digite um e-mail valido");
            return redirect()->back()->withInput();
        }

        if (!isset($params["subject"])) {
            $params["subject"] = 'Contato site';
        }

        try {
            Mail::send('mails.contato', $params, function ($message) use ($params) {
                $message->from('naoresposnda@codeline43.com.br', 'Contato Site');
                $message->to('ribeiro.henriquem@gmail.com', 'Usuario');
                $message->subject($params["subject"]);
                $message->priority(3);
            });
            // $request->session()->flash('status', 'E-mail enviado com sucesso! Por favor, verifique sua caixa de entrada e SPAM.');
            $request->session()->flash('status', 'Enviado com sucesso!');
            return redirect()->back();
        } catch (Exception $e) {
            Log::debug('Erro Contato Email', [
                'erro' => $e->getMessage(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'email' => $params['email'],
                'name' => $params['nome'],
            ]);
            $request->session()->flash('error', "Não foi possivel enviar. Tente novamente mais tarde.");
            return redirect()->back()->withInput();
        }
    }
}
