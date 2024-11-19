<?php
    include 'cabecalho.php';
    include 'config/mensagem/ajax_mensagem_alert.php';
    include 'acesso_restrito_adm.php';
?>

<div class="div_br"> </div>

<h11><i style="cursor: pointer;" class="fa-solid fa-link efeito-zoom"></i> Catracas</h11>
<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div>  

    <button onclick="abre_cangurus();" type="submit" class="botao_home"> 
        <i class="fa-solid fa-link" aria-hidden="true"></i> Cadastro
    </button>

    <br><br>

    <div class="col-md-3 "style="padding-left: 0;">
        <span style="padding-left: 5px;">Nome da Catraca:</span>
        <div class="input-group">
            <input class="form-control input-group" type="text" id="nm_catraca_pesquisa" required="">
            <button onclick="ajax_pesquisar_catraca(document.getElementById('nm_catraca_pesquisa').value)" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
            <input type="hidden" id="valor" readonly="">
        </div>
    </div>

    <div id="mensagem_acoes"></div>

    <!-- Abre bolsa Kanguru Modal -->
    <div id="cad_catraca" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97);                                   
                                  position: absolute; z-index: -99;">
        <div id="conteudo_cad_catraca" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <h11><i style="cursor: pointer;"class="fa-solid fa-link efeito-zoom"></i><a id="nm_preview_catraca"> Cadastrar</a></h11>

                    <div style="float: right;">
                     <i style="cursor:pointer;" onclick="fecha_cangurus(); limpar_catraca();" class="fa-solid fa-xmark"></i>
                    </div>

                    <div class="div_br"> </div>      
                </div>               

                <div class="col-md-4">
                   Nome da Catraca:<br>
                    <input id="nm_catraca"  required type="text" class="form-control" placeholder="Nome da Catraca" maxlength="50">  
                </div>

                <div class="col-md-5">
                    Local da Catraca:<br>
                    <input id="ds_catraca" type="text" class="form-control" placeholder="Local da Catraca" maxlength="100">  
                </div>

                <div class="col-md-3">
                    ID da Catraca:<br>
                    <input required id="id_catraca" type="text" class="form-control" placeholder="0" maxlength="5">  
                </div>
            </div>

            <div class="div_br"> </div> 

            <div class="row" style="width: 60vw;">
                <div class="col-md-4">
                    IP:<br>
                    <input required id="ip_catraca" type="text" class="form-control" placeholder="000.000.000.000" maxlength="15">
                </div>

                <div class="col-md-4">
                    Status:<br>        
                    <select id="tp_status_catraca" class="form-control">
                        <option value="All">Selecione</option>
                        <option value="A"> Ativo</option>
                        <option value="I"> Inativo</option>
                    </select>
                </div>

                
            </div>  

            <div class="div_br"> </div> 

            <div class="row" style="width: 60vw;">
                <div class="col-md-4">
                    Registra Entrada:<br>
                    <select id="sn_registra_entrada" class="form-control">
                        <option value="All">Selecione</option>
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                </div>

                <div class="col-md-4">
                    Hora início registro entrada:<br>
                    <input readonly id="hr_inicio_registro" type="datetime-local" class="form-control" step="1">
                </div>

                <div class="col-md-4">
                    Hora fim registro entrada:<br>
                    <input readonly id="hr_fim_registro" type="datetime-local" class="form-control" step="1">
                </div>

                
            </div>

            <div class="div_br"> </div> 

            <div class="row" style="width: 60vw;">
                <div class="col-md-4">
                    Registra Saida:<br>
                    <select id="sn_registra_saida" class="form-control">
                        <option value="All">Selecione</option>
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                </div>     
                
                <div class="col-md-4">
                    Hora início registro saída:<br>
                    <input readonly id="hr_inicio_registro_saida" type="datetime-local" class="form-control" step="1">
                </div>

                <div class="col-md-4">
                    Hora fim registro saída:<br>
                    <input readonly id="hr_fim_registro_saida" type="datetime-local" class="form-control" step="1">
                </div>

                <div class="col-md-4">
                    <br>
                    <button onclick="ajax_insert_catraca()" class="btn btn-primary"> <i class="fa-solid fa-plus" id="txt_salvar_catraca"></i><a id="btn_cadastrar_catraca"> Cadastrar<a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="div_br"> </div>
 
    <div id="constroi_tabela"></div>

