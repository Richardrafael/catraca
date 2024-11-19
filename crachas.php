<?php
    include 'cabecalho.php';
    include 'acesso_restrito.php';
?>

<div class="div_br"> </div>  

<h11><i style="cursor: pointer;" class="fa-solid fa-address-card efeito-zoom" style="color: #ffffff;"></i> Crachás</h11>

<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div>  

<div class="row" style="width: auto;">
    <div class="col-md-2">
        <span style="padding-left: 5px;">Crachá:</span>
        <i class="fa-solid fa-circle-info" style="color: #eec220;" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Para Funcionários e Médicos utilizar a Matrícula!"></i><br>
        <div class="input-group">
            <input class="form-control input-group" type="text" id="cd_cracha_pesquisa" required="true" placeholder="Código do Crachá" maxlength="12">
        </div>
    </div>
    <div class="col-md-2"style="padding-left: 0;">
        <span style="padding-left: 5px;">Tipo:</span>
        <div class="input-group">
            <select class="form-control input group" id="tp_pesquisa">
            <?php
                if($_SESSION['SN_ADM'] == 'S'){?>
                    <option value='0'>Selecione</option>
                    <option value='3'>Alunos</option>
                    <option value='4'>Estagiários</option>
                    <option value='2'>Funcionários</option>
                    <option value='5'>Médicos</option>
                    <option value='6'>Prestadores</option>
                    <option value='1'>Terceiros</option>
            <?php
                }else if($_SESSION['SN_IEP_ADM'] == 'S'){?>
                    <option value='0'>Selecione</option>
                    <option value='3'>Alunos</option>
                    <option value='4'>Estagiários</option>
                    <option value='2'>Funcionários</option>
            <?php
                }else if($_SESSION['SN_IEP'] == 'S' &&  $_SESSION['SN_USUARIO'] == 'N'){?>
                    <option value='0'>Selecione</option>
                    <option value='3'>Alunos</option>
                    <option value='4'>Estagiários</option>
            <?php
                }else if($_SESSION['SN_USUARIO'] == 'S'){?>
                    <option value='0'>Selecione</option>
                    <option value='2'>Funcionários</option>

                    <?php if($_SESSION['SN_IEP'] == 'S'){?>
                        <option value='3'>Alunos</option>
                        <option value='4'>Estagiários</option>
                    <?php } ?>

                    <option value='5'>Médicos</option>
                    <option value='6'>Prestadores</option>
                    <option value='1'>Terceiros</option>
            <?php
                }
            ?>
            </select>
        </div>
    </div>
    <div class="col-md-1"style="padding-left: 0;">
        <br/>
        <button onclick="pesquisar_cracha(document.getElementById('cd_cracha_pesquisa').value,document.getElementById('tp_pesquisa').value)" class=" btn btn-primary" id="btn_pesquisar"><i class="fa fa-search" aria-hidden="true"></i></button>	
    </div>
</div>

<div id="mensagem_acoes"></div>

<!-- Abre bolsa Kanguru Modal Editar -->
<div id="edit_cracha" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97);                                   
                             position: absolute; z-index: -99;">
    <div id="conteudo_edit_cracha" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
        <div class="row" style="width: 60vw;">
            <div class="col-md-12">
                <h11><i style="cursor: pointer;"class="fa-solid fa-address-card efeito-zoom"></i><a id="txt_titulo_modal"> Editar</a></h11>

                <div style="float: right;">
                    <i style="cursor:pointer;" onclick="fecha_visualizar_cracha();limpar_acesso_cracha();" class="fa-solid fa-xmark"></i>
                </div> 
            </div>     

            <div class="col-md-12">
                <div class="div_br"></div> 
                <h11 id="nm_edit_preview"></h11>  
            </div>         
        </div>

        <div class="div_br"></div>

        <div class="row" style="width: 60vw;">
            <div class="col-md-8">
                Nome da Catraca:<br>
                <select id="nm_catraca" class="form-control" onChange=""></select>
            </div>
            <div class="col-md-4">
                <br>
                <button onclick="adicionar_catraca();" class="btn btn-primary"> <i class="fa-solid fa-plus"></i> Adicionar</button>
            </div>
        </div>

        <br>

        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <div id="tabela_catracas" style="max-width: inherit; max-height: inherit; box-sizing:border-box;">
                        <!---Itens da Tabela-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="div_br"> </div>

