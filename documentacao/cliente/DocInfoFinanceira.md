# Consulta das informações financeiras do cliente no mês vigente ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar os dados financeiros das emissões de nota fiscal do cliente no mês vigente

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fcliente%2Finfo_fin%2F{id}-%2361AFFE)

## Parametro do endpoint

| Parametro | Tipo | Tamanho   | Descrição                          | Obrigatório? |
|-----------|------|-----------|------------------------------------|--------------|
| id        | int  | undefined | Id do cliente que deseja consultar | Sim          |

## Parametro de resposta

| Parametro      | Tipo   | Descrição                                                          |
|----------------|--------|--------------------------------------------------------------------|
| infoFinanceira | objeto | Dados financeiro de todas as notas fiscais emitidas no mês vigente |

## Exemplo de resposta

```json
{
    "infoFinanceira": {
        "totalNotas": 5474.5,
        "totalICMS": 0,
        "totalST": 0,
        "vPIS": 6.029999999999998,
        "vCOFINS": 27.94,
        "valorApxImpostosFederais": 218.98000000000002
    }
}
```
