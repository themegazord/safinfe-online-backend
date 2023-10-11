# Cadastro de contador em massa ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para cadastrar contadores em massa usando importacao por excel dentro do sistema, afim de, organizar e auxiliar em relatórios futuros

## URL

![Static Badge](https://img.shields.io/badge/POST-%2Fapi%2Fv1%2Finterno%2Fcontador%2FcadastroXML-%2349CC90)

## Parametro de requisição

| Parametro | Tipo | Extensao  | Descrição                                                                        | Obrigatório? |
|-----------|------|-----------|----------------------------------------------------------------------------------|--------------|
| arquivo   | file | xlsx, xls | Arquivo Excel com todos os dados dos contadores, sendo eles, nome, email e senha | Sim          |

## Exemplo de requisição form-data

```json
{
    "arquivo": "importContadores.xlsx"
}
```

## Parametro de resposta

| Parametro | Tipo   | Descrição                                                           |
|-----------|--------|---------------------------------------------------------------------|
| mensagem  | string | Mensagem informando que os contadores foram cadastrados com sucesso |

## Exemplo de resposta

```json
{
    "mensagem": "Contadores cadastrados com sucesso."
}
```

## Possibilidade de erro

| Código | Resposta                                              | Motivo                                                                     |
|--------|-------------------------------------------------------|----------------------------------------------------------------------------|
| 400    | Você não enviou o arquivo ou ele não é valido.        | Quando ou for enviado um arquivo invalido ou nao for encaminhado o arquivo |
