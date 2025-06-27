<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode(['sucesso' => false, 'msg' => 'Não autenticado']);
    exit;
}
require_once 'db.php';

$usuario_id = intval($_SESSION['usuario']['id']);
// Marca no usuário que o histórico foi excluído (permanente)
$sql = "UPDATE usuarios SET historico_financeiro_excluido = 1 WHERE id = $usuario_id";
if ($conn->query($sql)) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao atualizar banco.']);
}