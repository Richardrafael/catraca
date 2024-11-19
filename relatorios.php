<?php
    include 'cabecalho.php';
    include 'acesso_restrito_relatorio.php';
?>

<div class="div_br"> </div>  

<h11><i style="cursor: pointer;" class="fa-solid fa-chart-pie efeito-zoom" style="color: #ffffff;"></i> Relatórios</h11>

<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div> 

<div class="painel">
    <div class="row-custom">
        <div class="col-custom">
            <span>Relatório:</span>
            <select class="form-control input group" id="tp_relatorio">
                <option value='0'>Selecione</option>
                <option value='1'>Acesso Diário</option>
                <option value='2'>Tabela Prestadores</option>
            </select>
        </div>
    </div>
    
    <br/>

    <div class="row-custom" id="controls">
        <div class="col-custom" id="col_nm_pesquisa">
            <span>Nome:</span>
            <div class="input-group">
                <input class="form-control input-group" type="text" id="nm_pesquisa" placeholder="Nome para Pesquisa">
            </div>
        </div>

        <div class="col-custom" id="col_cd_cracha">
            <span>Crachá:</span>
            <div class="input-group">
                <input class="form-control input-group" type="text" id="cd_cracha" placeholder="Código do Crachá" maxlength="12">
            </div>
        </div>

        <div class="col-custom" id="col_tp_pesquisa">
            <span>Tipo:</span>
            <div class="container-custom-combobox">
                <div>
                    <input type="text" class="combo-search form-control" id="combo_search_type" placeholder="Digite para pesquisar">
                    <div class="datalist-custom-combobox" id="type_list">
                        <div class="option" data-value="A">Acompanhantes</div>
                        <div class="option" data-value="AL">Alunos</div>
                        <div class="option" data-value="F">Funcionários</div>
                        <div class="option" data-value="M">Médicos</div>
                        <div class="option" data-value="P">Pacientes</div>
                        <div class="option" data-value="PR">Prestadores</div>
                        <div class="option" data-value="T">Terceiros</div>
                        <div class="option" data-value="V">Visitantes</div>
                        <div class="option" data-value="VE">Visitantes Externos</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-custom" id="col_cd_catraca">
            <span>Catraca:</span>
            <div class="container-custom-combobox">
                <div>
                    <input type="text" class="combo-search form-control" id="combo_search_catraca" placeholder="Digite para pesquisar">
                    <div class="datalist-custom-combobox" id="catraca_list">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-custom" id="col_dt_inicio">
            <span>Data Inicio:</span>
            <input class="form-control" type="datetime-local" id="dt_inicio"></input>
        </div>

        <div class="col-custom" id="col_dt_fim">
            <span>Data Fim:</span>
            <input class="form-control" type="datetime-local" id="dt_fim"></input>
        </div>

        <div class="col-custom">
            <br/>
            <button onclick="pesquisa();" class="btn btn-primary" id="btn_gerar"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>

    <div class="div_br"></div>

    <div id="div_table"></div>
</div>
 
<div class="row" id="tabela">
    <div class="col-md-12">
        <table class="table table-striped table-inverse" id="example" style="text-align: center;">
            <thead class="thead-inverse">
                <tr> 
                    <th style="text-align: center;">Cracha</th>
                    <th style="text-align: center;">Nome</th>
                    <th style="text-align: center;">Tipo Cracha</th>
                    <th style="text-align: center;">Data de Inicio</th>
                    <th style="text-align: center;">Data Final</th>
                    <th style="text-align: center;">Dias Restantes</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>


<style>
    .container-custom-combobox{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: relative;
    }
    .combo-search{
        width: 100%;
    }
    .datalist-custom-combobox{
        display: none;
        max-height: 200px;
        overflow-y: scroll;
        position: absolute;
        z-index: 10;
        width: 100%;
        top: 100%;
        left: 0;
        background-color: white;
    }
    .row-custom{
        display: flex;
    }
    .col-custom{
        margin-right: 10px;
        margin-left: 0px;
    }
    .col-custom span{
        padding-left: 5px;
    }
    .option{
        border-style: solid;
        border-width: 1px;
        text-align: center;
    }

    #tabela{
        display: none;
    }
</style>
 
