# Paginação dos contadores cadastrados ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar a paginação de todos os contadores cadastrados dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fcontador%2Fpaginacao-%2361AFFE)

## Parametro do endpoint

| Parametro             | Tipo | Tamanho   | Descrição                                   | Obrigatório? |
|-----------------------|------|-----------|---------------------------------------------|--------------|
| page={numero_paginas} | int  | undefined | Numero da pagina que deseja para a consulta | Sim          |

## Exemplo de requisição

```text
    Requisição = /api/v1/interno/contador/paginacao?page=1
```

## Exemplo de resposta

```json
{
    "current_page": 1,
    "data": [
        {
            "contador_id": 32,
            "contador_nome": "Alexandre",
            "contador_email": "assessoria@excellerconsult.com.br"
        },
        {
            "contador_id": 33,
            "contador_nome": "Alternativa Contabilidade",
            "contador_email": "alternativa_contabilidade@hotmail.com"
        },
        {
            "contador_id": 34,
            "contador_nome": "Astecon - Cintia",
            "contador_email": "cintia@asteccontabil.com"
        },
        {
            "contador_id": 35,
            "contador_nome": "Astecon - Ieda",
            "contador_email": "fiscalastecon@gmail.com"
        },
        {
            "contador_id": 36,
            "contador_nome": "Beth da RC Contabilidade",
            "contador_email": "rccontabilidade2017@hotmail.com"
        },
        {
            "contador_id": 37,
            "contador_nome": "Cido Contabilidade",
            "contador_email": "55679228-9415"
        },
        {
            "contador_id": 38,
            "contador_nome": "Conpac",
            "contador_email": "556730230646"
        },
        {
            "contador_id": 39,
            "contador_nome": "Dalto",
            "contador_email": "daltoncostajr@hotmail.com"
        },
        {
            "contador_id": 40,
            "contador_nome": "Daniela",
            "contador_email": "fiscal@controllersolucoesms.com.br"
        },
        {
            "contador_id": 41,
            "contador_nome": "Edenir",
            "contador_email": "cp.assessoriacontabilcg@gmail.com"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=3",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=2",
            "label": "2",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=3",
            "label": "3",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=2",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao?page=2",
    "path": "http://127.0.0.1:8000/api/v1/interno/contador/paginacao",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 30
}
```
