<?php
define('FPDF_FONTPATH','fpdf/font/');  //para Linux
require('fpdf.php');
 
class PDF extends FPDF
{
var $widths;
var $aligns;
var $flowingBlockAttr;
########################## FUNCION PARA MOSTRAR EL FOOTER ###################################
   
   /*function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    //Page number
    $pagenumber = '{nb}';
    if($this->PageNo() == 2){
        $this->Cell(173,10, ' FOOTER TEST  -  '.$pagenumber, 0, 0);
    }
}*/

function Footer()
    {
        //Posición: a 2 cm del final
  $this->Ln();
  $this->SetY(-12);
  $this->SetFont('courier','B',10);
        //Número de página
  $this->Cell(190,5,'SIGA - SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA','T',0,'L');
  $this->AliasNbPages();
  $this->Cell(0,5,'Pagina '.$this->PageNo(),'T',1,'R');
  //Page number
  /*$pagenumber = '{nb}';
    if($this->PageNo() == 2){
        $this->Cell(173,10, ' FOOTER TEST  -  '.$pagenumber, 0, 0);
    }*/

      if($this->page>0)
        {
            // Page footer
            //$this->InFooter = true;
            //$this->Footer();
            //$this->InFooter = false;
            // Close page
            $this->_endpage();
        }

    } 
########################## FUNCION PARA MOSTRAR EL FOOTER ###################################
	
	

################################### REPORTES DE MANTENIMIENTO ##################################

########################## FUNCION LISTAR USUARIOS ##############################
      function TablaListarUsuarios()
   {
	$logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(350,10,'LISTADO GENERAL DE USUARIOS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(30,8,'Nº DE DNI',1,0,'C', True);
    $this->Cell(80,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(25,8,'SEXO',1,0,'C', True);
    $this->Cell(45,8,'CARGO',1,0,'C', True);
    $this->Cell(60,8,'EMAIL',1,0,'C', True);
    $this->Cell(40,8,'USUARIO',1,0,'C', True);
    $this->Cell(40,8,'NIVEL',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarUsuarios();

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(30,6,$reg[$i]["cedula"],1,0,'C');
    $this->CellFitSpace(80,6,utf8_decode($reg[$i]["nombres"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["sexo"]),1,0,'C');
    $this->CellFitSpace(45,6,utf8_decode($reg[$i]["cargo"]),1,0,'C');
    $this->CellFitSpace(60,6,utf8_decode($reg[$i]["email"]),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["usuario"]),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["nivel"]),1,0,'C');
    $this->Ln();
         }
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR USUARIOS ##############################

########################## FUNCION LISTAR USUARIOS ##############################
 function TablaListarLogs()
   {
	
	$logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(350,10,'LISTADO GENERAL DE LOGS DE ACCESO DE USUARIOS',0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(35,8,'IP EQUIPO',1,0,'C', True);
	$this->Cell(45,8,'TIEMPO ENTRADA',1,0,'C', True);
	$this->Cell(145,8,'NAVEGADOR DE ACCESO',1,0,'C', True);
	$this->Cell(60,8,'PÁGINAS DE ACCESO',1,0,'C', True);
	$this->Cell(35,8,'USUARIO',1,1,'C', True);
	

	$tra = new Login();
    $reg = $tra->ListarLogs();

    if($reg==""){
    echo "";      
    } else {
	
    /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,35,45,145,60,35));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["ip"]),utf8_decode($reg[$i]["tiempo"]),utf8_decode($reg[$i]["detalles"]),utf8_decode($reg[$i]["paginas"]),utf8_decode($reg[$i]["usuario"])));
       }
   }

    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(11);
   }
########################## FUNCION LISTAR USUARIOS ##############################

############################ FUNCION LISTAR ARQUEOS DE CAJAS ################################
      function TablaListarArqueos()
   {

    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $tra = new Login();
    $reg = $tra->ListarArqueoCaja();

	$this->Ln(2);
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+26, $this->GetY()+4, 30),5,0,'L');
	$this->Cell(105,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-10, $this->GetY()+1, 20),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(195,10,'LISTADO GENERAL DE ARQUEOS DE CAJAS',0,0,'C');
	
	$this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(10,8,'Nº',1,0,'C', True);
    $this->CellFitSpace(45,8,'RESPONSABLE',1,0,'C', True);
    $this->CellFitSpace(25,8,'NOMBRE DE CAJA',1,0,'C', True);
    $this->CellFitSpace(30,8,'HORA DE APERTURA',1,0,'C', True);
    $this->CellFitSpace(30,8,'HORA DE CIERRE',1,0,'C', True);
    $this->CellFitSpace(18,8,'ESTIMADO',1,0,'C', True);
    $this->CellFitSpace(18,8,'EFECTIVO',1,0,'C', True);
    $this->CellFitSpace(18,8,'DIFERENCIA',1,1,'C', True);
    
    $a=1;

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(45,6,utf8_decode($reg[$i]["nombres"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["nombrecaja"]),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["fechaapertura"]),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["fechacierre"]),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode(number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode(number_format($reg[$i]["dineroefectivo"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode(number_format($reg[$i]["diferencia"], 2, '.', ',')),1,0,'C');
    $this->Ln();
          }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(60,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(60,6,'',0,0,'');
    $this->Ln(4);
     }
############################ FUNCION LISTAR ARQUEOS DE CAJAS ################################

############################ FUNCION LISTAR ARQUEOS DE CAJAS POR FECHAS ################################
      function TablaListarArqueosFechas()
   {

    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $tra = new Login();
    $reg = $tra->BuscarArqueosxFechas();

	$this->Ln(2);
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+26, $this->GetY()+4, 30),5,0,'L');
	$this->Cell(105,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-10, $this->GetY()+1, 20),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(195,10,'ARQUEOS EN CAJA '.utf8_decode('DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"]).' DEL PERIODO '.$reg[0]['periodo'],0,0,'C');
	
	$this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(10,8,'Nº',1,0,'C', True);
    $this->CellFitSpace(45,8,'RESPONSABLE',1,0,'C', True);
    $this->CellFitSpace(25,8,'NOMBRE DE CAJA',1,0,'C', True);
    $this->CellFitSpace(30,8,'HORA DE APERTURA',1,0,'C', True);
    $this->CellFitSpace(30,8,'HORA DE CIERRE',1,0,'C', True);
    $this->CellFitSpace(18,8,'ESTIMADO',1,0,'C', True);
    $this->CellFitSpace(18,8,'EFECTIVO',1,0,'C', True);
    $this->CellFitSpace(18,8,'DIFERENCIA',1,1,'C', True);
    
    $a=1;

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(45,6,utf8_decode($reg[$i]["nombres"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["nombrecaja"]),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["fechaapertura"]),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["fechacierre"]),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode(number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode(number_format($reg[$i]["dineroefectivo"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode(number_format($reg[$i]["diferencia"], 2, '.', ',')),1,0,'C');
    $this->Ln();
          }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(60,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(60,6,'',0,0,'');
    $this->Ln(4);
     }
############################ FUNCION LISTAR ARQUEOS DE CAJAS POR FECHAS ################################

############################### FUNCION LISTAR MOVIMIENTOS DE CAJAS #################################
      function TablaListarMovimientos()
   {
    
    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $movim = new Login();
    $reg = $movim->ListarMovimientoCajas();

	$this->Ln(2);
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+26, $this->GetY()+4, 30),5,0,'L');
	$this->Cell(105,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-10, $this->GetY()+1, 20),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(195,10,'LISTADO GENERAL DE MOVIMIENTOS DE CAJAS',0,0,'C');
	
	$this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(10,8,'Nº',1,0,'C', True);
    $this->CellFitSpace(30,8,'Nº CAJA',1,0,'C', True);
    $this->CellFitSpace(20,8,'Nº FACT/REC',1,0,'C', True);
    $this->CellFitSpace(70,8,'DESCRIPCIÓN DE MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(15,8,'TIPO',1,0,'C', True);
    $this->CellFitSpace(21,8,'FECHA MOV.',1,0,'C', True);
    $this->CellFitSpace(26,8,'MONTO',1,1,'C', True);
    
$TotalIngresos=0;
$TotalEgresos=0;

if($reg==""){
echo "";      
} else {
  
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0"); 


    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["nrocaja"].": ".$reg[$i]['nombrecaja']),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]["nrorecibo"]),1,0,'C');
    $this->CellFitSpace(70,6,utf8_decode($reg[$i]["descripcionmovimientocaja"]),1,0,'C');
    $this->CellFitSpace(15,6,utf8_decode($reg[$i]["tipomovimientocaja"]),1,0,'C');
    $this->CellFitSpace(21,6,date("d-m-Y",strtotime($reg[$i]["fechamovimientocaja"])),1,0,'C');
    $this->CellFitSpace(26,6,utf8_decode(number_format($reg[$i]['montomovimientocaja'], 2, '.', ',')),1,0,'C');
    $this->Ln();
       }
   }
   
    $this->Cell(325,5,'',0,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(95,5,'DETALLES DE MOVIMIENTO',1,0,'C', True);
    $this->Ln();

if($_SESSION['acceso'] == "secretaria") {

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'RESPONSABLE DE CAJA',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,utf8_decode($reg[0]['nombres']),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'NOMBRE DE CAJA',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,utf8_decode($reg[0]['nrocaja'].": ".$reg[0]['nombrecaja']),1,0,'C');
    $this->Ln();

 }

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL INGRESOS',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,number_format($TotalIngresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL EGRESOS',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,number_format($TotalEgresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL GENERAL',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,number_format($TotalIngresos-$TotalEgresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(60,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(60,6,'',0,0,'');
    $this->Ln(4);
     }
############################### FUNCION LISTAR MOVIMIENTOS DE CAJAS #################################

