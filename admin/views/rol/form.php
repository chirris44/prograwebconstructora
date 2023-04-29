<h1>
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Rol
</h1>

<form class="container-fluid" method="POST" action="rol.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-2">
            <label for="rol">Rol:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="rol" name="data[rol]"
                value="<?php echo isset($data[0]['rol']) ? $data[0]['rol'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>
    

    <?
    if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_rol]"
            value="<?php echo isset($data[0]['id_rol']) ? $data[0]['id_rol'] : ''; ?>" class="" />
    <? endif; ?>
    
</form>