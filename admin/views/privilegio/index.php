<h1 class="text-center">Privilegios</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="privilegio.php?action=new" role="button">Ingresar un privilegio nuevo</a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Privilegio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $privilegio):
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $privilegio["privilegio"] ?>
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="privilegio.php?action=edit&id=<?php echo $privilegio["id_privilegio"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="privilegio.php?action=delete&id=<?php echo $privilegio["id_privilegio"] ?>"
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