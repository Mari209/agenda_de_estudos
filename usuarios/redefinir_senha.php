<?php
// Incluir o arquivo com a conexão com banco de dados
include_once '../conexao.php';

// Verifica se o token foi enviado pela URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifica se o token existe e não expirou
    $stmt = $pdo->prepare("SELECT user_id FROM recuperacao_senha WHERE token = ? AND expiracao > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Se o token for válido, o usuário pode redefinir a senha
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_password'])) {
            $new_password = $_POST['new_password'];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Atualiza a senha do usuário no banco de dados
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $user['user_id']]);

            // Remove o token usado para a recuperação
            $stmt = $pdo->prepare("DELETE FROM recuperacao_senha WHERE token = ?");
            $stmt->execute([$token]);

            echo "Senha redefinida com sucesso!";
        }
    } else {
        echo "Token inválido ou expirado!";
    }
} else {
    echo "Token não fornecido!";
}
?>

<!-- Formulário HTML para redefinição de senha -->
<div class="form-box">
    <h2>Redefinir Senha</h2>
    <form action="" method="POST">
        <input type="password" name="new_password" required placeholder="Nova Senha" />
        <label for="new_password">Nova Senha</label>
        <button type="submit" class="btn">Redefinir Senha</button>
    </form>
</div>