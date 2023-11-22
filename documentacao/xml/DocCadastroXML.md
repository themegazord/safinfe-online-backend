# Cadastro de xml ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para cadastrar um xml dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/POST-%2Fapi%2Fv1%2Finterno%2Fxml%2Fcadastro-%2349CC90)

## Parametro de requisição

| Parametro        | Tipo   | Tamanho | Descrição                                  | Obrigatório? |
|------------------|--------|---------|--------------------------------------------|--------------|
| cliente_cpf_cnpj | string | 14      | CPF ou CNPJ do cliente que emitente do XML | Sim          |
| status           | string | 15      | Status do XML                              | Sim          |
| arquivo          | file   | ~~~~    | XML que vai ser cadastrado                 | Sim          |

## Exemplo de requisição

```json
{
    "cliente_cpf_cnpj": "41238886000193",
    "status": "AUTORIZADA",
    "arquivo": "notafiscalxml12313123123131.xml"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                |
|-----------|--------|----------------------------------------------------------|
| mensagem  | string | Mensagem informando que o XML foi cadastrado com sucesso |

## Exemplo de resposta

```json
{
    "mensagem": "XML cadastrado com sucesso",
}
```

## Possibilidade de erro

| Código | Resposta                                                                                             | Motivo                                                                                                          |
|--------|------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|
| 422    | O campo é obrigatório.                                                                               | Quando esquecer de encaminhar algum campo que é obrigatório.                                                    |
| 422    | O campo deve receber apenas valores em string.                                                       | Ao passar qualquer outro tipo de dado para o campo, ser ser string                                              |
| 422    | O campo [cliente_cpf_cnpj] deve conter no máximo 14 caracteres.                                                 | Ao encaminhar um cliente_cpf_cnpj com mais de 14 caracteres.                                                               |
| 422    | O campo [status] deve conter no máximo 15 caracteres.                                                | Ao encaminhar um status com mais de 15 caracteres.                                                              |
