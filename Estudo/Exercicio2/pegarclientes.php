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
            $id = $data['id']; // Valor do ID
            $query = $pdo->prepare("SELECT id_cliente, cpf, nome, dataNascimento, sexo, estadoCivil, email, cidade, endereco, numeroCasa, bairro FROM dadosclientes WHERE id_cliente = :id");
            $query->execute(array(':id' => $id)); 
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC); // Obtenha os resultados como um array
            echo json_encode(array("success" => "Obtido com sucesso", "dados" => $resultado));

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