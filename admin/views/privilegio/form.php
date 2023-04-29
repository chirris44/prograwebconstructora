<h1>
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Privilegio
</h1>

<form class="container-fluid" method="POST" action="privilegio.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-2">
            <label for="privilegio">Privilegio:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="privilegio" name="data[privilegio]"
                value="<?php echo isset($data[0]['privilegio']) ? $data[0]['privilegio'] : ''; ?>" minlength="3"
                maxlength="50">
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
        <input type="hidden" name="data[id_privilegio]"
            value="<?php echo isset($data[0]['id_privilegio']) ? $data[0]['id_privilegio'] : ''; ?>" class="" />
    <? endif; ?>
</form>