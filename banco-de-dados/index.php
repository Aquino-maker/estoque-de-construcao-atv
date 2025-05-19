<?php

include('/laragon/www/mysql-atividade/back-end/conexao.php');

$pdo->exec("CREATE TABLE IF NOT EXISTS categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL,
    unidade VARCHAR(20) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
)");







