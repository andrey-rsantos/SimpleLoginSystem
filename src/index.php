<?php

    ini_set('session.gc_maxlifetime', 3600);
    session_start();

    //se o usuário escolher fazer logout no link, ele destrói a sessão antes de rodar o resto do código,
    //o que evita que a sessão continue ativa
    if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
        session_unset();
        session_destroy();
        header("location: login.php");
        exit;
    }

    if(!isset($_SESSION['username'])){
        header("location: login.php");
        exit;
    }
    
    $allowed_sources = ['login', 'cadastro']; //array com os possíveis caminhos de onde o user vem
    $from = isset($_GET['from']) ? $_GET['from'] : '';

    if(!in_array($from, $allowed_sources)){ //se o valor de $from não estiver dentro dos valores do array allowed, ele fica em branco (inválido)
        $from = '';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo(a)!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <?php 
            //o usuário só recebe uma das mensagens se vier por um destes meios e com a sessão startada
            if($from === 'login'){
                echo "<h1>Bem-vindo(a) " . $_SESSION['username'] . "</h1>"; 
            } elseif($from === 'cadastro'){
                echo "<h1>Usuário(a) cadastrado com sucesso! " . $_SESSION['username'] . "</h1>"; 
            } else{
                header("Location: login.php");
                exit;
            }
        ?>
        
        <p><a href="index.php?logout=true" class="logoff">Clique aqui </a>para fazer logoff</p>

    </div>
</body>
</html>