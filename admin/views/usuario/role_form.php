<?php require_once("controllers/rol.php");?>
<h1>Nuevo Rol para el usuario</h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>">
    <div class="row">
        <div class="col-2">
            <label for="id_rol">Rol</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <select name="data[id_rol]" required="required">
                <?php
                $data_rol = $rol->getExcept($data[0]['id_usuario']);
                $selected = " ";
                foreach ($data_rol as $key => $roel):
                    if ($roel['id_rol'] == $data[0]['id_rol']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $roel['id_rol']; ?>" <?php echo $selected; ?>>
                        <?php echo $roel['rol']; ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-1">
        <?
        if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_usuario]"
                value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>" class="" />

        <? endif; ?>
    </div>
    
    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>
</form>