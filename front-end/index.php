<?php
include('/laragon/www/mysql-atividade/back-end/conexao.php');
include('/laragon/www/mysql-atividade/back-end/produtos.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Controle de Estoque - Materiais de Construção</h1>

<h2>Adicionar Novo Produto</h2>
<form method="post">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="number" name="quantidade" placeholder="Quantidade" required>
    <input type="text" name="unidade" placeholder="Unidade" required>
    <input type="number" name="preco" placeholder="Preço" step="0.01" required>
    <select name="id_categoria" required>
        <option value="">Categoria</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" name="add">Cadastrar</button>
</form>

<form method="get">
    <label>Filtrar por:</label>
    <select name="filtro" onchange="this.form.submit()">
        <option value="">Ordenar</option>
        <option value="nome_asc">Nome (A-Z)</option>        
        <option value="nome_desc">Nome (Z-A)</option>
        <option value="quantidade_asc">Quantidade (↑)</option>
        <option value="quantidade_desc">Quantidade (↓)</option>
        <option value="id">ID</option>
    </select>
</form>

<h2>Produtos Cadastrados</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Qtd</th>
        <th>Unidade</th>
        <th>Preço</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($produtos as $p): ?>
        <tr class="<?= $p['quantidade'] <= 5 ? 'low-stock' : '' ?>">
            <td><?= $p['id'] ?></td>
            <td><?= $p['nome'] ?></td>
            <td><?= $p['quantidade'] ?></td>
            <td><?= $p['unidade'] ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= $p['categoria'] ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <input type="text" name="nome" value="<?= $p['nome'] ?>" required>
                    <input type="number" name="quantidade" value="<?= $p['quantidade'] ?>" required>
                    <input type="text" name="unidade" value="<?= $p['unidade'] ?>" required>
                    <input type="number" step="0.01" name="preco" value="<?= $p['preco'] ?>" required>
                    <select name="id_categoria" required>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $p['id_categoria'] ? 'selected' : '' ?>><?= $cat['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button name="update">Atualizar</button>
                </form>
                <a id="lixeira" href="?delete=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>