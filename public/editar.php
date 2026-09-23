<?php
require_once 'funcoes.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$brinquedo = buscarBrinquedoPorId($pdo, $id);
if (!$brinquedo) {
    die("Brinquedo não encontrado.");
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = $_POST;
    $erros = validarDadosBrinquedo($dados);

    if (empty($erros)) {
        editarBrinquedo($pdo, $id, $dados);
        header("Location: index.php");
        exit;
    }
    $brinquedo = $dados;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Brinquedo</title>
</head>
<body>
    <h1>Editar Brinquedo</h1>

    <?php if (!empty($erros)): ?>
        <ul style="color:red;">
            <?php foreach ($erros as $erro): ?>
                <li><?= htmlspecialchars($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($brinquedo['nome']) ?>" required></label><br><br>
        <label>Categoria: <input type="text" name="categoria" value="<?= htmlspecialchars($brinquedo['categoria']) ?>" required></label><br><br>
        <label>Faixa etária: <input type="text" name="faixa_etaria" value="<?= htmlspecialchars($brinquedo['faixa_etaria']) ?>" required></label><br><br>
        <label>Preço: <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($brinquedo['preco']) ?>" required></label><br><br>
        <label>Quantidade em estoque: <input type="number" name="quantidade_estoque" value="<?= htmlspecialchars($brinquedo['quantidade_estoque']) ?>" required></label><br><br>
        <button type="submit">Atualizar</button>
    </form>

    <p><a href="index.php">Voltar</a></p>
</body>
</html>
