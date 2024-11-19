<?php
    include 'cabecalho.php';
    include 'config/mensagem/ajax_mensagem_alert.php';
    include 'acesso_restrito_usuario.php';
?>

<div class="div_br" id='teste'> </div>

<h11><i style="cursor: pointer;" class="fa-solid fa-users efeito-zoom"></i> Terceiros</h11>
<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div>  

    <button onclick="abre_canguru();" type="submit" class="botao_home"> 
        <i class="fa-solid fa-users" aria-hidden="true"></i> Cadastro 
    </button>

    <br><br>

    <div class="col-md-3 "style="padding-left: 0;">
        <span style="padding-left: 5px;">Nome do Terceiro:</span>
        <div class="input-group">
            <input class="form-control input-group" type="text" id="nm_terceiro_pesquisa" required="" placeholder="Digite um nome">
            <button onclick="ajax_pesquisar_terceiro();" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
            <input type="hidden" id="valor" readonly="">
        </div>
    </div>

    <div id="mensagem_acoes"></div>

    <!-- Abre bolsa Kanguru Modal -->
    <div id="cad_terceiro" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97);                                   
                                  position: absolute; z-index: -99;">
        <div id="conteudo_cad_terceiro" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <h11><i style="cursor: pointer;"class="fa-solid fa-users efeito-zoom"></i><a id="nm_preview_terceiro"> Cadastrar</a></h11>

                    <div style="float: right;">
                     <i style="cursor:pointer;" onclick="fecha_canguru(); limpar_terceiro()" class="fa-solid fa-xmark"></i>
                    </div>

                    <div class="div_br"></div>
                </div>               

                <div class="col-md-4">
                    Crachá:<br>
                    <input id="ds_cracha"  required type="text" class="form-control" placeholder="Informe o Crachá" maxlength="12">  
                </div>

                <div class="col-md-5">
                    Nome:<br>
                    <input id="nome_terceiro" type="text" class="form-control" placeholder="Informe o Nome" maxlength="80">  
                </div>

                <div class="col-md-3">
                    Nascimento:<br>
                    <input required id="data_nascimento" type="date" class="form-control">  
                </div>

                <div class="col-md-4">
                    Rf-ID:<br>
                    <input id="ds_rfid"  required type="text" class="form-control" placeholder="Informe o Crachá" maxlength="12">  
                </div>


            </div>

            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <div class="div_br"> </div> 
                </div>

                <div class="col-md-4">
                    RG: <input type="checkbox" id="check_rg"> <i class="fa-solid fa-circle-info" style="color: #eec220;" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Para RGs com mais de 9 dígitos marcar!"></i> <br>
                    <input id="nr_rg" type="text" class="form-control" placeholder="Informe o RG" maxlength="12">
                </div>

                <div class="col-md-4">
                    CPF:<br>
                    <input id="nr_cpf" type="text" class="form-control" placeholder="Informe o CPF" maxlength="14">
                </div>

                <div class="col-md-4">
                    CNPJ:<br>
                    <input id="nr_cnpj" type="text" class="form-control" placeholder="Informe o CNPJ" maxlength="18">
                </div>
            </div>

            <div class="row" style="width: 60vw;">

                <div class="col-md-12">
                    <div class="div_br"> </div> 
                </div>               

                <div class="col-md-6">
                    Empresa:<br>
                    <input id="nm_empresa" type="text" class="form-control" placeholder="Informe a Empresa" maxlength="80">  
                </div>

                <div class="col-md-6">
                    Status:<br>        
                    <select id="tp_status" class="form-control">
                        <option value="All">Selecione</option>
                        <option value="A"> Ativo</option>
                        <option value="I"> Inativo</option>
                    </select>
                </div>
            </div>

            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <div class="div_br"> </div>  
                </div>               

                <div class="col-md-4">
                    Inicio:<br>
                    <input id="dt_inicio" type="date" class="form-control">  
                </div>

                <div class="col-md-4">
                    Fim:<br>
                    <input id="dt_fim" type="date" class="form-control">  
                </div>

                <div class="col-md-4">
                    <br>
                    <button onclick="ajax_insert_terceiro()" class="btn btn-primary"> <i class="fa-solid fa-plus" id="txt_salvar_terceiro"></i><a id="btn_cadastrar_terceiro"> Cadastrar<a></button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="div_br"> </div>

    <div id="constroi_tabela"></div>

