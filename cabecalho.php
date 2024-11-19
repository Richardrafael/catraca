<?php
    session_start();	
    //PHP GERAL

    //PAGINA ATUAL
    $_SESSION['pagina_acesso'] = substr($_SERVER["PHP_SELF"],1,30);

    //CORRIGE PROBLEMAS DE HEADER (LIMPAR O BUFFER)
    ob_start();

    //VARIAVEIS NOME
    @$nome = $_SESSION['usuarioNome'];
    @$pri_nome = substr($nome, 0, strpos($nome, ' '));

    //ACESSO RESTRITO
    include 'acesso_restrito.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logo/icone_santa_casa_sjc_colorido.png">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Portal Catraca</title>
    <!--CSS-->
    <?php 
        include 'css/style.php';
        include 'css/style_mobile.php';
        include 'css/style_animacoes.php';
        include 'config/mensagem/ajax_mensagem_alert.php';
    ?>

    </script>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <!--
    <script src="https://kit.fontawesome.com/302b2cb8e2.js" crossorigin="anonymous"></script>
    -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">


    <!-- JS DATA TABLE -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!--CSS DATA-TABLE-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
</head>
<body>
    <header>    
        <nav class="navbar navbar-expand-md navbar-dark bg-color">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo/icone_santa_casa_sjc_branco.png" height="28px" width="28px" class="d-inline-block align-top efeito-zoom" alt="Santa Casa de São José dos Campos">
                <h10>Portal Catraca</h10>
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsExample06">
                <ul class="navbar-nav">          
                <li class="nav-item active">
                    <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
                </li>
                <div class="menu_azul_claro">
                    <li class="nav-item">
                        <h10><a class="nav-link" onclick="ajax_redireciona_easter_egg('1')"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Faq</a></h10>
                    </li>
                </div>
                <div class="menu_preto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="conta_click('2')">
                        <i class="fa fa-bars" aria-hidden="true"></i> Menu</a></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown06">

                        <!--MENU-->
                        <?php
                            if($_SESSION['SN_ADM'] == 'S'){?>
                                <a class="dropdown-item" href="catracas.php"><i class="fa-solid fa-link"></i>  - Catracas</a>
                                <a class="dropdown-item" href="crachas.php"><i class="fa-solid fa-address-card"></i>  - Crachas</a>
                                <a class="dropdown-item" href="dashboard.php"><i class="fa-solid fa-chart-line"></i>  - Dashboard</a>
                                <a class="dropdown-item" href="estagio.php"><i class="fa-solid fa-graduation-cap"></i>  - Estagio</a>
                                <a class="dropdown-item" href="prestadores.php"><i class="fa-solid fa-address-book"></i>  - Prestadores</a>
                                <a class="dropdown-item" href="relatorios.php"><i class="fa-solid fa-chart-pie"></i>  -  Relatórios</a>
                                <a class="dropdown-item" href="terceiros.php"><i class="fa-solid fa-users"></i>  -  Terceiros</a>
                                <a class="dropdown-item" href="turmas.php"><i class="fa-solid fa-book"></i>  - Turmas</a>
                        <?php
                            }else if($_SESSION['SN_IEP'] == 'S'){?>
                                <a class="dropdown-item" href="crachas.php"><i class="fa-solid fa-address-card"></i>  - Crachas</a>
                                <a class="dropdown-item" href="estagio.php"><i class="fa-solid fa-graduation-cap"></i>  - Estagio</a>
                                <a class="dropdown-item" href="turmas.php"><i class="fa-solid fa-book"></i>  - Turmas</a>
                        <?php
                            }else if($_SESSION['SN_USUARIO'] == 'S'){?>
                                <a class="dropdown-item" href="crachas.php"><i class="fa-solid fa-address-card"></i>  - Crachas</a>
                                <?php if($_SESSION['SN_DASH'] == 'S') { ?>
                                    <a class="dropdown-item" href="dashboard.php"><i class="fa-solid fa-chart-line"></i>  - Dashboard</a>
                                <?php } ?>
                                <a class="dropdown-item" href="prestadores.php"><i class="fa-solid fa-address-book"></i>  - Prestadores</a>
                                <?php if($_SESSION['SN_REL'] == 'S') { ?>
                                    <a class="dropdown-item" href="relatorios.php"><i class="fa-solid fa-chart-pie"></i>  -  Relatórios</a>
                                <?php } ?>
                                <a class="dropdown-item" href="terceiros.php"><i class="fa-solid fa-users"></i>  -  Terceiros</a>
                        <?php
                            }
                        ?>

                        </div>
                    </li>
                </div>
                </li>
                <div class="menu_perfil">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $pri_nome ?></a></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown06">
                        <a class="dropdown-item" href="sair.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
                        </div>
                    </li>
                <div class="menu_vermelho">
                </ul>
            </div>
        </nav>

    </header>
    <main>

        <div class="conteudo">
            <div class="container">

