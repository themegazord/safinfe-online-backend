# Login de usuários ![Static Badge](https://img.shields.io/badge/Rota_n%C3%A3o_autenticada-%23F93E3E)

## Explicação da rota

Rota utilizada para logar dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/POST-%2Fapi%2Fv1%2Finterno%2Fautenticacao%2Flogin-%2349CC90)

## Parametro de requisição

| Parametro | Tipo   | Tamanho | Descrição        | Obrigatório? |
|-----------|--------|---------|------------------|--------------|
| email     | string | 255     | Email do usuário | Sim          |
| password  | string | 255     | Senha do usuário | Sim          |

## Exemplo de requisição

```json
{
    "email": "contato.wanjalagus@outlook.com.br",
    "password": "81590619"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                                                  |
|-----------|--------|--------------------------------------------------------------------------------------------|
| mensagem  | string | Mensagem informando que o usuário foi logado com sucesso                                   |
| dados     | object | Objeto contendo token de autenticação e os dados de id, nome e email do usuário em questão |

## Exemplo de resposta

```json
{
    "mensagem": "Usuário logado com sucesso.",
    "dados": {
        "token": "4|5WLLiw8qWs1Y9ZyyUtC15QFHXPomVrEvEHgJ8KiT1085cac5",
        "usuario": {
            "id": 1,
            "name": "Gustavo de Camargo Campos",
            "email": "contato.wanjalagus@outlook.com.br"
        }
    }
}
```

## Possibilidade de erro

| Código | Resposta                                                                                      | Motivo                                                             |
|--------|-----------------------------------------------------------------------------------------------|--------------------------------------------------------------------|
| 422    | O campo é obrigatório.                                                                        | Quando esquecer de encaminhar algum campo que é obrigatório.       |
| 422    | O email informado é inválido.                                                                 | Ao tentar enviar um email inválido                                 |
| 422    | O campo deve receber apenas valores em string.                                                | Ao passar qualquer outro tipo de dado para o campo, ser ser string |
| 422    | O campo [email] deve conter no máximo 155 caracteres.                                         | Ao encaminhar um email com mais de 155 caracteres.                 |
| 422    | O campo [senha] deve conter no máximo 155 caracteres.                                         | Ao encaminhar um nome com mais de 155 caracteres.                  |
| 409    | A senha é inválida.                                                                           | Ao passar uma senha que não condiz com a cadastrada                |
| 404    | O email: [email do usuário] não existe, por favor, cadastre-se ou insira um email cadastrado. | Ao tentar logar com um email que não está cadastrado               |
