<html>
    <head>
        <title>Invoice create</title> 
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            function addNewRow(e){ 
                var wrapper         = $("#items_table"); //Fields wrapper
                e.preventDefault(); 
                $(wrapper).append('<tr><td><input type="text" placeholder="Item Name" name="item_name[]" id="" required></td><td><input type="number" min="1" placeholder="Item Quantity" name="item_quantity[]" id="" required></td><td><input type="number" placeholder="Item Price" name="item_price[]" id="" required></td><td><select name="item_tax[]" id=""><option value="1">0 %</option><option value="0.01">1 %</option><option value="0.05">5 %</option><option value="0.1">10 %</option></select></td><td><button id="addbtn" onclick="addNewRow(event)" class="add_field_button">ADD</button><button name="remove" id="remove">REMOVE</button></td></tr>'); //add input box          
            }
            $(document).ready(function() { 
                var wrapper         = $("#items_table"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
            
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    addNewRow(e);  
                });
            
                $(wrapper).on("click","#remove", function(e){ //user click on remove text
                    let text = "Remove item?"; 
                    e.preventDefault(); 
                    if (confirm(text) == true) {
                        $(this).parent().parent().remove(); //x--; 
                    } else {
                        return;
                    }
                })
            });     
        </script>
    </head>
    <body>
        <center> 
        <h3>Invoice generation</h3>
        <form action="invoice.php" method="post">
            <table id="items_table" class="table table-hover">
                <tr class="success">
                    <th>Item Name</th>
                    <th>Item Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th> 
                    <th>Add / remove</th>      
                </tr>   
                <tr>
                    <td>
                        <input type="text" placeholder="Item Name" name="item_name[]" id="" required>
                    </td>
                    <td> 
                        <input type="number" min="1" placeholder="Item Quantity" name="item_quantity[]" id="" required> 
                    </td>
                    <td>
                        <input type="number" placeholder="Item Price" name="item_price[]" id="" required>
                    </td>
                    <td>
                        <select name="item_tax[]" id="" required>
                            <option value="0">0 %</option>  
                            <option value="0.01">1 %</option>
                            <option value="0.05">5 %</option> 
                            <option value="0.1">10 %</option> 
                        </select>
                    </td>
                    <td>
                        <button id="addbtn" class="add_field_button">ADD</button> 
                    </td>
                </tr> 
            </table>
            <input type="number" name="discount" id="" placeholder="Total discount %">
            <br /> <br /><br />
            <input class="btn-primary" type="submit" value="Calculate">
        </form>
        </center>
    </body>
</html>  