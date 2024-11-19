<style>
  .container-modal {
    height: 100vh;
    width: 100%;
    background: rgba(0, 0, 0, .5);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>


<div style="display: none;" id="modal" class="container-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal"> </h5>
        <button type="button" class="close" onclick="fecha_modal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="width: auto;" id="carrega_conteudo_modal">
        <div id="container_all">
          <form id="formulario" method="POST">
            <div class="form-group  col-md-12">
              <label for="Nome">
                Nome :
              </label>
              <input class="form-control" type="text" disabled placeholder="nome" name="nome" id="nome" data-js="nome" value="">
              <input class="form-control" name="nome" type="hidden">
            </div>
            <div class="form-group  col-md-12">
              <label for="matricula">
                Matricula Atual :
              </label>
              <input class="form-control" type="text" disabled placeholder="matricula" name="matricula" id="matricula" data-js="matricula" value="">
              <input class="form-control" name="matricula" type="hidden">
            </div>
            <div class="form-group col-md-12">
              <label>Deseja editar a matricula ?</label><br>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nova_matricula_cardiacos" id="nova_matricula_nao" value="nao" onchange="mostrarMatriculaNova(this)">
                <label class="form-check-label" for="nova_matricula_nao">Não</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nova_matricula_cardiacos" id="nova_matricula_sim" value="sim" onchange="mostrarMatriculaNova(this)">
                <label class="form-check-label" for="nova_matricula_sim">Sim</label>
              </div>
            </div>
            <div class="form-group col-md-12">
              <label>Deseja editar a cracha ?</label><br>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nova_cracha_cardiacos" id="nova_cracha_nao" value="nao" onchange="mostrarcrachaNova(this)">
                <label class="form-check-label" for="nova_cracha_nao">Não</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nova_cracha_cardiacos" id="nova_cracha_sim" value="sim" onchange="mostrarcrachaNova(this)">
                <label class="form-check-label" for="nova_cracha_sim">Sim</label>
              </div>
            </div>

            <div style="display: none;" id="container_nova_matricula" class="form-group  col-md-12">
              <label for="nova_matricula">
                Nova matricula:
              </label>
              <input class="form-control" type="text" placeholder="Digite a nova matricula" name="nova_matricula" id="nova_matricula" data-js="nova_matricula" value="">
            </div>
            <div id="nova_cracha" style="display: none;" class="form-group  col-md-12">
              <label for="novo">
                Novo Cracha :
              </label>
              <input class="form-control" type="number" placeholder="Adicione um novo Cracha" name="cracha" id="cracha" data-js="cracha">
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button style="display: flex;" type="button" id="salvar_assinatura" onclick="update_cracha()" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" onclick="fecha_modal()">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function mostrarMatriculaNova(radioElement) {
    var campo_matricula = document.getElementById('container_nova_matricula')
    console.log(radioElement)
    if (radioElement.value === 'sim') {
      campo_matricula.style.display = 'block'
      document.getElementById('nova_matricula').value = ''
      console.log('aparece')
    } else {
      campo_matricula.style.display = 'none'
      document.getElementById('nova_matricula').value = ''
      console.log('não aparece')
    }
  }


  function mostrarcrachaNova(radioElement) {
    var campo_cracha = document.getElementById('nova_cracha')
    console.log(radioElement)
    if (radioElement.value === 'sim') {
      campo_cracha.style.display = 'block'
      document.getElementById('cracha').value = ''
      console.log('aparece')
    } else {
      campo_cracha.style.display = 'none'
      document.getElementById('cracha').value = ''
      console.log('não aparece')
    }
  }
</script>