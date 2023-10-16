# Edição de cliente cadastrado![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para editar um cliente dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/PUT-%2Fapi%2Fv1%2Finterno%2Fcliente%2Fedicao%2F{id}-%23FCA130)

## Parametro do endpoint

| Parametro | Tipo | Tamanho   | Descrição                        | Obrigatório? |
|-----------|------|-----------|----------------------------------|--------------|
| id        | int  | undefined | Id do cliente que deseja editar  | Sim          |

## Parametro de requisição

| Parametro        | Tipo   | Tamanho | Descrição                                        | Obrigatório? |
|------------------|--------|---------|--------------------------------------------------|--------------|
| cliente_nome     | string | 155     | O nome do novo cliente                           | Sim          |
| cliente_email    | string | 255     | O email do novo cliente                          | Não          |
| cliente_cpf_cnpj | string | 14      | O CPF ou CNPJ do cliente                         | Sim          |
| contador_email   | string | 255     | O email do contador responsável por esse cliente | Sim          |

## Exemplo de requisição

```json
{
    "cliente_nome": "MARIAH EMPORIUM SHOES",
    "contador_email": "alternativa_contabilidade@hotmail.com",
    "cliente_email": "MARIAHEMPORIUMSHOES@email.com",
    "cliente_cpf_cnpj": "46496482000113"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                     |
|-----------|--------|---------------------------------------------------------------|
| mensagem  | string | Mensagem informando que o cliente foi atualizado com sucesso  |

## Exemplo de resposta

```json
{
    "Mensagem": "Cliente atualizado com sucesso.",
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