<script src="js/mask.js"></script>
<script>
    window.onload = function ajax_chama_tabela(){
        $('#constroi_tabela').load('config/funcoes/catracas/ajax_carrega_tabela_catracas.php');
    }

    document.getElementById('sn_registra_entrada').addEventListener('change', function(){
        if(document.getElementById('sn_registra_entrada').value == 'S'){
            document.getElementById('hr_inicio_registro').readOnly = false;
            document.getElementById('hr_fim_registro').readOnly = false;
        }else{
            document.getElementById('hr_inicio_registro').readOnly = true;
            document.getElementById('hr_fim_registro').readOnly = true;
        }
        
    }) 

    document.getElementById('sn_registra_saida').addEventListener('change', function(){
        if(document.getElementById('sn_registra_saida').value == 'S'){
            document.getElementById('hr_inicio_registro_saida').readOnly = false;
            document.getElementById('hr_fim_registro_saida').readOnly = false;
        }else{
            document.getElementById('hr_inicio_registro_saida').readOnly = true;
            document.getElementById('hr_fim_registro_saida').readOnly = true;
        }
        
    }) 

    let cd_catraca_edit;
    let id_catraca_edit;
    function ajax_insert_catraca(){
        var catraca = document.getElementById('nm_catraca').value;
        var local_catraca = document.getElementById('ds_catraca').value;
        var id = document.getElementById('id_catraca').value;
        var ip = document.getElementById('ip_catraca').value;
        var status = document.getElementById('tp_status_catraca').value;
        var registra_entrada = document.getElementById('sn_registra_entrada').value;
        var registra_saida = document.getElementById('sn_registra_saida').value;
        var inicio_registro = document.getElementById('hr_inicio_registro').value;
        var fim_registro = document.getElementById('hr_fim_registro').value;
        var registra_saida = document.getElementById('sn_registra_saida').value;
        var inicio_registro_saida = document.getElementById('hr_inicio_registro_saida').value;
        var fim_registro_saida = document.getElementById('hr_fim_registro_saida').value;

        if(catraca.trim() == ''){
            document.getElementById('nm_catraca').focus();
        }else if(local_catraca.trim() == ''){
            document.getElementById('ds_catraca').focus();
        }else if(id.trim() == ''){
            document.getElementById('id_catraca').focus();
        }else if(ip.trim() == ''){
            document.getElementById('ip_catraca').focus();
        }else if(status == 'All'){
            document.getElementById('tp_status_catraca').focus();
        }else if(registra_entrada == 'All'){
            document.getElementById('sn_registra_entrada').focus();
        }else if(registra_saida == 'All'){
            document.getElementById('sn_registra_saida').focus();
        }else{
            $.ajax({
                                url: "config/funcoes/cadastro_catracas/ajax_insert_catracas.php",
                                type: "POST",
                                data: {
                                    nm_catracas: catraca,
                                    ds_catracas: local_catraca,
                                    id_catracas: id,
                                    ip_catraca: ip,
                                    tp_status: status,
                                    sn_registra_entrada: registra_entrada,
                                    sn_registra_saida: registra_saida,
                                    hr_inicio_registro: inicio_registro,
                                    hr_inicio_registro_saida: inicio_registro_saida,
                                    hr_fim_registro: fim_registro,
                                    hr_fim_registro_saida: fim_registro_saida

                                },
                                cache: false,
                                success: function(dataResult){
                                    if(dataResult != 'Sucesso'){   
                                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                                        var_tp_msg = 'alert-danger';
                                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                                    }else{   
                                        var_ds_msg = 'Catraca%20Cadastrada%20com%20sucesso!';
                                        var_tp_msg = 'alert-success';
                                        fecha_cangurus();
                                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                                        $('#constroi_tabela').load('config/funcoes/catracas/ajax_carrega_tabela_catracas.php');
                                        limpar_catraca();
                                    }
                                }
                            });
        }
    }

    function ajax_muda_status(cd_catraca, status) {
        $.ajax({
            url: 'config/funcoes/cadastro_catracas/ajax_update_status_catracas.php',
            type: 'POST',data: {id: cd_catraca, status: status}, cache: false,
            success: function(dataResult){
                if(dataResult == 'Sucesso0'){   
                    var_ds_msg = 'Catraca%20Desativada%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);      
                }else if(dataResult == 'Sucesso1'){
                    var_ds_msg = 'Catraca%20Ativada%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }else{
                    var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                    var_tp_msg = 'alert-danger';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    console.log(dataResult);
                }
                $('#constroi_tabela').load('config/funcoes/catracas/ajax_carrega_tabela_catracas.php');
            }
        })
    }

    function ajax_delete_catraca(cd_catraca) {
        $.ajax({
            url: 'config/funcoes/cadastro_catracas/ajax_delete_catracas.php',                      
            type: 'POST',
            data: {
                cd: cd_catraca
            },
            cache: false,
            success: function(dataResult){
                if(dataResult == 'Sucesso'){          
                    var_ds_msg = 'Catraca%20Excluída%20com%20Sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }else{
                    console.log(dataResult)
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
                $('#constroi_tabela').load('config/funcoes/catracas/ajax_carrega_tabela_catracas.php');
            }
        })
    }
    
    function ajax_editar_catraca(id_catraca) {
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
        })

        $.ajax({
            url: 'config/funcoes/cadastro_catracas/ajax_select_catraca.php',
            type: 'POST', data: {id: id_catraca}, cache: false,
            success: function(array_dados){
                const array = JSON.parse(array_dados);
                document.getElementById('nm_preview_catraca').innerHTML = ' Editar';
                document.getElementById('txt_salvar_catraca').className = 'fa-regular fa-floppy-disk';
                document.getElementById('btn_cadastrar_catraca').innerHTML = '&nbsp; Salvar';
                cd_catraca_edit = array[0];
                document.getElementById('nm_catraca').value = array[1];
                document.getElementById('ds_catraca').value = array[2];
                document.getElementById('id_catraca').value = array[3];
                id_catraca_edit = array[3];
                document.getElementById('ip_catraca').value = array[4];
                document.getElementById('tp_status_catraca').value = array[5];
            }
        })    
    }

    function ajax_pesquisar_catraca(nm_catraca_pesquisa){
        $('#constroi_tabela').load('config/funcoes/catracas/ajax_carrega_tabela_catraca_pesquisa.php',{nm_catraca: nm_catraca_pesquisa});
    }

    function limpar_catraca(){
        document.getElementById('nm_catraca').value = '';
        document.getElementById('ds_catraca').value = '';
        document.getElementById('id_catraca').value = '';
        document.getElementById('ip_catraca').value = '';
        document.getElementById('tp_status_catraca').value = 'All';
        if(document.getElementById('nm_preview_catraca').innerHTML == ' Editar'){
            document.getElementById('nm_preview_catraca').innerHTML = ' Cadastrar';
            document.getElementById('txt_salvar_catraca').className = 'fa-solid fa-plus';
            document.getElementById('btn_cadastrar_catraca').innerHTML = '&nbsp; Cadastrar';
        }
        cd_catraca_edit = 0;
        id_catraca_edit = '';
    }

    document.getElementById('id_catraca').addEventListener('input', function (e){
        mask_int(e);
    });
    document.getElementById('ip_catraca').addEventListener('input', function (e){
        mask_ip(e);
    });
    document.getElementById('nm_catraca_pesquisa').addEventListener('keypress', function (e){
        if(e.key === "Enter"){
            e.preventDefault();
            document.getElementById("btn_pesquisar").click();
        }
    });
</script>

<?php
    include 'rodape.php';
?>