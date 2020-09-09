<?php 
include "../../vendor/autoload.php";
ini_set('display_errors', 'On');
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try{
$file = $_GET['file'];
//try{
// verificamos que se haya cargado el nombre del archivo
if($file){

// levanta contenido del archivo enviado en '$file'
ob_start();
require_once $file;
$html = ob_get_clean();
//print $html;
//creamos un nuevo objeto html2pdf
$html2pdf = new Html2Pdf('L', 'A4', 'es');
$html2pdf->writeHTML($html);
$html2pdf->output('informe.pdf');
}
}catch(Html2PdfException $e){
$html2pdf->clean();
$formatter = new ExceptionFormatter($e);
echo $formatter->getHtmlMessage();
error_reporting(E_ALL);
}

?>