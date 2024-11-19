<style>
    /*Abrir Cadastro Terceiros*/
    .anima_cadastro{
        border: solid 1px rgba(218, 218, 218,0.8);
        border-radius: 5px;
        animation-name: abre_cadastro; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes abre_cadastro {
        0%   {margin-left: 0px; opacity: 0; z-index: 99;}
        100% {margin-left: 20px; opacity: 100; z-index: 99;}
    }

    .anima_cadastro_input{
        animation-name: anima_cadastro_input; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes anima_cadastro_input {
        0%   {opacity: 0;}
        100% {opacity: 100;}
    }

    /*Fechar Cadastro Terceiros*/
    .anima_cadastro_fecha{
        border:none;
        animation-name: abre_cadastro_fecha; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes abre_cadastro_fecha {
        0% {width: auto; height: auto; margin-left: 20px; z-index: 99;}
        100% {width: 0px; height: 0px; margin-left: 0px; z-index: -99;}
    }

    .anima_cadastro_input_fecha{
        animation-name: anima_cadastro_input_fecha; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes anima_cadastro_input_fecha {
        0%   {opacity: 100;}
        100% {opacity: 0;}
    }


    
    /* Abrir Visualizar Turma */
    .anima_turma{
        border: solid 1px rgba(218, 218, 218,0.8);
        border-radius: 5px;
        animation-name: anima_turma; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes anima_turma {
        0%   {top: 0px; opacity: 0; z-index: 99;}
        100% {top: 10vh; opacity: 100; z-index: 99;}
    }

    .anima_visualizar_turma{
        animation-name: anima_visualizar_turma; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes anima_visualizar_turma {
        0%   {opacity: 0;}
        100% {opacity: 100;}
    }

    /* Fechar Visualizar Turma */
    .anima_turma_fecha{
        border:none;
        animation-name: anima_turma_fecha; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes anima_turma_fecha {
        0% {top: 10vh; z-index: 99;}
        100% {top: 0px; z-index: -99;}
    }

    .anima_visualizar_turma_fecha{
        animation-name: anima_visualizar_turma_fecha; 
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
    }
    @keyframes anima_visualizar_turma_fecha {
        0%   {opacity: 100;}
        100% {opacity: 0;}
    }
</style>

<script>
    // Cadastrar Terceiros
    function abre_canguru() {
        document.getElementById('conteudo_cad_terceiro').className = 'anima_cadastro_input';
        document.getElementById('cad_terceiro').className = 'anima_cadastro';
    }
    function fecha_canguru() {       
        document.getElementById('conteudo_cad_terceiro').className = 'anima_cadastro_input_fecha';
        document.getElementById('cad_terceiro').className = 'anima_cadastro_fecha'; 
    }



    // Cadastro de Catracas
    function abre_cangurus() {
        document.getElementById('conteudo_cad_catraca').className = 'anima_cadastro_input';
        document.getElementById('cad_catraca').className = 'anima_cadastro';  
    }
    function fecha_cangurus() {       
        document.getElementById('conteudo_cad_catraca').className = 'anima_cadastro_input_fecha';
        document.getElementById('cad_catraca').className = 'anima_cadastro_fecha'; 
    }

    //Editar Catracas
    function abre_canguru_edit_catraca() {
        document.getElementById('conteudo_editar_catraca').className = 'anima_cadastro_input';
        document.getElementById('editar_catraca').className = 'anima_cadastro';  
    }
    function fecha_canguru_edit_catraca() {       
        document.getElementById('conteudo_editar_catraca').className = 'anima_cadastro_input_fecha';
        document.getElementById('editar_catraca').className = 'anima_cadastro_fecha';  
    }


    
    // Cadastro de Funcionarios
    function abre_cangurus() {
        document.getElementById('conteudo_cad_catraca').className = 'anima_cadastro_input';
        document.getElementById('cad_catraca').className = 'anima_cadastro';   
        
    }
    function fecha_cangurus() {       
        document.getElementById('conteudo_cad_catraca').className = 'anima_cadastro_input_fecha';
        document.getElementById('cad_catraca').className = 'anima_cadastro_fecha'; 
    }



    // Cadastro de Turmas
    function abre_canguru_turma() {
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
        });
        document.getElementById('conteudo_cad_turma').className = 'anima_visualizar_turma';
        document.getElementById('cad_turma').className = 'anima_cadastro'; 
    }
    function fecha_canguru_turma() {       
        document.getElementById('conteudo_cad_turma').className = 'anima_cadastro_input_fecha';
        document.getElementById('cad_turma').className = 'anima_cadastro_fecha';    
    }

    //Visualizar Turma
    function abre_visualizar_turma(cd_turma, nm_turma){
        resize_modal();
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
        });
        document.getElementById('content_view_turma').className = 'anima_visualizar_turma';
        document.getElementById('view_turma').className = 'anima_turma'; 
        document.getElementById('nm_preview_turma').innerHTML = cd_turma + ' - ' + nm_turma;
    }
    function fecha_visualizar_turma(){
        document.getElementById('content_view_turma').className = 'anima_cadastro_input_fecha';
        document.getElementById('view_turma').className = 'anima_turma_fecha'; 
    }



    //Visualizar Estágio
    function abre_visualizar_estagio(cd_estagio, nm_estagio){
        resize_modal();
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
        });
        document.getElementById('content_view_estagio').className = 'anima_visualizar_turma';
        document.getElementById('view_estagio').className = 'anima_turma'; 
        document.getElementById('nm_preview_estagio').innerHTML = cd_estagio + ' - ' + nm_estagio;
    }
    function fecha_visualizar_estagio(){
        document.getElementById('content_view_estagio').className = 'anima_cadastro_input_fecha';
        document.getElementById('view_estagio').className = 'anima_turma_fecha'; 
    }



    //Visualizar Crachas
    function abre_visualizar_cracha(nome){
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
        });
        document.getElementById('conteudo_edit_cracha').className = 'anima_cadastro_input';
        document.getElementById('edit_cracha').className = 'anima_cadastro'; 
        //document.getElementById('nm_preview_estagio').innerHTML = nome;
    }
    function fecha_visualizar_cracha(){
        document.getElementById('conteudo_edit_cracha').className = 'anima_cadastro_input_fecha';
        document.getElementById('edit_cracha').className = 'anima_cadastro_fecha'; 
    }
</script>