<div id="constroi_tabela"></div>

<script src="js/mask.js"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function pesquisar_cracha(cd_pesquisa, tp_pesquisa){
        if(cd_pesquisa.trim() == '' || isNaN(cd_pesquisa)){
            document.getElementById('cd_cracha_pesquisa').focus();
        }else if(tp_pesquisa == 0){
            document.getElementById('tp_pesquisa').focus();
        }else{
            $('#constroi_tabela').load('config/funcoes/crachas/ajax_select_crachas.php',{cd_pesquisa: cd_pesquisa, tp_pesquisa: tp_pesquisa});
        }
    }

    var cracha_selecionado;
    var tipo_selecionado;
    function editar_acesso_cracha(cracha_editar, nm_preview, ds_tipo){
        limpar_acesso_cracha();
        cracha_selecionado = cracha_editar.trim();
        tipo_selecionado = ds_tipo;
        atualizar_acesso_cracha();
        document.getElementById('nm_edit_preview').innerHTML = nm_preview;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
        abre_visualizar_cracha();
    }

    var tabela_catracas = document.getElementById('tabela_catracas');
    function adicionar_catraca(){
        let  cd_catraca = document.getElementById('nm_catraca').value;
        if(cd_catraca == 'All'){
            document.getElementById('nm_catraca').focus();
        }else{
            $.ajax({
                url: 'config/funcoes/cadastro_crachas/ajax_insert_catraca.php',
                type: 'POST', data: {cd_cracha: cracha_selecionado, cd_catraca: cd_catraca, tipo: tipo_selecionado}, cache: false,
                success: function(dataResult){
                    if(dataResult != 'Sucesso'){
                        console.log(dataResult);
                        ajax_alert_ok('Erro: Contate o Suporte!');
                    }else{
                        atualizar_acesso_cracha();
                    }
                }
            });
        }
    }

    function deletar_catraca(cd_catraca){
        $.ajax({
            url: 'config/funcoes/cadastro_crachas/ajax_delete_catraca.php',
            type: 'POST', data: {cracha: cracha_selecionado, cd_catraca: cd_catraca, tipo: tipo_selecionado}, cache: false,
            success: function(dataResult){
                if(dataResult != 'Sucesso'){
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }else{
                    atualizar_acesso_cracha();
                }
            }
        });
    }

    function atualizar_acesso_cracha(){
        $('#nm_catraca').load('config/funcoes/crachas/ajax_select_catracas.php',{cracha_editar: cracha_selecionado, tipo: tipo_selecionado});
        document.getElementById('nm_catraca').value = 'All';
        $('#tabela_catracas').load('config/funcoes/crachas/ajax_select_catracas_cracha.php',{cd_cracha: cracha_selecionado, tipo: tipo_selecionado});
    }

    function limpar_acesso_cracha(){
        cracha_selecionado = '';
        document.getElementById('nm_edit_preview').innerHTML = '';
        document.getElementById('nm_catraca').value = 'All';
        tabela_catracas.innerHTML = '';
    }

    document.getElementById('cd_cracha_pesquisa').addEventListener('input', function (e){
        mask_int(e);
    });
    document.getElementById('cd_cracha_pesquisa').addEventListener('keypress', function (e){
        if(e.key === "Enter"){
            e.preventDefault();
            document.getElementById("btn_pesquisar").click();
        }
    });
</script>

<?php
    include 'rodape.php';
?>