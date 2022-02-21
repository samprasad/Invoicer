<?php
/* Code to generate pdf */ 
include_once 'dompdf/autoload.inc.php';  
use Dompdf\Dompdf;       // reference the Dompdf namespace   
if(isset($_POST['generate'])) {       

    $discount = 0;
    if(isset($_POST['discount'])) {
        $discount = $_POST['discount'];
    }
    if(isset($_POST['invoiceNumber'])) {
        $invoiceNumber = $_POST['invoiceNumber'];  
    }
    //invoiceNumber
    $dompdf   = new Dompdf();  // instantiate and use the dompdf class 

    if(isset($_SESSION['itemsArray'])) {
        $itemsArray = $_SESSION['itemsArray'];
    } 
    include_once "functions/loopdata.php";    
    $html_pdf = "";
    $html_pdf = "<html>
    <head>
        <script src='https://code.jquery.com/jquery-3.6.0.js'></script>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>
    </head>
    <body>
    <h3>Invoice #". $invoiceNumber ."</h3> 
    <table class='table table-bordered'> 
    <tr class='success'>
        <th>Item Name</th>
        <th>Item Quantity</th>
        <th>Item Price</th>
        <th>Item Tax</th>
        <th>Line Total</th>
        <th>Line Total whithout tax</th> 
        <th>Line Total with tax</th>    
    </tr>".loopThroughItems($itemsArray,$discount)."</table> 
    </body>
    </html>";       

    $dompdf->loadHtml($html_pdf);
 
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');    
    // Render the HTML as PDF
    $dompdf->render();   
    $filename = "Invoice_".$invoiceNumber . '.pdf';
    // Output the generated PDF to Browser
    $dompdf->stream($filename); 
    exit; 
} 
?>