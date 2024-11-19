<?php
    include 'cabecalho.php';
    include 'acesso_restrito_iep.php';
?>

<div class="div_br" id="control"> </div>

<h11><i style="cursor: pointer;" class="fa-solid fa-graduation-cap efeito-zoom" style="color: #ffffff;"></i> Estágio</h11>

<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div>  

<button onclick="abre_canguru_turma();" type="submit" class="botao_home"> 
    <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i> Cadastro 
</button>

<br><br>

<div class="col-md-3 "style="padding-left: 0;">
    <span style="padding-left: 5px;">Nome do Estágio:</span>
    <div class="input-group">
        <input class="form-control input-group" type="text" id="nm_estagio_pesquisa" required="">
        <button onclick="carrega_tabela_estagio_pesquisa(document.getElementById('nm_estagio_pesquisa').value);" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
        <input type="hidden" id="valor" readonly="">
    </div>
</div>

<div id="mensagem_acoes"></div>

<!-- Abre bolsa Kanguru Modal -->
<div id="cad_turma" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97);                                   
                             position: absolute; z-index: -99;">
    <div id="conteudo_cad_turma" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
        <div class="row" style="width: 60vw;">
            <div class="col-md-12">
          
                <h11><i style="cursor: pointer;"class="fa-solid fa-graduation-cap efeito-zoom"></i><a id="txt_titulo_modal"> Cadastrar</a></h11>

                <div style="float: right;">
                    <i style="cursor:pointer;" onclick="fecha_canguru_turma(); limpar_cadastro_estagio();" class="fa-solid fa-xmark"></i>
                </div>

                <div class="div_br"> </div> 

            </div>               

            <div class="col-md-8">

                Nome do Estágio:<br>
                <input id="nm_estagio"  required type="text" class="form-control" placeholder="Nome do Estágio">  

            </div>
        </div>   
            
        <div class="div_br"> </div> 

        <div class="row" style="width: 60vw;">
            <div class="col-md-3">

                Horário de Início:<br>
                <input required id="hr_inicio" type="time" class="form-control" placeholder="HH:MM">  

            </div>

            <div class="col-md-3">

                Horário do Fim:<br>
                <input required id="hr_fim" type="time" class="form-control" placeholder="HH:MM">  

            </div>
        </div>

        <div class="div_br"> </div> 

        <div class="row" style="width: 60vw;">
            <div class="col-md-8">
                
                Dias da Semana:<br>
                <button onclick="btn_semana_click(document.getElementById('btn_dom'));" class="btn btn-primary" id="btn_dom" style="animation: none !important;"> <i class="fa-solid"></i>Dom</button>
                <button onclick="btn_semana_click(document.getElementById('btn_seg'));" class="btn btn-primary" id="btn_seg" style="animation: none !important;"> <i class="fa-solid"></i>Seg</button>
                <button onclick="btn_semana_click(document.getElementById('btn_ter'));" class="btn btn-primary" id="btn_ter" style="animation: none !important;"> <i class="fa-solid"></i>Ter</button>
                <button onclick="btn_semana_click(document.getElementById('btn_qua'));" class="btn btn-primary" id="btn_qua" style="animation: none !important;"> <i class="fa-solid"></i>Qua</button>
                <button onclick="btn_semana_click(document.getElementById('btn_qui'));" class="btn btn-primary" id="btn_qui" style="animation: none !important;"> <i class="fa-solid"></i>Qui</button>
                <button onclick="btn_semana_click(document.getElementById('btn_sex'));" class="btn btn-primary" id="btn_sex" style="animation: none !important;"> <i class="fa-solid"></i>Sex</button>
                <button onclick="btn_semana_click(document.getElementById('btn_sab'));" class="btn btn-primary" id="btn_sab" style="animation: none !important;"> <i class="fa-solid"></i>Sab</button>

            </div>

            <div class="col-md-3">

                <br>
                <button onclick="cadastrar_estagio();" class="btn btn-primary" style="float: right;"> <i id="txt_salvar_estagio" class="fa-solid fa-plus"></i><a id="btn_cadastrar_estagio"> Cadastrar</a></button>

            </div>
        </div>
    </div>
</div>

