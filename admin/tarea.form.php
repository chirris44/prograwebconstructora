<div class="container">
    <h1>Tareas del proyecto: 
        <?php echo $data[0]['proyecto'] ?>
    </h1>
    <a href="proyecto.php?action=new" class="btn btn-success">Nuevo</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id_Proyecto</th>
                <th scope="col">Avance</th>
                <th>Tarea</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $tarea) : ?>
                <tr>
                    <th scope="row">
                        <?php echo $tarea['id_proyecto']; ?>
                    </th>
                    <td>
                        <?php echo $tarea['avance']; ?>
                    </td>
                    <td>
                        <?php echo $tarea['tarea']; ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Menu Renglon">
                            <a class="btn btn-primary" href="departamento.php?action=edit&id=<?php echo $departamento['id_departamento'] ?>">Ingresar tarea</a>
                            <a class="btn btn-danger" href="departamento.php?action=delete&id=<?php echo $departamento['id_departamento'] ?>">Eliminar tarea</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>