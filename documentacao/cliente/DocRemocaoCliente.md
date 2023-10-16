# Remoção de cliente cadastrado ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para deletar um cliente e seu usuário dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/DELETE-%2Fapi%2Fv1%2Finterno%2Fcliente%2Fremocao%2F{id}-%23F93E3E)

## Parametro do endpoint

| Parametro | Tipo    | Descrição                        |
|-----------|---------|----------------------------------|
| id        | integer | Id do cliente que deseja deletar |

## Possibilidade de erro

| Código | Resposta             | Motivo                                        |
|--------|----------------------|-----------------------------------------------|
| 404    | O cliente não existe | Ao tentar consultar um cliente que não existe |