<!-- Abre Menu Modal -->
<div id="view_estagio" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97);                                   
                             position: absolute; z-index: -99;">
    <div id="content_view_estagio" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12">
                <h11><i style="cursor: pointer;"class="fa-solid fa-book efeito-zoom"></i> <a id="nm_preview_estagio"> Visualizar<a></h11>
                
                <div style="float: right;">
                    <i style="cursor:pointer;" onclick="fecha_visualizar_estagio(); limpar_cadastro_alunos();" class="fa-solid fa-xmark"></i>
                </div>

                <div class="div_br"> </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                Incluir Aluno:
                <i class="fa-solid fa-circle-info" style="color: #eec220;" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Inclui alunos nessa Turma! <br> Digite o nome, selecione o aluno que deseja incluir e clique em Incluir!"></i><br>
                <input type="text" id="txt_aluno" list="datalist_alunos" class="form-control" placeholder="Digite o Nome do Aluno" onkeyup="timer_pesquisa_aluno_func(document.getElementById('txt_aluno').value);">
                <datalist id="datalist_alunos" style="max-height: 200px; overflow-y: auto;"></datalist>
            </div>

            <div class="col-md-3">
                <br>
                <button onclick="cadastrar_aluno()" class="btn btn-primary"> <i class="fa-solid fa-plus"></i> Incluir</button>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-md-9">
                Tranferir Aluno:
                <i class="fa-solid fa-circle-info" style="color: #eec220;" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Transfere alunos para essa Turma! <br> Digite o nome, selecione o aluno que deseja transferir e clique em Transferir!"></i><br>
                <input type="text" id="input_transferir_aluno" list="list_transferir_aluno" class="form-control" placeholder="Digite o Nome do Aluno" onkeyup="timer_pesquisa_aluno_transfer_func(document.getElementById('input_transferir_aluno').value);">
                <datalist id="list_transferir_aluno" style="max-height: 200px; overflow-y: auto;"></datalist>
            </div>

            <div class="col-md-3">
                <br>
                <button onclick="ajax_transfere_aluno();" class="btn btn-primary"> <i class="fa-solid fa-shuffle"></i> Transferir</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="div_br"> </div>
                <h11>Alunos:<h11>
            </div>
        </div>

        <div id="constroi_tabela_alunos" style="max-height: 100vh; overflow-y: auto;"></div>
    </div>
</div>

<div class="div_br"> </div>

<div id="constroi_tabela"></div>

