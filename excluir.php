<?php
require_once 'funcoes.php';

$id = $_GET['id'] ?? null;

if ($id) {
    excluirBrinquedo($pdo, $id);
}

header("Location: index.php");
exit;
