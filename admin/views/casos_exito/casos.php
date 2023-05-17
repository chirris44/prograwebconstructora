<div class="container p-4">
    <div class="col-">
        <?php
        foreach ($data as $key => $casos_exito) :
            if (!file_exists($casos_exito['imagen'])) :
                $casos_exito['imagen'] = "images/invitado.jpg";
            endif;
            if ($casos_exito['activo'] == 0) {
                $casos_exito['activo'] = 'Inactivo';
            } else {
                $casos_exito['activo'] = 'Activo';
            }
        ?>
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?php echo $casos_exito['imagen']; ?>" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title><?php echo $casos_exito["caso_exito"] ?></title>
                <div class="card-body">
                    <p class="card-text"><?php echo $casos_exito["descripcion"] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-body-secondary"><?php echo $casos_exito["activo"] ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.43.96/programacionwebconstructora/ws/caso.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=5nm37v7m1e8p7vdp9r1m9pl0ao'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response=json_decode($response);
//print_r($response);
foreach ($response as $key=>$caso):
    if ($caso->activo == 0) {
        $caso->activo = 'Inactivo';
    } else {
        $caso->activo = 'Activo';
    }
?>
    <div class="card shadow-sm">
        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?php echo $caso->imagen; ?>" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
        <title><?php echo $caso->caso_exito; ?></title>
        <div class="card-body">
            <p class="card-text"><?php echo $caso->descripcion; ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-body-secondary"><?php echo $caso->activo; ?></small>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
</div>