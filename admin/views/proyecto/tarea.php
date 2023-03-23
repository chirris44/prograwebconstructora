<h1>Tareas del proyecto:
  <?php echo $data[0]['proyecto']; ?>
</h1>
<a href="proyecto.php?action=newTask&&id=<?php echo $data[0]['id_proyecto']; ?>" class="btn btn-success">Nueva Tarea</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-2">#</th>
      <th scope="col" class="col-md-2">Tarea</th>
      <th scope="col" class="col-md-6">% Avance</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data_tarea as $key => $tarea):
      ?>
      <tr>
        <td scope="row">
          <?php echo $tarea['id_tarea']; ?>
        </td>
        <td>
          <?php echo $tarea['tarea']; ?>
        </td>
        <td>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: <?php echo $tarea['avance']; ?>%;" aria-valuenow="25" aria-valuemin="0"
              aria-valuemax="100"><?php echo $tarea['avance']; ?>%</div>
          </div>
        </td>

        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
          <a class="btn btn-primary"
              href="proyecto.php?action=editTask&id=<?php echo $data[0]['id_proyecto'] ?>&id_tarea=<?php echo $tarea['id_tarea']; ?>">Editar</a>
            <a class="btn btn-danger"
              href="proyecto.php?action=deleteTask&id=<?php echo $data[0]['id_proyecto'] ?>&id_tarea=<?php echo $tarea['id_tarea']; ?>">Eliminar</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tr>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Se encontraron
      <?php echo sizeof($data_tarea); ?> registros.
    </th>
  </tr>
</table>