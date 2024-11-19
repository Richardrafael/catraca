<style>
  .container-modal-success {
    height: 100vh;
    width: 100%;
    background: rgba(0, 0, 0, .5);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 2000;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<?php
function render_modal($resultado = null, $message = null)
{

  echo '<div style="display: flex;" id="modal_sucesso" class="container-modal-success">
  <div style="width: 70vw; height: 20vh; background-color: white; border-radius: 2rem; text-align: center;flex-direction: column; display: flex; ">
    <span style="font-size: 1.2rem; font-weight: 600;">';
  echo $message;
  echo '</span>';
  if ($resultado == 'error') {
    echo '<i style="font-size: 2rem;" class="fa-solid fa-face-frown"></i>';
  } else {
    echo '<i style="font-size: 2rem;" class="fa-solid fa-face-grin"></i>';
  }

  echo '</div>
</div>';
}
?>