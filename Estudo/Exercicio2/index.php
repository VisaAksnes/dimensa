<script>
    function voltarEAtualizar() {
        window.history.back();
        location.reload();
    }

    function excluirUsuario(id){
        //alert(id);
        url = "excluir.php";
        options = {
            method: "POST",
            credentials: "same-origin", 
            mode: "cors",
            headers: {
                'Content-Type': 'application/json; charset=UTF-8',
                'Accept':'Application/json'
            },
            body: JSON.stringify({  //Transforma em Json versão texto pra enviar
                                'id': id
                        })
        }

        fetch(url,options)
        .then(res=>res.json())
        .then(res=>{console.log(res); voltarEAtualizar();})
    }

    function editarUsuario(id){ //Ao clicar no botão editar da tabela
        url = "pegarclientes.php";
        options = {
            method: "POST",
            credentials: "same-origin", 
            mode: "cors",
            headers: {
                'Content-Type': 'application/json; charset=UTF-8',
                'Accept':'Application/json'
            },
            body: JSON.stringify({  //Transforma em Json versão texto pra enviar
                                'id': id
                        })
        }

        fetch(url,options)
        .then(res=>res.json())
        .then(res=>{
           //console.log(res['dados'][0]['cpf']);
            res = res['dados'][0];
            var cpf = document.getElementById("cpf"); cpf.value= res.cpf; cpf.disabled = true;
            var nome = document.getElementById("nome"); nome.value= res.nome;
            var dataNascimento = document.getElementById("dataNascimento"); dataNascimento.value= res.dataNascimento;
            var sexo = document.getElementById("sexo"); sexo.value= res.sexo;
            var estadoCivil = document.getElementById("estadoCivil"); estadoCivil.value= res.estadoCivil;
            var email = document.getElementById("email"); email.value= res.email;
            var cidade = document.getElementById("cidade"); cidade.value= res.cidade;
            var numeroCasa = document.getElementById("numeroCasa"); numeroCasa.value= res.numeroCasa;
            var bairro = document.getElementById("bairro"); bairro.value= res.bairro;
            var endereco = document.getElementById("endereco"); endereco.value= res.endereco;
            var tabela = document.getElementById("tabela");
            tabela.style.backgroundColor = "black";

            var adicionar = document.getElementById("adicionar");
            adicionar.style.display="none";

            var voltar = document.getElementById("voltar");
            voltar.style.display="inline";
            var atualizar = document.getElementById("atualizar");
            atualizar.style.display="inline";

        })
    }

    function btn_atualizarCliente(){ 
        //Daria também pra criar uma função só pra pegar os dados e retornar em array, ficaria mais compacto
        var cpf = document.getElementById("cpf").value; 
        var nome = document.getElementById("nome").value;
        var dataNascimento = document.getElementById("dataNascimento").value; 
        var sexo = document.getElementById("sexo").value; 
        var estadoCivil = document.getElementById("estadoCivil").value; 
        var email = document.getElementById("email").value; 
        var cidade = document.getElementById("cidade").value; 
        var numeroCasa = document.getElementById("numeroCasa").value; 
        var bairro = document.getElementById("bairro").value; 
        var endereco = document.getElementById("endereco").value;
        var dados = {
            cpf: cpf,
            nome: nome,
            dataNascimento: dataNascimento,
            sexo: sexo,
            estadoCivil: estadoCivil,
            email: email,
            cidade: cidade,
            numeroCasa: numeroCasa,
            bairro: bairro,
            endereco: endereco
        };

        url = "atualizarcliente.php";
        options = {
            method: "POST",
            credentials: "same-origin", 
            mode: "cors",
            headers: {
                'Content-Type': 'application/json; charset=UTF-8',
                'Accept':'Application/json'
            },
            body: JSON.stringify(dados)
        }

        fetch( url,options )
        .then( res=>res.json() )
        .then( res=>{console.log(res); location.reload();} )
        
    }
</script>

