<h1 class="text-center">Empleado
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
        <p><a class="btn btn-success" href="empleado.php?action=new" role="button">Ingresar un nuevo empleado</a>
            </p>
        </div>
    </div>
    <table class="table table-responsive table-bordered">
        <thead>
        <tr>
                <th scope="col" class="col-md-3">Nombre</th>
                <th scope="col" class="col-md-3"> Primer Apellido</th>
                <th scope="col" class="col-md-3"> Segundo Apellido</th>
                <th scope="col" class="col-md-3"> Fecha Nacimiento</th>
                <th scope="col" class="col-md-3"> RFC</th>
                <th scope="col" class="col-md-3"> CURP</th>
                <th scope="col" class="col-md-3">Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php $nReg = 0;
            foreach ($data as $key => $empleado):
                $nReg++; ?>
                <tr>
                    <td scope="row">
                        <?php echo $empleado["nombre"] ?>
                    </td>
                    <td scope="row">
                        <?php echo $empleado["primer_apellido"] ?>
                    </td>
                    <td scope="row">
                        <?php echo $empleado["segundo_apellido"] ?>
                    </td>
                    <td scope="row">
                        <?php echo $empleado["fecha_nacimiento"] ?>
                    </td>
                    <td scope="row">
                        <?php echo $empleado["rfc"] ?>
                    </td>
                    <td scope="row">
                        <?php echo $empleado["curp"] ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="empleado.php?action=edit&id=<?php echo $empleado["id_empleado"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="empleado.php?action=delete&id=<?php echo $empleado["id_empleado"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th>
                    Se encontraron
                    <?php echo $nReg ?> registros.
                </th>
            </tr>
        </tbody>
    </table>