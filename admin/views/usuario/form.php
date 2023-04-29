<h1>
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Usuario
</h1>

<form class="container-fluid" method="POST" action="usuario.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-2">
            <label for="correo">Usuario:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="correo" name="data[correo]"
                value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>

    <?
    if ($action == 'new'): ?>
       <div class="row">
        <div class="col-2">
            <label for="contrasena">Contrasena:</label>
        </div>
    </div>
    <div class="row">

        <div class="col-2">
            <input required="required" type="password" class="" id="contrasena" name="data[contrasena]"
                value="<?php echo isset($data[0]['contrasena']) ? $data[0]['contrasena'] : ''; ?>">
        </div>
    </div>
    <? endif; ?>
    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>
    

    <?
    if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_usuario]"
            value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>" class="" />
    <? endif; ?>
    
</form>