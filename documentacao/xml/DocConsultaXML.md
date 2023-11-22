# Consulta de XML cadastrado ![Static Badge](https://img.shields.io/badge/Rota_autenticada-49CC90)

## Explicação de Rotas

Rota usada para consultar um XML especifico dentro do sistema.

## URL

![Static Badge](https://img.shields.io/badge/GET-%2Fapi%2Fv1%2Finterno%2Fxml%2Fconsulta%2F{chave_nota}-%2361AFFE)

## Parametro do endpoint

| Parametro  | Tipo   | Tamanho | Descrição                          | Obrigatório? |
|------------|--------|---------|------------------------------------|--------------|
| chave_nota | string | 45      | Chave da nota que deseja consultar | Sim          |

## Parametro de resposta

| Parametro | Tipo   | Descrição               |
|-----------|--------|-------------------------|
| XML       | objeto | Dados do XML consultado |

## Exemplo de resposta

```json
{
    "ide": {
        "cUF": "50",
        "cNF": "68979631",
        "natOp": "VENDA MERC. ADQ. TERCEIROS",
        "mod": "65",
        "serie": "1",
        "nNF": "8",
        "dhEmi": "2021-11-18T10:13:08-04:00",
        "tpNF": "1",
        "idDest": "1",
        "cMunFG": "5002209",
        "tpImp": "4",
        "tpEmis": "9",
        "cDV": "0",
        "tpAmb": "1",
        "finNFe": "1",
        "indFinal": "1",
        "indPres": "1",
        "indIntermed": "0",
        "procEmi": "0",
        "verProc": "1.00",
        "dhCont": "2021-11-18T10:13:05-04:00",
        "xJust": "5014 - Erro: Falha na conexao: Mensagem Erro do Windows=[A conexao subjacente estava fechada: Erro i"
    },
    "emit": {
        "CNPJ": "29427828000102",
        "xNome": "JEIVA PAEL DA SILVA",
        "xFant": "ACOSTELAO",
        "enderEmit": {
            "xLgr": "R 24 DE FEVEREIRO",
            "nro": "1365",
            "xBairro": "CENTRO",
            "cMun": "5002209",
            "xMun": "BONITO",
            "UF": "MS",
            "CEP": "79290000",
            "cPais": "1058",
            "xPais": "BRASIL",
            "fone": "67984473319"
        },
        "IE": "284407976",
        "CRT": "1"
    },
    "dest": {
        "idEstrangeiro": {},
        "indIEDest": "9"
    },
    "det": [
        {
            "prod": {
                "cProd": "44",
                "cEAN": "SEM GTIN",
                "xProd": "RACAO ADULTO",
                "NCM": "23091000",
                "CEST": "2200100",
                "CFOP": "5405",
                "uCom": "KG",
                "qCom": "1.252",
                "vUnCom": "7.99",
                "vProd": "10.00",
                "cEANTrib": "SEM GTIN",
                "uTrib": "KG",
                "qTrib": "1.252",
                "vUnTrib": "7.99",
                "indTot": "1"
            },
            "imposto": {
                "vTotTrib": "0.40",
                "ICMS": {
                    "ICMSSN500": {
                        "orig": "0",
                        "CSOSN": "500"
                    }
                },
                "PIS": {
                    "PISNT": {
                        "CST": "07"
                    }
                },
                "COFINS": {
                    "COFINSNT": {
                        "CST": "07"
                    }
                }
            }
        }
    ],
    "total": {
        "ICMSTot": {
            "vBC": "0.00",
            "vICMS": "0.00",
            "vICMSDeson": "0.00",
            "vFCP": "0.00",
            "vBCST": "0.00",
            "vST": "0.00",
            "vFCPST": "0.00",
            "vFCPSTRet": "0.00",
            "vProd": "10.00",
            "vFrete": "0.00",
            "vSeg": "0.00",
            "vDesc": "0.00",
            "vII": "0.00",
            "vIPI": "0.00",
            "vIPIDevol": "0.00",
            "vPIS": "0.00",
            "vCOFINS": "0.00",
            "vOutro": "0.00",
            "vNF": "10.00",
            "vTotTrib": "0.40"
        }
    },
    "transp": {
        "modFrete": "9"
    },
    "pag": {
        "detPag": {
            "indPag": "0",
            "tPag": "01",
            "vPag": "10.00"
        }
    },
    "infAdic": {
        "infCpl": "EMPRESA OPTANTE DO SIMPLES NACIONAL. NAO GERA DIREITO A CREDITO FISCAL DE ICMS, ISS E IPI Voce pagou aproximadamente: R$: 0,26 (2,6%) DE TRIBUTOS FEDERAIS R$: 0,14 (1,4%) DE TRIBUTOS ESTADUAIS R$: 9,60 PELOS PRODUTOS FONTE IBPT OP: SILVERIO CX: CX.BALCAO MQ: DESKTOP-JND5OPC Obrigado pela preferencia e volte sempre"
    }
}
