<h1>
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Empleado
</h1>

<form class="container-fluid" method="POST" action="empleado.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-2">
            <label for="nombre">Nombre:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="nombre" name="data[nombre]"
                value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>

    <div class="row">
        <div class="col-2">
            <label for="primer_apellido">Primer Apellido:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="primer_apellido" name="data[primer_apellido]"
                value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="segundo_apellido">Segundo Apellido:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="segundo_apellido" name="data[segundo_apellido]"
                value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="fecha_nacimiento">Fecha Nacimiento:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="date" class="" id="fecha_nacimiento" name="data[fecha_nacimiento]"
                value="<?php echo isset($data[0]['fecha_nacimiento']) ? $data[0]['fecha_nacimiento'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="rfc">RFC:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="rfc" name="data[rfc]"
                value="<?php echo isset($data[0]['rfc']) ? $data[0]['rfc'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="curp">Curp:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="curp" name="data[curp]"
                value="<?php echo isset($data[0]['curp']) ? $data[0]['curp'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>

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