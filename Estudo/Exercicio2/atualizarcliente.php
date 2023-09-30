<?php
include("conexao.php");
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents("php://input");

    $data = json_decode($json_data, true);

    if ($data !== null) {
        if (isset($data['cpf'])) {
            $cpf = $data['cpf']; 
            $nome = $data['nome'];
            $numeroCasa = $data['numeroCasa'];
            $dataNascimento = $data['dataNascimento'];
            $sexo = $data['sexo'];
            $estadoCivil = $data['estadoCivil'];
            $email = $data['email'];
            $cidade = $data['cidade'];
            $bairro = $data['bairro'];
            $endereco = $data['endereco'];

            // Atualizando os dados no banco de dados
            $query = $pdo->prepare("UPDATE dadosclientes 
                                   SET nome=?, numeroCasa=?, dataNascimento=?, sexo=?, estadoCivil=?, email=?, cidade=?, bairro=?, endereco=? 
                                   WHERE cpf=?");
            $query->execute(array($nome, $numeroCasa, $dataNascimento, $sexo, $estadoCivil, $email, $cidade, $bairro, $endereco, $cpf));
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(array("success" => "Dados atualizados com sucesso", "dados" => $resultado));
        } else {
            echo json_encode(array("error" => "A chave 'cpf' não foi encontrada nos dados JSON.", "dado" => $data));
        }
    } else {
        echo json_encode(array("error" => "Falha ao decodificar os dados JSON."));
    }
} else {
    echo json_encode(array("error" => "Método de solicitação inválido. Use POST."));
}


?>