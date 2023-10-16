# Paginação dos clientes cadastrados ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar a paginação de todos os clientes cadastrados dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fcliente%2Fpaginacao-%2361AFFE)

## Parametro do endpoint

| Parametro             | Tipo | Tamanho   | Descrição                                   | Obrigatório? |
|-----------------------|------|-----------|---------------------------------------------|--------------|
| page={numero_paginas} | int  | undefined | Numero da pagina que deseja para a consulta | Sim          |

## Exemplo de requisição

```text
    Requisição = /api/v1/interno/cliente/paginacao?page=1
```

## Exemplo de resposta

```json
{
    "current_page": 1,
    "data": [
        {
            "cliente_id": 1,
            "cliente_nome": "ACOUGUE COSTELAO",
            "cliente_cpf_cnpj": "29427828000102",
            "cliente_email": "ACOUGUECOSTELAO@email.com"
        },
        {
            "cliente_id": 2,
            "cliente_nome": "AGUA DOCE DISTRIB",
            "cliente_cpf_cnpj": "35935344000177",
            "cliente_email": "AGUADOCEDISTRIB@email.com"
        },
        {
            "cliente_id": 3,
            "cliente_nome": "BARRACA DA AMELIA",
            "cliente_cpf_cnpj": "13459595000190",
            "cliente_email": "BARRACADAAMELIA@email.com"
        },
        {
            "cliente_id": 4,
            "cliente_nome": "BELLOVIME",
            "cliente_cpf_cnpj": "09353155000186",
            "cliente_email": "bellovime@hotmail.com"
        },
        {
            "cliente_id": 5,
            "cliente_nome": "BENITES GAS",
            "cliente_cpf_cnpj": "28938127000175",
            "cliente_email": "BENITESGAS@email.com"
        },
        {
            "cliente_id": 6,
            "cliente_nome": "BORRACHARIA CRISTALDO",
            "cliente_cpf_cnpj": "41238886000193",
            "cliente_email": "BORRACHARIACRISTALDO@email.com"
        },
        {
            "cliente_id": 7,
            "cliente_nome": "BORRACHARIA SANTOS",
            "cliente_cpf_cnpj": "28548032000145",
            "cliente_email": "BORRACHARIASANTOS@email.com"
        },
        {
            "cliente_id": 8,
            "cliente_nome": "BOYS STORE",
            "cliente_cpf_cnpj": "20110845000228",
            "cliente_email": "BOYSSTORE@email.com"
        },
        {
            "cliente_id": 9,
            "cliente_nome": "JM ALINHAMENTOS",
            "cliente_cpf_cnpj": "14424573000157",
            "cliente_email": "JMALINHAMENTOS@email.com"
        },
        {
            "cliente_id": 10,
            "cliente_nome": "CASA FERREIRA",
            "cliente_cpf_cnpj": "03026176000100",
            "cliente_email": "CASAFERREIRA@email.com"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=5",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=2",
            "label": "2",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=3",
            "label": "3",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=4",
            "label": "4",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=5",
            "label": "5",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=2",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao?page=2",
    "path": "http://127.0.0.1:8000/api/v1/interno/cliente/paginacao",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 49
}
```
