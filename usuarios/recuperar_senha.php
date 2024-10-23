<?php

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// ____________

// Incluir o arquivo com a conexão com banco de dados
include_once '../conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
  $email = $_POST['email'];

  // Verifica se o e-mail existe na base de dados
  $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if ($user) {
    // Gera um token único
    $token = bin2hex(random_bytes(16)); // Gera um token de 32 caracteres
    $userid = $user['id'];

    // Salva o token no banco de dados com uma expiração (por exemplo, 1 hora)
    $stmt = $pdo->prepare("INSERT INTO recuperacao_senha (user_id, token, expiracao) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
    $stmt->execute([$userid, $token]);

    // Envia o e-mail com o token
    $mail = new PHPMailer(true); // Habilita exceções
    try {
      // Configuração do servidor SMTP
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'marianaxavierquispe@gmail.com';
      $mail->Password = 'bmzc glfk vrhn tcra';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      // Configurações do remetente e destinatário
      $mail->setFrom('marianaxavierquispe@gmail.com', 'Mariana :)'); // Seu nome
      $mail->addAddress($email, 'Usuário'); // E-mail do destinatário

      // Conteúdo do e-mail
      $mail->isHTML(true);
      $mail->Subject = 'Recuperacao de Senha';
      $mail->Body    = 'Olá. Sou uma dos desenvolvedores desse projeto. Espero que esteja gostando :)
      Clique no link para redefinir sua senha: <br><a href="http://localhost/projetosphp/agenda-de-estudos/usuarios/redefinir_senha.php?token=' . $token . '">Redefinir Senha</a>';
      $mail->AltBody = 'Clique no link para redefinir sua senha: http://localhost/projetosphp/agenda-de-estudos/usuarios/redefinir_senha.php?token=' . $token;

      // Enviar o e-mail
      $mail->send();
      echo 'E-mail enviado com sucesso';
    } catch (Exception $e) {
      echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
  } else {
    echo "E-mail não encontrado.";
  }
}
?>

<!-- Formulário HTML -->
<div class="form-box login">
  <h2>Recuperação de Senha</h2>
  <form action="./recuperar_senha.php" method="POST">
    <input type="text" name="email" required />
    <label for="email">Email</label>
    <button type="submit" class="btn">Enviar</button>
  </form>
</div>





