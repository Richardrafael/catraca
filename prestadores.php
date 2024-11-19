<?php
    include 'cabecalho.php';
    include 'config/mensagem/ajax_mensagem_alert.php';
    include 'acesso_restrito_usuario.php';
?>

<div class="div_br" id='teste'> </div>

<h11><i style="cursor: pointer;" class="fa-solid fa-address-book efeito-zoom"></i> Prestadores</h11> 
<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div>  

    <button onclick="abre_canguru();" type="submit" class="botao_home"> 
        <i class="fa-solid fa-users" aria-hidden="true"></i> Cadastro 
    </button>

    <br><br>

    <div class="row" style="width: auto;">
        <div class="col-md-3">
            <span style="padding-left: 5px;">Nome:</span>
            <div class="input-group">
                <input class="form-control input-group" type="text" id="nm_prestador_pesquisa" required="true" placeholder="Nome do Prestador" maxlength="12">
            </div>
        </div>
        <div class="col-md-2"style="padding-left: 0;">
            <span style="padding-left: 5px;">Tipo:</span>
            <div class="input-group">
                <select class="form-control input group" id="tp_pesquisa">
                        <option value='ALL'>Selecione</option>
                        <option value='PR'>Provedoria</option>
                        <option value='IN'>Instrumentador</option>
                </select>
            </div>
        </div>
        <div class="col-md-1"style="padding-left: 0;">
            <br/>
            <button onclick="pesquisar_prestador()" class=" btn btn-primary" id="btn_pesquisar"><i class="fa fa-search" aria-hidden="true"></i></button>	
        </div>
    </div>

    <div id="mensagem_acoes"></div>

    <!-- Abre bolsa Kanguru Modal -->
    <div id="cad_terceiro" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97); position: absolute; z-index: -99;">
        <div id="conteudo_cad_terceiro" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
            <div class="row" style="width: 70vw;">
                <div class="col-md-12">
                    <h11><i style="cursor: pointer;"class="fa-solid fa-users efeito-zoom"></i><a id="nm_preview_prestador"> Cadastrar</a></h11>

                    <div style="float: right;">
                        <i style="cursor:pointer;" onclick="fecha_canguru(); limpar_prestador()" class="fa-solid fa-xmark"></i>
                    </div>

                    <div class="div_br"></div>
                </div>

                <div class="col-md-4">
                    Crachá:<br>
                    <input id="ds_cracha"  required type="text" class="form-control" placeholder="Informe o Crachá" maxlength="12">  
                </div>
                <!--
                <div class="col-md-3">
                    RF-ID:<br>
                    <input id="ds_rfid"  required type="text" class="form-control" placeholder="Informe o RF-ID" maxlength="12">  
                </div>
                -->
                <div class="col-md-3">
                    Rf-ID:<br>
                    <input id="ds_rfid"  required type="text" class="form-control" placeholder="Informe o RF-ID" maxlength="12">  
                </div>

                <div class="col-md-5">
                    Nome:<br>
                    <input id="nm_prestador" type="text" class="form-control" placeholder="Informe o Nome" maxlength="80">  
                </div>

                
            </div>

            

            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <div class="div_br"> </div> 
                </div>    

                <div class="col-md-4">
                    CPF:<br>
                    <input id="nr_cpf" type="text" class="form-control" placeholder="Informe o CPF" maxlength="14">
                </div>

                <div class="col-md-5">
                    Tipo:<br>
                    <select class="form-control input group" id="tp_cadastro">
                        <option value='ALL'>Selecione</option>
                        <option value='PR'>Provedoria</option>
                        <option value='IN'>Instrumentador</option>
                    </select>
                </div>
            </div>

            <div class="row" style="width: 60vw;">
                <div class="col-md-12">
                    <div class="div_br"> </div> 
                </div>

                <div class="col-md-4">
                    Status:<br>        
                    <select class="form-control input group" id="tp_status">
                        <option value="ALL">Selecione</option>
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                </div>

                <div class="col-md-3">
                    Inicio:<br>
                    <input id="dt_inicio" type="date" class="form-control">  
                </div>

                <div class="col-md-3">
                    Fim:<br>
                    <input id="dt_fim" type="date" class="form-control">  
                </div>

                <div class="col-md-2">
                    <br/><button onclick="insert_prestador()" class="btn btn-primary"> <i class="fa-solid fa-plus" id="txt_salvar_prestador"></i><a id="btn_cadastrar_prestador"> Cadastrar<a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="div_br"></div>

    <div id="tabela_prestador"></div>

    <script src="js/mask.js"></script>
    <script>
        const nm_pesquisa = document.getElementById('nm_prestador_pesquisa')
        const tp_pesquisa = document.getElementById('tp_pesquisa')

        const cracha = document.getElementById('ds_cracha');
        const ds_rfid = document.getElementById('ds_rfid');
        const nome = document.getElementById('nm_prestador');
        const cpf = document.getElementById('nr_cpf');
        const tipo = document.getElementById('tp_cadastro');
        const status = document.getElementById('tp_status');
        const dt_inicio = document.getElementById('dt_inicio');
        const dt_fim = document.getElementById('dt_fim');

        var nome_ultima_pesquisa = '';
        var tipo_ultima_pesquisa = '';

        var cracha_edit = '';
        var cd_prestador_edit = '';
        var tipo_prestador_edit = '';
        var tipo_disponibilizar = '';

        window.onload = function (){
            ajax_chama_tabela();
        }
        
        function ajax_chama_tabela(){
            //$('#tabela_prestador').load('config/funcoes/prestadores/ajax_carrega_tabela_prestadores.php');
        }

        function pesquisar_prestador(categoria_pesquisa, nome_prestador, tipo_prestador){
            if(categoria_pesquisa == 1){
                $('#tabela_prestador').load('config/funcoes/prestadores/ajax_carrega_tabela_prestadores_pesquisa.php',{nm_pesquisa: nome_prestador, tp_pesquisa: tipo_prestador});
            }else if(categoria_pesquisa == 2){
                $('#tabela_prestador').load('config/funcoes/prestadores/ajax_carrega_tabela_prestadores_pesquisa.php',{nm_pesquisa: nm_pesquisa.value, tp_pesquisa: tp_pesquisa.value});
            }else{
                if(nm_pesquisa.value.trim() == ''){
                    nm_pesquisa.focus();
                }else if(tp_pesquisa.value == 'ALL'){
                    tp_pesquisa.focus();
                }else{
                    nome_ultima_pesquisa = nm_pesquisa.value;
                    tipo_ultima_pesquisa = tp_pesquisa.value;
                    $('#tabela_prestador').load('config/funcoes/prestadores/ajax_carrega_tabela_prestadores_pesquisa.php',{nm_pesquisa: nm_pesquisa.value, tp_pesquisa: tp_pesquisa.value});
                }
            }
        }

        function verificar_disponibilidade_cracha(){
            let cd_cracha = cracha.value;
            $.ajax({
                url: "config/funcoes/geral/ajax_verificar_disponibilidade_cracha.php", type: "POST", data:{cracha_pesquisa: cd_cracha}, cache: false,
                success: function(dataResult){
                    tipo_disponibilizar = dataResult;
                    if(tipo_disponibilizar == 'F'){
                        ajax_alert_ok('Esse crachá já está vinculado a um Funcionário!');
                    }else if(tipo_disponibilizar == 'T'){
                        ajax_alert_ok('Esse crachá já está vinculado a um Terceiro!');
                    }else if(tipo_disponibilizar == 'M'){
                        ajax_alert_ok('Esse crachá já está vinculado a um Médico!');
                    }else if(tipo_disponibilizar == 'A'){
                        ajax_alert_ok('Esse crachá já está vinculado a um Aluno!');
                    }else if(tipo_disponibilizar == 'PR' && cd_cracha != cracha_edit){
                        ajax_alert('Esse crachá já está vinculado a um Prestador, deseja vincular ao usuário atual? ', 'disponibilizar_cracha()');
                    }else{
                        if(document.getElementById('nm_preview_prestador').innerHTML == ' Cadastrar'){
                            tipo_disponibilizar = '';
                            insert_prestador_auxiliar();
                        }else{
                            tipo_disponibilizar = tipo_prestador_edit;
                            update_prestador();
                        }
                    }
                }
            });
        }
        
        function disponibilizar_cracha(disponibilizar_anterior){
            let cracha_atual = cracha.value;
            if(cracha_atual != cracha_edit){
                let cracha_disponibilizar;
                if(disponibilizar_anterior){
                    cracha_disponibilizar = cracha_edit;
                }else{
                    cracha_disponibilizar = cracha_atual;
                }
                $.ajax({
                    url: "config/funcoes/geral/ajax_disponibilizar_cracha.php", type: "POST", data:{cracha: cracha_disponibilizar, tipo: tipo_disponibilizar}, cache: false,
                    success: function(dataResult){
                        if(dataResult != 'Sucesso'){
                            controle = false;
                            ajax_alert_ok('Erro: Contate o Suporte!');
                            console.log(dataResult);
                        }else{
                            insert_prestador_auxiliar();
                        }
                    }
                });
            }
        }

        function insert_prestador(){
            if(cracha.value.length != 12 || cracha.value.trim() == ''){
                cracha.focus();
            }else if(nome.value.trim() == ''){
                nome.focus();
            }else if(cpf.value.length != 14){
                cpf.focus();
            }else if(tipo.value == 'ALL'){
                tipo.focus();
            }else if(status.value == 'ALL'){
                status.focus();
            }else if(!dt_inicio.value || dt_inicio.value.length != 10){
                dt_inicio.focus();
            }else if(!dt_fim.value || dt_fim.value.length != 10 || dt_fim.value < dt_inicio.value){
                dt_fim.focus();
            }else{
                verificar_disponibilidade_cracha();
            }
        }

        function insert_prestador_auxiliar(){
            if (document.getElementById('nm_preview_prestador').innerHTML == ' Cadastrar'){
                $.ajax({
                    url: "config/funcoes/cadastro_prestadores/ajax_insert_prestadores.php", type: "POST",
                    data: {
                        cd_cracha: cracha.value,
                        nm_prestador: nome.value,
                        nr_cpf: cpf.value.replace(/[.-]/g, ''),
                        ds_rfid: ds_rfid.value,
                        tp_cadastro: tipo.value,
                        tp_status: status.value,
                        dt_inicio: dt_inicio.value,
                        dt_fim: dt_fim.value
                    },
                    cache: false,
                    success: function(dataResult){
                        if(dataResult == 'Sucesso'){
                            var_ds_msg = 'Prestador%20Cadastrado%20com%20sucesso!';
                            var_tp_msg = 'alert-success';
                            fecha_canguru();
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                            pesquisar_prestador('1', nome.value, tipo.value);
                            limpar_prestador();
                        }else{
                            var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                            var_tp_msg = 'alert-danger';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                            console.log(dataResult);
                        }
                    }
                });
            }else{
                update_prestador();
            }
        }

        function update_prestador(){
            $.ajax({
                url: "config/funcoes/cadastro_prestadores/ajax_update_prestadores.php", type: "POST",
                data: {
                    cd_seq_prestador: cd_prestador_edit,
                    cd_cracha_edit: cracha_edit,
                    cd_cracha: cracha.value,
                    ds_rfid: ds_rfid.value,
                    nm_prestador: nome.value,
                    nr_cpf: cpf.value.replace(/[.-]/g, ''),
                    ds_rfid: ds_rfid.value,
                    tp_cadastro: tipo.value,
                    tp_status: status.value,
                    dt_inicio: dt_inicio.value,
                    dt_fim: dt_fim.value
                },
                cache: false,
                success: function(dataResult){
                    if(dataResult == 'Sucesso'){
                        var_ds_msg = 'Prestador%20Atualizado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                        pesquisar_prestador('1', nome.value, tipo.value);
                        limpar_prestador();
                    }else{
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                        console.log(dataResult);
                    }
                }
            });
        }

        function editar_prestador(cd_prestador){
            cd_prestador_edit = '';
            cracha_edit = '';
            document.getElementById('nm_preview_prestador').innerHTML = ' Editar';
            document.getElementById('txt_salvar_prestador').className = 'fa-regular fa-floppy-disk';
            document.getElementById('btn_cadastrar_prestador').innerHTML = '&nbsp; Salvar';

            window.scrollTo({
            top: 0,
            behavior: 'smooth',
            })
            $.ajax({
                url: 'config/funcoes/cadastro_prestadores/ajax_select_prestador.php', type: 'POST', data: {cd: cd_prestador}, cache: false,
                success: function(array_dados){
                    const array = JSON.parse(array_dados);

                    cracha_edit = array[0];
                    cracha.value = array[0];
                    nome.value = array[1];
                    cpf.value = array[2];
                    tipo_prestador_edit = array[3];
                    tipo.value = array[3]
                    status.value = array[4];
                    dt_inicio.value = array[5];
                    dt_fim.value = array[6];
                    cd_prestador_edit = array[7];
                    ds_rfid.value = array[8];
                }
            });
        }

        function mudar_status(cd_prestador, status){
            $.ajax({
                url: 'config/funcoes/cadastro_prestadores/ajax_update_status_prestador.php', type: 'POST', data: {cd: cd_prestador, status}, cache: false,
                success: function(dataResult){
                    if(dataResult == 0){    
                        var_ds_msg = 'Prestador%20Desativado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);      
                    }else if(dataResult == 1){
                        var_ds_msg = 'Prestador%20Ativado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }else{
                        console.log(dataResult);
                        ajax_alert_ok('Erro: Contate o Suporte!');
                    }
                    pesquisar_prestador(2);
                }
            });
        }

        function deletar_prestador(cd_seq_prestador){
            $.ajax({
                url: 'config/funcoes/cadastro_prestadores/ajax_delete_prestador.php', type: 'POST', data: {cd_seq_prestador: cd_seq_prestador}, cache: false,
                success: function(dataResult){
                    if(dataResult == 'Sucesso'){    
                        var_ds_msg = 'Prestador%20Deletado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    }else{
                        console.log(dataResult);
                        ajax_alert_ok('Erro: Contate o Suporte!');
                    }
                    pesquisar_prestador(2);
                }
            });
        }

        function limpar_prestador(){
            cracha.value = '';
            nome.value = '';
            ds_rfid.value = '';
            cpf.value = '';
            tipo.value = 'ALL'
            status.value = 'ALL';
            dt_inicio.value = '';
            dt_fim.value = '';
            cd_terceiro_edit = '';

            document.getElementById('nm_preview_prestador').innerHTML = ' Cadastrar';
            document.getElementById('txt_salvar_prestador').className = 'fa-regular fa-plus';
            document.getElementById('btn_cadastrar_prestador').innerHTML = '&nbsp; Cadastrar';

            cd_prestador_edit = '';
            cracha_edit = '';
            tipo_prestador_edit = '';
            tipo_disponibilizar = '';
        }

        // Mask do Campo Cracha
        document.getElementById('ds_cracha').addEventListener('input', function (e){
            mask_int(e);
        });
        // Mask do Campo CPF
        document.getElementById('nr_cpf').addEventListener('input', function (e){
            mask_cpf(e);
        });
        // Event Enter Campo Pesquisa
        document.getElementById('nm_prestador_pesquisa').addEventListener('keypress', function (e){
            if(e.key === "Enter"){
                e.preventDefault();
                document.getElementById("btn_pesquisar").click();
            }
        });
    </script>
<?php
    include 'rodape.php';
?>