<?php
    include("conexao.php");

    
    function gerarTabela($pdo){
       //Pegando a Chave da tabela para o cabeçalho
        echo "<tr>";
        echo "<th>CPF</th>";
        echo "<th>Nome</th>";
        echo "<th>Nascimento</th>";
        echo "<th>Sexo</th>";
        echo "<th>Estado Civil</th>";
        echo "<th>Email</th>";
        echo "<th>Endereço</th>";
        echo "<th>Número da Casa</th>";
        echo "<th>Cidade</th>";
        echo "<th>Bairro</th>";
        echo "<th>DEL</th>";
        echo "<th>EDIT</th>";
        echo "</tr>";
    
        //Pegando os dados da tabela
            $cabecalho=0;
            $query = "SELECT id_cliente, cpf,nome,dataNascimento,sexo,estadoCivil,email,cidade,endereco,numeroCasa,bairro FROM dadosclientes";
            $resultado = $pdo->query($query);
            foreach($resultado as $chave => $item){
                echo '<tr>';
                echo '<td style="display:none">' . $item['id_cliente'] . '</td>';
                echo '<td>' . $item['cpf'] . '</td>';
                echo '<td>' . $item['nome'] . '</td>';
                echo '<td>' . $item['dataNascimento'] . '</td>';
                echo '<td>' . $item['sexo'] . '</td>';
                echo '<td>' . $item['estadoCivil'] . '</td>';
                echo '<td>' . $item['email'] . '</td>';
                echo '<td>' . $item['endereco'] . '</td>';
                echo '<td>' . $item['numeroCasa'] . '</td>';
                echo '<td>' . $item['cidade'] . '</td>';
                echo '<td>' . $item['bairro'] . '</td>';
                echo'<th onClick="excluirUsuario('.$item['id_cliente'].')">X</th>';
                echo'<th onClick="editarUsuario('.$item['id_cliente'].')">Editar</th>';
                echo '</tr>';
            }
    }
?>
<link rel="stylesheet" type="text/css" href="basico.css"/>


<!--Formulário básico para adicionar via POST, simples, sem ajax-->
<form method="POST" action="conexao.php" class="formulario" id="tabela">
    <input type="number" name="cpf" placeholder="CPF" id="cpf"><br/>
    <input type="text" name="nome" placeholder="Nome" id="nome"><br/>
    <input type="date" name="dataNascimento" placeholder="Data de Nascimento"  id="dataNascimento"><br/>
    <select name="sexo" id="sexo"> 
        <option value="M" selected>Masculino</option>
        <option value="F">Feminino</option>
    </select><br/>
    <select name="estadoCivil" id="estadoCivil"> 
        <option value="solteiro" selected>Solteiro</option>
        <option value="casado" >Casado</option>
        <option value="divorciado">Divorciado</option>
        <option value="viuvo">Viúvo</option>
    </select><br/>
    <input type="text" name="email" placeholder="Email" id="email"><br/>
    <input type="text" name="cidade" placeholder="Cidade" id="cidade"><br/>
    <input type="text" name="endereco" placeholder="Endereço" id="endereco"><br/>
    <input type="number" name="numeroCasa" placeholder="Número da Casa" id="numeroCasa"><br/>
    <input type="text" name="bairro" placeholder="Bairro" id="bairro"><br/>
    <input type="submit" value="Adicionar" id="adicionar" >
    <input type="button" value="ATUALIZAR" id="atualizar" style="display:none" onclick="btn_atualizarCliente()">
    <input type="button" value="VOLTAR" id="voltar" style="display:none" onclick="voltarEAtualizar()"/>
</form>
<button onClick="location.reload();">Atualizar registros</button>

<!--Exibir clientes já adicionados. 
Como o foco é o CRUD e não o layoult, resolvi utilizar tabela mesmo, por ser mais simples e rápido-->

<table style="width:100%;border:1px solid black">
    <?php gerarTabela($pdo); ?>
</table>


