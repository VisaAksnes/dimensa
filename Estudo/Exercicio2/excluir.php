<?php
include("conexao.php");
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ler os dados JSON do corpo da solicitação
    $json_data = file_get_contents("php://input");

    // Decodificar os dados JSON em um array
    $data = json_decode($json_data, true);

    if ($data !== null) {
       
        if (isset($data['id'])) {  // Verificando se a chave 'id' está presente nos dados
            $id = $data['id'];  //Se tiver, coloco ela numa var $id e prossigo com a exclusão
            $query = "delete from dadosclientes where id_cliente=?";
            $sql = $pdo->prepare($query);
            $sql->execute(array($id));
            echo json_encode(array("sucess" => "Deletado com sucesso"));
        } else {
            echo json_encode(array("error" => "A chave 'id' não foi encontrada nos dados JSON."));
        }
    } else {
        echo json_encode(array("error" => "Falha ao decodificar os dados JSON."));
    }
} else {
    echo json_encode(array("error" => "Método de solicitação inválido. Use POST."));
}


?>