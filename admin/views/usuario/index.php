<h1 class="text-center">Usuarios
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="usuario.php?action=new&id=<?php echo $data[0]['id_usuario']; ?>"
                    role="button">Ingresar una nuevo usuario</a>
            </p>
        </div>
    </div>
    <div id="paypal-button-container">
                        <script>
                            paypal.Buttons({
                                // Order is created on the server and the order id is returned

                            }).render('#paypal-button-container');
                        </script>
                        </div>
    <table class="table table-responsive table-bordered">
        <thead>
        <tr>
                <th scope="col" class="col-md-3">Correo Electronico</th>
                <th scope="col" class="col-md-3"> Contrasena</th>
            </tr>
        </thead>
        <tbody>
            <?php $nReg = 0;
            foreach ($data as $key => $usuario):
                $nReg++; ?>
                <tr>
                    <td scope="row">
                        <?php echo $usuario["correo"] ?>
                    </td>
                    <td scope="row">
                        <?php echo $usuario["contrasena"] ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <script src="https://www.paypal.com/sdk/js?client-id=AUvZPFSl5AKkbZepv6kIDq9-mzVUNPlSalQu3rdp8IzEDhJKdnrco_pqEHLYIMTQFT-UkF8XJLbG67NM&currency=MXN"></script>
                        <!-- Set up a container element for the button -->
                        
                        <a href="usuario.php?action=edit&id=<?php echo $usuario["id_usuario"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="usuario.php?action=delete&id=<?php echo $usuario["id_usuario"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                <a href="usuario.php?action=newRole&id=<?php echo $usuario["id_usuario"] ?>"
                                        type="button" class="btn btn-success">Nuevo Rol</a>
                        </div>
                    </td>
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