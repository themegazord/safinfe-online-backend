# Cadastro de contador ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para cadastrar um contador dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/POST-%2Fapi%2Fv1%2Finterno%2Fcontador%2Fcadastro-%2349CC90)

## Parametro de requisição

| Parametro      | Tipo   | Tamanho | Descrição                | Obrigatório? |
|----------------|--------|---------|--------------------------|--------------|
| contador_nome  | string | 155     | O nome do novo contador  | Sim          |
| contador_email | string | 255     | O email do novo contador | Sim          |
| contador_senha | string | 255     | A senha do novo contador | Sim          |

## Exemplo de requisição

```json
{
    "contador_nome": "Luiz",
    "contador_email": "luiz.contadorms@gmail.com",
    "contador_senha": "123456789"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                     |
|-----------|--------|---------------------------------------------------------------|
| mensagem  | string | Mensagem informando que o contador foi cadastrado com sucesso |
| contador  | object | Contador cadastrado.                                          |

## Exemplo de resposta

```json
{
    "mensagem": "Contador cadastrado com sucesso.",
    "contador": {
        "contador_nome": "Luiz",
        "contador_email": "luiz.contadorms@gmail.com",
        "user_id": 65,
        "updated_at": "2023-10-11T18:29:50.000000Z",
        "created_at": "2023-10-11T18:29:50.000000Z",
        "id": 64
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
| 422    | O campo [email] deve conter no máximo 255 caracteres. | Ao encaminhar um email com mais de 255 caracteres.                 |
| 422    | O campo [senha] deve conter no máximo 255 caracteres. | Ao encaminhar um nome com mais de 255 caracteres.                  |
| 409    | O email: [email do contador] já existe.               | Ao tentar cadastrar um contador com email que já existe.           |