<script src="js/mask.js"></script>
<script>
    window.onload = function ajax_chama_tabela(){
        //$('#constroi_tabela').load('config/funcoes/terceiros/ajax_carrega_tabela_terceiros.php');
    }

    var cracha, terceiro, nascimento, rg, cpf, cnpj, empresa, status, inicio, fim, rfid;
    function set_values(){
        cracha = document.getElementById('ds_cracha').value;
        terceiro = document.getElementById('nome_terceiro').value;
        nascimento = document.getElementById('data_nascimento').value;
        rg = document.getElementById('nr_rg').value;
        cpf = document.getElementById('nr_cpf').value;
        cnpj = document.getElementById('nr_cnpj').value;
        empresa = document.getElementById('nm_empresa').value;
        status = document.getElementById('tp_status').value;
        inicio = document.getElementById('dt_inicio').value;
        fim = document.getElementById('dt_fim').value;
        rfid = document.getElementById('ds_rfid').value;

    }

    var tipo;
    var cd_terceiro_edit = '';
    var cd_cracha_edit = '';
    function ajax_insert_terceiro(){
        set_values();
        let control = false;
        
        if(cracha.trim() == '' || cracha.length != 12){
            //Verifica se o Insert é Alteração de um registro ou um novo registro
            if(document.getElementById('nm_preview_terceiro').innerHTML == ' Cadastrar'){
                document.getElementById('ds_cracha').focus();
            }else{
                if(cracha.length > 0 && cracha.length != 12){
                    document.getElementById('ds_cracha').focus();
                }else{
                    control = true;
                }
            }
        }else if(cracha.length == 12){
            control = true;
        }
        if(control){
            if(terceiro.trim() == ''){
                document.getElementById('nome_terceiro').focus();
            }else if(!nascimento || nascimento.length != 10){
                document.getElementById('data_nascimento').focus();
            }else if(rg.trim == '' || (rg.length != 12 && !document.getElementById('check_rg').checked)){
                document.getElementById('nr_rg').focus();
            }else if(cpf.trim() == ''|| cpf.length != 14){
                document.getElementById('nr_cpf').focus();
            }else if(cnpj.trim() == '' || cnpj.length != 18){
                document.getElementById('nr_cnpj').focus();
            }else if(empresa.trim() == ''){
                document.getElementById('nm_empresa').focus();
            }else if(status.trim() == 'All'){
                document.getElementById('tp_status').focus();
            }else if(!inicio || inicio.length != 10){
                document.getElementById('dt_inicio').focus();
            }else if(!fim || fim.length != 10 || fim < inicio){
                document.getElementById('dt_fim').focus();
            //}else if(rfid.trim() == ''){
                //document.getElementById('ds_rfid').focus();
            }else{
                ajax_verificar_cracha(cracha);
            }
        }
    }

    function ajax_verificar_cracha(cracha){
        $.ajax({
            url: "config/funcoes/geral/ajax_verificar_disponibilidade_cracha.php", type: "POST", data:{cracha_pesquisa: cracha}, cache: false,
            success: function(dataResult){
                tipo = dataResult;
                if(tipo == 'F'){
                    ajax_alert_ok('Esse crachá já está vinculado a um Funcionário!');
                }else if(tipo == 'T' && cracha != cd_cracha_edit){
                    ajax_alert('Esse crachá já está vinculado a um Terceiro, deseja vincular ao usuário atual?', 'ajax_disponibilizar_cracha()');
                }else if(tipo == 'M'){
                    ajax_alert_ok('Esse crachá já está vinculado a um Médico!');
                }else if(tipo == 'A'){
                    ajax_alert_ok('Esse crachá já está vinculado a um Aluno!');
                }else if(tipo == 'PR'){
                    ajax_alert_ok('Esse crachá já está vinculado a um Prestador!');
                }else{
                    tipo = '';
                    ajax_insert_terceiro_auxiliar();
                }
            }
        });
    }

    function ajax_disponibilizar_cracha(disponibilizar_anterior){
        let cracha = document.getElementById('ds_cracha').value;
        if(cracha != cd_cracha_edit){
            let cracha_disponibilizar;
            if(disponibilizar_anterior){
                cracha_disponibilizar = cd_cracha_edit;
            }else{
                cracha_disponibilizar = cracha;
            }
            $.ajax({
                url: "config/funcoes/geral/ajax_disponibilizar_cracha.php", type: "POST", data:{cracha: cracha_disponibilizar, tipo: tipo}, cache: false,
                success: function(dataResult){
                    if(dataResult != 'Sucesso'){
                        controle = false;
                        ajax_alert_ok('Erro: Contate o Suporte!');
                        console.log(dataResult);
                    }else{
                        ajax_insert_terceiro_auxiliar();
                    }
                }
            });
        }
    }

    function ajax_insert_terceiro_auxiliar(){
        set_values();
        rg = rg.replace(/[.-]/g, '');
        cpf = cpf.replace(/[.-]/g, '');
        cnpj = cnpj.replace(/[\/.-]/g, '');

        if(document.getElementById('nm_preview_terceiro').innerHTML == ' Cadastrar'){
            tipo = 'T';
            $.ajax({
                url: "config/funcoes/cadastro_terceiros/ajax_insert_terceiros.php", type: "POST",
                data: {
                    cd_cracha: cracha,
                    nm_terceiro: terceiro,
                    dt_nasc: nascimento,
                    nr_rg: rg,
                    nr_cpf: cpf,
                    nr_cnpj: cnpj,
                    nm_empresa: empresa,
                    tp_status: status,
                    dt_ini: inicio,
                    dt_fim: fim,
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
        }else{
            $.ajax({
                url: 'config/funcoes/cadastro_terceiros/ajax_update_terceiro.php', type: 'POST',
                data: {
                    id: cd_terceiro_edit,
                    cd_cracha: cracha,
                    nm_terceiro: terceiro,
                    dt_nasc: nascimento,
                    nr_rg: rg,
                    nr_cpf: cpf,
                    nr_cnpj: cnpj,
                    nm_empresa: empresa,
                    tp_status: status,
                    dt_ini: inicio,
                    dt_fim: fim,
                    ds_rfid: rfid
                },
                cache: false,
                success: function(dataResult){
                    msg = dataResult;
                    if(dataResult == 'Sucesso'){
                        if(cracha != cd_cracha_edit){
                            ajax_disponibilizar_cracha(true);
                        }
                        var_ds_msg = 'Terceiro%20Editado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru();
                        limpar_terceiro();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                        nm_pesquisa_recente = terceiro;
                        ajax_atualiza_tabela();
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

    function ajax_mudar_status(id_terceiro, status){
        $.ajax({
            url: 'config/funcoes/cadastro_terceiros/ajax_update_status_terceiros.php', type: 'POST', data: {id: id_terceiro, status: status}, cache: false,
            success: function(dataResult){
                if(dataResult == 0){    
                    var_ds_msg = 'Terceiro%20Desativado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);      
                }else if(dataResult == 1){
                    var_ds_msg = 'Terceiro%20Ativado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }else{
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
                ajax_atualiza_tabela();
            }
        })
    }

    function ajax_delete_terceiro(id_terceiro){
        $.ajax({
            url: 'config/funcoes/cadastro_terceiros/ajax_delete_terceiros.php', type: 'POST', data: {id: id_terceiro}, cache: false,
            success: function(dataResult){
                if(dataResult == 'Sucesso'){     
                    var_ds_msg = 'Terceiro%20Excluído%20com%20Sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                }else{
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
                ajax_atualiza_tabela();
            }
        })
    }
    
    function ajax_editar_terceiro(id_terceiro){
        cd_terceiro_edit = '';
        cd_cracha_edit = '';
        document.getElementById('nm_preview_terceiro').innerHTML = ' Editar';
        document.getElementById('txt_salvar_terceiro').className = 'fa-regular fa-floppy-disk';
        document.getElementById('btn_cadastrar_terceiro').innerHTML = '&nbsp; Salvar';

        window.scrollTo({
        top: 0,
        behavior: 'smooth',
        })
        $.ajax({
            url: 'config/funcoes/cadastro_terceiros/ajax_select_terceiro.php', type: 'POST', data: {id: id_terceiro}, cache: false,
            success: function(array_dados){
                const array = JSON.parse(array_dados);

                cd_cracha_edit = array[0];
                document.getElementById('ds_cracha').value = array[0];
                document.getElementById('nome_terceiro').value = array[1];
                document.getElementById('data_nascimento').value = array[2].replaceAll('/','-');
                document.getElementById('nr_rg').value = array[3];
                document.getElementById('nr_cpf').value = array[4];
                document.getElementById('nr_cnpj').value = array[5];
                document.getElementById('nm_empresa').value = array[6];
                document.getElementById('tp_status').value = array[7];
                document.getElementById('dt_inicio').value = array[8].replaceAll('/','-');
                document.getElementById('dt_fim').value = array[9].replaceAll('/','-');
                cd_terceiro_edit = array[10];
                document.getElementById('ds_rfid').value = array[11];
            }
        });
    }

    function limpar_terceiro(){
        document.getElementById('ds_cracha').value = '';
        document.getElementById('nome_terceiro').value = '';
        document.getElementById('data_nascimento').value = '';
        document.getElementById('nr_rg').value = '';
        document.getElementById('nr_cpf').value = '';
        document.getElementById('nr_cnpj').value = '';
        document.getElementById('nm_empresa').value = '';
        document.getElementById('tp_status').value = '';
        document.getElementById('dt_inicio').value = '';
        document.getElementById('dt_fim').value = '';
        document.getElementById('ds_rfid').value = '';

        document.getElementById('nm_preview_terceiro').innerHTML = ' Cadastrar';
        document.getElementById('txt_salvar_terceiro').className = 'fa-regular fa-plus';
        document.getElementById('btn_cadastrar_terceiro').innerHTML = '&nbsp; Cadastrar';

        cd_terceiro_edit = '';
        cd_cracha_edit = '';
        tipo = '';
    }

    var nm_pesquisa_recente;
    function ajax_atualiza_tabela(){
        if (typeof nm_pesquisa_recente !== 'undefined'){
            $('#constroi_tabela').load('config/funcoes/terceiros/ajax_carrega_tabela_terceiros_pesquisa.php',{nm_terceiro: nm_pesquisa_recente});
        }else{
            //$('#constroi_tabela').load('config/funcoes/terceiros/ajax_carrega_tabela_terceiros.php');
        }
    }
    
    function ajax_pesquisar_terceiro(nm_pesquisa_auxiliar){
        let nm_terceiro_pesquisa = document.getElementById('nm_terceiro_pesquisa').value
        if(nm_terceiro_pesquisa.trim() == '' && !nm_pesquisa_auxiliar){
            document.getElementById('nm_terceiro_pesquisa').focus();
        }else{
            if(nm_pesquisa_auxiliar){
                nm_pesquisa_recente = nm_pesquisa_auxiliar;
                $('#constroi_tabela').load('config/funcoes/terceiros/ajax_carrega_tabela_terceiros_pesquisa.php',{nm_terceiro: nm_pesquisa_auxiliar});
            }else{
                nm_pesquisa_recente = nm_terceiro_pesquisa;
                $('#constroi_tabela').load('config/funcoes/terceiros/ajax_carrega_tabela_terceiros_pesquisa.php',{nm_terceiro: nm_terceiro_pesquisa});
            }
        }
    }

    // Mask do Campo Cracha
    document.getElementById('ds_cracha').addEventListener('input', function (e){
        mask_int(e);
    });
    // Mask do Campo RG
    document.getElementById('nr_rg').addEventListener('input', function (e){
        if(!document.getElementById('check_rg').checked){
            mask_rg(e);
        }
    });
    // Mask do Campo CPF
    document.getElementById('nr_cpf').addEventListener('input', function (e){
        mask_cpf(e);
    });
    // Mask do Campo CNPJ
    document.getElementById('nr_cnpj').addEventListener('input', function (e){
        mask_cnpj(e);
    });
    // Event Enter Campo Pesquisa
    document.getElementById('nm_terceiro_pesquisa').addEventListener('keypress', function (e){
        if(e.key === "Enter"){
            e.preventDefault();
            document.getElementById("btn_pesquisar").click();
        }
    });
    // Event Check RG
    document.getElementById('check_rg').addEventListener('input', function (e){
        if(document.getElementById('check_rg').checked){
            $('input#nr_rg').attr('maxLength','13');
        }else{
            $('input#nr_rg').attr('maxLength','12');
        }
    });
</script>

<?php
    include 'rodape.php';
?>