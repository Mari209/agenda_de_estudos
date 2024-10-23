<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Verifique se o usuário está logado e se a sessão contém o 'user_id'
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não autenticado.']);
    exit;
}

 // Obtém o user_id da sessão
 $user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

// Receber o id enviado pelo JavaScript
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Acessa o IF quando exite o id do evento
if (!empty($id)) {

    // Criar a QUERY apagar evento no banco de dados
    $query_apagar_event = "DELETE FROM events WHERE id=:id";

    // Prepara a QUERY
    $apagar_event = $pdo->prepare($query_apagar_event);

    // Substituir o link pelo valor
    $apagar_event->bindParam(':id', $id);

    // Verificar se consegui apagar corretamente
    if($apagar_event->execute()){
        $retorna = ['status' => true, 'msg' => 'Evento apagado com sucesso!'];
    }else{
        $retorna = ['status' => false, 'msg' => 'Erro: Evento não apagado!'];
    }

} else { // Acessa o ELSE quando o id está vazio
    $retorna = ['status' => false, 'msg' => 'Erro: Necessário enviar o id do evento!'];
}

// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);

}