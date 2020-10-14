<?php
    class Pdfexample extends CI_Controller{ 
    function __construct()
    { parent::__construct(); } 

    function index() {
    $this->load->library('Pdf');
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
     // ob_start();
    $pdf->SetTitle('Pdf Example');
    $pdf->SetHeaderMargin(10);
    $pdf->SetTopMargin(10);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetSubject('check');

    $pdf->SetDisplayMode('real', 'default');
    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
    $pdf->SetFont("helvetica", '', 10);
 $pdf->setBarcode('kami');
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

$pdf->AddPage();


// create some HTML content
$html = '<h1 style="font-style: italic;">Ghazi University, Dera Ghazi Khan</h1>
<h2>List</h2>
List example:
<ol>
    <li><b>bold text</b></li>
    <li><i>italic text</i></li>
    <li><u>underlined text</u></li>
    <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
    <li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
    <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
    <li>SUBLIST
        <ol>
            <li>row one
                <ul>
                    <li>sublist</li>
                </ul>
            </li>
            <li>row two</li>
        </ol>
    </li>
    <li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
    <li><font size="+3">font + 3</font></li>
    <li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
</ol>
</div>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
 
$pdf->lastPage();
    // ob_end_clean();
    $pdf->Output('pdfexample1.pdf', 'I'); }
    }


    // https://www.tutsway.com/codeignitertcpdf.php
    ?>
