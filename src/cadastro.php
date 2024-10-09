<?php

ini_set('session.gc_maxlifetime', 3600);
session_start();


include_once 'conexao.php';

function sanitizar_texto($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

$erro = "";



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(!isset($_POST['username'])){
        $erro = "Preencha o campo usuário!";
    } else{
        $username = sanitizar_texto($_POST['username']);
    }
    
    if(!isset($_POST['email'])){
        $erro = "Preencha o campo e-mail!";
    } else{
        $email = sanitizar_texto($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro = "Digite um e-mail válido!";
        }
    }
    
    if(!isset($_POST['data_nascimento'])){
        $erro = "Informe sua data de nascimento";
    } else{
        $data_nascimento = sanitizar_texto($_POST['data_nascimento']);
        $date = DateTime::createFromFormat('Y-m-d', $data_nascimento);
    
        // Vamos garantir que a data foi preenchida corretamente
        if ($date && $date->format('Y-m-d') === $data_nascimento) {

            $hoje = new DateTime(); //data atual
            if($date >= $hoje){
                $erro = "A data não pode ser maior ou igual a data de hoje";    
            } else{
                $idade = $hoje->diff($date)->y; //calcula os anos de diferença entre a data informada e o dia atual
                if($idade < 10){
                    $erro = "Você deve ter mais de 10 anos";
                } 
            }
       
        } else {
                $erro = "Formato de data inválido. Por favor, insira uma data válida.";
        }
    }
    
    if(!isset($_POST['senha'])){
        $erro = "Preencha o campo senha!";
    } elseif(strlen($_POST['senha']) <= 5){
        $erro = "A senha deve ter ao menos 6 dígitos.";
    } elseif($_POST['senha'] != $_POST['confirma_senha']){
        $erro = "As senhas não coincidem!";
    } else{
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }
  
  
    //se não existiu erro nas verificações iniciais...
    if(!$erro){
     
        //verifica se já existe username ou e-mail
        $check = $conectar->prepare("SELECT * FROM usuarios WHERE email = :email OR username = :username");
        $check->bindParam(':email', $email);
        $check->bindParam(':username', $username);
        $check->execute();

        if($check->rowCount() > 0){
            $erro = "Já existe um usuário cadastrado com o mesmo username e/ou e-mail";
        } else{

        
            $insert = $conectar->prepare("INSERT INTO usuarios (username, email, data_nascimento, senha) VALUES (:username, :email, :data_nascimento, :senha)");
            
            $insert->bindParam(':username', $username);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':data_nascimento', $data_nascimento);
            $insert->bindParam(':senha', $senha);
            $insert->execute();
            
            if($insert){
                $_SESSION['username'] = $username;
                header("location: index.php?from=cadastro");
                //echo "Cadastro efetuado! Bem-vindo(a) " . $_SESSION['username'];
                //........
                exit;
            }
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se já!</title>
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
            <h1>Cadastre-se</h1>
            <span class="obrigatorio">Obrigatório *</span>
            
            <p>
                <label for="">Nome de usuário:<span class="obrigatorio">*</span> </label>
                <input type="text" name="username" placeholder="Digite o nome de usuário" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
            </p>
            <p>
                <label for="">E-mail:<span class="obrigatorio">*</span> </label>
                <input type="text" name="email" placeholder="Digite seu melhor e-mail" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
            </p>
            <p>
                <label for="">Data de nascimento:<span class="obrigatorio">*</span> </label>
                <input type="date" name="data_nascimento" value="<?php if(isset($_POST['data_nascimento'])){echo $_POST['data_nascimento'];} ?>">
            </p>
            <p>
                <label for="">Senha:<span class="obrigatorio">*</span> </label>
                <input type="password" name="senha" placeholder="Digite uma senha">
                <span class="obrigatorio">**Mínimo 6 dígitos**</span>
            </p>
            <p>
                <label for="">Confirme sua Senha:<span class="obrigatorio">*</span> </label>
                <input type="password" name="confirma_senha" placeholder="Confirme sua senha">
            </p>
        <button type="submit">Cadastrar-se</button>
        
        <p>Já tem uma conta? <a href="login.php">Clique aqui</a> para fazer login</p>
        </form>
    </div>
    
</body>
</html>