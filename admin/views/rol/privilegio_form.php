<?php require_once("controllers/privilegio.php");?>
<h1>Nuevo privilegio de rol</h1>
<form method="POST" action="rol.php?action=<?php echo $action; ?>">
    <div class="row">
        <div class="col-2">
            <label for="id_privilegio">Privilegio</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <select name="data[id_privilegio]" required="required">
                <?php
                $data_privilegio = $privilegio->getExcept($data[0]['id_rol']);
                $selected = " ";
                foreach ($data_privilegio as $key => $privil):
                    if ($privil['id_privilegio'] == $data[0]['id_privilegio']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $privil['id_privilegio']; ?>" <?php echo $selected; ?>>
                        <?php echo $privil['privilegio']; ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-1">
        <?
        if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_rol]"
                value="<?php echo isset($data[0]['id_rol']) ? $data[0]['id_rol'] : ''; ?>" class="" />

        <? endif; ?>
    </div>
    
    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>
</form>