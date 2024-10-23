<?php
// Inicia a sessão e conecta ao banco de dados
session_start();
include 'conexao.php'; // Certifique-se de que o arquivo de conexão está configurado corretamente

// Obtém o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

// Verifica se a avaliação foi enviada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    // Prepara e executa a consulta para inserir a avaliação
    $sql = "INSERT INTO avaliacoes (user_id, nota, comentario) VALUES (:user_id, :nota, :comentario)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
    $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Avaliação enviada com sucesso!";
    } else {
        echo "Erro ao enviar a avaliação. Tente novamente.";
    }
}
?>
