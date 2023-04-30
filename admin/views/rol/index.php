<h1 class="text-center">Usuarios
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="rol.php?action=new&id=<?php echo $data[0]['id_rol']; ?>"
                    role="button">Ingresar una nuevo rol</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="privilegio.php"
                    role="button">Privilegios</a>
            </p>
        </div>
    </div>
    <table class="table table-responsive table-bordered">
        <thead>
        <tr>
                <th scope="col" class="col-md-3">Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php $nReg = 0;
            foreach ($data as $key => $rol):
                $nReg++; ?>
                <tr>
                    <td scope="row">
                        <?php echo $rol["rol"] ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="rol.php?action=edit&id=<?php echo $rol["id_rol"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                        <a href="rol.php?action=newPrivilegio&id=<?php echo $rol["id_rol"] ?>"
                                        type="button" class="btn btn-success">Nuevo Privilegio</a>
                                    <a href="rol.php?action=delete&id=<?php echo $rol["id_rol"] ?>"
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