<script>
    $(document).ready(function () {
        $('#catraca_list').load('config/funcoes/relatórios/ajax_get_catracas.php', function () {
            loadScript('js/custom-combobox-type.js');
            loadScript('js/custom-combobox-catraca.js');
            let controls = $('#controls');
            controls.hide();
        });

        
    });

    function loadScript(scriptSrc, callback) {
        var script = document.createElement('script');
        script.src = scriptSrc;
        script.onload = callback;
        document.head.appendChild(script);
    }

    function convertDateFormat(inputDate) {
        const parts = inputDate.split("-");
        if (parts.length !== 3) {
            throw new Error("Invalid date format. Please use yyyy-mm-dd.");
        }
        const year = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const day = parseInt(parts[2], 10);
        const date = new Date(year, month, day);
        const formattedDate = `${String(date.getDate()).padStart(2, "0")}/${String(
            date.getMonth() + 1
        ).padStart(2, "0")}/${date.getFullYear()}`;

        return formattedDate;
    }

    function pesquisa(){
        let items_cracha = '';
        selectedTypes.forEach(item => {
            items_cracha += "'" + item + "',"
        });
        items_cracha = items_cracha.replace(/,([^,]*)$/, '$1');

        let items_catraca = '';
        selectedCatracas.forEach(item => {
            items_catraca += "" + item + ","
        });
        items_catraca = items_catraca.replace(/,([^,]*)$/, '$1');

        let nm_pesquisa = document.getElementById('nm_pesquisa');
        let cd_cracha = document.getElementById('cd_cracha');
        let dt_inicio = document.getElementById('dt_inicio');
        let dt_fim = document.getElementById('dt_fim');

        if (selectedTypes.length < 1) {
            document.getElementById('combo_search_type').focus();
        }else if (selectedCatracas.length < 1) {
            document.getElementById('combo_search_catraca').focus();
        }else if (!dt_inicio.value || ((dt_inicio.value > dt_fim.value) && dt_fim.value)) {
            dt_inicio.focus();
        }else if (!dt_fim.value) {
            dt_fim.focus();
        }else{
            let dt_inicio_con = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' }).format(new Date(dt_inicio.value));
            let dt_fim_con = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' }).format(new Date(dt_fim.value));
            let nm_pesquisa_con = '';
            let cd_cracha_con = '';
            if(nm_pesquisa.value.length > 0){
                nm_pesquisa_con = nm_pesquisa.value;
            }
            if(cd_cracha.value.length > 0){
                cd_cracha_con = cd_cracha.value;
            }
            $('#div_table').load('config/funcoes/relatórios/acesso_diario.php',{
                nm_pesquisa: nm_pesquisa.value,
                cd_cracha: cd_cracha.value,
                tp_cracha: items_cracha,
                cd_catraca: items_catraca,
                dt_inicio: dt_inicio_con,
                dt_fim: dt_fim_con
            });
        }
    } 

    $('#tp_relatorio').on('change', function () {
        let tipo_relatorio = $(this).val();
        let controls = $('#controls');
        let nome = $('#col_nm_pesquisa');
        let cracha = $('#col_cd_cracha');
        let tipo = $('#col_tp_pesquisa');
        let catraca = $('#col_cd_catraca');
        let dt_inicio = $('#col_dt_inicio');
        let dt_fim = $('#col_dt_fim');

        switch (tipo_relatorio){
            case "0":
                $("#tabela").hide()
                controls.hide();
                console.log(tipo_relatorio)
                break;
            case "1":
                $("#tabela").hide()
                controls.show();
                nome.show();
                cracha.show();
                tipo.show();
                catraca.show();
                dt_inicio.show();
                dt_fim.show();
                console.log(tipo_relatorio)
                break;
            case "2":
                controls.hide();
                $("#tabela").show()
                if ($.fn.DataTable.isDataTable('#example')) {
                    // Se existir, destrói o DataTable atual
                    $('#example').DataTable().clear().destroy();
                }
                const table = $('#example').DataTable({
                                dom: 'Bfrtip', 
                                scrollCollapse: true,
                                "pageLength": 10,
                                "buttons": [{
                                    extend: 'excel',
                                    text: '<i class="fas fa-file-excel"></i>',
                                }],
                                language: {
                                    "lengthMenu": "Mostrar _MENU_ registros por p\u00E1gina",
                                    "zeroRecords": "Nenhum registro encontrado",
                                    "info": "Mostrando p\u00E1gina _PAGE_ de _PAGES_",
                                    "infoEmpty": "Nenhum registro disponí­vel",
                                    "infoFiltered": "(filtrado de _MAX_ registros no total)",
                                    "search": "Pesquisar:",
                                    "paginate": {
                                        "first": "Primeira",
                                        "last": "Ultima",
                                        "next": "<i class='fa-solid fa-angles-right'></i>",
                                        "previous": "<i class='fa-solid fa-angles-left'></i>"
                                    }
                                },
                                "ajax": {
                                    "url": 'config/funcoes/relatórios/ajax_vencimento.php',
                                    "type": "GET", 
                                    "dataSrc": "data"  
                                },
                                "columns": [
                                    { "data": "CRACHA" },
                                    { "data": "NM_PRESTADOR" },
                                    { "data": "TIPO" },
                                    { "data": "DT_INICIO" },
                                    { "data": "DT_FIM" },
                                    { "data": "DIAS" },
                                ],
                                order: [[5, 'asc']]
                            }) 
                break;
            default:
                $("#tabela").hide()
                controls.hide();
                break;
        }
 
    });
</script>

<?php
    include 'rodape.php';
?>