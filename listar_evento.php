
<?php
session_start();
 // Isso deve mostrar os dados da sessão

header('Content-Type: application/json');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit();
}

// Incluir o arquivo com a conexão com banco de dados
include_once './conexao.php';

// Obtém o user_id da sessão
$user_id = $_SESSION['user_id'];

// QUERY para recuperar os eventos apenas do usuário logado
$query_events = "SELECT evt.id, evt.title, evt.color, evt.start, evt.end, evt.obs
                 FROM events AS evt
                 WHERE evt.user_id = :user_id";

// Prepara a QUERY
$result_events = $pdo->prepare($query_events);
$result_events->bindParam(':user_id', $user_id, PDO::PARAM_INT);

// Executar a QUERY
$result_events->execute();

// Criar o array que recebe os eventos
$eventos = [];

// Percorrer a lista de registros retornados do banco de dados
while ($row_events = $result_events->fetch(PDO::FETCH_ASSOC)) {
    $start = (new DateTime($row_events['start']))->format('Y-m-d\TH:i:s');
    $end = (new DateTime($row_events['end']))->format('Y-m-d\TH:i:s');

    $eventos[] = [
        'id' => $row_events['id'],
        'title' => $row_events['title'],
        'color' => $row_events['color'],
        'start' => $start,
        'end' => $end,
        'obs' => $row_events['obs']
    ];


}
ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($result_events->rowCount() == 0) {
    echo json_encode(['message' => 'Nenhum evento encontrado.']);
 } // else {
//     echo json_encode('funcionou'); // Retorna os eventos como JSON
// }

echo json_encode($eventos);





// // Incluir o arquivo com a conexão com banco de dados
// include_once './conexao.php';

// // QUERY para recuperar os eventos
// $query_events = "SELECT evt.id, evt.title, evt.color, evt.start, evt.end, evt.obs, evt.user_id,
//                 usr.name, usr.email
//                 FROM events AS evt
//                 INNER JOIN users AS usr ON usr.id = evt.user_id";

// // Prepara a QUERY
// $result_events = $pdo->prepare($query_events);

// // Executar a QUERY
// $result_events->execute();

// // Criar o array que recebe os eventos
// $eventos = [];

// // Percorrer a lista de registros retornado do banco de dados
// while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){

//     // Extrair o array
//     extract($row_events);

//     $eventos[] = [
//         'id' => $id,
//         'title' => $title,
//         'color' => $color,
//         'start' => $start,
//         'end' => $end,
//         'obs' => $obs,
//         'user_id' => $user_id,
//         'name' => $name,
//         'email' => $email
//     ];
// }

// echo json_encode($eventos);