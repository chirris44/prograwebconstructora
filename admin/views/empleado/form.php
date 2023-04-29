<h1><?php echo ($action == 'edit')?'Modificar':'Nuevo' ;?> Empleado</h1>
<form method="POST" action="empleado.php?action=<?php echo $action; ?>">
    <div class="mb-1">
        <label for="exampleFormControlInput1" class="form-label">Nombre empleado</label>
        <input type="text" name="data[nombre]" class="form-control" placeholder="nombre"
            value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" />
    </div>

    <div class="mb-1">
        <label for="exampleFormControlInput1" class="form-label">Primer apellido</label>
        <input type="text" name="data[primer_apellido]" class="form-control" placeholder="primer_apellido"
            value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>" />
    </div>

    <div class="mb-1">
        <label for="exampleFormControlInput1" class="form-label">Segundo apellido</label>
        <input type="text" name="data[segundo_apellido]" class="form-control" placeholder="segundo_apellido"
            value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>" />
    </div>

    <div class="mb-1">
        <label for="exampleFormControlInput1" class="form-label">Fecha nacimiento</label>
        <input type="date" name="data[fecha_nacimiento]" class="form-control" placeholder="fecha_nacimiento"
            value="<?php echo isset($data[0]['fecha_nacimiento']) ? $data[0]['fecha_nacimiento'] : ''; ?>" />
    </div>

    <div class="mb-1">
        <label for="exampleFormControlInput1" class="form-label">RFC</label>
        <input type="text" name="data[rfc]" class="form-control" placeholder="rfc"
            value="<?php echo isset($data[0]['rfc']) ? $data[0]['rfc'] : ''; ?>" />
    </div>

    <div class="mb-1">
        <label for="exampleFormControlInput1" class="form-label">CURP</label>
        <input type="text" name="data[curp]" class="form-control" placeholder="curp"
            value="<?php echo isset($data[0]['curp']) ? $data[0]['curp'] : ''; ?>" />
    </div>


    <div class="row">
        <div class="col-2">
            <label for="id_departamento">Departamento</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <select name="data[id_departamento]" required="required">
                <?php
                $selected = " ";
                foreach ($data_departamento as $key => $depto):
                    if ($depto['id_departamento'] == $data[0]['id_departamento']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $depto['id_departamento']; ?>" <?php echo $selected; ?>>
                        <?php echo $depto['departamento']; ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    

    <div class="mb-1">
        <?
        if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_empleado]"
                value="<?php echo isset($data[0]['id_empleado']) ? $data[0]['id_empleado'] : ''; ?>" class="" />

        <? endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="" />

    </div>
</form>