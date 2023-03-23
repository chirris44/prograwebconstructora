<h1>
  <?php echo ($action == 'editTask') ? 'Modificar ' : 'Nueva ' ?> tarea del proyecto:
  <?php echo $data[0]['proyecto']; ?>
</h1>

<form method="POST" action="proyecto.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_proyecto']) ?>">
  <div class="mb-3">
    <label class="form-label">Nombre de la tarea</label>
    <input type="text" name="data[tarea]" class="form-control" placeholder="Tarea"
      value="<?php echo isset($data_tarea[0]['tarea']) ? $data_tarea[0]['tarea'] : ''; ?>" required minlength="3" maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">Nombre de la tarea</label>
    <input id="por_avance" type="range" name="data[avance]" class="form-control" placeholder="Avance"
      value="<?php echo isset($data_tarea[0]['avance']) ? $data_tarea[0]['avance'] : ''; ?>" required minlength="3" maxlength="50" />
    <p>Porcentaje de avance: <output id="value"><?php echo isset($data_tarea[0]['avance']) ? $data_tarea[0]['avance'] : ''; ?></output></p>
  </div>

  <div class="mb-3">
    <input type="hidden" name="data[id_proyecto]" value="<?php echo ($data[0]['id_proyecto']) ?>">
    <?php if ($action == 'editTask'): ?>
      <input type="hidden" name="data[id_tarea]"
        value="<?php echo isset($data_tarea[0]['id_tarea']) ? $data_tarea[0]['id_tarea'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>

<script>
  const value = document.querySelector("#value")
  const input = document.querySelector("#por_avance")
  value.textContent = input.value
  input.addEventListener("input", (event) => {
    value.textContent = event.target.value
  })
</script>