<script>
    var cd_estagio_edit = '';

    $(document).ready(function () {
        carrega_tabela_estagio();
        $('[data-toggle="tooltip"]').tooltip();
    });

    function btn_semana_click(id_item){
        let cor = $(id_item).css("background-color");
        if(cor == 'rgb(49, 133, 193)'){
            id_item.setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
        }else{
            id_item.setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        }
    }

    function carrega_tabela_estagio(){
        $('#constroi_tabela').load('config/funcoes/estagio/ajax_carrega_estagio.php');
    }

    function carrega_tabela_estagio_pesquisa(nm_pesquisa){
        $('#constroi_tabela').load('config/funcoes/estagio/ajax_carrega_estagio_pesquisa.php',{nm_pesquisa: nm_pesquisa});
    }

    function carrega_tabela_alunos(cd_estagio){
        $('#constroi_tabela_alunos').load('config/funcoes/estagio/ajax_carrega_alunos.php',{cd_estagio: cd_estagio});
    }

    function carrega_editar_estagio(cd_estagio){
        limpar_cadastro_estagio();
        document.getElementById('txt_salvar_estagio').className = 'fa-regular fa-floppy-disk';
        document.getElementById('txt_titulo_modal').innerHTML = ' Editar';
        document.getElementById('btn_cadastrar_estagio').innerHTML = '&nbsp; Salvar';
        $.ajax({
            url:'config/funcoes/cadastro_estagio/ajax_select_editar_estagio.php', type: 'POST', data:{cd_estagio: cd_estagio}, 
            success: function(array_dados){
                const array = JSON.parse(array_dados);
                document.getElementById('nm_estagio').value = array[1];
                document.getElementById('hr_inicio').value = array[2];
                document.getElementById('hr_fim').value = array[3];
            }
        });
        $.ajax({
            url:'config/funcoes/cadastro_estagio/ajax_select_editar_estagio_dias.php', type: 'POST', data:{cd_estagio: cd_estagio}, 
            success: function(array_dados){
                const array = JSON.parse(array_dados);
                if(array[0] == 'S'){document.getElementById('btn_dom').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
                if(array[1] == 'S'){document.getElementById('btn_seg').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
                if(array[2] == 'S'){document.getElementById('btn_ter').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
                if(array[3] == 'S'){document.getElementById('btn_qua').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
                if(array[4] == 'S'){document.getElementById('btn_qui').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
                if(array[5] == 'S'){document.getElementById('btn_sex').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
                if(array[6] == 'S'){document.getElementById('btn_sab').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');}
            }
        });
        cd_estagio_edit = cd_estagio;
    }

    function cadastrar_estagio(){
        let nome_estagio = document.getElementById('nm_estagio').value;
        let hora_inicio = document.getElementById('hr_inicio').value;
        let hora_fim = document.getElementById('hr_fim').value;
        let cor_dom = $('#btn_dom').css("background-color");
        let cor_seg = $('#btn_seg').css("background-color");
        let cor_ter = $('#btn_ter').css("background-color");
        let cor_qua = $('#btn_qua').css("background-color");
        let cor_qui = $('#btn_qui').css("background-color");
        let cor_sex = $('#btn_sex').css("background-color");
        let cor_sab = $('#btn_sab').css("background-color");
        let sn_dom = sn_seg = sn_ter = sn_qua = sn_qui = sn_sex = sn_sab = 'N';
        if(cor_dom != 'rgb(49, 133, 193)'){ sn_dom = 'S' }
        if(cor_seg != 'rgb(49, 133, 193)'){ sn_seg = 'S' }
        if(cor_ter != 'rgb(49, 133, 193)'){ sn_ter = 'S' }
        if(cor_qua != 'rgb(49, 133, 193)'){ sn_qua = 'S' }
        if(cor_qui != 'rgb(49, 133, 193)'){ sn_qui = 'S' }
        if(cor_sex != 'rgb(49, 133, 193)'){ sn_sex = 'S' }
        if(cor_sab != 'rgb(49, 133, 193)'){ sn_sab = 'S' }

        if(nome_estagio.trim() == ''){
            document.getElementById('nm_estagio').focus();
        }else if(hora_inicio == ''){
            document.getElementById('hr_inicio').focus();
        }else if(hora_fim == '' || hora_fim <= hora_inicio){
            document.getElementById('hr_fim').focus();
        }else if(document.getElementById('txt_titulo_modal').innerHTML == ' Cadastrar'){
            //Cadastrar Estágio
            $.ajax({
                url: 'config/funcoes/cadastro_estagio/ajax_insert_estagio.php', type: 'POST',
                data: {
                    nm_estagio: nome_estagio,
                    sn_ativo: 'A',
                    inicio: hora_inicio,
                    fim: hora_fim,
                    dom: sn_dom,
                    seg: sn_seg,
                    ter: sn_ter,
                    qua: sn_qua,
                    qui: sn_qui,
                    sex: sn_sex,
                    sab: sn_sab
                },
                cache: false,
                success: function(dataResult){
                    msg = dataResult;
                    if(dataResult == 'Sucesso'){         
                        var_ds_msg = 'Estágio%20Adicionado%20com%20Sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru_turma();
                        carrega_tabela_estagio();
                        limpar_cadastro_estagio();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }else{
                        console.log(dataResult);
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }
                }
            });
        }else{
            //Editar Estágio
            $.ajax({
                url: 'config/funcoes/cadastro_estagio/ajax_update_estagio.php', type: 'POST',
                data: {
                    cd_estagio: cd_estagio_edit,
                    nm_estagio: nome_estagio,
                    inicio: hora_inicio,
                    fim: hora_fim,
                    dom: sn_dom,
                    seg: sn_seg,
                    ter: sn_ter,
                    qua: sn_qua,
                    qui: sn_qui,
                    sex: sn_sex,
                    sab: sn_sab
                },
                cache: false,
                success: function(dataResult){
                    msg = dataResult;
                    if(dataResult == 'Sucesso'){         
                        var_ds_msg = 'Estágio%20Alterado%20com%20Sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru_turma();
                        carrega_tabela_estagio();
                        limpar_cadastro_estagio();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }else{
                        console.log(dataResult);
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }
                }
            });
        }
    }

    function cadastrar_aluno(){
        let cd_estagio = document.getElementById('nm_preview_estagio').innerHTML;
        cd_estagio = cd_estagio.substring(0, (cd_estagio.trim()).indexOf('-'));
        cd_estagio = cd_estagio.trim();
        let val = $('#txt_aluno').val();
        let cd_aluno = $('#datalist_alunos option').filter(function(){
            return this.value == val;
        }).data('value');
        if(!cd_aluno){
            $('#txt_aluno').focus()
        }else{
            $.ajax({
                url:'config/funcoes/cadastro_estagio/ajax_insert_aluno.php', type:'POST', data:{cd_estagio: cd_estagio, cd_aluno: cd_aluno}, 
                success: function(dataResult){
                    if(dataResult == 'Sucesso'){
                        carrega_tabela_alunos(cd_estagio);
                        limpar_cadastro_alunos();
                    }else{
                        console.log(dataResult);
                        ajax_alert_ok('Erro: Contate o Suporte!');
                    }
                }
            });
        }
    }

    function limpar_cadastro_estagio(){
        document.getElementById('nm_estagio').value = '';
        document.getElementById('hr_inicio').value = '';
        document.getElementById('hr_fim').value = '';
        document.getElementById('btn_dom').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_seg').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_ter').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_qua').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_qui').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_sex').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_sab').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        if(document.getElementById('txt_titulo_modal').innerHTML == ' Editar'){
            document.getElementById('txt_titulo_modal').innerHTML = ' Cadastrar';
            document.getElementById('txt_salvar_estagio').className = 'fa-solid fa-plus';
            document.getElementById('btn_cadastrar_estagio').innerHTML = '&nbsp; Cadastrar';
        }
        cd_estagio_edit = 'Nenhuma';
    }

    function limpar_cadastro_alunos(){
        document.getElementById('txt_aluno').value = '';
        document.getElementById('input_transferir_aluno').value = '';
        $('#list_transferir_aluno').empty();
        $('#datalist_alunos').empty();
    }

    function ajax_muda_status(estagio, status){
        $.ajax({
            url: 'config/funcoes/cadastro_estagio/ajax_update_status.php', type: 'POST', data: {cd_estagio: estagio, sn_ativo: status},
            cache: false,
            success: function(dataResult){
                msg = dataResult;
                if(dataResult == 'Sucesso'){          
                    var_ds_msg = 'Status%20Alterado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    carrega_tabela_estagio();
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }else{
                    console.log(dataResult);         
                    var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                    var_tp_msg = 'alert-danger';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }
            }
        });
    }

    function ajax_muda_status_aluno(cd_estagio, cd_aluno, sn_ativo){
        $.ajax({
            url:'config/funcoes/cadastro_estagio/ajax_update_status_aluno.php', type:'POST', data:{cd_aluno: cd_aluno, cd_estagio: cd_estagio, sn_ativo: sn_ativo}, 
            success: function(dataResult){
                if(dataResult == 'Sucesso'){
                    carrega_tabela_alunos(cd_estagio);
                }else{
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
            }
        });
    }

    function ajax_delete_estagio(cd_estagio){
        $.ajax({
            url: 'config/funcoes/cadastro_estagio/ajax_delete_estagio.php', type:'POST', data:{cd_estagio: cd_estagio}, cache: false,
            success: function(dataResult){
                if(dataResult == 'Sucesso'){
                    var_ds_msg = 'Estágio%20Excluído%20com%20Sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }else{
                    console.log(dataResult);
                    var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                    var_tp_msg = 'alert-danger';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }
                carrega_tabela_estagio();
            }
        })
    }

    function ajax_delete_aluno(cd_estagio, cd_aluno_estagio){
        $.ajax({
            url:'config/funcoes/cadastro_estagio/ajax_delete_aluno.php', type:'POST', data:{cd_aluno_estagio: cd_aluno_estagio}, 
            success: function(dataResult){
                if(dataResult == 'Sucesso'){
                    carrega_tabela_alunos(cd_estagio);
                }else{
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
            }
        });
    }

    function ajax_transfere_aluno(){
        let valor = $('#input_transferir_aluno').val();
        let cd_aluno_estagio = $('#list_transferir_aluno option').filter(function() {
            return this.value == valor;
        }).data('cd_aluno_estagio');
        let val = $('#input_transferir_aluno').val();
        let ds_opt = $('#list_transferir_aluno option').filter(function(){
            return this.value == val;
        }).data('option');
        let cd_estagio = document.getElementById('nm_preview_estagio').innerHTML;
        cd_estagio = cd_estagio.substring(0, (cd_estagio.trim()).indexOf('-'));
        if(!ds_opt){
            $('#input_transferir_aluno').focus();
        }else{
            $.ajax({
                url:'config/funcoes/cadastro_estagio/ajax_update_estagio_aluno.php', type:'POST', data:{cd_estagio: cd_estagio, cd_aluno_estagio: cd_aluno_estagio}, 
                success: function(dataResult){
                    if(dataResult == 'Sucesso'){
                        limpar_cadastro_alunos();
                        carrega_tabela_alunos(cd_estagio);
                    }else{
                        console.log(dataResult);
                        ajax_alert_ok('Erro: Contate o Suporte!');
                    }
                }
            });
        }
    }

    // Pesquisa de Alunos para Inclusao
    let timer_pesquisa_aluno;
    const tempo_timer = 1500;
    function timer_pesquisa_aluno_func(nm_aluno){
        clearTimeout(timer_pesquisa_aluno);
        if(nm_aluno.length >= 3 && nm_aluno && nm_aluno != ''){
            let val = $('#txt_aluno').val();
            let ds_opt = $('#datalist_alunos option').filter(function(){
                return this.value == val;
            }).data('option');
            if(!ds_opt){
                timer_pesquisa_aluno_transfer = setTimeout(() => ajax_select_aluno(nm_aluno), tempo_timer);
            }
        }
    }
    function ajax_select_aluno(nm_pesquisa){
        let cd_estagio = document.getElementById('nm_preview_estagio').innerHTML;
        cd_estagio = cd_estagio.substring(0, (cd_estagio.trim()).indexOf('-'));
        let val = $('#txt_aluno').val();
        $('#datalist_alunos').load('config/funcoes/estagio/ajax_carrega_lista_alunos_pesquisa.php',{nm_pesquisa: nm_pesquisa, cd_estagio: cd_estagio});
    }

    // Pesquisa de Alunos para Transferencia
    let timer_pesquisa_aluno_transfer;
    function timer_pesquisa_aluno_transfer_func(nm_aluno){
        clearTimeout(timer_pesquisa_aluno_transfer);
        if(nm_aluno.length >= 3 && nm_aluno && nm_aluno != ''){
            let val = $('#input_transferir_aluno').val();
            let ds_opt = $('#list_transferir_aluno option').filter(function(){
                return this.value == val;
            }).data('option');
            if(!ds_opt){
                timer_pesquisa_aluno_transfer = setTimeout(() => ajax_select_aluno_transfer(nm_aluno), tempo_timer);
            }
        }
    }
    function ajax_select_aluno_transfer(nm_pesquisa){
        let cd_estagio = document.getElementById('nm_preview_estagio').innerHTML;
        cd_estagio = cd_estagio.substring(0, (cd_estagio.trim()).indexOf('-'));
        let val = $('#input_transferir_aluno').val();
        $('#list_transferir_aluno').load('config/funcoes/estagio/ajax_carrega_lista_alunos_pesquisa_transfer.php',{nm_pesquisa : nm_pesquisa, cd_estagio: cd_estagio});
    }

    document.getElementById('nm_estagio_pesquisa').addEventListener('keypress', function (e){
        if(e.key === "Enter"){
            e.preventDefault();
            document.getElementById("btn_pesquisar").click();
        }
    });

    // Resize da Modal
    function resize_modal(){
        var element = document.getElementById('control'),
        style = window.getComputedStyle(element),
        x = style.getPropertyValue('width');
        document.getElementById('view_estagio').style.width = x;
    }
    window.addEventListener('resize', function(event) {
        resize_modal();
    }, true);
</script>

<?php
include 'rodape.php';
?>