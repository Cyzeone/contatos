# 📇 Sistema de Contatos

🌎 English version available below.

Projeto de uma aplicação web para gerenciamento de contatos, desenvolvido em PHP com MySQL, utilizando o **XAMPP** como servidor local.

## 🚀 Funcionalidades

- Adicionar novos contatos (nome, e-mail e telefone)
- Editar contatos existentes
- Excluir contatos (soft delete → vai para a lixeira)
- Restaurar contatos da lixeira
- Excluir contatos permanentemente
- Listagem organizada de contatos ativos e excluídos

## 🛠️ Tecnologias Utilizadas

- **PHP** (Back-end)
- **MySQL** (Banco de dados)
- **HTML5 / CSS3 / JavaScript** (Front-end)
- **XAMPP** (Ambiente de desenvolvimento local)

## 📂 Como Rodar o Projeto

1. Instale o [XAMPP](https://www.apachefriends.org/).
2. Copie a pasta **contatos** para o diretório: C:\xampp\htdocs\
3. Inicie o Apache e o MySQL pelo painel do XAMPP.
4. Acesse o **phpMyAdmin** (`http://localhost/phpmyadmin`).
5. Execute o script SQL abaixo para criar o banco de dados:

```sql
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sistema_contatos;
USE sistema_contatos;

-- Criação da tabela de contatos
CREATE TABLE IF NOT EXISTS contatos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(100) NULL,
 telefone VARCHAR(20) NULL,
 status ENUM('ativo', 'excluido') NOT NULL DEFAULT 'ativo',
 data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 data_atualizacao TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
 data_exclusao TIMESTAMP NULL,
 INDEX idx_nome (nome),
 INDEX idx_email (email),
 INDEX idx_telefone (telefone),
 INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserção de dados de exemplo
INSERT INTO contatos (nome, email, telefone) VALUES 
('Ana Silva', 'ana.silva@email.com', '11 99999-8888'),
('Pedro Oliveira', 'pedro.oliveira@email.com', '21 88888-7777'),
('Mariana Souza', 'mariana.souza@email.com', '31 77777-6666'),
('Lucas Santos', 'lucas.santos@email.com', '41 66666-5555');
```

6. Abra o navegador e acesse:

http://localhost/contatos

## 👨‍💻 Autores

- Eduardo Henrique
- Arthur Santana 
- Jonatas Bicio

---

# 📇 Contact Management System

A web application for managing contacts, developed with PHP and MySQL, using **XAMPP** as the local server.

## 🚀 Features

- Add new contacts (name, email, and phone)
- Edit existing contacts
- Soft delete contacts (moves to trash)
- Restore contacts from trash
- Permanently delete contacts
- Organized listing of active and deleted contacts

## 🛠️ Technologies Used

- **PHP** (Back-end)
- **MySQL** (Database)
- **HTML5 / CSS3 / JavaScript** (Front-end)
- **XAMPP** (Local development environment)

## 📂 How to Run the Project

1. Install [XAMPP](https://www.apachefriends.org/).
2. Copy the **contatos** folder to the directory: `C:\xampp\htdocs\`
3. Start Apache and MySQL from the XAMPP control panel.
4. Access **phpMyAdmin** (`http://localhost/phpmyadmin`).
5. Execute the following SQL script to create the database:

```sql
-- Create the database
CREATE DATABASE IF NOT EXISTS sistema_contatos;
USE sistema_contatos;

-- Create the contacts table
CREATE TABLE IF NOT EXISTS contatos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(100) NULL,
 telefone VARCHAR(20) NULL,
 status ENUM('ativo', 'excluido') NOT NULL DEFAULT 'ativo',
 data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 data_atualizacao TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
 data_exclusao TIMESTAMP NULL,
 INDEX idx_nome (nome),
 INDEX idx_email (email),
 INDEX idx_telefone (telefone),
 INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO contatos (nome, email, telefone) VALUES 
('Ana Silva', 'ana.silva@email.com', '11 99999-8888'),
('Pedro Oliveira', 'pedro.oliveira@email.com', '21 88888-7777'),
('Mariana Souza', 'mariana.souza@email.com', '31 77777-6666'),
('Lucas Santos', 'lucas.santos@email.com', '41 66666-5555');
```

6. Open your browser and go to:

http://localhost/contatos

## 👨‍💻 Authors

- Eduardo Henrique
- Arthur Santana
- Jonatas Bicio