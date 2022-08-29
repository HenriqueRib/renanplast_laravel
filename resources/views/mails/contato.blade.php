    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <div style="border: 1px #efefef solid; margin: 15px; padding: 0 20px 20px; ">
            <br>
            <br>
            <p style=" font-size: 15px; color: #888;  font-family: 'Open Sans', sans-serif;">
                <b>Olá! <br> Você Recebeu uma nova mensagem via formulário de contato!</b>
                <br>
                <br>
                <b>Nome: </b> {{ $name }} <br>
                <b>Email: </b> <a href="mailto:{{ $email }}">{{ $email }}</a> <br>
                <b>Mensagem: </b> {{ $text }} <br>
                <b>Horário: </b> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
            </p>
            <br>
            <img style="width: 150px" src="{{ asset('img/site/logo.png') }}" alt="mail">
        </div>
    </body>

    </html>
