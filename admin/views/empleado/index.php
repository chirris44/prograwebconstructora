<h1 class="text-center">Empleado</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="empleado.php?action=new" role="button">Ingresar un empleado nuevo</a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-10">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-1">id</th>
                        <th scope="col" class="col-md-1">Nombre</th>
                        <th scope="col" class="col-md-1">Primer Apellido</th>
                        <th scope="col" class="col-md-1">Segundo Apellido</th>
                        <th scope="col" class="col-md-1">Fecha Nacimiento</th>
                        <th scope="col" class="col-md-1">RFC</th>
                        <th scope="col" class="col-md-1">CURP</th>
                        <th scope="col" class="col-md-1">Departamento</th>
                        <th scope="col" class="col-md-1">Foto</th>
                        <th scope="col" class="col-md-1">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $empleado):
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $empleado["id_empleado"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["nombre"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["primer_apellido"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["segundo_apellido"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["fecha_nacimiento"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["rfc"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["curp"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["departamento"] ?>
                            </td>
                            <td>
                                <img src="<?php echo $empleado["foto"] ?>" width="100px">
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="empleado.php?action=foto&id=<?php echo $empleado["id_empleado"] ?>"
                                        type="button" class="btn btn-dark">Foto</a>    
                                <a href="empleado.php?action=edit&id=<?php echo $empleado["id_empleado"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="empleado.php?action=delete&id=<?php echo $empleado["id_empleado"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <th>
                            Se encontraron
                            <?php echo $nReg ?> registros.
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>