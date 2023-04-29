<?php 
require_once("controllers/sistema.php");
require_once ('../vendor/autoload.php');
use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf();
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$sistema->db();
switch($action):
    case 'proyecto':
            $sql = "select * from vw_proyecto 
            where id_proyecto=:id";
            $st = $sistema->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            $html="<!DOCTYPE html>
            <html lang='en'>
              <head>
                <meta charset='utf-8'>
                <title>Example 1</title>
                <link rel='stylesheet' media='all' />
                <style type='text/css'>
                .clearfix:after {
                    content: '';
                    display: table;
                    clear: both;
                  }
                  
                  a {
                    color: #5D6975;
                    text-decoration: underline;
                  }
                  
                  body {
                    border-color:#001028;
                    position: relative;
                    width: 21cm;  
                    height: 29.7cm; 
                    margin: 0 auto; 
                    color: #001028;
                    background: #FFFFFF; 
                    font-family: Arial, sans-serif; 
                    font-size: 12px; 
                    font-family: Arial;
                  }
                  
                  #logo {
                    text-align: center;
                    margin-bottom: 10px;
                  }
                  
                  #logo img {
                    width: 180px;
                  }
                  
                  h1 {
                    border-top: 1px solid  #5D6975;
                    border-bottom: 1px solid  #5D6975;
                    color: #5D6975;
                    font-size: 2.4em;
                    line-height: 1.4em;
                    font-weight: normal;
                    text-align: center;
                    margin: 0 0 20px 0;
                    background: url(dimension.png);
                  }
                  
                  #project {
                    float: left;
                  }
                  
                  #project span {
                    color: #5D6975;
                    text-align: right;
                    width: 52px;
                    margin-right: 10px;
                    display: inline-block;
                    font-size: 0.8em;
                  }
                  
                  #company {
                    float: right;
                    text-align: right;
                  }
                  
                  #project div,
                  #company div {
                    white-space: nowrap;        
                  }
                  
                  table {
                    width: 100%;
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin-bottom: 20px;
                  }
                  
                  table tr:nth-child(2n-1) td {
                    background: #F5F5F5;
                  }
                  
                  table th,
                  table td {
                    text-align: center;
                  }
                  
                  table th {
                    padding: 2px 15px;
                    color: #5D6975;
                    border-bottom: 1px solid #C1CED9;
                    white-space: nowrap;        
                    font-weight: normal;
                  }
                  
                  table .service,
                  table .desc {
                    text-align: left;
                  }
                  
                  table td {
                    text-align: center;
                  }
                  
                  table td.service,
                  table td.desc {
                    vertical-align: top;
                  }
                  
                  table td.unit,
                  table td.qty,
                  table td.total {
                    font-size: 1.5em;
                  }
                  
                  table td.grand {
                    border-top: 1px solid #5D6975;;
                  }
                  
                  #notices .notice {
                    color: #5D6975;
                    font-size: 1.2em;
                  }
                </style>
              </head>
              <body>
                <div class='clearfix'>
                  <div id='logo'>
                    <img src='../images/logo.png'/>
                  </div>
                </div>
                  <table>
                    <thead>
                      <tr>
                        <th scope='row'>Departamento</th>
                        <th>Proyecto</th>
                        <th>Descripcion</th>
                        <th>Fecha Inicial</th>
                        <th>Fecha Final</th>
                        <th>Tarea</th>
                        <th>Avance</th>
                      </tr>
                      </thead>";
                      foreach ($data as $key => $reporte):
                  $html.= "
                      <tbody>
                      <tr>
                          <td>".$reporte['departamento']."</td>
                          <td>".$reporte['proyecto']."</td>
                          <td>".$reporte['descripcion']."</td>
                          <td>".$reporte['fecha_inicio']."</td>
                          <td>".$reporte['fecha_fin']."</td>
                          <td>".$reporte['tarea']."</td>
                          <td>".$reporte['avance']."</td>
                      </tr>
                      </tbody>";
                  endforeach;
                 $html.= "</table>
                  <div id='notices'>
                    <div>NOTICE:</div>
                    <div class='notice'>A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                  </div>
              </body>
            </html>";
        break;
    default:
    $html='<h1>Sin Reporte</h1>No hay ningun reporte a generar.';
endswitch;
$html2pdf->writeHTML($html);
$html2pdf->output();
?>