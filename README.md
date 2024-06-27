# Projeto de Controle Financeiro

Este projeto consiste na criação de um banco de dados para gerenciar o controle financeiro de uma empresa. Ele foi desenvolvido como parte de um teste técnico para uma empresa.

## Descrição do Projeto

O projeto envolve a criação de um banco de dados chamado `controle_financeiro` com duas tabelas principais:

1. **tbl_empresa**: Armazena informações sobre as empresas.
2. **tbl_conta_pagar**: Armazena informações sobre contas a pagar, incluindo o valor, a data de pagamento, o status de pagamento e a referência à empresa associada.

## Estrutura do Banco de Dados

### Banco de Dados

- `controle_financeiro`

### Tabelas

#### tbl_empresa

- `id_empresa`: Identificador único da empresa (chave primária).
- `nome`: Nome da empresa (campo obrigatório).

#### tbl_conta_pagar

- `id_conta_pagar`: Identificador único da conta a pagar (chave primária).
- `valor`: Valor da conta a ser paga (campo obrigatório).
- `data_pagar`: Data de vencimento da conta (campo obrigatório).
- `pago`: Indicador se a conta foi paga (0 para não pago, 1 para pago, padrão é 0).
- `id_empresa`: Identificador da empresa associada à conta (chave estrangeira que referencia a tabela `tbl_empresa`).

## Script SQL

O seguinte script SQL cria o banco de dados e as tabelas descritas acima:

```sql
CREATE DATABASE controle_financeiro;

USE controle_financeiro;

CREATE TABLE tbl_empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_conta_pagar (
    id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10, 2) NOT NULL,
    data_pagar DATE NOT NULL,
    pago TINYINT NOT NULL DEFAULT 0,
    id_empresa INT,
    FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa)
);
