<?php
require_once __DIR__ . '/funcoes.php';

$id = $_GET['id'] ?? null;

if ($id) {
    excluirBrinquedo($pdo, $id);
}

header("Location: ../index.php");
exit;