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
# Validações   
Executamos os seguintes testes na aplicação:
Cadastro:
- Todos os campos são obrigatórios;
- A senha deve ter no mínimo 8 caracteres;
- Um e-mail não pode ser igual a outro;

Login:
- Campos são obrigatórios;
- Se a senha informada estiver incorreta;
- Se a senha informada for de outro usuário cadastrado (fica como senha incorreta);
- Se tentar logar com o nome em vez do email (não permite);

Dashboard
- Vai trazer o nome do usuário logado;
- O AJAX funciona através do botão "Atualizar lista";

# Melhorias
Cadastro:
- Também tem a opção de ir direto para a tela de login, caso já possua uma conta;
Login:
- A mensagem de senha incorreta some após 5 segundos;
