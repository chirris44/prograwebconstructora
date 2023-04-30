<?php
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
?>

<body>

    <div class="container">

        <h1 class="text-center">Tomar Foto Empleado</h1>

        <form method="POST" action="empleado.php?action=guardarFoto&id=<?php echo $id ?>">

            <div class="row">

                <div class="col-md-6">

                    <div id="my_camera"></div>

                    <br />

                    <input type=button value="Take Snapshot" onClick="take_snapshot()">

                    <input type="hidden" name="image" class="image-tag">

                </div>

                <div class="col-md-6">

                    <div id="results">Tu foto aparecera aqui...</div>

                </div>

                <div class="col-md-12 text-center">

                    <br />

                    <input type="submit" value="Subir al sistema" name="save" class="btn btn-success"></button>

                </div>

            </div>

        </form>

    </div>



    <!-- Configure a few settings and attach camera -->

    <script language="JavaScript">

        Webcam.set({
            // live preview size
            width: 640,
            height: 480,

            // device capture size
            dest_width: 640,
            dest_height: 480,

            // final cropped size
            width: 640,
            height: 480,

            // format and quality
            image_format: 'jpeg',
            jpeg_quality: 90,

            // flip horizontal (mirror mode)
            flip_horiz: true,
        });



        Webcam.attach('#my_camera');



        function take_snapshot() {

            Webcam.snap(function (data_uri) {

                $(".image-tag").val(data_uri);

                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                var rawImageData = encodeURIComponent(imagenComoBase64);
                document.getElementById('imagen').value = rawImageData;
            });

        }

    </script>