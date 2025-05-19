<?php

include('/laragon/www/mysql-atividade/back-end/conexao.php'); // Altere para o caminho correto do seu arquivo de conexão

$categorias = [
    "Placa-mãe",
    "Processador",
    "Memória RAM",
    "Placa de Vídeo",
    "Fonte",
    "Gabinete",
    "HD/SSD",
    "Cooler",
    "Monitor",
    "Periféricos"
];

$stmt = $pdo->prepare("INSERT INTO categoria (nome) VALUES (:nome)");

foreach ($categorias as $nome) {
    $stmt->bindParam(":nome", $nome);
    $stmt->execute();
}

echo "Categorias inseridas com sucesso!";