<?php

    include 'cabecalho.php';
    include 'config/mensagem/ajax_mensagem_alert.php';
    include 'acesso_restrito_usuario.php';

?>

    <!--TITULO------------------------------------------------->
    <h11><i class="fas fa-file-import"></i> Funcionario</h11>
    <span class="espaco_pequeno" style="width: 6px;" ></span>
    <h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <!--------------------------------------------------------->

    <div class='row'>

        <div class='col-md-3'>
    
            Matrícula do funcionário:
            </br>
            <input type="number" name="frm_usu_sol" id="matricula" class="form-control" autocomplete = "off">  

        </div>

        <div class="col-md-2">

        <br>
        <button type="button" class="btn btn-primary" onchange="pesquisar_funcionario()" id="pesquisar_funcionario"><i class="fas fa-search" style="color: white;"></i></button>
            

        </div>

    </div>

    <div class="div_br"></div>
                
    <div id="solicitacoes"></div>

    <div class="div_br"></div>

<script>
    $(document).ready(function() {

        function pesquisar_funcionario(){

            var matricula = document.getElementById('matricula').value;

            if(matricula != ''){
                $.ajax({
                    url: 'config/funcoes/cadastro_rfid/ajax_select_funcionario.php',
                    method: 'GET',
                    data: {
                        matricula: matricula
                    },
                    success: function(response) {
                    // Insere o HTML carregado dentro do elemento #conteudo
                    $('#solicitacoes').html(response);
                    },
                    error: function(xhr, status, error) {
                    console.error('Erro na solicitação:', error);
                    }
                });
            }else{
                alert('Coloque a matrícula do funcionário!! ');
            }
        
        }

        $('#pesquisar_funcionario').on('click', function() {
            pesquisar_funcionario();
        });

    
    });
    
    function enviarRFID() {

        var chapa, rfid;

        chapa = document.getElementById('matricula').value;
        rfid = document.getElementById('ds_rfid').value;

        $.ajax({
                url: "config/funcoes/cadastro_rfid/ajax_insert_funcionario.php", type: "POST",
                data: {
                    cd_chapa: chapa,
                    ds_rfid: rfid
                    },
                cache: false,
                success: function(dataResult){
                    if(dataResult == 'Sucesso'){
                        var_ds_msg = 'Terceiro%20Cadastrado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';

                        $('#mensagem_acoes').load('config/mensagem/\.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                        pesquisar_funcionario();
                    }else{
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                        pesquisar_funcionario();
                    }
                }
            });

        }    

    function atualizarRFID() {

        var chapa, rfid;

        chapa = document.getElementById('matricula').value;
        rfid = document.getElementById('ds_rfid').value;

        $.ajax({
                url: "config/funcoes/cadastro_rfid/ajax_update_funcionario.php", type: "POST",
                data: {
                    cd_chapa: chapa,
                    ds_rfid: rfid
                    },
                cache: false,
                success: function(dataResult){
                    if(dataResult == 'Sucesso'){
                        var_ds_msg = 'Terceiro%20Cadastrado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru();
                        limpar_terceiro();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                        ajax_pesquisar_terceiro(terceiro);
                    }else{
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }
                }
            });

    }

    
</script>

<?php
    ///CAMINHO DOS ARQUIVOS --> opt/docker-cess/prod/Certificados

    include 'rodape.php';
?>