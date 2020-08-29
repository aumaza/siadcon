<?php include "../../vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\src\Exception\Html2PdfException;
use Spipu\Html2Pdf\src\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\src\Exception\ImageException;
use Spipu\Html2Pdf\src\Exception\TableException;

$file = $_GET['file'];


// verificamos que se haya cargado el nombre del archivo
if($file){
// levanta contenido del archivo enviado en '$file'
ob_start();
require_once $file;
$html = ob_get_clean();
}

//creamos un nuevo objeto html2pdf
$html2pdf = new Html2Pdf('L', 'A4', 'es');
$html2pdf->writeHTML($html);
$html2pdf->output('informe.pdf');

?>