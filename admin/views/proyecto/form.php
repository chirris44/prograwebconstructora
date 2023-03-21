<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Proyecto
</h1>
<form method="POST" action="proyecto.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre del Proyecto</label>
    <input type="text" name="data[proyecto]" class="form-control" placeholder="proyecto"
      value="<?php echo isset($data[0]['proyecto']) ? $data[0]['proyecto'] : ''; ?>" required minlength="3" maxlength="50" />
  </div>

  <div class="mb-3">
    <label class="form-label">Descripcion</label>
    <input type="text" name="data[descripcion]" class="form-control" placeholder="descripcion"
      value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>" required minlength="3" maxlength="50" />
  </div>

  <div class="mb-3">
    <label class="form-label">Departamento</label>
    <select name="data[id_departamento]" class="form-control" required>
      <?php 
      foreach($datadepartamentos as $key => $depto): 
        $selected = " ";
      if($depto['id_departamento']==$data[0]['id_departamento']):
        $selected =  " selected";
      endif;
      ?>
      <option value="<?php echo $depto['id_departamento'] ; ?>" <?php echo $selected;?>>
      <?php echo $depto['departamento']?>
    </option>
    <?php $selected=''; endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Fecha inicial</label>
    <input type="date" name="data[fecha_inicio]" class="form-control" placeholder="fecha_inicio"
      value="<?php echo isset($data[0]['fecha_inicio']) ? $data[0]['fecha_inicio'] : ''; ?>" required/>
  </div>

  <div class="mb-3">
    <label class="form-label">Fecha final</label>
    <input type="date" name="data[fecha_fin]" class="form-control" placeholder="fecha_fin"
      value="<?php echo isset($data[0]['fecha_fin']) ? $data[0]['fecha_fin'] : ''; ?>" required/>
  </div>


  <div class="mb-3">
    <label class="form-label">Archivo adjunto</label>
    <input type="file" name="archivo" class="form-control" />
  </div>
  
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_proyecto]"
        value="<?php echo isset($data[0]['id_proyecto']) ? $data[0]['id_proyecto'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>