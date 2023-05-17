<?php 
require_once("controllers/departamento.php");
$sistema -> validateRol('Usuario');
include_once(__DIR__."/controllers/sistema.php");
include_once(__DIR__."/controllers/proyecto.php");
include_once("views/header.php");
include_once("views/menu.php");
$reporte=$proyecto->chartProyecto();
// ?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">

//       // Load the Visualization API and the corechart package.
//       google.charts.load('current', {'packages':['corechart']});

//       // Set a callback to run when the Google Visualization API is loaded.
//       google.charts.setOnLoadCallback(drawChart);

//       // Callback that creates and populates a data table,
//       // instantiates the pie chart, passes in the data and
//       // draws it.
//       function drawChart() {

//         // Create the data table.
//         var data = google.visualization.arrayToDataTable([
//          ['Element', 'Density', { role: 'style' }],
//          <?php foreach($reporte as $key => $value):?>
//           ['<?php echo $value['mes']; ?>', <?php echo $value['cantidad']; ?>, '#b87333'], // CSS-style declaration
//           <?php endforeach; ?>
//       ]);
//         // Set chart options
//         var options = {'title':'Proyectos mensuales',
//                        'width':400,
//                        'height':300};

//         // Instantiate and draw our chart, passing in some options.
//         var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//         chart.draw(data, options);
//       }
//     </script>
     <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
<?php
// include_once("views/footer.php");
// ?>