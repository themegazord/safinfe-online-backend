# Remoção de contador cadastrado ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para deletar um contador e seu usuário dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/DELETE-%2Fapi%2Fv1%2Finterno%2Fcontador%2Fremocao%2F{id}-%23F93E3E)

## Parametro do endpoint

| Parametro | Tipo    | Descrição                         |
|-----------|---------|-----------------------------------|
| id        | integer | Id do contador que deseja deletar |

## Possibilidade de erro

| Código | Resposta              | Motivo                                         |
|--------|-----------------------|------------------------------------------------|
| 404    | O contador não existe | Ao tentar consultar um contador que não existe |
