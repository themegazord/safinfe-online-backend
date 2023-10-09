# Cadastro de usuários ![Static Badge](https://img.shields.io/badge/Rota_n%C3%A3o_autenticada-%23F93E3E)

## Explicação da rota

Rota utilizada para cadastro de usuário dentro do sistema

## URL

![Static Badge](https://img.shields.io/badge/POST-%2Fapi%2Fv1%2Finterno%2Fautenticacao%2Fcadastro-%2349CC90)

## Parametro de requisição

| Parametro | Tipo   | Tamanho | Descrição        | Obrigatório? |
|-----------|--------|---------|------------------|--------------|
| nome      | string | 155     | Nome do usuário  | Sim          |
| email     | string | 255     | Email do usuário | Sim          |
| senha     | string | 255     | Senha do usuário | Sim          |

## Exemplo de requisição

```json
{
    "nome": "Gustavo de Camargo Campos",
    "email": "contato.wanjalagus@outlook.com.br",
    "senha": "81590619"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                            |
|-----------|--------|--------------------------------------|
| usuario   | object | Objeto contendo o usuário cadastrado |

## Exemplo de resposta

```json
{
    "usuario": {
        "nome": "Gustavo de Camargo Campos",
        "email": "contato.wanjalagus@outlook.com.br",
        "updated_at": "2023-10-09T19:43:39.000000Z",
        "created_at": "2023-10-09T19:43:39.000000Z",
        "id": 2
    }
}
```

## Possibilidade de erro

| Código | Resposta                                              | Motivo                                                             |
|--------|-------------------------------------------------------|--------------------------------------------------------------------|
| 422    | O campo é obrigatório.                                | Quando esquecer de encaminhar algum campo que é obrigatório.       |
| 422    | O email informado é inválido.                         | Ao tentar enviar um email inválido                                 |
| 422    | O campo deve receber apenas valores em string.        | Ao passar qualquer outro tipo de dado para o campo, ser ser string |
| 422    | O campo [nome] deve conter no máximo 155 caracteres.  | Ao encaminhar um nome com mais de 155 caracteres.                  |
| 422    | O campo [email] deve conter no máximo 155 caracteres. | Ao encaminhar um email com mais de 155 caracteres.                 |
| 422    | O campo [senha] deve conter no máximo 155 caracteres. | Ao encaminhar um nome com mais de 155 caracteres.                  |
| 409    | O email: [email do usuário] já existe.                | Ao tentar cadastrar um usuário com email que já existe.            |
