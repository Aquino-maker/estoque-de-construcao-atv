<?php
include('/laragon/www/mysql-atividade/back-end/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    if (!empty($_POST['nome']) && !empty($_POST['quantidade']) && !empty($_POST['unidade']) && !empty($_POST['preco']) && !empty($_POST['id_categoria'])) {
        $stmt = $pdo->prepare("INSERT INTO produto (nome, quantidade, unidade, preco, id_categoria) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['nome'], $_POST['quantidade'], $_POST['unidade'], $_POST['preco'], $_POST['id_categoria']]);
        header("Location: ../front-end/index.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE produto SET nome=?, quantidade=?, unidade=?, preco=?, id_categoria=? WHERE id=?");
    $stmt->execute([$_POST['nome'], $_POST['quantidade'], $_POST['unidade'], $_POST['preco'], $_POST['id_categoria'], $_POST['id']]);
    header("Location: ../front-end/index.php");
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM produto WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: ../front-end/index.php");
    exit;
}

$order = "p.nome ASC";
if (isset($_GET['filtro'])) {
    switch ($_GET['filtro']) {
        case 'nome_asc':
            $order = "p.nome ASC";
            break;
        case 'nome_desc':
            $order = "p.nome DESC";
            break;
        case 'quantidade_asc':
            $order = "p.quantidade ASC";
            break;
        case 'quantidade_desc':
            $order = "p.quantidade DESC";
            break;
        case 'id':
            $order = "p.id ASC";
            break;
    }
}

$produtos = $pdo->query("SELECT p.*, c.nome AS categoria FROM produto p JOIN categoria c ON p.id_categoria = c.id ORDER BY $order")->fetchAll(PDO::FETCH_ASSOC);
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);
