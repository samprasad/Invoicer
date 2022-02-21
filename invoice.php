<?php
session_start();
include_once "pdfgenerate.php";  // code for pdf generation 
if(isset($_POST['item_name']) && isset($_POST['item_quantity']) && isset($_POST['item_price']) && isset($_POST['item_tax'])) { 

    $itemNamesArray      = $_POST['item_name'];  
    $itemQuantitiesArray = $_POST['item_quantity'];  
    $itemPricesArray     = $_POST['item_price'];
    $itemTaxesArray      = $_POST['item_tax'];
    $discount            = 0; //set default discount as 0 
    if(isset($_POST['discount'])) {
        $discount        = $_POST['discount'];   
    }

    $itemsArray = array();  
    /* rearrage indexes of items Array */ 
    $arrayIndex = 0;
    foreach($itemNamesArray as $item) {
        $itemsArray[$arrayIndex] = array('item_name'=>$itemNamesArray[$arrayIndex],'item_quantity'=>$itemQuantitiesArray[$arrayIndex],'item_price'=>$itemPricesArray[$arrayIndex],'item_tax'=>$itemTaxesArray[$arrayIndex] );   
        $arrayIndex++;
    }
    /* End rearrage */
    $_SESSION['itemsArray'] = $itemsArray; // saved in session variable since array cant be posted for pdf
    include_once "functions/loopdata.php";   
    $invoiceNumber = rand();
?> 
<html>
    <head>
        <title>Generate Invoice</title>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h3>Invoice #<?php echo $invoiceNumber; ?></h3>
        <table class="table table-bordered">
            <tr class="success"> 
                <th>Item Name</th>
                <th>Item Quantity</th>
                <th>Item Price</th>
                <th>Item Tax</th>
                <th>Line Total</th>
                <th>Line Total whithout tax</th>
                <th>Line Total with tax</th>  
            </tr>
            <?php echo loopThroughItems($itemsArray,$discount); ?> 
        </table>
        <center>
        <form action="invoice.php" method="post">
            <input type="hidden" name="discount" value="<?php echo $discount; ?>"> 
            <input type="hidden" name="invoiceNumber" value="<?php echo $invoiceNumber; ?>"> 
            <input style="text-align: right;" class="btn-primary float-right" type="submit" name="generate" value="Generate Invoice"> 
        </form>
        <button class="float-left"><a href="index.php" style="text-decoration: none;">BACK</a></button> 
        </center>
    </body>
</html>
<?php } ?>