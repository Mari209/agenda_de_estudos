<?php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit();
}

// Obtém o user_id da sessão
$user_id = $_SESSION['user_id'];

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Receber os dados enviados pelo JavaScript
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Verifica se os dados necessários foram recebidos
    if (empty($dados['edit_title']) || empty($dados['edit_start']) || empty($dados['edit_end'])) {
        echo json_encode(['error' => 'Dados incompletos.']);
        exit();
    }

    // Criar a QUERY para editar evento no banco de dados
    $query_edit_event = "UPDATE events SET title=:title, color=:color, start=:start, end=:end, obs=:obs WHERE id=:id AND user_id=:user_id";

    // Prepara a QUERY
    $edit_event = $pdo->prepare($query_edit_event);

    // Substituir os links pelos valores
    $edit_event->bindParam(':title', $dados['edit_title']);
    $edit_event->bindParam(':color', $dados['edit_color']);
    $edit_event->bindParam(':start', $dados['edit_start']);
    $edit_event->bindParam(':end', $dados['edit_end']);
    $edit_event->bindParam(':obs', $dados['edit_obs']);
    $edit_event->bindParam(':id', $dados['edit_id']);
    $edit_event->bindParam(':user_id', $user_id); // Vincula o evento ao user_id da sessão

    // Verificar se consegui editar corretamente
    if ($edit_event->execute()) {
        $retorna = [
            'status' => true,
            'msg' => 'Evento editado com sucesso!',
            'id' => $dados['edit_id'],
            'title' => $dados['edit_title'],
            'color' => $dados['edit_color'],
            'start' => $dados['edit_start'],
            'end' => $dados['edit_end'],
            'obs' => $dados['edit_obs']
        ];
    } else {
        $retorna = ['status' => false, 'msg' => 'Erro: Evento não editado!'];
    }

    // Retornar os dados para o JavaScript
    echo json_encode($retorna);
}
