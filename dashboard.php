<?php
    include 'cabecalho.php';
    include 'acesso_restrito_dashboard.php';
?>

<div class="div_br"> </div>  

<h11><i style="cursor: pointer;" class="fa-solid fa-chart-line efeito-zoom" style="color: #ffffff;"></i> Dashboard</h11>

<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div> 

<div id="charts">
    <div>
        <h4>Visão Geral</h4>
    </div>

    <div class="div_br"></div>

    <div style="display: flex; margin-left: 5%; margin-right: 5%; justify-content: center; align-items: center;">
        <div style="width: 95%; flex: 1; text-align: center;">
            <h6>Acessos</h6>
            <canvas id="chart_acessos_catracas" style="max-height: 400px;"></canvas>
        </div>
    </div>

    <div class="div_br"></div><div class="div_br"></div><div class="div_br"></div>

    <div style="display: flex; margin-left: 5%; margin-right: 5%; justify-content: center; align-items: center;">
        <div style="width: 95%; flex: 1; text-align: center;">
            <h6>Acessos 24h</h6>
            <canvas id="chart_acessos_catracas_24h" style="max-height: 400px;"></canvas>
        </div>
    </div>

    <div class="div_br"></div><div class="div_br"></div><div class="div_br"></div>

    <div style="text-align: center;">
        <h5>Status: <h6 id="txt_status_catraca_timestamp"></h6></h5>
        <i id="btn_status_catraca" class="fa-solid fa-arrows-rotate" onclick="atualizar_grafico_acessos_catracas();"></i>
        <div class="div_br"></div>
    </div>
    <div style="width: 100%; text-align: center; display: flex; justify-content: center; align-items: center;">
        <div id="div_status_catracas" style="width: 100vw; height: auto; display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); grid-gap: 5px;"></div>
    </div>

    <div class="div_br"></div><div class="div_br"></div><div class="div_br"></div>

    <div style="display: flex; width: 100%;">
        <div style="width: 30%; flex: 1; text-align: center;">
            <h6>Funcionarios</h6>
            <canvas id="chart_funcionarios"></canvas>
        </div>

        <div style="width: 30%; flex: 1; text-align: center;">
            <h6>Catracas</h6>
            <canvas id="chart_catracas"></canvas>
        </div>

        <div style="width: 30%; flex: 1; text-align: center;">
            <h6>Cadastros</h6>
            <canvas id="chart_cadastros"></canvas>
        </div>
    </div>
