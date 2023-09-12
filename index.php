<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "generate_invoice_number";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn) {
    echo "";
} 

$query = "select invoice_id from sales order by invoice_id desc";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$last_id = $row["invoice_id"];
if($last_id == " "){

    $emp_id ="E-001";
    

}
else{
    $emp_id = substr($last_id, 3);
    
    $emp_id = intval($emp_id);
    
    $emp_id = "EMP".($emp_id + 1);
}
?>
<?php  

if(isset($_POST['submit'])){

    $invoice_id = $_POST['invoice_id'];
    $product_name = $_POST['invoice_product'];
    $price = $_POST['invoice_price'];

    
    $query_insert = "insert into `sales` (`invoice_id`, `product_name`, `price`) values('$invoice_id', '$product_name', '$price')";
    $result_insert = mysqli_query($conn, $query_insert);
    if($result_insert==true){
    
        echo 'inserted data';

    }else{
        echo "failed";
    }

}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="index.php" method="POST">
                    <h1>Generate Invoice Number</h1>
                    <label class="form-label">Invoice No </label>
                    <input type="text" name="invoice_id" id="invoice_id" class="form-control" value="<?php echo $emp_id; ?>" readonly style="color:red"/>
                    <label class="form-label">Product Name </label>
                    <input type="text" name="invoice_product" id="invoice_product" class="form-control" />
                    <label class="form-label">Price</label>
                    <input type="number" name="invoice_price" id="invoice_price" class="form-control" />
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" id="btn" value="submit" name="submit"/>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>

</html>