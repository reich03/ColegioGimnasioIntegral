<?php
include_once('fpdf/pdf.php');

require_once("class/class.php");

ob_start();

$casos = array (

                  'USUARIOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarUsuarios',

                                    'output' => array('Listado de Usuarios.pdf', 'I')

                                  ),

                  'LOGS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLogs',

                                    'output' => array('Listado Logs de Acceso.pdf', 'I')

                                  ),


                  'ARQUEOSGENERAL' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarArqueos',

                                    'output' => array('Listado de Arqueo de Cajas.pdf', 'I')

                                  ),


                  'ARQUEOSXFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarArqueosFechas',

                                    'output' => array('Listado de Arqueos por Fechas.pdf', 'I')

                                  ),


                  'MOVIMIENTOSGENERAL' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarMovimientos',

                                    'output' => array('Listado de Movimientos de Cajas.pdf', 'I')

                                  ),

                  'MOVIMIENTOSXFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarMovimientosFechas',

                                    'output' => array('Listado de Movimientos por Fechas.pdf', 'I')

                                  ),
        
                   'MATERIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarMaterias',

                                    'output' => array('Listado de Materias.pdf', 'I')

                                  ),
        
                   'MATERIASXCURSOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarMateriasCursos',

                                    'output' => array('Listado de Materias.pdf', 'I')

                                  ),

                  'DOCENTES' => array(

                                    'medidas' => array('L', 'mm', 'LETTER'),

                                    'func' => 'TablaListarDocentes',

                                    'output' => array('Listado de Docentes.pdf', 'I')

                                  ),

                  'ASIGNACIONES' => array(

                                    'medidas' => array('L', 'mm', 'LETTER'),

                                    'func' => 'TablaListarAsignaciones',

                                    'output' => array('Listado de Asignaciones de Materias.pdf', 'I')

                                  ),

                  'ASIGNACIONESXDOCENTES' => array(

                                    'medidas' => array('L', 'mm', 'LETTER'),

                                    'func' => 'TablaListarAsignacionesxDocentes',

                                    'output' => array('Listado de Asignaciones de Materias por Docentes.pdf', 'I')

                                  ),
				
				'ESTUDIANTESXCURSOS' => array(

                                    'medidas' => array('L', 'mm', 'LETTER'),

                                    'func' => 'TablaListarEstudiantes',

                                    'output' => array('Listado de Estudiantes.pdf', 'I')

                                  ),
				
				'REPRESENTANTESXCURSOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarRepresentantes',

                                    'output' => array('Listado de Representantes.pdf', 'I')

                                  ),

                  'COMPROBANTE' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaComprobante',

                                    'output' => array('Comprobante de Pagos.pdf', 'I')

                                  ),

                  'COMPROBANTEPAGOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaComprobantePagos',

                                    'output' => array('Comprobante de Pagos.pdf', 'I')

                                  ),
				
				'PAGOSFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarPagosFechas',

                                    'output' => array('Listado de Pagos Generales.pdf', 'I')

                                  ),
				
				'PAGOSALDIA' => array(

                                    'medidas' => array('L', 'mm', 'LETTER'),

                                    'func' => 'TablaListarPagosAlDia',

                                    'output' => array('Listado de Pagos Por Mes.pdf', 'I')

                                  ),
				
				'PAGOSVENCIDOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarPagosVencidos',

                                    'output' => array('Listado de Pagos Vencidos.pdf', 'I')

                                  ),
                  
          'AVISOCOBRANZA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaCobranza',

                                    'output' => array('Aviso de Cobranza.pdf', 'I')

                                  ),

                  'BOLETA' => array(

                                    'medidas' => array('L', 'mm', 'A4'),

                                    'func' => 'TablaBoletin',

                                    'output' => array('Boletin.pdf', 'I')

                                  ),

                  'BOLETAXCURSOS' => array(

                                    'medidas' => array('L', 'mm', 'A4'),

                                    'func' => 'TablaBoletaxCursos',

                                    'output' => array('Boletin General.pdf', 'I')

                                  ),

                  'BOLETAXPERIODO' => array(

                                    'medidas' => array('L', 'mm', 'A4'),

                                    'func' => 'TablaBoletaxPeriodo',

                                    'output' => array('Boletin x Periodo.pdf', 'I')

                                  ),
								  
				  'ESTADISTICAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'MuestraGrafica',

                                    'output' => array('Grafico de Ventas Anual.pdf', 'I')

                                  ),

                );

 
$tipo = base64_decode($_GET['tipo']);
$caso_data = $casos[$tipo];
$pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
$pdf->AddPage();
$pdf->SetAuthor("Ing. Ruben Chirinos");
$pdf->SetCreator("FPDF Y PHP");
$pdf->{$caso_data['func']}();
$pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
ob_end_flush();
?>