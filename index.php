<?php
require_once 'funcoes.php';
$brinquedos = listarBrinquedos($pdo);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Brinquedos</title>
</head>
<body>
    <h1>Brinquedos Cadastrados</h1>
    <p><a href="cadastrar.php">+ Novo brinquedo</a></p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Faixa Etária</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
        <?php if (empty($brinquedos)): ?>
        <tr>
            <td colspan="6">Nenhum brinquedo cadastrado ainda.</td>
        </tr>
        <?php endif; ?>
        <?php foreach ($brinquedos as $b): ?>
        <tr>
            <td><?= htmlspecialchars($b['nome']) ?></td>
            <td><?= htmlspecialchars($b['categoria']) ?></td>
            <td><?= htmlspecialchars($b['faixa_etaria']) ?></td>
            <td>R$ <?= number_format($b['preco'], 2, ',', '.') ?></td>
            <td><?= (int) $b['quantidade_estoque'] ?></td>
            <td>
                <a href="editar.php?id=<?= $b['id'] ?>">Editar</a> |
                <a href="excluir.php?id=<?= $b['id'] ?>" onclick="return confirm('Excluir este brinquedo?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
