# Paginação dos XML cadastrados ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar a paginação de todos os XML cadastrados dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fpaginacao_dadosxml%2F{contador_email}%2F{cliente_cpf_cnpj}%2F{perPage}-%2361AFFE)

## Parametro do endpoint

| Parametro        | Tipo   | Tamanho | Descrição                                  | Obrigatório? |
|------------------|--------|---------|--------------------------------------------|--------------|
| contador_email   | string | 255     | Email do contador responsável pelo cliente | Sim          |
| cliente_cpf_cnpj | string | 14      | CPF ou CNPJ do cliente emissor do XML      | Sim          |
| perPage          | int    | ~~      | Quantidade de itens por página             | Não          |

## Exemplo de requisição

```text
    Requisição = /api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10
```

## Exemplo de resposta

```json
{
    "dados_xml": {
        "current_page": 1,
        "data": [
            {
                "status": "INUTILIZADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 6,
                "dh_emissao_evento": "2021-11-18 10:58:21",
                "chave": "50202129427828000102651000000006000000006"
            },
            {
                "status": "INUTILIZADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 7,
                "dh_emissao_evento": "2021-11-18 10:58:58",
                "chave": "50202129427828000102651000000007000000007"
            },
            {
                "status": "CANCELADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 1,
                "dh_emissao_evento": "2021-11-09 16:24:05",
                "chave": "50211129427828000102650010000000011746578944"
            },
            {
                "status": "CANCELADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 2,
                "dh_emissao_evento": "2021-11-09 16:30:42",
                "chave": "50211129427828000102650010000000021744354558"
            },
            {
                "status": "CANCELADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 3,
                "dh_emissao_evento": "2021-11-09 16:37:30",
                "chave": "50211129427828000102650010000000031397349745"
            },
            {
                "status": "CANCELADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 5,
                "dh_emissao_evento": "2021-11-09 16:45:14",
                "chave": "50211129427828000102650010000000051374671025"
            },
            {
                "status": "AUTORIZADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 8,
                "dh_emissao_evento": "2021-11-18 10:13:08",
                "chave": "50211129427828000102650010000000089689796310"
            },
            {
                "status": "AUTORIZADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 11,
                "dh_emissao_evento": "2021-11-18 18:27:43",
                "chave": "50211129427828000102650010000000119474926761"
            },
            {
                "status": "AUTORIZADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 12,
                "dh_emissao_evento": "2021-11-18 18:42:33",
                "chave": "50211129427828000102650010000000129098832759"
            },
            {
                "status": "AUTORIZADA",
                "modelo": 65,
                "serie": 1,
                "numeronf": 13,
                "dh_emissao_evento": "2021-11-18 18:48:06",
                "chave": "50211129427828000102650010000000139002140459"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=1",
        "from": 1,
        "last_page": 60,
        "last_page_url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=60",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=10",
                "label": "10",
                "active": false
            },
            {
                "url": null,
                "label": "...",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=59",
                "label": "59",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=60",
                "label": "60",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10?page=2",
        "path": "http://127.0.0.1:8000/api/v1/interno/xml/paginacao_dadosxml/g.alves.marques@uol.com.br/29427828000102/10",
        "per_page": 10,
        "prev_page_url": null,
        "to": 10,
        "total": 597
    }
}
```

## Possibilidade de erro

| Código | Resposta                                                                                             | Motivo                                                                                          |
|--------|------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------|
| 404    | O contador não existe.                                                                               | Ao passar um email de contador que não esteja cadastrado no banco de dados                      |
| 404    | O cliente não existe.                                                                                | Ao passar um CPF/CNPJ de cliente que não esteja cadastrado no banco de dados                    |
| 409    | O contador portador deste email => [contador_email] não é responsável pelo cliente => [cliente_nome] | Ao passar um CPF/CNPJ de um cliente que não seja do contador informado pelo email ou vice versa |