</div>
<style>
    .items_status{
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: rgba(151,205,242, 0.3);
        border-radius: 5px;
        border: 1px solid rgba(151,205,242, 0.8);
        display: grid;
        grid-template-rows: ifr auto;
        height: auto;
    }
    
    .items_name{
        color: black;
        grid-row: 1;
    }

    .items_img{
        display: flex;
        justify-content: center;
        align-items: center;
        grid-row: 2;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chart_acessos_catracas = document.getElementById('chart_acessos_catracas');
    const chart_acessos_catracas_24h = document.getElementById('chart_acessos_catracas_24h');
    const chart_funcionarios = document.getElementById('chart_funcionarios');
    const chart_catracas = document.getElementById('chart_catracas');
    const chart_cadastros = document.getElementById('chart_cadastros');

    var ChartAcessoCatracas;
    let lastColorIndex = 0;
    const predefinedColors = [
        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
        '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf',
        '#8dd3c7', '#bebada', '#fb8072', '#80b1d3', '#fdb462',
        '#b3de69', '#fccde5', '#d9d9d9', '#bc80bd', '#ccebc5',
        '#ffed6f', '#b15928', '#6b6ecf', '#33a02c', '#a6cee3',
        '#1f78b4', '#b2df8a', '#33a02c', '#fb9a99', '#e31a1c'
    ];

    $(document).ready(function () {
        atualizar_grafico_acessos_catracas();
        atualizar_grafico_acessos_catracas_24h();
        updateStatus();
        atualizar_grafico_funcionarios();
        atualizar_grafico_catracas();
        atualizar_grafico_cadastros();
    });

    /* --- General Functions  --- */

    function unicodeToChar(text) {
        return text.replace(/\\u[\dA-F]{4}/gi, 
            function (match) {
                return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
            });
    }

    function ping() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: 'config/funcoes/dashboard/ajax_select_catracas_status.php',
                type: 'POST',
                cache: false,
                success: function(dataResult) {
                    const array = JSON.parse(dataResult);
                    resolve(dataResult);
                },
                error: function(error) {
                    reject(error);
                }
            });
        });
    }

    function getNextColor() {
        const color = predefinedColors[lastColorIndex];
        lastColorIndex = (lastColorIndex + 1) % predefinedColors.length;
        return color;
    }

    function addDataChartAcessosCatracas(label, data, backgroundColor) {
        ChartAcessoCatracas.data.datasets.push({
            label: label,
            data: data,
            borderWidth: 1,
            backgroundColor: backgroundColor,
            borderColor: backgroundColor
        });
        ChartAcessoCatracas.update();
    }

    function getAccessPoints(catracas) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: 'config/funcoes/dashboard/ajax_select_acessos_catraca.php',
                type: 'POST',
                data: {catracas: catracas},
                cache: false,
                success: function(dataResult) {
                    const array = JSON.parse(dataResult);
                    for (const item of array){
                        addDataChartAcessosCatracas(item[1], item[3], item[2]);
                    }
                    resolve();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    reject(errorThrown);
                }
            });
        });
    }

    /* --- Charts Creation --- */

    function create_chart_acessos_catracas(){
        $.ajax({
            url: 'config/funcoes/dashboard/ajax_select_horarios_dataset.php',
            type: 'POST', cache: false,
            success: function(dataResult){
                const array = JSON.parse(dataResult);
                ChartAcessoCatracas = new Chart(chart_acessos_catracas, {
                    type: 'line',
                    data: { labels: array },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                maxWidth: 450
                            }
                        }
                    }
                });
            }
        });
    }

    function create_chart_acessos_catracas_24h(labels, datasets){
        new Chart(chart_acessos_catracas_24h, {
            type: 'bar',
            data: { 
                labels: [''],
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        maxWidth: 450
                    }
                }
            }
        });
    }

    function create_chart_funcionarios(ativos, inativos){
        new Chart(chart_funcionarios, {
            type: 'bar',
            data: {
                labels: [''],
                datasets: [
                    {
                        label: 'Ativos',
                        data: [ativos],
                        borderWidth: 1
                    },
                    {
                        label: 'Inativos',
                        data: [inativos],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }

    function create_chart_catracas(ativas, inativas){
        new Chart(chart_catracas, {
            type: 'bar',
            data: {
                labels: [''],
                datasets: [
                    {
                        label: 'Ativas',
                        data: [ativas],
                        borderWidth: 1
                    },
                    {
                        label: 'Inativas',
                        data: [inativas],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }

    function create_chart_cadastros(terceiros, alunos, estagiarios, prestadores, funcionarios, medicos){
        new Chart(chart_cadastros, {
            type: 'bar',
            data: {
                labels: [''],
                datasets: [
                    {
                        label: 'Terceiros',
                        data: [terceiros],
                        borderWidth: 1
                    },
                    {
                        label: 'Alunos',
                        data: [alunos],
                        borderWidth: 1
                    },
                    {
                        label: 'Estagiários',
                        data: [estagiarios],
                        borderWidth: 1
                    },
                    {
                        label: 'Prestadores',
                        data: [prestadores],
                        borderWidth: 1
                    },
                    {
                        label: 'Funcionários',
                        data: [funcionarios],
                        borderWidth: 1
                    },
                    {
                        label: 'Médicos',
                        data: [medicos],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }

    /* --- Charts Update  --- */

    async function atualizar_grafico_acessos_catracas() {
        create_chart_acessos_catracas();
        try {
            const dataResult = await $.ajax({
                url: 'config/funcoes/dashboard/ajax_select_catracas_acessos.php',
                type: 'POST',
                cache: false
            });

            const catracas = JSON.parse(dataResult);
            var catracaData = [];
            for (const item of catracas) {
                const color = getNextColor();
                catracaData.push([item[0], item[1], color]);
            }
            await getAccessPoints(catracaData);
        }catch(error){
            console.log('Erro: ' + error);
        }
    }

    function atualizar_grafico_acessos_catracas_24h(){
        $.ajax({
            url: 'config/funcoes/dashboard/ajax_select_acessos_catraca_24h.php',
            type: 'POST', cache: false,
            success: function(dataResult){
                const catracaData = JSON.parse(dataResult);
                const labels = catracaData.map(item => item[0]);
                const datasets = catracaData.map((item, index) => ({
                    label: labels[index],
                    data: [item[1]],
                    borderWidth: 1,
                    backgroundColor: predefinedColors[index],
                    borderColor: predefinedColors[index],
                }));

                create_chart_acessos_catracas_24h(labels, datasets);
            }
        });
    }

    function updateStatus(){
        $("#btn_status_catraca").toggleClass("fa-spin");
        ping().then(function(res) {
            try{
                $("#div_status_catracas").empty();
                const dataArray = JSON.parse(res);
                dataArray.forEach((data) => {
                    let elements = "";
                    if(data[3] == 'ON'){
                        elements = '<div class="items_status"><p class="items_name">' + unicodeToChar(data[2]) + '</p>';
                        elements += '<div class="items_img"><span data-tooltip="  Catraca Ativa  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png" style="background-color: rgba(0, 0, 0, 0);"></span></div></div>';
                    }else if (data[3] == 'OFF'){
                        elements = '<div class="items_status"><p class="items_name">' + unicodeToChar(data[2]) + '</p>';
                        elements += '<div class="items_img""><span data-tooltip="  Catraca Inativa  "><img src="http://10.200.0.50:8080/imagens/dot_vermelho.png" style="background-color: rgba(0, 0, 0, 0);"></div></div>';
                    }else{
                        elements = '<div class="items_status"><p class="items_name">' + unicodeToChar(data[2]) + '</p>';
                        elements += '<div class="items_img""><span data-tooltip="  Erro!  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png" style="background-color: rgba(0, 0, 0, 0);"></div></div>'; 
                        console.log(data[3]);
                    }
                    $("#div_status_catracas").append(elements);
                });
                const timestamp = new Date().getTime();
                const date = new Date(timestamp);
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                const formattedDate = `${hours}:${minutes}:${seconds} ${day}/${month}/${year}`;
                $("#txt_status_catraca_timestamp").html(formattedDate);
                $("#btn_status_catraca").toggleClass("fa-spin");
            }catch(error) {
                console.error("Error parsing response:", error);
            }
        }).catch(function(error) {
            console.error(error);
        });
    }

    function atualizar_grafico_funcionarios(){
        $.ajax({
            url: 'config/funcoes/dashboard/ajax_select_funcionarios.php',
            type: 'POST', cache: false,
            success: function(dataResult){
                const array = JSON.parse(dataResult);
                create_chart_funcionarios(array[0], array[1]);
            }
        });
    }

    function atualizar_grafico_catracas(){
        $.ajax({
            url: 'config/funcoes/dashboard/ajax_select_catracas.php',
            type: 'POST', cache: false,
            success: function(dataResult){
                const array = JSON.parse(dataResult);
                create_chart_catracas(array[0], array[1]);
            }
        });
    }

    function atualizar_grafico_cadastros(){
        $.ajax({
            url: 'config/funcoes/dashboard/ajax_select_cadastros.php',
            type: 'POST', cache: false,
            success: function(dataResult){
                const array = JSON.parse(dataResult);
                create_chart_cadastros(array[0], array[1], array[2], array[3], array[4], array[5]);
            }
        });
    }
</script>

<?php
    include 'rodape.php';
?>