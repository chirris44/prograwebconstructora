<h1 class="text-center">Casos de Exito</h1>
<a href="casos_exito.php?action=new" class="btn btn-success">Nuevo</a>
<a href="casos_exito.php?action=user" type="button" class="btn btn-danger">Casos</a>
<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Casos exito</th>
            <th scope="col">Descripción</th>
            <th scope="col">Resumen</th>
            <th scope="col">Activo</th>
        </tr>
    </thead>
    <tbody>
        <?php $nReg = 0;
        foreach ($data as $key => $casos_exito) :
            $nReg++;
            if (!file_exists($casos_exito['imagen'])) :
                $casos_exito['imagen'] = "images/invitado.jpg";
            endif;
            if($casos_exito['activo']==0){
                    $casos_exito['activo'] ='No';
                }else{
                    $casos_exito['activo'] ='Si';
                }
            ?>

            <tr>
                <th scope="row">
                    <?php echo $casos_exito["id_caso_exito"] ?>
                </th>
                <td>
                    <img src="<?php echo $casos_exito['imagen']; ?>" height="64px" width="64px" class="rounded-circle" alt="Cinque Terre">
                </td>
                <th scope="row">
                    <?php echo $casos_exito["caso_exito"] ?>
                </th>
                <th scope="row">
                    <?php echo $casos_exito["descripcion"] ?>
                </th>
                <th scope="row">
                    <?php echo $casos_exito["resumen"] ?>
                </th>
                <th scope="row">
                    <?php echo $casos_exito["activo"] ?>
                </th>
                <th>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="casos_exito.php?action=edit&id=<?php echo $casos_exito["id_caso_exito"] ?>" type="button" class="btn btn-primary">Modificar</a>
                        <a href="casos_exito.php?action=delete&id=<?php echo $casos_exito["id_caso_exito"] ?>" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                </th>
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
<?php
