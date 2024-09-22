<?php

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// QUERY para recuperar os eventos
$query_events = "SELECT evt.id, evt.title, evt.color, evt.start, evt.end, evt.obs, evt.user_id,
                usr.name, usr.email
                FROM events AS evt
                INNER JOIN users AS usr ON usr.id = evt.user_id";

// Prepara a QUERY
$result_events = $conn->prepare($query_events);

// Executar a QUERY
$result_events->execute();

// Criar o array que recebe os eventos
$eventos = [];

// Percorrer a lista de registros retornado do banco de dados
while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){

    // Extrair o array
    extract($row_events);

    $eventos[] = [
        'id' => $id,
        'title' => $title,
        'color' => $color,
        'start' => $start,
        'end' => $end,
        'obs' => $obs,
        'user_id' => $user_id,
        'name' => $name,
        'email' => $email
    ];
}

echo json_encode($eventos);