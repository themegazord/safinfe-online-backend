# Edição de contador cadastrado![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para editar um contador dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/PUT-%2Fapi%2Fv1%2Finterno%2Fcontador%2Fedicao%2F{id}-%23FCA130)

## Parametro de requisição

| Parametro      | Tipo   | Descrição                | Obrigatório? |
|----------------|--------|--------------------------|--------------|
| contador_nome  | string | O novo nome do contador  | Sim          |
| contador_email | string | O novo email do contador | Sim          |

## Exemplo de requisição

```json
{
    "contador_nome": "Assessoria Contabil RN",
    "contador_email": "xml@assessoriacontabilrn.com.br"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                     |
|-----------|--------|---------------------------------------------------------------|
| mensagem  | string | Mensagem informando que o contador foi atualizado com sucesso |
| contador  | object | Os dados do contador atualizados.                             |

## Exemplo de resposta

```json
{
    "mensagem": "Contador atualizado com sucesso.",
    "contador": {
        "contador_id": "54",
        "contador_nome": "Assessoria Contabil RN",
        "contador_email": "xml@assessoriacontabilrn.com.br"
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
| 404    | O contador não existe.                                | Ao tentar atualizar um contador que não existe.                    |
