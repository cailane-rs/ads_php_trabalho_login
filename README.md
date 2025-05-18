# ads_php_trabalho_login
1ª avaliação prática de PHP - Sistema Simples de Cadastro e Login de Usuários

# Preparando o ambiente SQL
Rode os scripts abaixo para criar a base de dados e a tabela:
```
CREATE DATABASE BANCO;

CREATE TABLE usuarios(
    id INT auto_increment PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL
);
```
