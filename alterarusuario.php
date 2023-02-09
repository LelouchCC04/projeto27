<?php
Include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $ativo = $_POST['ativo'];

    $sql = "UPDATE usuarios SET usu_senha='$senha', usu_nome='$nome', usu_ativo='$ativo' WHERE usu_id= $id";
    mysqli_query($link, $sql);
    header("Location: listausuario.php");

    echo "<script>window.alert('USUARIO ALTERADO COM SUCESSO');</script>";
    exit();
}

//CAPTURAR ID VIA GET
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE usu_id= $id";
$resultado = mysqli_query($link, $sql);

while($tbl = mysqli_fetch_array($resultado)) {
$nome = $tbl[1];
$senha = $tbl[2];
$ativo = $tbl[3];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ALTERAR USUARIO</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <div>
            <form action="alterarusuario.php" method="post">           
                <input type="hidden" value="<?=$id?>" name="id"><!-- Coleta o id de forma oculta -->
                <label>NOME</label>
                <input type="text" name="nome" id="nome" value="<?=$nome?>" required><!-- coleta o nome do usuario  --> <br>
                <label>SENHA</label>                
                <input type="password" name="senha" id="senha" value="<?=$senha?>" required><!-- coleta o nome do usuario  -->
                <br>
                <label>Status: <?= $check = ($ativo == 's')?"ATIVO":"INATIVO";?></label>
                <br>
                <input type="radio" name="ativo" value="s">ATIVAR <br>
                <input type="radio" name="ativo" value="n">DESATIVAR
                <b></b>
                <input type="submit" value="SALVAR">
            </form>
        </div>
    </body>

</html>

