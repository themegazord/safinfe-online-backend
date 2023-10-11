# Consulta de contador cadastrado ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar um contador especifico dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fcontador%2Fconsulta%2F{id}-%2361AFFE)

## Parametro do endpoint

| Parametro | Tipo | Tamanho   | Descrição                           | Obrigatório? |
|-----------|------|-----------|-------------------------------------|--------------|
| id        | int  | undefined | Id do contador que deseja consultar | Sim          |

## Parametro de resposta

| Parametro | Tipo   | Descrição                    |
|-----------|--------|------------------------------|
| contador  | objeto | Dados do contador consultado |


## Exemplo de resposta
```json
{
    "contador": {
        "contador_id": 60,
        "user_id": 61,
        "contador_nome": "Michelle",
        "contador_email": "secretariaexecon@hotmail.com",
        "created_at": "2023-10-11T02:24:50.000000Z",
        "updated_at": "2023-10-11T02:24:50.000000Z"
    }
}
```

## Possibilidade de erro

| Código | Resposta              | Motivo                                         |
|--------|-----------------------|------------------------------------------------|
| 404    | O contador não existe | Ao tentar consultar um contador que não existe |
