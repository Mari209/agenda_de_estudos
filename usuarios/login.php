 <?php
    include_once '../conexao.php';

    // Verifica se os campos estão preenchidos
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        header("Location: ../index.php");
        exit();
    }
    session_start();

    $_SESSION['user_id'] = $user_id; 

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        // Consulta o usuário pelo email
        $sql = "SELECT id, name, password FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        // Se o usuário existe
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_OBJ);

            // Verifica se a senha está correta
            if (password_verify($password, $row->password)) {
                // Armazena o ID e o nome do usuário na sessão
                $_SESSION["user_id"] = $row->id;
                $_SESSION["name"] = $row->name;

                // Redireciona para a página inicial
                header("Location: ../index.php");
                exit();
            } else {
                // Senha incorreta
                echo "<script>alert('Usuário e/ou uuuuuuu senha incorreto(s)');</script>";
                echo "<script>location.href='login.html';</script>";
                exit();
            }
        } else {
            // Usuário não encontrado
            echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
            echo "<script>location.href='login.html';</script>";
            exit();
        }
    } catch (PDOException $e) {
        die("Erro na consulta: " . $e->getMessage());
    }


    ?>


