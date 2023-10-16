# Consulta de cliente cadastrado ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar um cliente especifico dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fcliente%2Fconsulta%2F{id}-%2361AFFE)

## Parametro do endpoint

| Parametro | Tipo | Tamanho   | Descrição                          | Obrigatório? |
|-----------|------|-----------|------------------------------------|--------------|
| id        | int  | undefined | Id do cliente que deseja consultar | Sim          |

## Parametro de resposta

| Parametro | Tipo   | Descrição                   |
|-----------|--------|-----------------------------|
| cliente   | objeto | Dados do cliente consultado |

## Exemplo de resposta

```json
{
    "cliente": {
        "cliente_id": 5,
        "user_id": 43,
        "cliente_nome": "BENITES GAS",
        "cliente_cpf_cnpj": "28938127000175",
        "cliente_email": "BENITESGAS@email.com"
    }
}
```

## Possibilidade de erro

| Código | Resposta              | Motivo                                        |
|--------|-----------------------|-----------------------------------------------|
| 404    | O cliente não existe. | Ao tentar consultar um cliente que não existe |
