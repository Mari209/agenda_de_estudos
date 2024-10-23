<?php

session_start();
header('Content-Type: application/json');

// Verifique se o usuário está logado e se a sessão contém o 'user_id'
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit;
}

 // Obtém o user_id da sessão
 $user_id = $_SESSION['user_id'];

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Receber os dados enviado pelo JavaScript
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Verifica se os dados necessários foram recebidos
    if (empty($dados['cad_title']) || empty($dados['cad_start']) || empty($dados['cad_end'])) {
        echo json_encode(['error' => 'Dados incompletos.']);
        exit();
    }

    // Criar a QUERY cadastrar evento no banco de dados
    $query_cad_event = "INSERT INTO events (title, color, start, end, obs, user_id) VALUES (:title, :color, :start, :end, :obs, :user_id)";

    // Prepara a QUERY
    $cad_event = $pdo->prepare($query_cad_event);

    // Substituir o link pelo valor
    $cad_event->bindParam(':title', $dados['cad_title']);
    $cad_event->bindParam(':color', $dados['cad_color']);
    $cad_event->bindParam(':start', $dados['cad_start']);
    $cad_event->bindParam(':end', $dados['cad_end']);
    $cad_event->bindParam(':obs', $dados['cad_obs']);
    $cad_event->bindParam(':user_id', $user_id);

    // Verificar se consegui cadastrar corretamente
    if ($cad_event->execute()) {
        $retorna = [
            'status' => true,
            'msg' => 'Evento cadastrado com sucesso!',
            'id' => $pdo->lastInsertId(),
            'title' => $dados['cad_title'],
            'color' => $dados['cad_color'],
            'start' => $dados['cad_start'],
            'end' => $dados['cad_end'],
            'obs' => $dados['cad_obs'],
            'user_id' => $user_id,
        ];
    } else {
        $retorna = ['status' => false, 'msg' => 'Erro: Evento não cadastrado!'];
    }

    // Converter o array em objeto e retornar para o JavaScript
    echo json_encode($retorna);
}
