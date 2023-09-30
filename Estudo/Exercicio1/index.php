<?php
$meuJson = file_get_contents('dados.json');
$meuJsonArray = json_decode($meuJson,true);
$data_nascimento;

function formatarDataNascimento($dataNascimento) {
    // Converte a data de nascimento para um objeto DateTime
    $data = new DateTime($dataNascimento);

    // Formata a data no estilo desejado (dia/mês/ano)
    return $data->format('d/m/Y');
}

echo 'Nomes: <br/>';

foreach($meuJsonArray['dadosClientes'] as $clientes){
    $data_nascimento = formatarDataNascimento($clientes['dataNascimento']);
    echo($clientes['nome']).'. Nascido(a) em '.$data_nascimento.'<hr/>';
}


?>