############################### FUNCION LISTAR MOVIMIENTOS POR FECHAS #################################
      function TablaListarMovimientosFechas()
   {
    
    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $movim = new Login();
    $reg = $movim->BuscarMovimientosxFechas();

	$this->Ln(2);
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+26, $this->GetY()+4, 30),5,0,'L');
	$this->Cell(105,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-10, $this->GetY()+1, 20),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(105,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(195,10,'MOVIMIENTOS EN CAJA '.utf8_decode('DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"]).' DEL PERIODO '.$reg[0]['periodo'],0,0,'C');
	
	$this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(10,8,'Nº',1,0,'C', True);
    $this->CellFitSpace(25,8,'Nº FACT/REC',1,0,'C', True);
    $this->CellFitSpace(95,8,'DESCRIPCIÓN DE MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(15,8,'TIPO',1,0,'C', True);
    $this->CellFitSpace(21,8,'FECHA MOV.',1,0,'C', True);
    $this->CellFitSpace(26,8,'MONTO',1,1,'C', True);
    
$TotalIngresos=0;
$TotalEgresos=0;

if($reg==""){
echo "";      
} else {
  
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0"); 


    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["nrorecibo"]),1,0,'C');
    $this->CellFitSpace(95,6,utf8_decode($reg[$i]["descripcionmovimientocaja"]),1,0,'C');
    $this->CellFitSpace(15,6,utf8_decode($reg[$i]["tipomovimientocaja"]),1,0,'C');
    $this->CellFitSpace(21,6,date("d-m-Y",strtotime($reg[$i]["fechamovimientocaja"])),1,0,'C');
    $this->CellFitSpace(26,6,utf8_decode(number_format($reg[$i]['montomovimientocaja'], 2, '.', ',')),1,0,'C');
    $this->Ln();
       }
   }
   
    $this->Cell(325,5,'',0,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(95,5,'DETALLES DE MOVIMIENTO',1,0,'C', True);
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'RESPONSABLE DE CAJA',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,utf8_decode($reg[0]['nombres']),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'NOMBRE DE CAJA',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,utf8_decode($reg[0]['nrocaja'].": ".$reg[0]['nombrecaja']),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL INGRESOS',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,number_format($TotalIngresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL EGRESOS',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,number_format($TotalEgresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL GENERAL',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,number_format($TotalIngresos-$TotalEgresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(60,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(60,6,'',0,0,'');
    $this->Ln(4);
     }
############################### FUNCION LISTAR MOVIMIENTOS POR FECHAS #################################

############################# FUNCION REPORTES DE MATERIAS ##############################
 function TablaListarMaterias()
   {
	
	$logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
    $tra = new Login();
    $reg = $tra->ListarMaterias();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(350,10,'LISTADO GENERAL DE MATERIAS',0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(20,8,'CÓDIGO',1,0,'C', True);
	$this->Cell(85,8,'NOMBRE DE ÁREA',1,0,'C', True);
	$this->Cell(157,8,'NOMBRE DE MATERIA',1,0,'C', True);
	$this->Cell(30,8,'NIVEL',1,0,'C', True);
	$this->Cell(30,8,'GRADO',1,1,'C', True);
	
	/* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,20,85,157,30,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */

    if($reg==""){
    echo "";      
    } else {

    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codmateria"]),utf8_decode($reg[$i]["nomarea"]),utf8_decode($reg[$i]["nommateria"]),utf8_decode($reg[$i]["nivel"]),utf8_decode($reg[$i]["grado"])));
   } }
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(11);
     }
############################# FUNCION REPORTES DE MATERIAS ##############################

############################# FUNCION REPORTES DE MATERIAS ##############################
 function TablaListarMateriasCursos()
   {
	
	$logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
    $tra = new Login();
    $reg = $tra->BuscarMateriasReportes();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(350,10,'LISTADO DE MATERIAS DEL NIVEL '.utf8_decode($reg[0]['nivel']).' - GRADO '.utf8_decode($reg[0]['grado']),0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(20,8,'CÓDIGO',1,0,'C', True);
	$this->Cell(100,8,'NOMBRE DE ÁREA',1,0,'C', True);
	$this->Cell(202,8,'NOMBRE DE MATERIA',1,1,'C', True);
	
	/* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,20,100,202));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codmateria"]),utf8_decode($reg[$i]["nomarea"]),utf8_decode($reg[$i]["nommateria"])));
   }
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(11);
     }
############################# FUNCION REPORTES DE MATERIAS ##############################

################################### REPORTES DE MANTENIMIENTO ##################################
	

	
	










################################# FUNCION DOCENTES Y ASIGNACIONES DE CURSOS #################################

################################ FUNCION LISTAR DOCENTES #################################
 function TablaListarDocentes()
   {
    
    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+42, $this->GetY()+4, 38),5,0,'L');
    $this->Cell(170,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-34, $this->GetY()+1, 22),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-21,'NIT. '.utf8_decode($con[0]['codinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-13,'DIREC. '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,3,'EMAIL. '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(255,10,'LISTADO GENERAL DE DOCENTES',0,0,'C');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N°',1,0,'C', True);
    $this->Cell(30,8,'Nº DE DNI',1,0,'C', True);
    $this->Cell(70,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(45,8,'ESPECIALIDAD',1,0,'C', True);
    $this->Cell(75,8,'DIRECCIÓN DOMICILIARIA',1,0,'C', True);
    $this->Cell(25,8,'TELÉFONO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarDocentes();

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('Courier','',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->Cell(30,6,utf8_decode($reg[$i]["ceddoc"]."-".$status = ( $reg[$i]["expedido"] == 'LA PAZ' ? "LP." : ($status = ( $reg[$i]["expedido"] == 'COCHABAMBA' ? "CB." : ($status = ( $reg[$i]["expedido"] == 'SANTA CRUZ' ? "SC." : ($status = ( $reg[$i]["expedido"] == 'CHUQUISACA' ? "CH." : ($status = ( $reg[$i]["expedido"] == 'ORURO' ? "OR." : ($status = ( $reg[$i]["expedido"] == 'TARIJA' ? "TJ." : ($status = ( $reg[$i]["expedido"] == 'POTOSI' ? "PT." : ($status = ( $reg[$i]["expedido"] == 'BENI' ? "BE." : ($status = ( $reg[$i]["expedido"] == 'PANDO' ? "PA." : "")))))))))))))))))),1,0,'C');
    $this->Cell(70,6,utf8_decode($reg[$i]['nomdoc']),1,0,'C');
    $this->Cell(45,6,utf8_decode($reg[$i]["especdoc"]),1,0,'C');
    $this->Cell(75,6,utf8_decode($reg[$i]["direcdoc"]),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["tlfdoc"]),1,0,'C');
    $this->Ln();
       }
   }
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(70,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(70,6,'',0,0,'');
    $this->Ln(11);
     }
################################ FUNCION LISTAR DOCENTES #################################

################################ FUNCION LISTAR ASIGNACIONES DE MATERIAS A DOCENTES #################################
 function TablaListarAsignaciones()
   {
    
    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+42, $this->GetY()+4, 38),5,0,'L');
    $this->Cell(170,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-34, $this->GetY()+1, 22),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-21,'NIT. '.utf8_decode($con[0]['codinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-13,'DIREC. '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,3,'EMAIL. '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(255,10,'LISTADO GENERAL DE ASIGNACIONES DE MATERIAS A DOCENTES',0,0,'C');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N°',1,0,'C', True);
    $this->Cell(30,8,'Nº DE DNI',1,0,'C', True);
    $this->Cell(70,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(20,8,'TURNO',1,0,'C', True);
    $this->Cell(20,8,'NIVEL',1,0,'C', True);
    $this->Cell(25,8,'GRADO',1,0,'C', True);
    $this->Cell(20,8,'SECCIÓN',1,0,'C', True);
    $this->Cell(40,8,'MATERIA',1,0,'C', True);
    $this->Cell(20,8,'PERIODO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarAsignacion();

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('Courier','',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->Cell(30,6,utf8_decode($reg[$i]["ceddoc"]."-".$status = ( $reg[$i]["expedido"] == 'LA PAZ' ? "LP." : ($status = ( $reg[$i]["expedido"] == 'COCHABAMBA' ? "CB." : ($status = ( $reg[$i]["expedido"] == 'SANTA CRUZ' ? "SC." : ($status = ( $reg[$i]["expedido"] == 'CHUQUISACA' ? "CH." : ($status = ( $reg[$i]["expedido"] == 'ORURO' ? "OR." : ($status = ( $reg[$i]["expedido"] == 'TARIJA' ? "TJ." : ($status = ( $reg[$i]["expedido"] == 'POTOSI' ? "PT." : ($status = ( $reg[$i]["expedido"] == 'BENI' ? "BE." : ($status = ( $reg[$i]["expedido"] == 'PANDO' ? "PA." : "")))))))))))))))))),1,0,'C');
    $this->Cell(70,6,utf8_decode($reg[$i]['nomdoc']),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["turno"]),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["nivel"]),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["grado"]),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["seccion"]),1,0,'C');
    $this->Cell(40,6,utf8_decode($reg[$i]["nommateria"]),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["periodo"]),1,0,'C');
    $this->Ln();
       }
   }
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(70,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(70,6,'',0,0,'');
    $this->Ln(11);
     }
################################ FUNCION LISTAR ASIGNACIONES DE MATERIAS A DOCENTES #################################

################################ FUNCION LISTAR ASIGNACIONES DE MATERIAS POR PERIODO #################################
 function TablaListarAsignacionesxDocentes()
   {
    
    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 
    
    $tra = new Login();
    $reg = $tra->BuscarAsignacionMateriasReportes();

    $this->Ln(2);
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+42, $this->GetY()+4, 38),5,0,'L');
    $this->Cell(170,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-34, $this->GetY()+1, 22),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-21,'NIT. '.utf8_decode($con[0]['codinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-13,'DIREC. '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(170,3,'EMAIL. '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(255,10,'LISTADO DE ASIGNACIONES DE MATERIAS DEL PERIODO ESCOLAR '.$reg[0]['periodo'],0,0,'C');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'N°',1,0,'C', True);
    $this->Cell(30,8,'Nº DE DNI',1,0,'C', True);
    $this->Cell(70,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(25,8,'TURNO',1,0,'C', True);
    $this->Cell(25,8,'NIVEL',1,0,'C', True);
    $this->Cell(25,8,'GRADO',1,0,'C', True);
    $this->Cell(20,8,'SECCIÓN',1,0,'C', True);
    $this->Cell(50,8,'MATERIA',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('Courier','',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->Cell(30,6,utf8_decode($reg[$i]["ceddoc"]."-".$status = ( $reg[$i]["expedido"] == 'LA PAZ' ? "LP." : ($status = ( $reg[$i]["expedido"] == 'COCHABAMBA' ? "CB." : ($status = ( $reg[$i]["expedido"] == 'SANTA CRUZ' ? "SC." : ($status = ( $reg[$i]["expedido"] == 'CHUQUISACA' ? "CH." : ($status = ( $reg[$i]["expedido"] == 'ORURO' ? "OR." : ($status = ( $reg[$i]["expedido"] == 'TARIJA' ? "TJ." : ($status = ( $reg[$i]["expedido"] == 'POTOSI' ? "PT." : ($status = ( $reg[$i]["expedido"] == 'BENI' ? "BE." : ($status = ( $reg[$i]["expedido"] == 'PANDO' ? "PA." : "")))))))))))))))))),1,0,'C');
    $this->Cell(70,6,utf8_decode($reg[$i]['nomdoc']),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["turno"]),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["nivel"]),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["grado"]),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["seccion"]),1,0,'C');
    $this->Cell(50,6,utf8_decode($reg[$i]["nommateria"]),1,0,'C');
    $this->Ln();
       }
   }
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(70,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(70,6,'',0,0,'');
    $this->Ln(11);
     }
################################ FUNCION LISTAR ASIGNACIONES DE MATERIAS POR PERIODO #################################

################################# FUNCION DOCENTES Y ASIGNACIONES DE MATERIAS #################################












################################# FUNCION ESTUIDANTES Y REPRESENTANTES #################################

############################ FUNCION REPORTES DE ESTUDIANTES ##############################
 function TablaListarEstudiantes()
   {
	
	$logo = "./assets/images/logo_sm.png";
	$logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $tra = new Login();
    $reg = $tra->BuscarEstudiantesReportes();

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+42, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(170,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-34, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(260,10,'LISTADO GENERAL DE ESTUDIANTES POR CURSOS DEL PERIODO ESCOLAR '.$reg[0]['periodo'],0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(37,8,'Nº DE DNI',1,0,'C', True);
	$this->Cell(78,8,'APELLIDOS Y NOMBRES',1,0,'C', True);
	$this->Cell(20,8,'EDAD',1,0,'C', True);
	$this->Cell(28,8,'NIVEL',1,0,'C', True);
	$this->Cell(25,8,'GRADO',1,0,'C', True);
	$this->Cell(20,8,'SECCIÓN',1,0,'C', True);
	$this->Cell(20,8,'TURNO',1,0,'C', True);
	$this->Cell(22,8,'BECADO',1,1,'C', True);
	
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('Courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->Cell(37,6,utf8_decode($reg[$i]["cedest"]),1,0,'C');
    $this->Cell(78,6,utf8_decode($reg[$i]['papeest']." ".$reg[$i]['sapeest']." ".$reg[$i]['pnomest']." ".$reg[$i]['snomest']),1,0,'C');
	$this->Cell(20,6,edad($reg[$i]["fnacest"])." AÑOS",1,0,'C');
    $this->Cell(28,6,utf8_decode($reg[$i]["nivel"]),1,0,'C');
	$this->Cell(25,6,utf8_decode($reg[$i]["grado"]),1,0,'C');
	$this->Cell(20,6,utf8_decode($reg[$i]["seccion"]),1,0,'C');
	$this->Cell(20,6,utf8_decode($reg[$i]["turno"]),1,0,'C');
	$this->Cell(22,6,utf8_decode($reg[$i]["becado"]),1,0,'C');
    $this->Ln();
   }
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(70,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(70,6,'',0,0,'');
    $this->Ln(11);
     }
############################ FUNCION REPORTES DE ESTUDIANTES ##############################

############################# FUNCION REPORTES DE REPRESENTANTES ##############################
 function TablaListarRepresentantes()
   {
	
	$logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
	
    $codseccion = $_GET["codseccion"];
	$codturno = $_GET["codturno"];
   
    $tra = new Login();
    $reg = $tra->BuscarRepresentantesReportes();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(350,10,'LISTADO GENERAL DE PADRES/TUTORES POR CURSOS DEL PERIODO ESCOLAR '.$reg[0]['periodo'],0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(42,8,'Nº DE DNI',1,0,'C', True);
	$this->Cell(75,8,'APELLIDOS Y NOMBRES',1,0,'C', True);
	$this->Cell(30,8,'NIVEL',1,0,'C', True);
	$this->Cell(25,8,'GRADO',1,0,'C', True);
	$this->Cell(18,8,'SECCIÓN',1,0,'C', True);
	$this->Cell(25,8,'TURNO',1,0,'C', True);
	$this->Cell(22,8,'BECADO',1,0,'C', True);
	$this->Cell(85,8,'PADRE/TUTOR',1,1,'C', True);
	
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('Courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->Cell(42,6,utf8_decode($reg[$i]["cedest"]),1,0,'C');
    $this->Cell(75,6,utf8_decode($reg[$i]['papeest']." ".$reg[$i]['sapeest']." ".$reg[$i]['pnomest']." ".$reg[$i]['snomest']),1,0,'C');
    $this->Cell(30,6,utf8_decode($reg[$i]["nivel"]),1,0,'C');
	$this->Cell(25,6,utf8_decode($reg[$i]["grado"]),1,0,'C');
	$this->Cell(18,6,utf8_decode($reg[$i]["seccion"]),1,0,'C');
	$this->Cell(25,6,utf8_decode($reg[$i]["turno"]),1,0,'C');
	$this->Cell(22,6,utf8_decode($reg[$i]["becado"]),1,0,'C');
	$this->Cell(85,6,utf8_decode($reg[$i]['cedpadre']." - ".$reg[$i]['nompadre']." ".$reg[$i]['apepadre']),1,0,'C');
    $this->Ln();
   }
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(11);
     }
########################## FUNCION REPORTES DE REPRESENTANTES ############################

################################# FUNCION ESTUIDANTES Y REPRESENTANTES #################################
















###################################### FUNCION PAGOS DE ESTUDIANTES #####################################

############################ FUNCION PARA MOSTRAR COMPROBANTE ##############################
 /*function TablaComprobante()
   {
		
	$con = new Login();
	$con = $con->ConfiguracionPorId();
	
	$tra = new Login();
    $reg = $tra->EstudiantesPorId();
	
	//Logo
    $this->Image("./assets/images/logo.png", 16, 9.5, 17, 17, "PNG");  
   	
	############### BLOQUE DEL MEMBRETE ###################
	//Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 9, 190, 18, '1.5', '');
	
	//Linea de membrete Nro 1
	$this->SetFont('Courier','BI',9);
    $this->SetXY(38, 10);
    $this->Cell(28, 5, 'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA', 0 , 0);
    $this->SetXY(130, 10);
    $this->Cell(28, 5, 'NIT: '.utf8_decode($con[0]['codinstituto']), 0 , 0);
	
	//Linea de membrete Nro 2
    $this->SetXY(38, 14);
    $this->Cell(28, 5, utf8_decode($con[0]['nominstituto']), 0 , 0);
    $this->SetXY(130, 14);
    $this->Cell(28, 5, 'FECHA DE PAGO: '.utf8_decode(date("d-m-Y",strtotime($reg[0]['fechainscripcion']))), 0 , 0);
    
	//Linea de membrete Nro 3
    $this->SetXY(38, 18);
    $this->Cell(28, 5, utf8_decode($con[0]['direcinstituto']), 0 , 0);
    $this->SetXY(130, 18);
    $this->Cell(28, 5, 'USUARIO: '.utf8_decode($_SESSION["usuario"]), 0 , 0);
	
	//Linea de membrete Nro 4
    $this->SetXY(38, 22);
    $this->Cell(28, 5, 'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']), 0 , 0);
    $this->SetXY(130, 22);
    $this->Cell(28, 5, 'N° DE COMPROBANTE: '.$reg[0]["codest"], 0 , 0);
	$this->Ln(12);
	
	############### BLOQUE DE DATOS PERSONALES DEL TUTOR ###################
	$this->Ln(12);
	$this->SetXY(10, 30);
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(189.5,6,'DATOS : PADRE  |  MADRE  |  TUTOR  |  APODERADO',1,0,'L', True);
    $this->Ln();
	//Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 36, 190, 8, '1.5', '');
	
	//Linea de membrete Nro 3
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetXY(11, 38);
    $this->Cell(28, 5, 'NIT/CI: '.utf8_decode($reg[0]["cedpadre"]), 0 , 0);
    $this->SetXY(60, 38);
    $this->Cell(28, 5, 'RAZÓN SOCIAL: '.utf8_decode($reg[0]["nompadre"]." ".$reg[0]["apepadre"]), 0 , 0);
	
	
	############### BLOQUE DE DATOS PERSONALES DEL ESTUDIANTE ###################
	$this->Ln(10);
	$this->SetXY(10, 46);
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(189.5,6,'DATOS DEL ESTUDIANTE',1,0,'L', True);
    $this->Ln();
	//Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 52, 190, 12, '1.5', '');
	
	//Linea de membrete Nro 3
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetXY(11, 54);
    $this->Cell(28, 5, 'NIVEL: '.utf8_decode($reg[0]["nivel"]), 0 , 0);
    $this->SetXY(48, 54);
    $this->Cell(28, 5, 'GRADO: '.utf8_decode($reg[0]["grado"]), 0 , 0);
    $this->SetXY(85, 54);
    $this->Cell(28, 5, 'SECCIÓN: '.utf8_decode($reg[0]["seccion"]), 0 , 0);
    $this->SetXY(108, 54);
    $this->Cell(28, 5, 'TURNO: '.utf8_decode($reg[0]["turno"]), 0 , 0);
    $this->SetXY(139, 54);
    $this->Cell(28, 5, 'BECADO: '.utf8_decode($reg[0]["becado"]), 0 , 0);
    $this->SetXY(172, 54);
    $this->Cell(28, 5, 'PERIODO: '.utf8_decode($reg[0]["periodo"]), 0 , 0);
	
	$this->SetXY(11, 59);
    $this->Cell(28, 5, 'CÓDIGO: '.utf8_decode($reg[0]["cedest"]), 0 , 0);
    $this->SetXY(60, 59);
    $this->Cell(28, 5, 'NOMBRES Y APELLgggggIDOS: '.utf8_decode($reg[0]["pnomest"]." ".$reg[0]["snomest"]." ".$reg[0]["papeest"]." ".$reg[0]["sapeest"]), 0 , 0);
	
	//Bloque de datos de empresa
    $this->SetFillColor(5, 130, 275);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 66, 190, 8, '1.5', 'F');
	
	$this->SetFillColor(5, 130, 275);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 66, 190, 8, '1.5', '');
	
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->SetXY(12, 67.5);
    $this->Cell(30, 5, 'N°', 0 , 0);
    $this->SetXY(70, 67.5);
    $this->Cell(28, 5, 'DESCRIPCIÓN', 0 , 0);
    $this->SetXY(152, 67.5);
    $this->Cell(28, 5, 'VALOR UNIT', 0 , 0);
    $this->SetXY(180, 67.5);
    $this->Cell(28, 5, 'IMPORTE', 0 , 0);

	$this->Ln();
	$this->SetXY(10, 74);

	$this->SetFont('Courier','',8);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,5,"1",1,0,'C');
    $this->Cell(130,5,"COSTO DE INSCRIPCIÓN DEL NIVEL ".utf8_decode($reg[0]["nivel"]),1,0,'C');
	$this->Cell(25,5,utf8_decode(number_format($reg[0]["pagonivel"], 2, '.', ',')),1,0,'C');
	$this->Cell(25,5,utf8_decode(number_format($reg[0]["pagonivel"], 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->Cell(10,5,"2",1,0,'C');
    $this->Cell(130,5,"PAGO DE CUOTA UNICA",1,0,'C');
	$this->Cell(25,5,utf8_decode(number_format($reg[0]["cuotaunica"], 2, '.', ',')),1,0,'C');
	$this->Cell(25,5,utf8_decode(number_format($reg[0]["cuotaunica"], 2, '.', ',')),1,0,'C');
    $this->Ln();

	
	$this->SetFont('Courier','B',9);  
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(60,5,'FECHA: '.utf8_decode(date("d-m-Y h:i:s A")),0,0,'C');
    $this->Cell(80,5,'',0,0,'C');
    $this->SetFont('Courier','B',7);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(25,5,'TOTAL A PAGAR',1,0,'C', True);
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->CellFitSpace(25,5,utf8_decode(number_format($reg[0]['pagonivel'] + $reg[0]['cuotaunica'], 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(6);
	$this->SetFont('Courier','B',7);
    $this->Cell(190,0,'RECORTAR - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);
     }*/
############################ FUNCION PARA MOSTRAR COMPROBANTE ##############################

############################ FUNCION PARA MOSTRAR COMPROBANTE DE PAGOS ##############################
 function TablaComprobantePagos()
   {
		
	$con = new Login();
	$con = $con->ConfiguracionPorId();
	
	$tra = new Login();
    $reg = $tra->BuscarComprobantePagos();
	
	//Logo
    $this->Image("./assets/images/logo.png", 16, 9.5, 17, 17, "PNG");  
   	
	############### BLOQUE DEL MEMBRETE ###################
	//Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 9, 190, 18, '1.5', '');
	
	//Linea de membrete Nro 1
	$this->SetFont('Courier','BI',9);
    $this->SetXY(38, 10);
    $this->Cell(28, 5, 'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA', 0 , 0);
    $this->SetXY(130, 10);
    $this->Cell(28, 5, 'NIT: '.utf8_decode($con[0]['codinstituto']), 0 , 0);
	
	//Linea de membrete Nro 2
    $this->SetXY(38, 14);
    $this->Cell(28, 5, utf8_decode($con[0]['nominstituto']), 0 , 0);
    $this->SetXY(130, 14);
    $this->Cell(28, 5, 'FECHA DE PAGO: '.utf8_decode(date("d-m-Y",strtotime($reg[0]['fechapago']))), 0 , 0);
    
	//Linea de membrete Nro 3
    $this->SetXY(38, 18);
    $this->Cell(28, 5, utf8_decode($con[0]['direcinstituto']), 0 , 0);
    $this->SetXY(130, 18);
    $this->Cell(28, 5, 'USUARIO: '.$reg[0]["usuario"], 0 , 0); //$this->Cell(28, 5, 'USUARIO: '.utf8_decode($_SESSION["usuario"]), 0 , 0);
	
	//Linea de membrete Nro 4
    $this->SetXY(38, 22);
    $this->Cell(28, 5, 'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']), 0 , 0);
    $this->SetXY(130, 22);
    $this->Cell(28, 5, 'N° COMPROBANTE: '.$reg[0]["numcomprobante"], 0 , 0);
	$this->Ln(12);
	
	############### BLOQUE DE DATOS PERSONALES DEL TUTOR ###################
	$this->Ln(12);
	$this->SetXY(10, 30);
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(189.5,6,'DATOS : PADRE  |  MADRE  |  TUTOR  |  APODERADO',1,0,'L', True);
    $this->Ln();
	//Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 36, 190, 8, '1.5', '');
	
	//Linea de membrete Nro 3
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetXY(11, 38);
    $this->Cell(28, 5, 'Nº DE DNI: '.utf8_decode($reg[0]["cedpadre"]), 0 , 0);
    $this->SetXY(60, 38);
    $this->Cell(28, 5, 'RAZÓN SOCIAL: '.utf8_decode($reg[0]["nompadre"]." ".$reg[0]["apepadre"]), 0 , 0);
	
	
	############### BLOQUE DE DATOS PERSONALES DEL ESTUDIANTE ###################
	$this->Ln(10);
	$this->SetXY(10, 46);
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(189.5,6,'DATOS DEL ESTUDIANTE',1,0,'L', True);
    $this->Ln();
	//Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 52, 190, 12, '1.5', '');
	
	//Linea de membrete Nro 3
	$this->SetFont('Courier','B',8);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetXY(11, 54);
    $this->Cell(28, 5, 'NIVEL: '.utf8_decode($reg[0]["nivel"]), 0 , 0);
    $this->SetXY(48, 54);
    $this->Cell(28, 5, 'GRADO: '.utf8_decode($reg[0]["grado"]), 0 , 0);
    $this->SetXY(85, 54);
    $this->Cell(28, 5, 'SECCIÓN: '.utf8_decode($reg[0]["seccion"]), 0 , 0);
    $this->SetXY(108, 54);
    $this->Cell(28, 5, 'TURNO: '.utf8_decode($reg[0]["turno"]), 0 , 0);
    $this->SetXY(139, 54);
    $this->Cell(28, 5, 'BECADO: '.utf8_decode($reg[0]["becado"]), 0 , 0);
    $this->SetXY(172, 54);
    $this->Cell(28, 5, 'PERIODO: '.utf8_decode($reg[0]["periodo"]), 0 , 0);
	
	$this->SetXY(11, 59);
    $this->Cell(28, 5, 'Nº DE DNI: '.utf8_decode($reg[0]["cedest"]), 0 , 0);
    $this->SetXY(60, 59);
    $this->Cell(28, 5, 'NOMBRES Y APELLIDOS: '.utf8_decode($reg[0]["pnomest"]." ".$reg[0]["snomest"]." ".$reg[0]["papeest"]." ".$reg[0]["sapeest"]), 0 , 0);
	
	//Bloque de datos de empresa
    $this->SetFillColor(5, 130, 275);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 66, 190, 8, '1.5', 'F');
	
	$this->SetFillColor(5, 130, 275);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 66, 190, 8, '1.5', '');

   if($reg==""){

    echo "";
    exit();

    } else {
    
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetXY(12, 67.5);
    $this->Cell(30, 5, 'N°', 0 , 0);
    $this->SetXY(70, 67.5);
    $this->Cell(28, 5, 'DESCRIPCIÓN', 0 , 0);
    $this->SetXY(152, 67.5);
    $this->Cell(28, 5, 'VALOR UNIT', 0 , 0);
    $this->SetXY(180, 67.5);
    $this->Cell(28, 5, 'IMPORTE', 0 , 0);
    
    $this->Ln();
    $this->SetXY(10, 74);

    $a=1;
    $pagoTotal=0;
    for($i=0;$i<sizeof($reg);$i++){
    $pagoTotal+=$reg[$i]["montopago"];
    $desc=$reg[0]['descuento']/100;


    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,5,$a++,1,0,'C');
    $this->Cell(130,5,"PAGO DE CUOTA CORRESPONDIENTE AL MES DE ".convertir($reg[$i]['mespago']),1,0,'C');
    $this->Cell(25,5,utf8_decode(number_format($reg[$i]["montopago"], 2, '.', ',')),1,0,'C');
    $this->Cell(25,5,utf8_decode(number_format($reg[$i]["montopago"], 2, '.', ',')),1,0,'C');
    $this->Ln();
   }
   
if($reg[0]["becado"]=="COMPLETA"){

    $this->Cell(10,5,"2",1,0,'C');
    $this->Cell(130,5,"PAGO DE CUOTA UNICA",1,0,'C');
    $this->Cell(25,5,utf8_decode(number_format($reg[0]["cuotaunica"], 2, '.', ',')),1,0,'C');
    $this->Cell(25,5,utf8_decode(number_format($reg[0]["cuotaunica"], 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,'FECHA: '.utf8_decode(date("d-m-Y h:i:s A")),0,0,'C');
    $this->Cell(80,5,'',0,0,'C');
    $this->SetFont('Courier','B',7);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(25,5,'TOTAL A PAGAR',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->CellFitSpace(25,5,utf8_decode(number_format($pagoTotal + $reg[0]['cuotaunica'], 2, '.', ',')),1,0,'C');
    $this->Ln();

} else {

    $this->SetFont('Courier','B',7);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)$this->Cell(10,5,'',1,0,'C');
    $this->Cell(140,5,'',0,0,'C');
    $this->CellFitSpace(25,5,'CUOTA UNICA',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL 
    $this->Cell(25,5,utf8_decode($cuota = ( $reg[0]["cuotaunica"] == '' ? "0.00" : $reg[0]["cuotaunica"])),1,0,'C');
    $this->Ln();

if($reg[0]["becado"]=="MEDIA"){

    $this->SetFont('Courier','B',7);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)$this->Cell(10,5,'',1,0,'C');
    $this->Cell(140,5,'',0,0,'C');
    $this->CellFitSpace(25,5,'MONTO MESES EXTRA',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL 
    $this->Cell(25,5,utf8_decode($monto = ( $reg[0]["montomesextra"] == '' ? "0.00" : $reg[0]["montomesextra"])),1,0,'C');
    $this->Ln();
}

    $this->SetFont('Courier','B',7);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)$this->Cell(10,5,'',1,0,'C');
    $this->Cell(140,5,'',0,0,'C');
    $this->CellFitSpace(25,5,'DESCUENTO '.$reg[0]['descuento'].' %',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL 
    $this->CellFitSpace(25,5,utf8_decode(number_format($pagoTotal*$desc, 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->SetFont('Courier','B',7);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)$this->Cell(10,5,'',1,0,'C');
    $this->Cell(140,5,'',0,0,'C');
    $this->CellFitSpace(25,5,'INTERÉS POR MORA',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL 
    $this->CellFitSpace(25,5,utf8_decode($reg[0]['interesmora']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',7);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->Cell(140,5,'',0,0,'C');
    $this->CellFitSpace(25,5,'CUOTAS VENC. PAG.',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL 
    $this->Cell(25,5,utf8_decode($nro = ( $reg[0]["cantmora"] == '' ? "0" : $reg[0]["cantmora"])),1,0,'C');
    $this->Ln();
    
    $this->SetFont('Courier','B',9);  
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,'FECHA: '.utf8_decode(date("d-m-Y h:i:s A")),0,0,'C');
    $this->Cell(80,5,'',0,0,'C');
    $this->SetFont('Courier','B',7);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(25,5,'TOTAL A PAGAR',1,0,'C', True);
    $this->SetFont('Courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $costoinscripcion = ($reg[0]['becado']== "COMPLETA" ? $reg[0]["montopago"] : "0.00");
    $calculo=$reg[0]["cantmora"] * $reg[0]['interesmora'] + $pagoTotal;
    $subtotal= $calculo * $desc;
    $total=$calculo - $subtotal;
    $this->CellFitSpace(25,5,utf8_decode(number_format($total + $reg[0]['cuotaunica'] + $reg[0]['montomesextra'] + $costoinscripcion, 2, '.', ',')),1,0,'C');
    $this->Ln();

}
    }
   
    $this->Ln(6);
	$this->SetFont('Courier','B',7);
    $this->Cell(190,0,'RECORTAR - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',1,'C');
    $this->Ln(4);
     }
############################ FUNCION PARA MOSTRAR COMPROBANTE DE PAGOS ##############################

######################### FUNCION PARA MOSTRAR REPORTES DE PAGOS GENERALES ###########################
 function TablaListarPagosFechas()
   {
	
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];
	$codperiodo = $_GET['codperiodo'];	

	$logo = "./assets/images/logo_sm.png";
	$logo2 = "./assets/images/logo.png";
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 
	
	$com = new Login();
    $com = $com->BuscarPagosGeneralReportes();

    $egreso = new Login();
    $egreso = $egreso->SumaGastosFechas();

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	//$this->Cell(255,8,'LISTADO DE PAGOS GENERALES DEL PERIODO '.$com[0]['periodo'],0,0,'C');
	$this->Cell(350,8,'LISTADO GENERAL DE PAGOS '.utf8_decode('DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"].' - PERIODO '.$com[0]['periodo']),0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(33,8,'Nº DE DNI',1,0,'C', True);
	$this->Cell(65,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
	$this->Cell(23,8,'NIVEL',1,0,'C', True);
	$this->Cell(26,8,'GRADO/SECC',1,0,'C', True);
	$this->Cell(78,8,'MESES PAGADOS',1,0,'C', True);
	$this->Cell(20,8,'BECADO',1,0,'C', True);
	$this->Cell(12,8,'MORA',1,0,'C', True);
	$this->Cell(22,8,'MONTO MES',1,0,'C', True);
    $this->Cell(22,8,'MES EXTRA',1,0,'C', True);
	$this->Cell(25,8,'PAGO TOTAL',1,1,'C', True);
	
	$a=1;
	$pagoTotal=0;
	for($i=0;$i<sizeof($com);$i++){ 
	$desc=$com[$i]['descuento']/100; 
    $calculo=($com[$i]['sumpago'])+($com[$i]['cantmora']*$com[$i]['interesmora']);
    $subtotal= $calculo*$desc;
    $total=$calculo-$subtotal+$com[$i]['cuotaunica']+$com[$i]['montomesextra'];
    $pagoTotal+=$total;
	$this->SetFont('Courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->Cell(33,6,utf8_decode($com[$i]["cedest"]),1,0,'C');
    $this->Cell(65,6,utf8_decode($com[$i]['pnomest']." ".$com[$i]['snomest']." ".$com[$i]['papeest']." ".$com[$i]['sapeest']),1,0,'C');
    $this->Cell(23,6,utf8_decode($com[$i]["nivel"]),1,0,'C');
	$this->Cell(26,6,utf8_decode($com[$i]["grado"]." ".$com[$i]["seccion"]),1,0,'C');
	$this->Cell(78,6,utf8_decode(convertir2($com[$i]["meses"])),1,0,'C');   //$this->Cell(93,6,utf8_decode(convertir($com[$i]["meses"])),1,0,'C');
	$this->Cell(20,6,utf8_decode($com[$i]["becado"]),1,0,'C');
	$this->Cell(12,6,utf8_decode($mora = ($com[$i]['cantmora'] == '' ? "0" : $com[$i]['cantmora'])),1,0,'C');
	$this->Cell(22,6,utf8_decode($com[$i]["montopago"]),1,0,'C');
    $this->Cell(22,6,utf8_decode($montoextra = ($com[$i]['montomesextra']== "" ? "0.00" : $com[$i]['montomesextra'])),1,0,'C');
	$this->Cell(25,6,utf8_decode(number_format($total, 2, '.', ',')),1,0,'C');
    $this->Ln();
   }
   
    $this->SetFont('Courier','B',9);  
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->Cell(277,5,'',0,0,'C');
	$this->Cell(34,5,'MONTO TOTAL',1,0,'C', True);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(25,5,utf8_decode(number_format($pagoTotal, 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->SetFont('Courier','B',9);  
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->Cell(277,5,'',0,0,'C');
	$this->Cell(34,5,'EGRESOS',1,0,'C', True);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(25,5,utf8_decode(number_format($egreso[0]['egresos'], 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->SetFont('Courier','B',9);  
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->Cell(277,5,'',0,0,'C');
	$this->Cell(34,5,'TOTAL GEN.',1,0,'C', True);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(25,5,utf8_decode(number_format($pagoTotal-$egreso[0]['egresos'], 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(70,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(70,6,'',0,0,'');
    $this->Ln(11);
     }
######################### FUNCION PARA MOSTRAR REPORTES DE PAGOS GENERALES ###########################

######################### FUNCION PARA MOSTRAR REPORTES DE PAGOS AL DIA ############################
 function TablaListarPagosAlDia()
   {
	$codseccion = $_GET['codseccion'];
	$codturno = $_GET['codturno'];
	$mespago = $_GET['mespago'];
	$codperiodo = $_GET['codperiodo'];		
	
	$logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
   
    $com = new Login();
    $com = $com->BuscarPagosAlDiaReportes();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+42, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(170,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-34, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',9);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(170,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);

	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(255,6,'LISTADO DE PAGOS AL DÍA AL MES DE '.convertir($mespago),0,1,'C');
	$this->Cell(255,6,'TURNO '.utf8_decode($com[0]['turno']).' - NIVEL '.$com[0]['nivel'].' - GRADO '.$com[0]['grado'].' '.$com[0]['seccion'].' - PERIODO '.$com[0]['periodo'],0,0,'C');
	
	$this->Ln(10);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(40,8,'Nº DE DNI',1,0,'C', True);
	$this->Cell(96,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
	$this->Cell(25,8,'BECADO',1,0,'C', True);
	$this->Cell(27,8,'INTERÉS MORA',1,0,'C', True);
	$this->Cell(25,8,'CUOTA MES',1,0,'C', True);
	$this->Cell(35,8,'PAGO TOTAL',1,1,'C', True);
	
	$a=1;
	$pagoTotal=0;
	for($i=0;$i<sizeof($com);$i++){
	$desc=$com[$i]['descuento']/100;
	$calculo=$com[$i]['montopago']+$com[$i]['cantmora']*$com[$i]['interesmora']+$com[0]['cuotaunica'];
	$subtotal= $calculo * $desc;
	$total=$calculo - $subtotal;
	$pagoTotal+=$total;
	$this->SetFont('Courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->Cell(40,6,utf8_decode($com[$i]["cedula"]),1,0,'C');
    $this->Cell(96,6,utf8_decode($com[$i]['pNombre']." ".$com[$i]['sNombre']." ".$com[$i]['pApellido']." ".$com[$i]['sApellido']),1,0,'C');
    $this->Cell(25,6,utf8_decode($com[$i]["becado"]),1,0,'C');
	$this->Cell(27,6,utf8_decode($com[$i]["interesmora"]),1,0,'C');
	$this->Cell(25,6,utf8_decode($com[$i]["montopago"]),1,0,'C');
	$this->Cell(35,6,utf8_decode(number_format($total, 2, '.', ',')),1,0,'C');
    $this->Ln();
   }
   
    $this->SetFont('Courier','B',9);  
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,5,'',0,0,'C');
	$this->Cell(22,5,'',0,0,'C');
    $this->Cell(85,5,'',0,0,'C');
    $this->Cell(30,5,'',0,0,'C');
	$this->Cell(38,5,'',0,0,'C');
	$this->Cell(38,5,'MONTO TOTAL',1,0,'C', True);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(35,5,utf8_decode(number_format($pagoTotal, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(70,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(10,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(70,6,'',0,0,'');
    $this->Ln(11);
     }
######################### FUNCION PARA MOSTRAR REPORTES DE PAGOS AL DIA ############################

####################### FUNCION PARA MOSTRAR REPORTES DE PAGOS VENCIDOS ######################
 function TablaListarPagosVencidos()
   {
	$codseccion = $_GET['codseccion'];
	$codturno = $_GET['codturno'];
	$codperiodo = $_GET['codperiodo'];
	
    $logo = "./assets/images/logo_sm.png";
    $logo2 = "./assets/images/logo.png";
   
    $com = new Login();
    $com = $com->BuscarPagosVencidosReportes();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,22,$this->Image($logo, $this->GetX()+78, $this->GetY()+4, 38),5,0,'L');
	$this->Cell(250,8,'SISTEMA INTEGRADO PARA LA GESTIÓN ACADÉMICA',5,0,'C');
	$this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+1, 22),5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-28,utf8_decode($con[0]['nominstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-21,'NIT: '.utf8_decode($con[0]['codinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-13,'DIREC: '.utf8_decode($con[0]['direcinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,-5,'Nº DE TELÉFONO: '.utf8_decode($con[0]['tlfinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(45,0,'',5,0,'L');
	$this->Cell(250,3,'EMAIL: '.utf8_decode($con[0]['correoinstituto']),5,0,'C');
	$this->Cell(45,0,'',5,0,'L');
	$this->Ln(8);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(332,10,'LISTADO DE PAGOS VENCIDOS TURNO '.utf8_decode($com[0]['turno']).' - NIVEL '.$com[0]['nivel'].' - GRADO '.$com[0]['grado'].' '.$com[0]['seccion'].' - PERIODO '.$com[0]['periodo'],0,0,'C');
	
	$this->Ln();
	$this->SetFont('Courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
	$this->Cell(10,8,'N°',1,0,'C', True);
	$this->Cell(40,8,'Nº DE DNI',1,0,'C', True);
	$this->Cell(85,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
	$this->Cell(23,8,'BECADO',1,0,'C', True);
	$this->Cell(92,8,'MESES VENCIDOS',1,0,'C', True);
	$this->Cell(27,8,'INTERÉS MORA',1,0,'C', True);
	$this->Cell(25,8,'CUOTA MES',1,0,'C', True);
	$this->Cell(30,8,'PAGO TOTAL',1,1,'C', True);
	
	$a=1;
	$pagoTotal=0;
	for($i=0;$i<sizeof($com);$i++){ 
	$pagoTotal+=($com[$i]['montopago']+$com[$i]['interesmora'])*count(explode(", ",$com[$i]['meses']));
	$this->SetFont('Courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->Cell(40,6,utf8_decode($com[$i]["cedula"]),1,0,'C');
    $this->Cell(85,6,utf8_decode($com[$i]['pNombre']." ".$com[$i]['sNombre']." ".$com[$i]['pApellido']." ".$com[$i]['sApellido']),1,0,'C');
	$this->Cell(23,6,utf8_decode($com[$i]["becado"]),1,0,'C');
	$this->Cell(92,6,utf8_decode(convertir2($com[$i]["meses"])),1,0,'C');
	$this->Cell(27,6,utf8_decode($com[$i]["interesmora"]),1,0,'C');
	$this->Cell(25,6,utf8_decode(number_format($com[$i]['montopago'], 2, '.', ',')),1,0,'C');
	$this->Cell(30,6,utf8_decode(number_format(($com[$i]['montopago']+$com[$i]['interesmora'])*count(explode(", ",$com[$i]['meses'])), 2, '.', ',')),1,0,'C');
    $this->Ln();
   }
   
    $this->SetFont('Courier','B',9);  
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,5,'',0,0,'C');
	$this->Cell(22,5,'',0,0,'C');
    $this->Cell(80,5,'',0,0,'C');
    $this->Cell(20,5,'',0,0,'C');
	$this->Cell(25,5,'',0,0,'C');
	$this->Cell(80,5,'',0,0,'C');
	$this->Cell(35,5,'',0,0,'C');
	$this->Cell(30,5,'MONTO TOTAL',1,0,'C', True);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(30,5,utf8_decode(number_format($pagoTotal, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('Courier','B',10);
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'ELABORADO POR: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO POR:______________________________________________',0,0,'');
    $this->Ln();
    $this->Cell(30,6,'',0,0,'');
    $this->Cell(160,6,'FECHA/HORA ELABORACIÓN:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(11);
     }
####################### FUNCION PARA MOSTRAR REPORTES DE PAGOS VENCIDOS ######################

############################# FUNCION PARA MOSTRAR AVISO DE COBRANZA #############################
 function TablaCobranza()
   {
	
	$codseccion = $_GET['codseccion'];
	$codturno = $_GET['codturno'];
	$codperiodo = $_GET['codperiodo'];
   
    $com = new Login();
    $com = $com->BuscarPagosVencidosReportes();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $pagoTotal=0;
	for($i=0;$i<sizeof($com);$i++){ 
	$pagoTotal+=($com[$i]['montopago']+$com[$i]['interesmora'])*count(explode(", ",$com[$i]['meses']));

    //Bloque de membrete principal
    /*$this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 6, 194, 25, '1.5', '');*/

    $this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,0,'AVISO DE COBRANZA',0,1,'C');
	$this->SetFont('Courier','B',8);
	$this->Cell(190,0,'FECHA IMPRESIÓN '. date("d-m-Y"),0,0,'R');
	$this->Ln(5);

    $this->newFlowingBlock( 188, 5, 0, 'J' );
	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock('HACEMOS RECUERDO A USTED POR FAVOR PASAR POR SECRETARÍA A CANCELAR LA(S) CUOTA(S) DE ');

    $this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode(convertir($com[$i]["meses"])));

	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock(' DE SU HIJO(A) ');

	$this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode($com[$i]['pNombre']." ".$com[$i]['sNombre']." ".$com[$i]['pApellido']." ".$com[$i]['sApellido']));

	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock(', DEL ');

	$this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode($com[$i]['grado'].' '.$com[$i]['seccion']));

	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock(' DE ');

	$this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode($com[$i]['nivel']));

	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock(' TURNO ');

	$this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode($com[$i]['turno']));

	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock(' DEL PERIODO ');

	$this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode($com[$i]['periodo']));

	$this->SetFont( 'Arial', '', 8 );
	$this->WriteFlowingBlock(' HACIENDO UN TOTAL DE ');

	$this->SetFont( 'Arial', 'B', 8 );
	$this->WriteFlowingBlock(utf8_decode(number_format(($com[$i]['montopago']+$com[$i]['interesmora'])*count(explode(", ",$com[$i]['meses'])), 2, '.', ',')).' BS.');

	$this->finishFlowingBlock();
	$this->Ln();

	$this->SetFont('Courier','B',10);
	$this->Cell(190,0,'LA DIRECCIÓN',0,0,'C');
	$this->Ln(10);
	

    //$this->AddPage();

       }
}
############################# FUNCION PARA MOSTRAR AVISO DE COBRANZA #############################

###################################### FUNCION PAGOS DE ESTUDIANTES #####################################





















###################################### FUNCION NOTAS DE ESTUDIANTES #####################################

############################# FUNCION PARA MOSTRAR BOLETIN #############################
 function TablaBoletin()
   {
    //Logo
    $logo2 = "./assets/images/logo.png";
    $this->Image($logo2 , 258, 10, 22, 22, "PNG");
   
	$codest = $_GET['codest'];	
    $nota = new Login();
    $nota = $nota->BuscarNotasEstudiantes();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->SetFont('courier','B',22);
    $this->SetFillColor(2,157,116);
    $this->Cell(270,14,'BOLETIN DE INFORMACIÓN EDUCATIVA '.utf8_decode($nota[0]['nivel']),10,1,'C');

    $this->SetFont('courier','B',14);
    $this->Cell(65,8,'APELLIDO Y NOMBRE: ',0,0,'');
    $this->CellFitSpace(205,8,utf8_decode($nota[0]['papeest']." ".$nota[0]['sapeest']." ".$nota[0]['pnomest']." ".$nota[0]['snomest']),0,1,'');

    $this->SetFont('courier','B',14);
    $this->Cell(65,8,'AÑO DE ESCOLARIDAD: ',0,0,'');
    $this->CellFitSpace(50,8,utf8_decode($nota[0]['grado']),0,0,'');
    $this->Cell(30,8,'SECCIÓN: ',0,0,'');
    $this->CellFitSpace(15,8,utf8_decode($nota[0]['seccion']),0,0,'');
    $this->CellFitSpace(112,8,"GESTIÓN: ".utf8_decode($nota[0]['periodo']),0,1,'R');

    $this->SetFont('courier','B',10);
    $this->Cell(270,8,'EVALUACIÓN (SER, SABER, HACER, DECIDIR) ',0,1,'C');


if($nota[0]['nivel']=="INICIAL"){

    $this->SetFont('courier','B',14);
    $this->MultiCellText(80,8,'CAMPOS DE SABERES Y CONOCIMIENTO',1,0,'C');
    $this->SetFont('courier','B',12);
    $this->CellFitSpace(192,6,'VALORACIÓN CUALITATIVA',1,1,'C');

    $this->SetFont('courier','B',12);
    $this->Cell(80,6,'',0,0,'C');
    $this->CellFitSpace(64,10,'PRIMER TRIMESTRE',1,0,'C');
    $this->CellFitSpace(64,10,'SEGUNDO TRIMESTRE',1,0,'C');
    $this->CellFitSpace(64,10,'TERCER TRIMESTRE',1,1,'C');

	/* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(80,64,64,64));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
for($i=0;$i<sizeof($nota);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array(utf8_decode($nota[$i]['nomarea']." - ".$nota[$i]['nommateria']),utf8_decode($nota[$i]["nota1"]),utf8_decode($nota[$i]["nota2"]),utf8_decode($nota[$i]["nota3"])));
   }

} else {

    $this->SetFont('courier','B',14);
    $this->MultiCellText(65,14.5,'CAMPOS DE SABERES Y ÁREAS DE CONOCIMIENTO',1,0,'C');
    $this->MultiCellText(113,29,'ÁREAS CURRICULARES',1,0,'C');
    $this->SetFont('courier','B',10);
    $this->CellFitSpace(96,6,'VALORACIÓN CUALITATIVA',1,1,'C');

    $this->SetFont('courier','B',8);
    $this->Cell(178,6,'',0,0,'C');

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(196,75.5,"1ER TRIMESTRE",90);

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(211,75.5,"2DO TRIMESTRE",90);

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(229,75.5,"3ER TRIMESTRE",90);

    $this->SetFont('courier','B',12);
    $this->CellFitSpace(48,12,'PROMEDIO ANUAL',1,1,'C');

    $this->SetFont('courier','B',10);
    $this->Cell(226,6,'',0,0,'C');
    $this->CellFitSpace(24,11,'NUM',1,0,'C');
    $this->CellFitSpace(24,11,'LIT',1,1,'C');
	
    $SumaTotal=0;
    for($i=0;$i<sizeof($nota);$i++){ 
    $array[] = $nota[$i]['definitiva'];
    $TotalDef=count($array);
    $SumaTotal+=$nota[$i]['definitiva'];

	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	
	$this->CellFitSpace(65,8,utf8_decode($nota[$i]['nomarea']),1,0,'C');
    $this->CellFitSpace(113,8,utf8_decode($nota[$i]['nommateria']),1,0,'C'); 
	$this->SetFont('Courier','',11);

if($nota[$i]["nota1"]<=50 && $nota[$i]["nota1"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(16,8,utf8_decode($nota[$i]["nota1"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(16,8,utf8_decode($nota[$i]["nota1"]),1,0,'C');
}

if($nota[$i]["nota2"]<=50 && $nota[$i]["nota2"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(16,8,utf8_decode($nota[$i]["nota2"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(16,8,utf8_decode($nota[$i]["nota2"]),1,0,'C');
}

if($nota[$i]["nota3"]<=50 && $nota[$i]["nota3"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(16,8,utf8_decode($nota[$i]["nota3"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(16,8,utf8_decode($nota[$i]["nota3"]),1,0,'C');
}


if($nota[$i]["definitiva"]<=50 && $nota[$i]["definitiva"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(24,8,utf8_decode($nota[$i]["definitiva"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(24,8,utf8_decode($nota[$i]["definitiva"]),1,0,'C');
}

	$this->Cell(24,8,utf8_decode(''),1,0,'C');
    $this->Ln();
   }
   $this->Cell(178,8,utf8_decode(""),0,0,'C');
   $this->Cell(48,8,utf8_decode("PROMEDIO FINAL"),0,0,'R');
   $this->Cell(24,8,rount($SumaTotal/$TotalDef,2),0,0,'C');
 
 }//FIN DE ELSE DE NIVEL $this->AddPage();

    $this->Ln(16);
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es blanco) 
    $this->SetFont('Courier','B',10);
    $this->Cell(90,6,'FIRMA MAESTRO/A',0,0,'C');
    $this->Cell(90,6,'FIRMA DIRECTOR/A',0,0,'C');
    $this->Cell(90,6,'SELLO UNIDAD EDUCATIVA',0,0,'C');
    $this->Ln(11);
}
############################# FUNCION PARA MOSTRAR BOLETIN #############################

############################# FUNCION PARA MOSTRAR BOLETIN POR CURSOS #############################
 function TablaBoletaxCursos()
   {
	$codseccion = $_GET['codseccion'];
	$codturno = $_GET['codturno'];

    $not = new Login();
    $not = $not->BuscarNotasxCursos();

    $nota = new Login();
    $nota = $nota->BuscarNotasxCursosDos();

   for($i=0;$i<sizeof($not);$i++){ 
	
    //Logo
    $logo2 = "./assets/images/logo.png";
    $this->Image($logo2 , 258, 10, 22, 22, "PNG");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->SetFont('courier','B',22);
    $this->SetFillColor(2,157,116);
    $this->Cell(270,14,'BOLETIN DE INFORMACIÓN EDUCATIVA '.utf8_decode($not[$i]['nivel']),10,1,'C');

    $this->SetFont('courier','B',14);
    $this->Cell(65,8,'APELLIDO Y NOMBRE: ',0,0,'');
    $this->CellFitSpace(205,8,utf8_decode($not[$i]['papeest']." ".$not[$i]['sapeest']." ".$not[$i]['pnomest']." ".$not[$i]['snomest']),0,1,'');

      $this->SetFont('courier','B',14);
    $this->Cell(65,8,'AÑO DE ESCOLARIDAD: ',0,0,'');
    $this->CellFitSpace(50,8,utf8_decode($not[$i]['grado']),0,0,'');
    $this->Cell(30,8,'SECCIÓN: ',0,0,'');
    $this->CellFitSpace(15,8,utf8_decode($not[$i]['seccion']),0,0,'');
    $this->CellFitSpace(112,8,"GESTIÓN: ".utf8_decode($not[$i]['periodo']),0,1,'R');

    $this->SetFont('courier','B',10);
    $this->Cell(270,8,'EVALUACIÓN (SER, SABER, HACER, DECIDIR) ',0,1,'C');

    /*$nota = new Login();
    $nota = $nota->BuscarNotasxCursosDos();*/

if($nota[$i]['nivel']=="INICIAL"){

    $this->SetFont('courier','B',14);
    $this->MultiCellText(80,8,'CAMPOS DE SABERES Y CONOCIMIENTO',1,0,'C');
    $this->SetFont('courier','B',12);
    $this->CellFitSpace(192,6,'VALORACIÓN CUALITATIVA',1,1,'C');

    $this->SetFont('courier','B',12);
    $this->Cell(80,6,'',0,0,'C');
    $this->CellFitSpace(64,10,'PRIMER TRIMESTRE',1,0,'C');
    $this->CellFitSpace(64,10,'SEGUNDO TRIMESTRE',1,0,'C');
    $this->CellFitSpace(64,10,'TERCER TRIMESTRE',1,1,'C');

	/*$this->SetWidths(array(80,64,64,64));

for($i=0;$i<sizeof($nota);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array(utf8_decode($nota[$i]['nomarea']." - ".$nota[$i]['nommateria']),utf8_decode($nota[$i]["nota1"]),utf8_decode($nota[$i]["nota2"]),utf8_decode($nota[$i]["nota3"])));
   }*/

} else {

    $this->SetFont('courier','B',14);
    $this->MultiCellText(65,14.5,'CAMPOS DE SABERES Y ÁREAS DE CONOCIMIENTO',1,0,'C');
    $this->MultiCellText(113,29,'ÁREAS CURRICULARES',1,0,'C');
    $this->SetFont('courier','B',10);
    $this->CellFitSpace(96,6,'VALORACIÓN CUALITATIVA',1,1,'C');

    $this->SetFont('courier','B',8);
    $this->Cell(178,6,'',0,0,'C');

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(196,75.5,"1ER TRIMESTRE",90);

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(211,75.5,"2DO TRIMESTRE",90);

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(229,75.5,"3ER TRIMESTRE",90);

    $this->SetFont('courier','B',12);
    $this->CellFitSpace(48,12,'PROMEDIO ANUAL',1,1,'C');

    $this->SetFont('courier','B',10);
    $this->Cell(226,6,'',0,0,'C');
    $this->CellFitSpace(24,11,'NUM',1,0,'C');
    $this->CellFitSpace(24,11,'LIT',1,1,'C');
	
	/*for($i=0;$i<sizeof($nota);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->CellFitSpace(65,8,utf8_decode($nota[$i]['nomarea']),1,0,'C');
    $this->CellFitSpace(113,8,utf8_decode($nota[$i]['nommateria']),1,0,'C'); 
	$this->SetFont('Courier','',11);

if($nota[$i]["nota1"]<=50 && $nota[$i]["nota1"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(12,8,utf8_decode($nota[$i]["nota1"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(12,8,utf8_decode($nota[$i]["nota1"]),1,0,'C');
}

if($nota[$i]["nota2"]<=50 && $nota[$i]["nota2"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(12,8,utf8_decode($nota[$i]["nota2"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(12,8,utf8_decode($nota[$i]["nota2"]),1,0,'C');
}

if($nota[$i]["nota3"]<=50 && $nota[$i]["nota3"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(12,8,utf8_decode($nota[$i]["nota3"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(12,8,utf8_decode($nota[$i]["nota3"]),1,0,'C');
}

if($nota[$i]["nota4"]<=50 && $nota[$i]["nota4"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(12,8,utf8_decode($nota[$i]["nota4"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(12,8,utf8_decode($nota[$i]["nota4"]),1,0,'C');
}

if($nota[$i]["definitiva"]<=50 && $nota[$i]["definitiva"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(24,8,utf8_decode($nota[$i]["definitiva"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(24,8,utf8_decode($nota[$i]["definitiva"]),1,0,'C');
}

	$this->Cell(24,8,utf8_decode(''),1,0,'C');
    $this->Ln();
   }*/
   
 
 }//FIN DE ELSE DE NIVEL $this->AddPage();


    $this->Ln(16);
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es blanco) 
    $this->SetFont('Courier','B',10);
    $this->Cell(90,6,'FIRMA MAESTRO/A',0,0,'C');
    $this->Cell(90,6,'FIRMA DIRECTOR/A',0,0,'C');
    $this->Cell(90,6,'SELLO UNIDAD EDUCATIVA',0,0,'C');
    $this->Ln(11);

    $this->AddPage();

       }
}
############################# FUNCION PARA MOSTRAR BOLETIN POR CURSOS #############################

############################# FUNCION PARA MOSTRAR BOLETIN POR PERIODOS #############################
 function TablaBoletaxPeriodo()
   {
    //Logo
    $logo2 = "./assets/images/logo.png";
    $this->Image($logo2 , 258, 10, 22, 22, "PNG");
   
	$codest = $_GET['codest'];	
    $nota = new Login();
    $nota = $nota->BuscarNotasxPeriodos();
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->SetFont('courier','B',22);
    $this->SetFillColor(2,157,116);
    $this->Cell(270,14,'BOLETIN DE INFORMACIÓN EDUCATIVA '.utf8_decode($nota[0]['nivel']),10,1,'C');

    $this->SetFont('courier','B',14);
    $this->Cell(65,8,'APELLIDO Y NOMBRE: ',0,0,'');
    $this->CellFitSpace(205,8,utf8_decode($nota[0]['papeest']." ".$nota[0]['sapeest']." ".$nota[0]['pnomest']." ".$nota[0]['snomest']),0,1,'');

    $this->SetFont('courier','B',14);
    $this->Cell(65,8,'AÑO DE ESCOLARIDAD: ',0,0,'');
    $this->CellFitSpace(50,8,utf8_decode($nota[0]['grado']),0,0,'');
    $this->Cell(30,8,'SECCIÓN: ',0,0,'');
    $this->CellFitSpace(15,8,utf8_decode($nota[0]['seccion']),0,0,'');
    $this->CellFitSpace(112,8,"GESTIÓN: ".utf8_decode($nota[0]['periodo']),0,1,'R');

    $this->SetFont('courier','B',10);
    $this->Cell(270,8,'EVALUACIÓN (SER, SABER, HACER, DECIDIR) ',0,1,'C');


if($nota[0]['nivel']=="INICIAL"){

    $this->SetFont('courier','B',14);
    $this->MultiCellText(80,8,'CAMPOS DE SABERES Y CONOCIMIENTO',1,0,'C');
    $this->SetFont('courier','B',12);
    $this->CellFitSpace(192,6,'VALORACIÓN CUALITATIVA',1,1,'C');

    $this->SetFont('courier','B',12);
    $this->Cell(80,6,'',0,0,'C');
    $this->CellFitSpace(64,10,'PRIMER TRIMESTRE',1,0,'C');
    $this->CellFitSpace(64,10,'SEGUNDO BIMESTRE',1,0,'C');
    $this->CellFitSpace(64,10,'TERCER BIMESTRE',1,1,'C');

	/* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(80,64,64,64));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
for($i=0;$i<sizeof($nota);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array(utf8_decode($nota[$i]['nomarea']." - ".$nota[$i]['nommateria']),utf8_decode($nota[$i]["nota1"]),utf8_decode($nota[$i]["nota2"]),utf8_decode($nota[$i]["nota3"])));
   }

} else {

    $this->SetFont('courier','B',14);
    $this->MultiCellText(65,14.5,'CAMPOS DE SABERES Y ÁREAS DE CONOCIMIENTO',1,0,'C');
    $this->MultiCellText(113,29,'ÁREAS CURRICULARES',1,0,'C');
    $this->SetFont('courier','B',10);
    $this->CellFitSpace(96,6,'VALORACIÓN CUALITATIVA',1,1,'C');

    $this->SetFont('courier','B',8);
    $this->Cell(178,6,'',0,0,'C');

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(196,75.5,"1ER TRIMESTRE",90);

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(211,75.5,"2DO TRIMESTRE",90);

    $this->Cell(16,23,'',1,0,'C');
    $this->TextWithRotation(229,75.5,"3ER TRIMESTRE",90);

    $this->SetFont('courier','B',12);
    $this->CellFitSpace(48,12,'PROMEDIO ANUAL',1,1,'C');

    $this->SetFont('courier','B',10);
    $this->Cell(226,6,'',0,0,'C');
    $this->CellFitSpace(24,11,'NUM',1,0,'C');
    $this->CellFitSpace(24,11,'LIT',1,1,'C');
	
	$SumaTotal=0;
    for($i=0;$i<sizeof($nota);$i++){ 
    $array[] = $nota[$i]['definitiva'];
    $TotalDef=count($array);
    $SumaTotal+=$nota[$i]['definitiva'];

	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	
	$this->CellFitSpace(65,8,utf8_decode($nota[$i]['nomarea']),1,0,'C');
    $this->CellFitSpace(113,8,utf8_decode($nota[$i]['nommateria']),1,0,'C'); 
	$this->SetFont('Courier','',11);

if($nota[$i]["nota1"]<=50 && $nota[$i]["nota1"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(16,8,utf8_decode($nota[$i]["nota1"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(16,8,utf8_decode($nota[$i]["nota1"]),1,0,'C');
}

if($nota[$i]["nota2"]<=50 && $nota[$i]["nota2"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(16,8,utf8_decode($nota[$i]["nota2"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(16,8,utf8_decode($nota[$i]["nota2"]),1,0,'C');
}

if($nota[$i]["nota3"]<=50 && $nota[$i]["nota3"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(16,8,utf8_decode($nota[$i]["nota3"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(16,8,utf8_decode($nota[$i]["nota3"]),1,0,'C');
}


if($nota[$i]["definitiva"]<=50 && $nota[$i]["definitiva"] > 0){
	$this->SetTextColor(255, 0, 0);  // Establece el color del texto (en este caso es rojo)
    $this->Cell(24,8,utf8_decode($nota[$i]["definitiva"]),1,0,'C');
} else {
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es negro) 
    $this->Cell(24,8,utf8_decode($nota[$i]["definitiva"]),1,0,'C');
}

	$this->Cell(24,8,utf8_decode(''),1,0,'C');
    $this->Ln();
   }
   $this->Cell(178,8,utf8_decode(""),0,0,'C');
   $this->Cell(48,8,utf8_decode("PROMEDIO FINAL"),0,0,'R');
   $this->Cell(24,8,rount($SumaTotal/$TotalDef, 2),0,0,'C');
 
 }//FIN DE ELSE DE NIVEL $this->AddPage();/$TotalDef

    $this->Ln(16);
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es blanco) 
    $this->SetFont('Courier','B',10);
    $this->Cell(90,6,'FIRMA MAESTRO/A',0,0,'C');
    $this->Cell(90,6,'FIRMA DIRECTOR/A',0,0,'C');
    $this->Cell(90,6,'SELLO UNIDAD EDUCATIVA',0,0,'C');
    $this->Ln(11);
}
############################# FUNCION PARA MOSTRAR BOLETIN POR PERIODOS #############################

###################################### FUNCION NOTAS DE ESTUDIANTES #####################################










































######################### AQUI COMIENZA CODIGO PARA AJUSTAR TEXTO #########################

########### FUNCION PARA CODIGO DE BARRA CON CODE39 ############
function Code39($x, $y, $code, $ext = true, $cks = false, $w = 0.4, $h = 20, $wide = true) {

    //Display code
    $this->SetFont('Arial', '', 10);
    $this->Text($x, $y+$h+4, $code);

    if($ext) {
        //Extended encoding
        $code = $this->encode_code39_ext($code);
    }
    else {
        //Convert to upper case
        $code = strtoupper($code);
        //Check validity
        if(!preg_match('|^[0-9A-Z. $/+%-]*$|', $code))
            $this->Error('Invalid barcode value: '.$code);
    }

    //Compute checksum
    if ($cks)
        $code .= $this->checksum_code39($code);

    //Add start and stop characters
    $code = '*'.$code.'*';

    //Conversion tables
    $narrow_encoding = array (
        '0' => '101001101101', '1' => '110100101011', '2' => '101100101011', 
        '3' => '110110010101', '4' => '101001101011', '5' => '110100110101', 
        '6' => '101100110101', '7' => '101001011011', '8' => '110100101101', 
        '9' => '101100101101', 'A' => '110101001011', 'B' => '101101001011', 
        'C' => '110110100101', 'D' => '101011001011', 'E' => '110101100101', 
        'F' => '101101100101', 'G' => '101010011011', 'H' => '110101001101', 
        'I' => '101101001101', 'J' => '101011001101', 'K' => '110101010011', 
        'L' => '101101010011', 'M' => '110110101001', 'N' => '101011010011', 
        'O' => '110101101001', 'P' => '101101101001', 'Q' => '101010110011', 
        'R' => '110101011001', 'S' => '101101011001', 'T' => '101011011001', 
        'U' => '110010101011', 'V' => '100110101011', 'W' => '110011010101', 
        'X' => '100101101011', 'Y' => '110010110101', 'Z' => '100110110101', 
        '-' => '100101011011', '.' => '110010101101', ' ' => '100110101101', 
        '*' => '100101101101', '$' => '100100100101', '/' => '100100101001', 
        '+' => '100101001001', '%' => '101001001001' );

    $wide_encoding = array (
        '0' => '101000111011101', '1' => '111010001010111', '2' => '101110001010111', 
        '3' => '111011100010101', '4' => '101000111010111', '5' => '111010001110101', 
        '6' => '101110001110101', '7' => '101000101110111', '8' => '111010001011101', 
        '9' => '101110001011101', 'A' => '111010100010111', 'B' => '101110100010111', 
        'C' => '111011101000101', 'D' => '101011100010111', 'E' => '111010111000101', 
        'F' => '101110111000101', 'G' => '101010001110111', 'H' => '111010100011101', 
        'I' => '101110100011101', 'J' => '101011100011101', 'K' => '111010101000111', 
        'L' => '101110101000111', 'M' => '111011101010001', 'N' => '101011101000111', 
        'O' => '111010111010001', 'P' => '101110111010001', 'Q' => '101010111000111', 
        'R' => '111010101110001', 'S' => '101110101110001', 'T' => '101011101110001', 
        'U' => '111000101010111', 'V' => '100011101010111', 'W' => '111000111010101', 
        'X' => '100010111010111', 'Y' => '111000101110101', 'Z' => '100011101110101', 
        '-' => '100010101110111', '.' => '111000101011101', ' ' => '100011101011101', 
        '*' => '100010111011101', '$' => '100010001000101', '/' => '100010001010001', 
        '+' => '100010100010001', '%' => '101000100010001');

    $encoding = $wide ? $wide_encoding : $narrow_encoding;

    //Inter-character spacing
    $gap = ($w > 0.29) ? '00' : '0';

    //Convert to bars
    $encode = '';
    for ($i = 0; $i< strlen($code); $i++)
        $encode .= $encoding[$code[$i]].$gap;

    //Draw bars
    $this->draw_code39($encode, $x, $y, $w, $h);
}

function checksum_code39($code) {

    //Compute the modulo 43 checksum

    $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
                            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 
                            'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 
                            'W', 'X', 'Y', 'Z', '-', '.', ' ', '$', '/', '+', '%');
    $sum = 0;
    for ($i=0 ; $i<strlen($code); $i++) {
        $a = array_keys($chars, $code[$i]);
        $sum += $a[0];
    }
    $r = $sum % 43;
    return $chars[$r];
}

function encode_code39_ext($code) {

    //Encode characters in extended mode

    $encode = array(
        chr(0) => '%U', chr(1) => '$A', chr(2) => '$B', chr(3) => '$C', 
        chr(4) => '$D', chr(5) => '$E', chr(6) => '$F', chr(7) => '$G', 
        chr(8) => '$H', chr(9) => '$I', chr(10) => '$J', chr(11) => '£K', 
        chr(12) => '$L', chr(13) => '$M', chr(14) => '$N', chr(15) => '$O', 
        chr(16) => '$P', chr(17) => '$Q', chr(18) => '$R', chr(19) => '$S', 
        chr(20) => '$T', chr(21) => '$U', chr(22) => '$V', chr(23) => '$W', 
        chr(24) => '$X', chr(25) => '$Y', chr(26) => '$Z', chr(27) => '%A', 
        chr(28) => '%B', chr(29) => '%C', chr(30) => '%D', chr(31) => '%E', 
        chr(32) => ' ', chr(33) => '/A', chr(34) => '/B', chr(35) => '/C', 
        chr(36) => '/D', chr(37) => '/E', chr(38) => '/F', chr(39) => '/G', 
        chr(40) => '/H', chr(41) => '/I', chr(42) => '/J', chr(43) => '/K', 
        chr(44) => '/L', chr(45) => '-', chr(46) => '.', chr(47) => '/O', 
        chr(48) => '0', chr(49) => '1', chr(50) => '2', chr(51) => '3', 
        chr(52) => '4', chr(53) => '5', chr(54) => '6', chr(55) => '7', 
        chr(56) => '8', chr(57) => '9', chr(58) => '/Z', chr(59) => '%F', 
        chr(60) => '%G', chr(61) => '%H', chr(62) => '%I', chr(63) => '%J', 
        chr(64) => '%V', chr(65) => 'A', chr(66) => 'B', chr(67) => 'C', 
        chr(68) => 'D', chr(69) => 'E', chr(70) => 'F', chr(71) => 'G', 
        chr(72) => 'H', chr(73) => 'I', chr(74) => 'J', chr(75) => 'K', 
        chr(76) => 'L', chr(77) => 'M', chr(78) => 'N', chr(79) => 'O', 
        chr(80) => 'P', chr(81) => 'Q', chr(82) => 'R', chr(83) => 'S', 
        chr(84) => 'T', chr(85) => 'U', chr(86) => 'V', chr(87) => 'W', 
        chr(88) => 'X', chr(89) => 'Y', chr(90) => 'Z', chr(91) => '%K', 
        chr(92) => '%L', chr(93) => '%M', chr(94) => '%N', chr(95) => '%O', 
        chr(96) => '%W', chr(97) => '+A', chr(98) => '+B', chr(99) => '+C', 
        chr(100) => '+D', chr(101) => '+E', chr(102) => '+F', chr(103) => '+G', 
        chr(104) => '+H', chr(105) => '+I', chr(106) => '+J', chr(107) => '+K', 
        chr(108) => '+L', chr(109) => '+M', chr(110) => '+N', chr(111) => '+O', 
        chr(112) => '+P', chr(113) => '+Q', chr(114) => '+R', chr(115) => '+S', 
        chr(116) => '+T', chr(117) => '+U', chr(118) => '+V', chr(119) => '+W', 
        chr(120) => '+X', chr(121) => '+Y', chr(122) => '+Z', chr(123) => '%P', 
        chr(124) => '%Q', chr(125) => '%R', chr(126) => '%S', chr(127) => '%T');

    $code_ext = '';
    for ($i = 0 ; $i<strlen($code); $i++) {
        if (ord($code[$i]) > 127)
            $this->Error('Invalid character: '.$code[$i]);
        $code_ext .= $encode[$code[$i]];
    }
    return $code_ext;
}

function draw_code39($code, $x, $y, $w, $h) {

    //Draw bars

    for($i=0; $i<strlen($code); $i++) {
        if($code[$i] == '1')
            $this->Rect($x+$i*$w, $y, $w, $h, 'F');
    }
}


########### FUNCION PARA CODIGO DE BARRA CON EAN13 ############
function EAN13($x, $y, $barcode, $h=16, $w=.35)
{
 $this->Barcode($x,$y,$barcode,$h,$w,13);
}
function UPC_A($x, $y, $barcode, $h=16, $w=.35)
{
 $this->Barcode($x,$y,$barcode,$h,$w,12);
}
function GetCheckDigit($barcode)
{
 //Compute the check digit
 $sum=0;
 for($i=1;$i<=11;$i+=2)
 $sum+=3*$barcode[$i];
 for($i=0;$i<=10;$i+=2)
 $sum+=$barcode[$i];
 $r=$sum%10;
 if($r>0)
 $r=10-$r;
 return $r;
}
function TestCheckDigit($barcode)
{
 //Test validity of check digit
 $sum=0;
 for($i=1;$i<=11;$i+=2)
 $sum+=3*$barcode[$i];
 for($i=0;$i<=10;$i+=2)
 $sum+=$barcode[$i];
 return ($sum+$barcode[12])%10==0;
}
function Barcode($x, $y, $barcode, $h, $w, $len)
{
 //Padding
 $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
 if($len==12)
 $barcode='0'.$barcode;
 //Add or control the check digit
 if(strlen($barcode)==12)
 $barcode.=$this->GetCheckDigit($barcode);
 elseif(!$this->TestCheckDigit($barcode))
 $this->Error('Incorrect check digit');
 //Convert digits to bars
 $codes=array(
 'A'=>array(
 '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
 '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
 'B'=>array(
 '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
 '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
 'C'=>array(
 '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
 '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
 );
 $parities=array(
 '0'=>array('A','A','A','A','A','A'),
 '1'=>array('A','A','B','A','B','B'),
 '2'=>array('A','A','B','B','A','B'),
 '3'=>array('A','A','B','B','B','A'),
 '4'=>array('A','B','A','A','B','B'),
 '5'=>array('A','B','B','A','A','B'),
 '6'=>array('A','B','B','B','A','A'),
 '7'=>array('A','B','A','B','A','B'),
 '8'=>array('A','B','A','B','B','A'),
 '9'=>array('A','B','B','A','B','A')
 );
 $code='101';
 $p=$parities[$barcode[0]];
 for($i=1;$i<=6;$i++)
 $code.=$codes[$p[$i-1]][$barcode[$i]];
 $code.='01010';
 for($i=7;$i<=12;$i++)
 $code.=$codes['C'][$barcode[$i]];
 $code.='101';
 //Draw bars
 for($i=0;$i<strlen($code);$i++)
 {
 if($code[$i]=='1')
 $this->Rect($x+$i*$w,$y,$w,$h,'F');
 }
 //Print text uder barcode
 $this->SetFont('Arial','',12);
 $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}



########### FUNCION PARA CREAR MULTICELL SIN SALTO DE LINEA ############
function SetWidths($w)
{
//Set the array of column widths
$this->widths=$w;
}

function SetAligns($a)
{
//Set the array of column alignments
$this->aligns=$a;
}

function Row($data)
{
//Calculate the height of the row
$nb=0;
for($i=0;$i<count($data);$i++)
$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
$h=5*$nb;
//Issue a page break first if needed
$this->CheckPageBreak($h);
//Draw the cells of the row
for($i=0;$i<count($data);$i++)
{
$w=$this->widths[$i];
$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
//Save the current position
$x=$this->GetX();
$y=$this->GetY();
//Draw the border
$this->Rect($x,$y,$w,$h);
//Print the text
$this->MultiCell($w,5,$data[$i],0,$a);
//Put the position to the right of the cell
$this->SetXY($x+$w,$y);
}
//Go to the next line
$this->Ln($h);
}

function CheckPageBreak($h)
{
//If the height h would cause an overflow, add a new page immediately
if($this->GetY()+$h>$this->PageBreakTrigger)
$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
//Computes the number of lines a MultiCell of width w will take
$cw=&$this->CurrentFont['cw'];
if($w==0)
$w=$this->w-$this->rMargin-$this->x;
$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
$s=str_replace("\r",'',$txt);
$nb=strlen($s);
if($nb>0 and $s[$nb-1]=="\n")
$nb--;
$sep=-1;
$i=0;
$j=0;
$l=0;
$nl=1;
while($i<$nb)
{
$c=$s[$i];
if($c=="\n")
{
$i++;
$sep=-1;
$j=$i;
$l=0;
$nl++;
continue;
}
if($c==' ')
$sep=$i;
$l+=$cw[$c];
if($l>$wmax)
{
if($sep==-1)
{
if($i==$j)
$i++;
}
else
$i=$sep+1;
$sep=-1;
$j=$i;
$l=0;
$nl++;
}
else
$i++;
}
return $nl;
}
########### FUNCION PARA CREAR MULTICELL SIN SALTO DE LINEA ############

function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
	// Calculate MultiCell with automatic or explicit line breaks height
	// $border is un-used, but I kept it in the parameters to keep the call
	//   to this function consistent with MultiCell()
	$cw = &$this->CurrentFont['cw'];
	if($w==0)
		$w = $this->w-$this->rMargin-$this->x;
	$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
	$s = str_replace("\r",'',$txt);
	$nb = strlen($s);
	if($nb>0 && $s[$nb-1]=="\n")
		$nb--;
	$sep = -1;
	$i = 0;
	$j = 0;
	$l = 0;
	$ns = 0;
	$height = 0;
	while($i<$nb)
	{
		// Get next character
		$c = $s[$i];
		if($c=="\n")
		{
			// Explicit line break
			if($this->ws>0)
			{
				$this->ws = 0;
				$this->_out('0 Tw');
			}
			//Increase Height
			$height += $h;
			$i++;
			$sep = -1;
			$j = $i;
			$l = 0;
			$ns = 0;
			continue;
		}
		if($c==' ')
		{
			$sep = $i;
			$ls = $l;
			$ns++;
		}
		$l += $cw[$c];
		if($l>$wmax)
		{
			// Automatic line break
			if($sep==-1)
			{
				if($i==$j)
					$i++;
				if($this->ws>0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				//Increase Height
				$height += $h;
			}
			else
			{
				if($align=='J')
				{
					$this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
				}
				//Increase Height
				$height += $h;
				$i = $sep+1;
			}
			$sep = -1;
			$j = $i;
			$l = 0;
			$ns = 0;
		}
		else
			$i++;
	}
	// Last chunk
	if($this->ws>0)
	{
		$this->ws = 0;
		$this->_out('0 Tw');
	}
	//Increase Height
	$height += $h;

	return $height;
}

function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false)
{
    // Store reset values for (x,y) positions
    $x = $this->GetX() + $w;
    $y = $this->GetY();

    // Make a call to FPDF's MultiCell
    $this->MultiCell($w,$h,$text,$border,$align,$fill);

    // Reset the line position to the right, like in Cell
    if( $ln==0 )
    {
        $this->SetXY($x,$y);
    }
}


function MultiCellText($w, $h, $txt, $border=0, $ln=0, $align='J', $fill=false)
{
    // Custom Tomaz Ahlin
    if($ln == 0) {
        $current_y = $this->GetY();
        $current_x = $this->GetX();
    }

    // Output text with automatic or explicit line breaks
    $cw = &$this->CurrentFont['cw'];
    if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
    $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
    $s = str_replace("\r",'',$txt);
    $nb = strlen($s);
    if($nb>0 && $s[$nb-1]=="\n")
        $nb--;
    $b = 0;
    if($border)
    {
        if($border==1)
        {
            $border = 'LTRB';
            $b = 'LRT';
            $b2 = 'LR';
        }
        else
        {
            $b2 = '';
            if(strpos($border,'L')!==false)
                $b2 .= 'L';
            if(strpos($border,'R')!==false)
                $b2 .= 'R';
            $b = (strpos($border,'T')!==false) ? $b2.'T' : $b2;
        }
    }
    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $ns = 0;
    $nl = 1;
    while($i<$nb)
    {
        // Get next character
        $c = $s[$i];
        if($c=="\n")
        {
            // Explicit line break
            if($this->ws>0)
            {
                $this->ws = 0;
                $this->_out('0 Tw');
            }
            $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
            $i++;
            $sep = -1;
            $j = $i;
            $l = 0;
            $ns = 0;
            $nl++;
            if($border && $nl==2)
                $b = $b2;
            continue;
        }
        if($c==' ')
        {
            $sep = $i;
            $ls = $l;
            $ns++;
        }
        $l += $cw[$c];
        if($l>$wmax)
        {
            // Automatic line break
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
                if($this->ws>0)
                {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
            }
            else
            {
                if($align=='J')
                {
                    $this->ws = ($ns>1) ?     ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                    $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                }
                $this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
                $i = $sep+1;
            }
            $sep = -1;
            $j = $i;
            $l = 0;
            $ns = 0;
            $nl++;
            if($border && $nl==2)
                $b = $b2;
        }
        else
            $i++;
    }
    // Last chunk
    if($this->ws>0)
    {
        $this->ws = 0;
        $this->_out('0 Tw');
    }
    if($border && strpos($border,'B')!==false)
        $b .= 'B';
    $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
    $this->x = $this->lMargin;

    // Custom Tomaz Ahlin
    if($ln == 0) {
        $this->SetXY($current_x + $w, $current_y);
    }
}


function RoundedRect($x, $y, $w, $h, $r, $style = '')
	{
		$k = $this->k;
		$hp = $this->h;
		if($style=='F')
			$op='f';
		elseif($style=='FD' || $style=='DF')
			$op='B';
		else
			$op='S';
		$MyArc = 4/3 * (sqrt(2) - 1);
		$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
		$xc = $x+$w-$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

		$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
		$xc = $x+$w-$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
		$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
		$xc = $x+$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
		$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
		$xc = $x+$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
		$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
		$this->_out($op);
	}

	function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
	{
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
			$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
	}


    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)

    {

        //Get string width

        $str_width=$this->GetStringWidth($txt);


        //Calculate ratio to fit cell

        if($w==0)

            $w = $this->w-$this->rMargin-$this->x;

        $ratio = ($w-$this->cMargin*2)/$str_width;


        $fit = ($ratio < 1 || ($ratio > 1 && $force));

        if ($fit)

        {

            if ($scale)

            {

                //Calculate horizontal scaling

                $horiz_scale=$ratio*100.0;

                //Set horizontal scaling

                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));

            }

            else

            {

                //Calculate character spacing in points

                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;

                //Set character spacing

                $this->_out(sprintf('BT %.2F Tc ET',$char_space));

            }

            //Override user alignment (since text will fill up cell)

            $align='';

        }


        //Pass on to Cell method

        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);


        //Reset character spacing/horizontal scaling

        if ($fit)

            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');

    }


    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')

    {

        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);

    }


    //Patch to also work with CJK double-byte text

    function MBGetStringLength($s)

    {

        if($this->CurrentFont['type']=='Type0')

        {

            $len = 0;

            $nbbytes = strlen($s);

            for ($i = 0; $i < $nbbytes; $i++)

            {

                if (ord($s[$i])<128)

                    $len++;

                else

                {

                    $len++;

                    $i++;

                }

            }

            return $len;

        }

        else

            return strlen($s);

    }

########################## FIN DEL CODIGO PARA AJUSTAR TEXTO EN CELDAS ###############################

function saveFont()
	{

		$saved = array();

		$saved[ 'family' ] = $this->FontFamily;
		$saved[ 'style' ] = $this->FontStyle;
		$saved[ 'sizePt' ] = $this->FontSizePt;
		$saved[ 'size' ] = $this->FontSize;
		$saved[ 'curr' ] =& $this->CurrentFont;

		return $saved;

	}

	function restoreFont( $saved )
	{

		$this->FontFamily = $saved[ 'family' ];
		$this->FontStyle = $saved[ 'style' ];
		$this->FontSizePt = $saved[ 'sizePt' ];
		$this->FontSize = $saved[ 'size' ];
		$this->CurrentFont =& $saved[ 'curr' ];

		if( $this->page > 0)
			$this->_out( sprintf( 'BT /F%d %.2F Tf ET', $this->CurrentFont[ 'i' ], $this->FontSizePt ) );

	}

	function newFlowingBlock( $w, $h, $b = 0, $a = 'J', $f = 0 )
	{

		// cell width in points
		$this->flowingBlockAttr[ 'width' ] = $w * $this->k;

		// line height in user units
		$this->flowingBlockAttr[ 'height' ] = $h;

		$this->flowingBlockAttr[ 'lineCount' ] = 0;

		$this->flowingBlockAttr[ 'border' ] = $b;
		$this->flowingBlockAttr[ 'align' ] = $a;
		$this->flowingBlockAttr[ 'fill' ] = $f;

		$this->flowingBlockAttr[ 'font' ] = array();
		$this->flowingBlockAttr[ 'content' ] = array();
		$this->flowingBlockAttr[ 'contentWidth' ] = 0;

	}

	function finishFlowingBlock()
	{

		$maxWidth =& $this->flowingBlockAttr[ 'width' ];

		$lineHeight =& $this->flowingBlockAttr[ 'height' ];

		$border =& $this->flowingBlockAttr[ 'border' ];
		$align =& $this->flowingBlockAttr[ 'align' ];
		$fill =& $this->flowingBlockAttr[ 'fill' ];

		$content =& $this->flowingBlockAttr[ 'content' ];
		$font =& $this->flowingBlockAttr[ 'font' ];

		// set normal spacing
		$this->_out( sprintf( '%.3F Tw', 0 ) );

		// print out each chunk

		// the amount of space taken up so far in user units
		$usedWidth = 0;

		foreach ( $content as $k => $chunk )
		{

			$b = '';

			if ( is_int( strpos( $border, 'B' ) ) )
				$b .= 'B';

			if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
				$b .= 'L';

			if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
				$b .= 'R';

			$this->restoreFont( $font[ $k ] );

			// if it's the last chunk of this line, move to the next line after
			if ( $k == count( $content ) - 1 )
				$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
			else
				$this->Cell( $this->GetStringWidth( $chunk ), $lineHeight, $chunk, $b, 0, $align, $fill );

			$usedWidth += $this->GetStringWidth( $chunk );

		}

	}

	function WriteFlowingBlock( $s )
	{

		// width of all the content so far in points
		$contentWidth =& $this->flowingBlockAttr[ 'contentWidth' ];

		// cell width in points
		$maxWidth =& $this->flowingBlockAttr[ 'width' ];

		$lineCount =& $this->flowingBlockAttr[ 'lineCount' ];

		// line height in user units
		$lineHeight =& $this->flowingBlockAttr[ 'height' ];

		$border =& $this->flowingBlockAttr[ 'border' ];
		$align =& $this->flowingBlockAttr[ 'align' ];
		$fill =& $this->flowingBlockAttr[ 'fill' ];

		$content =& $this->flowingBlockAttr[ 'content' ];
		$font =& $this->flowingBlockAttr[ 'font' ];

		$font[] = $this->saveFont();
		$content[] = '';

		$currContent =& $content[ count( $content ) - 1 ];

		// where the line should be cutoff if it is to be justified
		$cutoffWidth = $contentWidth;

		// for every character in the string
		for ( $i = 0; $i < strlen( $s ); $i++ )
		{

			// extract the current character
			$c = $s[ $i ];

			// get the width of the character in points
			$cw = $this->CurrentFont[ 'cw' ][ $c ] * ( $this->FontSizePt / 1000 );

			if ( $c == ' ' )
			{

				$currContent .= ' ';
				$cutoffWidth = $contentWidth;

				$contentWidth += $cw;

				continue;

			}

			// try adding another char
			if ( $contentWidth + $cw > $maxWidth )
			{

				// won't fit, output what we have
				$lineCount++;

				// contains any content that didn't make it into this print
				$savedContent = '';
				$savedFont = array();

				// first, cut off and save any partial words at the end of the string
				$words = explode( ' ', $currContent );

				// if it looks like we didn't finish any words for this chunk
				if ( count( $words ) == 1 )
				{

					// save and crop off the content currently on the stack
					$savedContent = array_pop( $content );
					$savedFont = array_pop( $font );

					// trim any trailing spaces off the last bit of content
					$currContent =& $content[ count( $content ) - 1 ];

					$currContent = rtrim( $currContent );

				}

				// otherwise, we need to find which bit to cut off
				else
				{

					$lastContent = '';

					for ( $w = 0; $w < count( $words ) - 1; $w++)
						$lastContent .= "{$words[ $w ]} ";

					$savedContent = $words[ count( $words ) - 1 ];
					$savedFont = $this->saveFont();

					// replace the current content with the cropped version
					$currContent = rtrim( $lastContent );

				}

				// update $contentWidth and $cutoffWidth since they changed with cropping
				$contentWidth = 0;

				foreach ( $content as $k => $chunk )
				{

					$this->restoreFont( $font[ $k ] );

					$contentWidth += $this->GetStringWidth( $chunk ) * $this->k;

				}

				$cutoffWidth = $contentWidth;

				// if it's justified, we need to find the char spacing
				if( $align == 'J' )
				{

					// count how many spaces there are in the entire content string
					$numSpaces = 0;

					foreach ( $content as $chunk )
						$numSpaces += substr_count( $chunk, ' ' );

					// if there's more than one space, find word spacing in points
					if ( $numSpaces > 0 )
						$this->ws = ( $maxWidth - $cutoffWidth ) / $numSpaces;
					else
						$this->ws = 0;

					$this->_out( sprintf( '%.3F Tw', $this->ws ) );

				}

				// otherwise, we want normal spacing
				else
					$this->_out( sprintf( '%.3F Tw', 0 ) );

				// print out each chunk
				$usedWidth = 0;

				foreach ( $content as $k => $chunk )
				{

					$this->restoreFont( $font[ $k ] );

					$stringWidth = $this->GetStringWidth( $chunk ) + ( $this->ws * substr_count( $chunk, ' ' ) / $this->k );

					// determine which borders should be used
					$b = '';

					if ( $lineCount == 1 && is_int( strpos( $border, 'T' ) ) )
						$b .= 'T';

					if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
						$b .= 'L';

					if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
						$b .= 'R';

					// if it's the last chunk of this line, move to the next line after
					if ( $k == count( $content ) - 1 )
						$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
					else
					{

						$this->Cell( $stringWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 0, $align, $fill );
						$this->x -= 2 * $this->cMargin;

					}

					$usedWidth += $stringWidth;

				}

				// move on to the next line, reset variables, tack on saved content and current char
				$this->restoreFont( $savedFont );

				$font = array( $savedFont );
				$content = array( $savedContent . $s[ $i ] );

				$currContent =& $content[ 0 ];

				$contentWidth = $this->GetStringWidth( $currContent ) * $this->k;
				$cutoffWidth = $contentWidth;

			}

			// another character will fit, so add it on
			else
			{

				$contentWidth += $cw;
				$currContent .= $s[ $i ];

			}

		}

	}
	
	########### FUNCION PARA CODIGO DE BARRA CON CODABAR ############
	function Codabar($xpos, $ypos, $code, $start='A', $end='A', $basewidth=0.12, $height=10) {
	$barChar = array (
		'0' => array (6.5, 4.4, 6.5, 3.4, 6.5, 7.3, 2.9),
		'1' => array (6.5, 4.4, 6.5, 8.4, 4.9, 4.3, 6.5),
		'2' => array (6.5, 4.0, 6.5, 9.4, 6.5, 3.0, 8.6),
		'3' => array (17.9, 24.3, 6.5, 6.4, 6.5, 3.4, 6.5),
		'4' => array (6.5, 2.4, 8.9, 6.4, 6.5, 4.3, 6.5),
		'5' => array (5.9,	2.4, 6.5, 6.4, 6.5, 4.3, 6.5),
		'6' => array (6.5, 8.3, 6.5, 6.4, 6.5, 6.4, 7.9),
		'7' => array (6.5, 8.3, 6.5, 2.4, 7.9, 6.4, 6.5),
		'8' => array (6.5, 8.3, 5.9, 10.4, 6.5, 6.4, 6.5),
		'9' => array (7.6, 5.0, 6.5, 8.4, 6.5, 3.0, 6.5),
		'$' => array (6.5, 5.0, 18.6, 24.4, 6.5, 10.0, 6.5),
		'-' => array (6.5, 5.0, 6.5, 4.4, 8.6, 10.0, 6.5),
		':' => array (16.7, 9.3, 6.5, 9.3, 16.7, 9.3, 14.7),
		'/' => array (14.7, 9.3, 16.7, 9.3, 6.5, 9.3, 16.7),
		'.' => array (13.6, 10.1, 14.9, 10.1, 17.2, 10.1, 6.5),
		'+' => array (6.5, 10.1, 17.2, 10.1, 14.9, 10.1, 13.6),
		'A' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
		'T' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
		'B' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
		'N' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
		'C' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
		'*' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
		'D' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
		'E' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
	);
	$this->SetFont('Arial','',8.5);
	$this->SetTextColor(3, 3, 3);  // Establece el color del texto (en este caso es blanco 259)
	$this->Text($xpos, $ypos + $height + 2, $code);
	$this->SetFillColor(0);
	$code = strtoupper($start.$code.$end);
	for($i=0; $i<strlen($code); $i++){
		$char = $code[$i];
		if(!isset($barChar[$char])){
			$this->Error('Invalid character in barcode: '.$char);
		}
		$seq = $barChar[$char];
		for($bar=0; $bar<7; $bar++){
			$lineWidth = $basewidth*$seq[$bar]/4;
			if($bar % 2 == 0){
				$this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
			}
			$xpos += $lineWidth;
		}
		$xpos += $basewidth*10.4/6.5;
	}
}

   function TextWithDirection($x, $y, $txt, $direction='R')
{
    if ($direction=='R')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', 1, 0, 0, 1, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    elseif ($direction=='L')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', -1, 0, 0, -1, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    elseif ($direction=='U')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', 0, 1, -1, 0, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    elseif ($direction=='D')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', 0, -1, 1, 0, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    else
        $s=sprintf('BT %.2F %.2F Td (%s) Tj ET', $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
{
    $font_angle+=90+$txt_angle;
    $txt_angle*=M_PI/180;
    $font_angle*=M_PI/180;

    $txt_dx=cos($txt_angle);
    $txt_dy=sin($txt_angle);
    $font_dx=cos($font_angle);
    $font_dy=sin($font_angle);

    $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', $txt_dx, $txt_dy, $font_dx, $font_dy, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}
 // FIN Class PDF
}
?>