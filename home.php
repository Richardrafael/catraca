<?php
//CABECALHO
include 'cabecalho.php';
include 'acesso_restrito.php';
?>

<div class="div_br"> </div>

<!--MENSAGENS-->
<?php
include 'js/mensagens.php';
include 'js/mensagens_usuario.php';
?>

<h11><i class="fa-solid fa-id-card efeito-zoom" aria-hidden="true"></i> Portal Catraca</h11>

<div class="div_br"> </div>

<div style="width: 100%; padding-left: 5%; padding-right: 5%;">
    <?php
    if ($_SESSION['SN_ADM'] == 'S') { ?>
        <a href="catracas.php" class="botao_home" type="submit"><i class="fa-solid fa-link"></i> Catracas</a></td>
        </tr>
        <a href="crachas.php" class="botao_home" type="submit"><i class="fa-solid fa-address-card" style="color: #ffffff;"></i> Crachás</a></td>
        </tr>
        <a href="dashboard.php" class="botao_home" type="submit"><i class="fa-solid fa-chart-line"></i> Dashboard</a></td>
        </tr>
        <a href="estagio.php" class="botao_home" type="submit"><i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i> Estágio</a></td>
        </tr>
        <a href="prestadores.php" class="botao_home" type="submit"><i class="fa-solid fa-address-book" style="color: #ffffff;"></i> Prestadores</a></td>
        </tr>
        <a href="relatorios.php" class="botao_home" type="submit"><i class="fa-solid fa-chart-pie" style="color: #ffffff;"></i> Relatórios</a></td>
        </tr>
        <a href="terceiros.php" class="botao_home" type="submit"><i class="fa-solid fa-users"></i> Terceiros</a></td>
        </tr>
        <a href="turmas.php" class="botao_home" type="submit"><i class="fa-solid fa-book" style="color: #ffffff;"></i> Turmas</a></td>
        </tr>
        <a href="funcionario_rfid.php" class="botao_home" type="submit"><i class="fa-solid fa-book" style="color: #ffffff;"></i> Funcionario RF-ID</a></td>
        </tr>
    <?php
    } else if (($_SESSION['SN_IEP'] == 'S') || ($_SESSION['SN_IEP_ADM'] == 'S')) { ?>
        <a href="crachas.php" class="botao_home" type="submit"><i class="fa-solid fa-address-card" style="color: #ffffff;"></i> Crachás</a></td>
        </tr>

        <?php if ($_SESSION['SN_DASH'] == 'S') { ?>
            <a href="dashboard.php" class="botao_home" type="submit"><i class="fa-solid fa-chart-line"></i> Dashboard</a></td>
            </tr>
        <?php } ?>

        <a href="estagio.php" class="botao_home" type="submit"><i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i> Estágio</a></td>
        </tr>

        <?php if ($_SESSION['SN_USUARIO'] == 'S') { ?>
            <a href="prestadores.php" class="botao_home" type="submit"><i class="fa-solid fa-address-book" style="color: #ffffff;"></i> Prestadores</a></td>
            </tr>
        <?php } ?>

        <?php if ($_SESSION['SN_REL'] == 'S') { ?>
            <a href="relatorios.php" class="botao_home" type="submit"><i class="fa-solid fa-chart-pie" style="color: #ffffff;"></i> Relatórios</a></td>
            </tr>
        <?php } ?>

        <?php if ($_SESSION['SN_USUARIO'] == 'S') { ?>
            <a href="terceiros.php" class="botao_home" type="submit"><i class="fa-solid fa-users"></i> Terceiros</a></td>
            </tr>
        <?php } ?>
        <a href="turmas.php" class="botao_home" type="submit"><i class="fa-solid fa-book" style="color: #ffffff;"></i> Turmas</a></td>
        </tr>

        <?php if ($_SESSION['SN_USUARIO'] == 'S') { ?>
            <a href="funcionario_rfid.php" class="botao_home" type="submit"><i class="fa-solid fa-book" style="color: #ffffff;"></i> Funcionario RF-ID</a></td>
            </tr>
        <?php } ?>

    <?php
    } else if ($_SESSION['SN_USUARIO'] == 'S') { ?>
        <a href="crachas.php" class="botao_home" type="submit"><i class="fa-solid fa-address-card" style="color: #ffffff;"></i> Crachás</a></td>
        </tr>
        <?php if ($_SESSION['SN_DASH'] == 'S') { ?>
            <a href="dashboard.php" class="botao_home" type="submit"><i class="fa-solid fa-chart-line"></i> Dashboard</a></td>
            </tr>
        <?php } ?>
        <a href="prestadores.php" class="botao_home" type="submit"><i class="fa-solid fa-address-book" style="color: #ffffff;"></i> Prestadores</a></td>
        </tr>
        <?php if ($_SESSION['SN_REL'] == 'S') { ?>
            <a href="relatorios.php" class="botao_home" type="submit"><i class="fa-solid fa-chart-pie" style="color: #ffffff;"></i> Relatórios</a></td>
            </tr>
        <?php } ?>
        <a href="terceiros.php" class="botao_home" type="submit"><i class="fa-solid fa-users"></i> Terceiros</a></td>
        </tr>
        <a href="funcionario_rfid.php" class="botao_home" type="submit"><i class="fa-solid fa-book" style="color: #ffffff;"></i> Funcionario RF-ID</a></td>
        </tr>
    <?php
    } else if ($_SESSION['SN_TERCEIROS'] == "S") { ?>
        <a href="terceiros.php" class="botao_home" type="submit"><i class="fa-solid fa-users"></i> Terceiros</a></td>
        </tr>
    <?php }
    ?>
</div>

<div class='espaco_vertical_medio'></div>

<?php
//RODAPE
include 'rodape.php';
?>