 <?php 

session_start();

// Verifica se os campos estão preenchidos
if (empty($_POST["email"]) || empty($_POST["password"])) {
    header("Location: ../index.php");
    exit(); 
} 

include_once '../conexao.php';

$email = $_POST["email"];
$password = $_POST["password"];

try {
    // Consulta o usuário pelo email
    $sql = "SELECT id, name, password FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
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


















<!-- 



// session_start();

// if (empty($_POST["email"]) || empty($_POST["password"])) {
//     echo "<script>location.href='../index.php';</script>";
//     exit(); 
// }

// include_once '../conexao.php';

// $email = $_POST["email"];
// $password = $_POST["password"];

// try {
//     $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':email', $email);
//     $stmt->bindParam(':password', $password); 

//     $stmt->execute();
    
//     if ($stmt->rowCount() > 0) {
//         $row = $stmt->fetch(PDO::FETCH_OBJ);
//         $_SESSION["name"] = $row->name; 
        
//         echo "<script>location.href='../index.php';</script>";
//         exit(); 
//     } else {
//         echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
//         echo "<script>location.href='login.html';</script>";
//         exit(); 
//     }
// } catch (PDOException $e) {
//     die("Erro na consulta: " . $e->getMessage());
// } 

// //http://localhost/projetosphp/recuperar-eventos-do-usuario/usuarios/cadastro.html








//     session_start();
//     if(empty($_POST) or (empty($_POST["email"]) or (empty($_POST["password"])))){
//         echo "<script>location.href='../index.php';</script>";
//     }

//     include_once '../conexao.php';
// //include('conexao.php');

// $email = $_POST["email"];
// $password = $_POST["password"];


// $sql = "SELECT * FROM users
//     WHERE email = '{$email}'
//     AND password = '{$password}'";

// // $res = $conn->query($sql) or die($conn->error);

// $row = $res->fetch_object();

// $qtd = $res->num_rows;

// if($qtd > 0){
//     // $_SESSION["usuario"] = $usuario;
//     // $_SESSION["nome"] = $row->nome;
//     $_SESSION["name"] = $name;
  
//     echo "<script>location.href='index-crud.php';</script>";
//     echo 'trem aqui sô';
// } else {
//     echo "<script>alert('Usuário e/ou senha e/ou tipo incorreto(s)');</script>";
//     echo "<script>location.href='login.html';</script>";
//     echo 'trem aqui sô';
// }

// ?>  -->