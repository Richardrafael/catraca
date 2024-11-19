<?php
include 'cabecalho.php';
include 'acesso_restrito_iep.php';
?>
<style>
    .container-modal-success {
        height: 100vh;
        width: 100%;
        /* background: rgba(0, 0, 0, .5); */
        position: fixed;
        top: 0;
        left: 0;
        z-index: 5000;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<div class="div_br" id="control"> </div>

<h11><i style="cursor: pointer;" class="fa-solid fa-book efeito-zoom" style="color: #ffffff;"></i> Turmas</h11>

<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>
<div class="div_br"> </div>

<button onclick="abre_canguru_turma();" type="submit" class="botao_home">
    <i class="fa-solid fa-book" aria-hidden="true"></i> Cadastro
</button>

<br><br>

<div class="col-md-3 " style="padding-left: 0;">
    <span style="padding-left: 5px;">Nome da Turma:</span>
    <div class="input-group">
        <input class="form-control input-group" type="text" id="nm_turma_pesquisa" required="">
        <button onclick="carrega_tabela_turmas_pesquisa(document.getElementById('nm_turma_pesquisa').value);" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>
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

                <h11><i style="cursor: pointer;" class="fa-solid fa-book efeito-zoom"></i><a id="txt_titulo_modal"> Cadastrar</a></h11>

                <div style="float: right;">
                    <i style="cursor:pointer;" onclick="fecha_canguru_turma(); limpar_cadastro_turmas();" class="fa-solid fa-xmark"></i>
                </div>

                <div class="div_br"> </div>

            </div>

            <div class="col-md-8">

                Nome da Turma:<br>
                <input id="nm_turma" required type="text" class="form-control" placeholder="Nome da Turma" maxlength="80">

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
                <button onclick="cadastrar_turma();" class="btn btn-primary" style="float: right;"> <i id="txt_salvar_turma" class="fa-solid fa-plus"></i><a id="btn_cadastrar_turma"> Cadastrar</a></button>

            </div>
        </div>
    </div>
</div>

<!-- Abre Menu Modal -->
<div id="view_turma" style="width: auto; height: auto; background-color: rgba(254,254,254,0.97); position: absolute; z-index: -99;">
    <div id="content_view_turma" style="width: auto;  margin: 0 auto; opacity: 0; padding: 20px;">
        <div class="row" style="width: 100%;">
            <div class="col-md-12">
                <h11><i style="cursor: pointer;" class="fa-solid fa-book efeito-zoom"></i> <a id="nm_preview_turma"> Visualizar<a></h11>

                <div style="float: right;">
                    <i style="cursor:pointer;" onclick="fecha_visualizar_turma(); limpar_cadastro_alunos();" class="fa-solid fa-xmark"></i>
                </div>

                <div class="div_br"> </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                Matricula:<br>
                <input id="matricula_cadastro" type="number" class="form-control" placeholder="Informe a matricula">
            </div>
            <div class="col-md-6">
                Nome do Aluno:<br>
                <input id="nome_aluno" type="text" class="form-control" placeholder="Informe o Nome" maxlength="80">
            </div>

            <div class="col-md-2">
                RG: <input type="checkbox" id="check_rg"> <i class="fa-solid fa-circle-info" style="color: #eec220;" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Para RGs com mais de 9 dígitos marcar!"></i> <br>
                <input id="nr_rg" type="text" class="form-control" placeholder="Informe o RG" maxlength="12">
            </div>

            <div class="col-md-2">
                Crachá:<br>
                <input id="nr_cracha" type="text" class="form-control" placeholder="Informe o Crachá" maxlength="12">
            </div>

            <div class="col-md-2">
                <br>
                <button onclick="cadastrar_aluno();" class="btn btn-primary"> <i class="fa-solid fa-plus"></i> Incluir</button>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="col-md-9">
                Tranferir Aluno:
                <i class="fa-solid fa-circle-info" style="color: #eec220;" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Transfere alunos para essa Turma! <br> Digite o nome, selecione o aluno que deseja transferir e clique em Transferir!"></i><br>
                <input type="text" id="input_transferir_aluno" list="list_transferir_aluno" class="form-control" placeholder="Digite o Nome" onkeyup="timer_pesquisa_aluno_transfer_func(document.getElementById('input_transferir_aluno').value);">
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

<div style="display: none; flex-direction:column" id="modal_sucesso" class="container-modal-success">
    <div style="width: 70vw; height: 20vh; background-color: white; border-radius: 2rem; text-align: center;flex-direction: column; display: flex; ">
        <div class="w-100 d-flex justify-content-end p-2">
            <button style="border: none; background-color: white; border-radius:1rem ; z-index:2000" onclick="closemodal()">
                <i style="font-size: 2rem;" class="fa-solid fa-circle-xmark"></i>
            </button>
        </div>
        <span id="mensagem" style="font-size: 1.1rem; font-weight: 600; margin-top:-3rem">
            cjfjkdkjvhdjkhvdh vjfhkvhdj
        </span>
        <i id="icone-feliz" style="font-size: 2rem; padding-top:1rem ; display:none" class="fa-solid fa-face-smile"></i>
        <i id="icone-triste" style="font-size: 2rem ; padding-top:1rem ; display:none" class="fa-solid fa-face-frown"></i>
    </div>
</div>

<div class="div_br"> </div>

<div id="constroi_tabela"></div>

<div id="constroi_modal"></div>

<?php include 'config/funcoes/modal_sucesso/modal_sucesso.php'; ?>

<?php include 'config/funcoes/edite_modal/index.php'; ?>


<script src="js/mask.js"></script>
<script>
    function closemodal() {
        document.getElementById('modal_sucesso').style.display = 'none'
    }

    var cd_turma_edit = '';

    $(document).ready(function() {
        carrega_tabela_turmas();
        $('[data-toggle="tooltip"]').tooltip();
    });

    function btn_semana_click(id_item) {
        let cor = $(id_item).css("background-color");
        if (cor == 'rgb(49, 133, 193)') {
            id_item.setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
        } else {
            id_item.setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        }
    }

    function carrega_tabela_turmas() {
        $('#constroi_tabela').load('config/funcoes/turmas/ajax_carrega_turmas.php');
    }

    function carrega_tabela_turmas_pesquisa(nm_pesquisa) {
        $('#constroi_tabela').load('config/funcoes/turmas/ajax_carrega_turmas_pesquisa.php', {
            nm_pesquisa: nm_pesquisa
        });
    }

    function carrega_tabela_alunos(cd_turma) {
        document.getElementById('matricula_cadastro').value = ""
        $('#constroi_tabela_alunos').load('config/funcoes/turmas/ajax_carrega_alunos.php', {
            cd_turma: cd_turma
        });
    }

    function carrega_editar_turma(cd_turma) {
        limpar_cadastro_turmas();
        document.getElementById('txt_titulo_modal').innerHTML = ' Editar';
        document.getElementById('txt_salvar_turma').className = 'fa-regular fa-floppy-disk';
        document.getElementById('btn_cadastrar_turma').innerHTML = '&nbsp; Salvar';
        $.ajax({
            url: 'config/funcoes/cadastro_turmas/ajax_select_editar_turma.php',
            type: 'POST',
            data: {
                cd_turma: cd_turma
            },
            success: function(array_dados) {
                const array = JSON.parse(array_dados);
                document.getElementById('nm_turma').value = array[1];
                document.getElementById('hr_inicio').value = array[2];
                document.getElementById('hr_fim').value = array[3];
            }
        });
        $.ajax({
            url: 'config/funcoes/cadastro_turmas/ajax_select_editar_turma_dias.php',
            type: 'POST',
            data: {
                cd_turma: cd_turma
            },
            success: function(array_dados) {
                const array = JSON.parse(array_dados);
                if (array[0] == 'S') {
                    document.getElementById('btn_dom').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
                if (array[1] == 'S') {
                    document.getElementById('btn_seg').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
                if (array[2] == 'S') {
                    document.getElementById('btn_ter').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
                if (array[3] == 'S') {
                    document.getElementById('btn_qua').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
                if (array[4] == 'S') {
                    document.getElementById('btn_qui').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
                if (array[5] == 'S') {
                    document.getElementById('btn_sex').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
                if (array[6] == 'S') {
                    document.getElementById('btn_sab').setAttribute('style', 'background-color: #cf1f1f !important; border-color: #cf1f1f !important; animation: none !important;');
                }
            }
        });
        cd_turma_edit = cd_turma;
    }

    function abre_modal(matricula, nome) {
        document.getElementById('modal').style.display = 'flex'
        console.log(matricula, nome)
        document.getElementById('tituloModal').innerHTML = `EDITANDO ${nome}`
        document.getElementById('matricula').value = matricula
        document.getElementById('nome').value = nome
        document.getElementById('cracha').value = ''
    }

    function fecha_modal() {
        document.getElementById('modal').style.display = 'none'
        document.getElementById('nova_matricula').value = ""
        document.getElementById('cracha').value = ""
        // document.getElementById('nova_cracha_sim').checked = false
        document.getElementById('nova_cracha_nao').checked = true
        // document.getElementById('nova_matricula_sim').checked = false
        document.getElementById('nova_matricula_nao').checked = true
        document.getElementById('container_nova_matricula').style.display = 'none'
        document.getElementById('nova_cracha').style.display = 'none'
    }

    // function valida


    function update_cracha() {
        let cd_turma = document.getElementById('nm_preview_turma').innerHTML;
        cd_turma = cd_turma.substring(0, (cd_turma.trim()).indexOf('-'));

        $.ajax({
            url: 'config/funcoes/update_aluno/ajax_update_aluno.php',
            type: 'POST',
            data: {
                matricula: document.getElementById('matricula').value,
                cracha: document.getElementById('cracha').value,
                nova_matricula: document.getElementById('nova_matricula').value,
                cd_turma: cd_turma

            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log(response.message);
                    document.getElementById('modal_sucesso').style.display = 'flex'
                    document.getElementById('mensagem').innerHTML = `${response.message}`
                    document.getElementById('icone-triste').style.display = 'none'
                    document.getElementById('icone-feliz').style.display = 'block'
                    console.log('sucesso')
                    carrega_tabela_alunos(cd_turma);
                } else {
                    console.log(response);
                    document.getElementById('modal_sucesso').style.display = 'flex'
                    document.getElementById('mensagem').innerHTML = `${response.message}`
                    document.getElementById('icone-feliz').style.display = 'none'
                    document.getElementById('icone-triste').style.display = 'block'
                    console.log('not_sucesso')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro na requisição: ' + textStatus + ' - ' + errorThrown);
                ajax_alert_ok('Erro na requisição: Contate o Suporte!');
            }
        });
    }
    // }

    function cadastrar_turma() {
        let nome_turma = document.getElementById('nm_turma').value;
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
        if (cor_dom != 'rgb(49, 133, 193)') {
            sn_dom = 'S'
        }
        if (cor_seg != 'rgb(49, 133, 193)') {
            sn_seg = 'S'
        }
        if (cor_ter != 'rgb(49, 133, 193)') {
            sn_ter = 'S'
        }
        if (cor_qua != 'rgb(49, 133, 193)') {
            sn_qua = 'S'
        }
        if (cor_qui != 'rgb(49, 133, 193)') {
            sn_qui = 'S'
        }
        if (cor_sex != 'rgb(49, 133, 193)') {
            sn_sex = 'S'
        }
        if (cor_sab != 'rgb(49, 133, 193)') {
            sn_sab = 'S'
        }

        if (nome_turma.trim() == '') {
            document.getElementById('nm_turma').focus();
        } else if (hora_inicio == '') {
            document.getElementById('hr_inicio').focus();
        } else if (hora_fim == '' || hora_fim <= hora_inicio) {
            document.getElementById('hr_fim').focus();
        } else if (document.getElementById('txt_titulo_modal').innerHTML == ' Cadastrar') {
            //Cadastrar Turma
            $.ajax({
                url: 'config/funcoes/cadastro_turmas/ajax_insert_turma.php',
                type: 'POST',
                data: {
                    nm_turma: nome_turma,
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
                success: function(dataResult) {
                    msg = dataResult;
                    if (dataResult == 'Sucesso') {
                        var_ds_msg = 'Turma%20Adicionado%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru_turma();
                        carrega_tabela_turmas();
                        limpar_cadastro_turmas();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                    } else {
                        console.log(dataResult);
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                    }
                }
            });
        } else {
            //Editar Turma
            $.ajax({
                url: 'config/funcoes/cadastro_turmas/ajax_update_turma.php',
                type: 'POST',
                data: {
                    cd_turma: cd_turma_edit,
                    nm_turma: nome_turma,
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
                success: function(dataResult) {
                    msg = dataResult;
                    if (dataResult == 'Sucesso') {
                        var_ds_msg = 'Turma%20Alterada%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        fecha_canguru_turma();
                        carrega_tabela_turmas();
                        limpar_cadastro_turmas();
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                    } else {
                        console.log(dataResult);
                        var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                        var_tp_msg = 'alert-danger';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                    }
                }
            });
        }
    }

    var tipo;

    function cadastrar_aluno() {
        let cd_turma = document.getElementById('nm_preview_turma').innerHTML;
        cd_turma = cd_turma.substring(0, (cd_turma.trim()).indexOf('-'));
        let matricula_cadastro = document.getElementById('matricula_cadastro').value
        let nm_aluno = document.getElementById('nome_aluno').value;
        let rg = document.getElementById('nr_rg').value;
        let cracha = document.getElementById('nr_cracha').value;


        if (nm_aluno.trim() == '') {
            document.getElementById('nome_aluno').focus();
        } else if (rg.trim == '' || (rg.length != 12 && !document.getElementById('check_rg').checked)) {
            document.getElementById('nr_rg').focus();
        } else if (cracha.trim() == '' || cracha.length != 12) {
            document.getElementById('nr_cracha').focus();
        } else if (matricula_cadastro == '') {
            document.getElementById('matricula_cadastro').focus()
        } else {
            rg = rg.replace(/[.-]/g, '');
            $.ajax({
                url: "config/funcoes/geral/ajax_verificar_disponibilidade_cracha.php",
                type: "POST",
                data: {
                    cracha_pesquisa: cracha
                },
                cache: false,
                success: function(dataResult) {
                    tipo = dataResult;
                    if (dataResult == 'F') {
                        ajax_alert_ok('Esse crachá já está vinculado a um Funcionário!');
                    } else if (dataResult == 'T') {
                        ajax_alert_ok('Esse crachá já está vinculado a um Terceiro!');
                    } else if (tipo == 'M') {
                        ajax_alert_ok('Esse crachá já está vinculado a um Médico!');
                    } else if (dataResult == 'A') {
                        ajax_alert('Esse crachá já está vinculado a um Aluno, deseja vincular ao usuário atual?', 'cadastrar_aluno_auxiliar()');
                    } else if (dataResult == 'PR') {
                        ajax_alert_ok('Esse crachá já está vinculado a um Prestador!');
                    } else {
                        cadastrar_aluno_auxiliar();
                    }
                }
            });
        }
    }

    function cadastrar_aluno_auxiliar() {
        let cd_turma = document.getElementById('nm_preview_turma').innerHTML;
        cd_turma = cd_turma.substring(0, (cd_turma.trim()).indexOf('-'));
        let nm_aluno = document.getElementById('nome_aluno').value;
        let rg = document.getElementById('nr_rg').value;
        rg = rg.replace(/[.-]/g, '');
        let cracha = document.getElementById('nr_cracha').value;
        let matricula_cadastro = document.getElementById('matricula_cadastro').value

        let controle = true;
        if (tipo == 'T' || tipo == 'A') {
            $.ajax({
                url: "config/funcoes/geral/ajax_disponibilizar_cracha.php",
                type: "POST",
                data: {
                    cracha: cracha,
                    tipo: tipo
                },
                cache: false,
                success: function(dataResult) {
                    if (dataResult != 'Sucesso') {
                        controle = false;
                        ajax_alert_ok('Erro: Contate o Suporte!');
                        console.log(dataResult);
                    } else {
                        controle = true;
                    }
                }
            });
        }

        if (controle == true) {
            $.ajax({
                url: 'config/funcoes/cadastro_turmas/ajax_insert_aluno.php',
                type: 'POST',
                data: {
                    cd_turma: cd_turma,
                    nm_aluno: nm_aluno,
                    rg: rg,
                    cracha: cracha,
                    matricula: matricula_cadastro
                },
                success: function(response) {
                    console.log(response.status)
                    document.getElementById('modal_sucesso').style.display = 'flex'
                    document.getElementById('mensagem').innerHTML = `${response.message}`
                    if (response.status == 'erro') {
                        document.getElementById('icone-feliz').style.display = 'none'
                        document.getElementById('icone-triste').style.display = 'block'
                        console.log('not_sucesso')
                    } else {
                        document.getElementById('icone-triste').style.display = 'none'
                        document.getElementById('icone-feliz').style.display = 'block'
                        console.log('sucesso')
                        carrega_tabela_alunos(cd_turma);
                        limpar_cadastro_alunos();
                    }
                }
            });
        }
        tipo = '';
    }

    function limpar_cadastro_turmas() {
        document.getElementById('nm_turma').value = '';
        document.getElementById('hr_inicio').value = '';
        document.getElementById('hr_fim').value = '';
        document.getElementById('btn_dom').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_seg').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_ter').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_qua').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_qui').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_sex').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        document.getElementById('btn_sab').setAttribute('style', 'background-color: #3185C1 !important; border-color: #3185C1 !important; animation: none !important;');
        if (document.getElementById('txt_titulo_modal').innerHTML == ' Editar') {
            document.getElementById('txt_titulo_modal').innerHTML = ' Cadastrar';
            document.getElementById('txt_salvar_turma').className = 'fa-solid fa-plus';
            document.getElementById('btn_cadastrar_turma').innerHTML = '&nbsp; Cadastrar';
        }
        cd_turma_edit = 'Nenhuma';
    }

    function limpar_cadastro_alunos() {
        document.getElementById('nome_aluno').value = '';
        document.getElementById('nr_rg').value = '';
        document.getElementById('nr_cracha').value = '';
        let temp_limpar = document.getElementById('input_transferir_aluno');
        temp_limpar.value = '';
    }

    function ajax_muda_status(turma, status) {
        $.ajax({
            url: 'config/funcoes/cadastro_turmas/ajax_update_status.php',
            type: 'POST',
            data: {
                cd_turma: turma,
                sn_ativo: status
            },
            cache: false,
            success: function(dataResult) {
                msg = dataResult;
                if (dataResult == 'Sucesso') {
                    var_ds_msg = 'Status%20Alterado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    carrega_tabela_turmas();
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                } else {
                    console.log(dataResult);
                    var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                    var_tp_msg = 'alert-danger';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                }
            }
        });
    }

    function ajax_muda_status_aluno(cd_turma, cd_aluno, sn_ativo) {
        $.ajax({
            url: 'config/funcoes/cadastro_turmas/ajax_update_status_aluno.php',
            type: 'POST',
            data: {
                cd_aluno: cd_aluno,
                cd_turma: cd_turma,
                sn_ativo: sn_ativo
            },
            success: function(dataResult) {
                if (dataResult == 'Sucesso') {
                    carrega_tabela_alunos(cd_turma);
                } else {
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
            }
        });
    }

    function ajax_delete_turma(cd_turma) {
        $.ajax({
            url: 'config/funcoes/cadastro_turmas/ajax_delete_turma.php',
            type: 'POST',
            data: {
                cd_turma: cd_turma
            },
            cache: false,
            success: function(dataResult) {
                if (dataResult == 'Sucesso') {
                    var_ds_msg = 'Turma%20Excluída%20com%20Sucesso!';
                    var_tp_msg = 'alert-success';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);
                } else {
                    console.log(dataResult);
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
                carrega_tabela_turmas();
            }
        })
    }

    function ajax_delete_aluno(cd_turma, cd_aluno) {
        $.ajax({
            url: 'config/funcoes/cadastro_turmas/ajax_delete_aluno.php',
            type: 'POST',
            data: {
                cd_aluno: cd_aluno,
                cd_turma: cd_turma
            },
            success: function(dataResult) {
                if (dataResult == 'Sucesso') {
                    carrega_tabela_alunos(cd_turma);
                } else {
                    console.log(dataResult)
                    ajax_alert_ok('Erro: Contate o Suporte!');
                }
            }
        });
    }

    function ajax_transfere_aluno() {
        let valor = $('#input_transferir_aluno').val();
        let cd_aluno = $('#list_transferir_aluno option').filter(function() {
            return this.value == valor;
        }).data('value');
        let cd_turma = document.getElementById('nm_preview_turma').innerHTML;
        cd_turma = cd_turma.substring(0, (cd_turma.trim()).indexOf('-'));
        if (valor.trim() == '' || typeof(cd_aluno) == "undefined" || cd_aluno == '') {
            document.getElementById('input_transferir_aluno').focus();
        } else {
            $.ajax({
                url: 'config/funcoes/cadastro_turmas/ajax_update_turma_aluno.php',
                type: 'POST',
                data: {
                    cd_aluno: cd_aluno,
                    cd_turma: cd_turma
                },
                success: function(dataResult) {
                    if (dataResult == 'Sucesso') {
                        carrega_tabela_alunos(cd_turma);
                        document.getElementById('input_transferir_aluno').value = '';
                    } else {
                        console.log(dataResult);
                        ajax_alert_ok('Erro: Contate o Suporte!');
                    }
                }
            });
        }
    }

    // Pesquisa de Alunos para Transferencia
    let timer_pesquisa_aluno_transfer;
    const tempo_timer = 1500;

    function timer_pesquisa_aluno_transfer_func(nm_aluno) {
        clearTimeout(timer_pesquisa_aluno_transfer);
        if (nm_aluno.length >= 3 && nm_aluno && nm_aluno != '') {
            let val = $('#input_transferir_aluno').val();
            let ds_opt = $('#list_transferir_aluno option').filter(function() {
                return this.value == val;
            }).data('option');
            if (!ds_opt) {
                timer_pesquisa_aluno_transfer = setTimeout(() => ajax_select_aluno_transfer(nm_aluno), tempo_timer);
            }
        }
    }

    function ajax_select_aluno_transfer(nm_pesquisa) {
        let cd_turma = document.getElementById('nm_preview_turma').innerHTML;
        cd_turma = cd_turma.substring(0, (cd_turma.trim()).indexOf('-'));
        let val = $('#input_transferir_aluno').val();
        $('#list_transferir_aluno').load('config/funcoes/turmas/ajax_carrega_lista_alunos_pesquisa.php', {
            nm_pesquisa: nm_pesquisa,
            cd_turma: cd_turma
        });
    }

    // Mask do Campo RG
    document.getElementById('nr_rg').addEventListener('input', function(e) {
        if (!document.getElementById('check_rg').checked) {
            mask_rg(e);
        }
    });
    document.getElementById('nome_aluno').addEventListener('input', function(e) {
        mask_nome(e)
    })
    // Mask do Campo Cracha
    document.getElementById('nr_cracha').addEventListener('input', function(e) {
        mask_int(e);
    });
    document.getElementById('nm_turma_pesquisa').addEventListener('keypress', function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            document.getElementById("btn_pesquisar").click();
        }
    });
    // Event Check RG
    document.getElementById('check_rg').addEventListener('input', function(e) {
        if (document.getElementById('check_rg').checked) {
            $('input#nr_rg').attr('maxLength', '13');
        } else {
            $('input#nr_rg').attr('maxLength', '12');
        }
    });

    // Resize da Modal
    function resize_modal() {
        var element = document.getElementById('control'),
            style = window.getComputedStyle(element),
            x = style.getPropertyValue('width');
        document.getElementById('view_turma').style.width = x;
    }
    window.addEventListener('resize', function(event) {
        resize_modal();
    }, true);
</script>

<?php
include 'rodape.php';
?>