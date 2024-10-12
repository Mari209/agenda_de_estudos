<?php
// Inclui a conexão com o banco de dados
include_once '../conexao.php';

if (isset($_POST["email"]) && isset($_POST["password"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    
    // Criptografa a senha antes de salvar no banco
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepara a query para evitar SQL Injection
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password); // Salva a senha criptografada

        // Executa a query
        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso');</script>";
            echo "<script>location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Não foi possível cadastrar');</script>";
            echo "<script>location.href='cadastro.html';</script>";
        }
    } catch (PDOException $e) {
        // Captura e exibe o erro, se houver
        die("Erro na consulta: " . $e->getMessage());
    }
}
?>
