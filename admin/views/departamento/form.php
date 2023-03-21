<h1><?php echo ($action == 'edit')?'Modificar':'Nuevo' ;?> Departamento</h1>
<form method="POST" action="departamento.php?action=<?php echo $action; ?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nombre departamento</label>
        <input type="text" name="data[departamento]" class="form-control" placeholder="Departamento"
            value="<?php echo isset($data[0]['departamento']) ? $data[0]['departamento'] : ''; ?>" />
    </div>
    <div class="mb-3">
        <?
        if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_departamento]"
                value="<?php echo isset($data[0]['id_departamento']) ? $data[0]['id_departamento'] : ''; ?>" class="" />

        <? endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="" />

    </div>
</form>