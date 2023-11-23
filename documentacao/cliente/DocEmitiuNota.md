# Verificação de notas fiscais emitidas no mês vigente ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para verificar se o cliente emitiu nota fiscal no mês vigente.

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fcliente%2Femitiu_nota%2F{id}-%2361AFFE)

## Parametro do endpoint

| Parametro | Tipo | Tamanho   | Descrição                          | Obrigatório? |
|-----------|------|-----------|------------------------------------|--------------|
| id        | int  | undefined | Id do cliente que deseja consultar | Sim          |

## Parametro de resposta

| Parametro   | Tipo    | Descrição                                             |
|-------------|---------|-------------------------------------------------------|
| emitiu_nota | boolean | `true` ou `false` para emissão de nota no mês vigente |

## Exemplo de resposta

```json
{
    "emitiu_nota": true 
}
```
