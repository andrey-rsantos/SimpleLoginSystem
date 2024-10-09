<?php

ini_set('session.gc_maxlifetime', 3600);
session_start();



include_once 'conexao.php';

function sanitizar_texto($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}


$erro = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(!isset($_POST['login'])){
        $erro = "Preencha o username ou email";
    } else{
        $login = sanitizar_texto($_POST['login']);
    }

    if(!isset($_POST['senha'])){
        $erro = "Preencha sua senha!";
    } else{
        $senha = sanitizar_texto($_POST['senha']);
    }


    //verificando se o username/email é válido
    if(filter_var($login, FILTER_VALIDATE_EMAIL)){
        $sql_code = "SELECT * FROM usuarios WHERE email = :login";
    } else{
        $sql_code = "SELECT * FROM usuarios WHERE username = :login";
    }
    $stmt = $conectar->prepare($sql_code);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->execute();

    //o usuário foi encontrado?
    if($stmt->rowCount() > 0){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //a senha bate com hash?
        if(password_verify($senha, $user['senha'])){
            $_SESSION['username'] = $user['username'];
            //echo "Logou! Bem-vindo(a) " . $_SESSION['username'];
            header("location: index.php?from=login");
            exit;
        } else{
            $erro = "Senha incorreta!";
        }
    
    //se o usuário não existir...
    } else{
        $erro = "Usuário ou email inexistente ou não encontrado.";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre ou Cadastre-se</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
    <?php
            if($erro){
                //echo "<p class=\"error-message\"><b>$erro</b></p>";
                echo "<p style='color: red; font-weight: bold; text-align: center; margin-bottom: 20px;'>$erro</p>";
            }
        ?>
   
    <form action="" method="post">
        <h1>Fazer Login</h1>
        <p>
            <label for="">Nome de usuário: </label> <!--Ou email-->
            <input type="text" placeholder="Digite seu nome de usuário" name="login">
        </p>
        <p>
            <label for="">Senha: </label>
            <input type="password" placeholder="Digite sua senha" name="senha">
        </p>
        
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem uma conta? <a href="cadastro.php">Clique aqui</a> e cadastre-se.</p>
    </div>
</body>
</html>