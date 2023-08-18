<?php
class MYPDF extends TCPDF {

    public function Header() {

        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();     
    }

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(15);
        // Set font
        $this->SetFont('helvetica', 'I', 9);
        // Page number
        $this->Cell(205, 0, '', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, PDO::SQLSRV_ENCODING_UTF8, false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Felipe Alves');
$pdf->SetTitle('Listagem de PDF');
$pdf->SetSubject('Listagem de PDF');
$pdf->SetKeywords('Listagem de PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 10, '', false);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$html = '
<style>
  th{
      margin-top: 15px;
      margin-right: 15px;
      margin-left: 5px;
  }
</style>';

$html .= '      <br><br><br>
                <h2 align="center"> Documento em PDF </h2>';

$html .= '<table>
            <tr>
                <td>                 
                    <table align="center">';    

$html .=' <tr>
             <th border="1"><b>Id</b></th>
             <th border="1"><b>Texto PDF</b></th>
             <th border="1"><b>Tipo</b></th>
          </tr> ';

          foreach ($PDF as $value){
$html .=' <tr>
             <th border="1">'.$value['TEXTOID'].'</th>
             <th border="1">'.$value['TEXTO'].'</th>
             <th border="1">'.$value['TIPO'].'</th>        
          </tr>';
          }
                    
$html .=   '  </table>

                </td>
            </tr>
        </table>';
                  
//$pdf->writeHTML($html, true, 0, true, true);
$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Cartão de Autógrafo.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>