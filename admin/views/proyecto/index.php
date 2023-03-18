<h1>Proyectos</h1>
<a href="proyecto.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col-md-1">#</th>
      <th scope="col-md-2">Departamento</th>
      <th scope="col-md-2">Proyecto</th>
      <th scope="col-md-2">Descripción</th>
      <th scope="col-md-1">Fecha Inicio</th>
      <th scope="col-md-1">Fecha Fin</th>
      <th scope="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $proyecto) : ?>
      <tr>
        <th scope="row"><?php echo $proyecto['id_proyecto']; ?></th>
        <th scope="row"><?php echo $proyecto['departamento']; ?></th>
        <td><?php echo $proyecto['proyecto']; ?></td>
        <td><?php echo $proyecto['descripcion']; ?></td>
        <td><?php echo $proyecto['fecha_inicio']; ?></td>
        <td><?php echo $proyecto['fecha_fin']; ?></td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a type="button" class="btn btn-dark" href="proyecto.php?action=task&id=<?php echo $proyecto['id_proyecto']; ?>">Tareas</a>
            <a type="button" class="btn btn-primary" href="proyecto.php?action=edit&id=<?php echo $proyecto['id_proyecto']; ?>">Modificar</a>
            <a type="button" class="btn btn-danger" href="proyecto.php?action=delete&id=<?php echo $proyecto['id_proyecto']; ?>">Eliminar</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tr>
  <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Se encontraron <?php echo sizeof($data);?> registros.</th>
  </tr>
</table>