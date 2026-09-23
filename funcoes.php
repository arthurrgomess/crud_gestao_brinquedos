<?php
require_once 'config.php';

// READ - lista todos os brinquedos
function listarBrinquedos($pdo) {
    $stmt = $pdo->query("SELECT * FROM brinquedos ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// READ - busca um brinquedo pelo id
function buscarBrinquedoPorId($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM brinquedos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Validação básica dos dados enviados pelo formulário
function validarDadosBrinquedo($dados) {
    $erros = [];
    if (empty($dados['nome'])) $erros[] = "O nome é obrigatório.";
    if (empty($dados['categoria'])) $erros[] = "A categoria é obrigatória.";
    if (empty($dados['faixa_etaria'])) $erros[] = "A faixa etária é obrigatória.";
    if (!is_numeric($dados['preco'] ?? '') || $dados['preco'] < 0) $erros[] = "Preço inválido.";
    if (!is_numeric($dados['quantidade_estoque'] ?? '') || $dados['quantidade_estoque'] < 0) $erros[] = "Quantidade em estoque inválida.";
    return $erros;
}

// CREATE
function cadastrarBrinquedo($pdo, $dados) {
    $sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade_estoque) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $dados['nome'],
        $dados['categoria'],
        $dados['faixa_etaria'],
        $dados['preco'],
        $dados['quantidade_estoque'],
    ]);
}

// UPDATE
function editarBrinquedo($pdo, $id, $dados) {
    $sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade_estoque = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $dados['nome'],
        $dados['categoria'],
        $dados['faixa_etaria'],
        $dados['preco'],
        $dados['quantidade_estoque'],
        $id,
    ]);
}

// DELETE
function excluirBrinquedo($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM brinquedos WHERE id = ?");
    return $stmt->execute([$id]);
}
