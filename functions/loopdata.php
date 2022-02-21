<?php
/* Function to loop through items array and combine html data */  
function loopThroughItems($itemsArray,$discount) {

    $dynamicHtml     = "";
    $subTotal        = 0;     
    $discountAmount  = 0;
    if($discount==0){
        $discountPercent = 0;
    } else {
        $discountPercent = $discount/100;
    }

    foreach ($itemsArray as $item) {
        $linetotal      = $item['item_quantity']*$item['item_price']*$item['item_tax']+$item['item_quantity']*$item['item_price'];
        $subTotal       = $subTotal + $linetotal;  
        $discountAmount = $subTotal*$discountPercent;    
        $total          = $subTotal - $discountAmount;    
        $dynamicHtml .= "
            <tr>
            <td>". $item['item_name'] ."</td>
            <td>". $item['item_quantity'] ."</td>
            <td>". $item['item_price'] ."</td>
            <td>". $item['item_tax']*100 ." %</td> 

            <td>". $item['item_quantity']*$item['item_price'] ."</td> 
            <td>". $item['item_quantity']*$item['item_price'] ."</td> 
            <td>". $linetotal ."</td>    
            </tr>";
    }

    $dynamicHtml .= "
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td>Sub Total:</td><td>". $subTotal ."</td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td>Discount ". $discount ." %:</td><td>-". $discountAmount ."</td> 
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td>Total:</td><td>". $total ."</td>
    </tr>"; 
    return $dynamicHtml; 
} 
?>