<?php 
session_start();

$userId = $_SESSION['user_id'];

include_once '../conexao.php';

$stmt = $pdo->prepare("SELECT * FROM events WHERE user_id = :user_id");
$stmt->execute(['user_id' => $userId]);
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retorna os eventos como JSON
header('Content-Type: application/json');
echo json_encode($eventos);

?>