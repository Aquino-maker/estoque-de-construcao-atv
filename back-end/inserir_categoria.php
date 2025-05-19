<?php

include('/laragon/www/mysql-atividade/back-end/conexao.php'); // Altere para o caminho correto do seu arquivo de conexão

$categorias = [
    "Alvenaria",
    "Concreto e Argamassa",
    "Aço e Ferragens",
    "Madeiras",
    "Hidráulica",
    "Elétrica",
    "Impermeabilizantes",
    "Pisos e Revestimentos",
    "Tintas e Acessórios",
    "Ferramentas",
    "EPI (Equipamentos de Proteção Individual)",
    "Portas e Janelas",
    "Telhas e Coberturas",
    "Canos e Conexões",
    "Parafusos e Fixadores",
    "Vedação e Selantes",
    "Iluminação",
    "Acessórios de Banheiro e Cozinha"
];

$stmt = $pdo->prepare("INSERT INTO categoria (nome) VALUES (:nome)");

foreach ($categorias as $nome) {
    $stmt->bindParam(":nome", $nome);
    $stmt->execute();
}

echo "Categorias inseridas com sucesso!";
