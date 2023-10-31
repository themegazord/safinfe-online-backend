<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <meta name="author" content="SF Sistemas">
    <title>Esqueceu sua senha?</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #000511;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0 auto;
            width: 60%;
        }

        td {
            padding: 2rem;
            border-radius: 15px;
            background-color: #ffffff;
        }

        .titulo-email {
            font-family: 'Roboto', sans-serif;
        }

        .lista-body {
            list-style: none;
            padding: 0;
        }

        .item-lista-body {
            margin-bottom: 1rem;
        }

        .item-lista-body button {
            border: 1px solid transparent;
            background-color: #000511;
            color: #ffffff;
            cursor: pointer;
            transition-duration: 0.4s;
            padding: 0.8rem;
            border-radius: 10px;
            margin-top: 18px;
        }

        .item-lista-body button:hover {
            background-color: #042575;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <h1 class="titulo-email">Prezado(a), {{ $usuario_nome }}</h1>
                <p class="subtitulo-email">Você solicitou a redefinição da senha da sua conta no sistema SAFI NFe Online. Para prosseguir com a redefinição da sua senha, siga as intruções abaixo:</p>
                <ul class="lista-body">
                    <li class="item-lista-body">
                        Clique no botão a seguir para criar uma nova senha
                        <a href="{{ $frontend }}/{{ $emailHash }}/{{ $hashResetSenha }}">
                            <button>Clique aqui para redefinir sua senha</button>
                        </a>
                    </li>
                    <li class="item-lista-body">
                       1. Você será redirecionado para uma página onde poderá escolher uma nova senha. Certifique-se de criar uma senha forte e única que contenha uma combinação de letras maiúsculas, minúsculas, números e caracteres especiais.
                    </li>
                    <li class="item-lista-body">
                       2. Após criar a nova senha, você poderá acessar a sua conta com suas credenciais atualizadas.
                    </li>
                </ul>
                <p class="info-body">
                    Se você não solicitou esta redefinição de senha ou tiver alguma dúvida, entre em contato conosco imediatamente. A segurança da sua conta é de extrema importância para nós.
                </p>
                <p class="gratificacao">
                    Agradecemos pela sua cooperação e por escolher SF Sistemas como seu provedor de serviços. Estamos à disposição para ajudar, caso precise de suporte adicional.
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
