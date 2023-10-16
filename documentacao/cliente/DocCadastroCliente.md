# Cadastro de cliente ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para cadastrar um cliente dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/POST-%2Fapi%2Fv1%2Finterno%2Fcliente%2Fcadastro-%2349CC90)

## Parametro de requisição

| Parametro        | Tipo   | Tamanho | Descrição                                        | Obrigatório? |
|------------------|--------|---------|--------------------------------------------------|--------------|
| cliente_nome     | string | 155     | O nome do novo cliente                           | Sim          |
| cliente_email    | string | 255     | O email do novo cliente                          | Não         |
| cliente_senha    | string | 255     | A senha do novo cliente                          | Sim          |
| cliente_cpf_cnpj | string | 14      | O CPF ou CNPJ do cliente                         | Sim          |
| contador_email   | string | 255     | O email do contador responsável por esse cliente | Sim          |

Obs:. Caso não seja inserido um email para o cliente, o sistema vai usar o nome do cliente sem espaços + @email.com, favor, entrar em contato com o suporte para solicitar a troca manualmente.

## Exemplo de requisição

```json
{
    "cliente_nome": "Teste 123",
    "contador_email": "alternativa_contabilidade@hotmail.com",
    "cliente_email": "teste@email.com",
    "cliente_senha": "123",
    "cliente_cpf_cnpj": "46519423000113"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                     |
|-----------|--------|---------------------------------------------------------------|
| mensagem  | string | Mensagem informando que o cliente foi cadastrado com sucesso |
| cliente  | object | Cliente cadastrado.                                          |

## Exemplo de resposta

```json
{
    "mensagem": "Cliente cadastrado com sucesso",
    "cliente": {
        "cliente_nome": "Teste 123",
        "cliente_cpf_cnpj": "46519423000113",
        "cliente_email": "teste@email.com",
        "contador_id": 3,
        "user_id": 89,
        "updated_at": "2023-10-16T20:20:26.000000Z",
        "created_at": "2023-10-16T20:20:26.000000Z",
        "id": 51
    }
}
```

## Possibilidade de erro

| Código | Resposta                                                                                             | Motivo                                                                                                          |
|--------|------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|
| 422    | O campo é obrigatório.                                                                               | Quando esquecer de encaminhar algum campo que é obrigatório.                                                    |
| 422    | O email informado é inválido.                                                                        | Ao tentar enviar um email inválido                                                                              |
| 422    | O campo deve receber apenas valores em string.                                                       | Ao passar qualquer outro tipo de dado para o campo, ser ser string                                              |
| 422    | O campo [nome] deve conter no máximo 155 caracteres.                                                 | Ao encaminhar um nome com mais de 155 caracteres.                                                               |
| 422    | O campo [email] deve conter no máximo 255 caracteres.                                                | Ao encaminhar um email com mais de 255 caracteres.                                                              |
| 422    | O campo [senha] deve conter no máximo 255 caracteres.                                                | Ao encaminhar um nome com mais de 255 caracteres.                                                               |
| 409    | O email: [email do cliente] já existe.                                                               | Ao tentar cadastrar um cliente com email que já existe.                                                         |
| 404    | O contador não existe.                                                                               | Ao passar um email de um contador que não existe                                                                |
| 400    | O dado inserido: [CPF ou CNPJ] nao se encaixa nem em CPF (11 caracteres) nem em CNPJ (14 caracteres) | Ao tentar cadastra um cliente com um CPF ou CNPJ com numero de caracteres diferente de 11 ou 14 respectivamente |
| 400    | O CNPJ: [CNPJ] é invalido.                                                                           | Ao tentar cadastrar um cliente com CNPJ matematicamente invalido                                                |
| 400    | O CPF: [CPF] é invalido.                                                                             | Ao tentar cadastrar um cliente com CPF matematicamente invalido                                                 |
