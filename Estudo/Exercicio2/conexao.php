<?php
function retornar(){
    echo "<br/><a style='cursor:pointer' onClick='window.location.href=\"index.php\"'>Voltar</a>";
}

try{
    //Alterar login e senha de acordo com a configurada. Alterar a porta (3312) para a configurada, geralmente 3306
    $pdo = new PDO('mysql:host=localhost;port=3312;dbname=dimensa;charset=utf8', 'root', ''); 
    if(isset($_POST['nome'])){
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $dataNascimento = $_POST['dataNascimento'];
        $sexo = $_POST['sexo'];
        $estadoCivil = $_POST['estadoCivil'];
        $email = $_POST['email'];
        $cidade = $_POST['cidade'];
        $endereco = $_POST['endereco'];
        $numeroCasa = $_POST['numeroCasa'];
        $bairro = $_POST['bairro'];
    
        $sql = $pdo->prepare("INSERT INTO dadosclientes (cpf,nome,dataNascimento,sexo,estadoCivil,email,endereco,numeroCasa,cidade,bairro) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($cpf,$nome,$dataNascimento,$sexo,$estadoCivil,$email,$endereco,$numeroCasa,$cidade,$bairro));
        echo "usuario adicionado com sucesso!";
        retornar();
    }
}
catch (PDOException $e){
    if($e->getCode()==23000){ //Codigo de chave duplicada
        echo"Erro chave duplicada no CPF (cpf ja cadastrado)."; //Unica chave q tem unique q o cliente pode modificar é o cpf
        retornar();
        exit();
    }
    
    echo "Erro de conexão: " . $e->getMessage();
    retornar();
}


?>