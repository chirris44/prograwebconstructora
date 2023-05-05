<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Caso exito
</h1>
<form method="POST" enctype="multipart/form-data" action="casos_exito.php?action=<?php echo $action; ?>">
  <div class="mb-3">
    <label class="form-label">Caso exito</label>
    <input type="text" name="data[caso_exito]" class="form-control" placeholder="caso_exito" value="<?php echo isset($data[0]['caso_exito']) ? $data[0]['caso_exito'] : ''; ?>" required minlength="3" maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea id="mytextarea" name="data[descripcion]" value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>">Hello, World!</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Resumen</label>
    <input type="text" name="data[resumen]" class="form-control" placeholder="resumen" value="<?php echo isset($data[0]['resumen']) ? $data[0]['resumen'] : ''; ?>" required minlength="3" maxlength="50" />
  </div>
  <div class="col-auto">
  <label for="fotografia" class="visually-hidden">Fotografía:</label>
    <input type="file" class="form-control" name="imagen"/>
  </div>
  <div class="col-auto">
  <div class="row">
    <div class="col-2">
      <select name="data[activo]">
        <option value="1">Si</option>
        <option value="0">No</option>
      </select>
    </div>
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit') : ?>
      <input type="hidden" name="data[id_caso_exito]" value="<?php echo isset($data[0]['id_caso_exito']) ? $data[0]['id_caso_exito'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>