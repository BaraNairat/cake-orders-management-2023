
<?php
    session_start();
    if(!isset($_SESSION['userInfo'])) {
        header('location:login.php');
    }
    
    include('conn.php');

    $orderId = $_GET['id'];

    $customerNameError = "";
    $customerPhoneError = "";
    $numberOfPiecesError = "";
    $decorIdError = "";
    $flavorIdError = "";
    $priceError = "";
    $statusIdError = "";
    $deliveryDateError = "";

    if(isset($_POST['save'])) {
        $customerName = $_POST['customerName'];
        $customerPhone = $_POST['customerPhone'];
        $numberOfPieces = $_POST['numberOfPieces'];
        $flavorId = $_POST['flavor'];
        $decorId = $_POST['decor'];
        $statusId = $_POST['status'];
        $price = $_POST['price'];
        $deliveryDate = $_POST['deliveryDate'];

        $errorResult = true;

        if("$customerName" === "") {
            $customerNameError = "Customer Name Required";
            $errorResult = false;
        } else if(strlen("$customerName") > 50) {
            $customerNameError = "Customer name must be at most 50 characters";
            $errorResult = false;
        }
        if("$customerPhone" === "") {
            $customerPhoneError = "Customer Phone Required";
            $errorResult = false;
        } else if(preg_match("/^05(9[987542]|6[982])\d{6}$/", $customerPhone) == 0) {
            $customerPhoneError = "Not valid customer phone ";
            $errorResult = false;
        }
        if("$numberOfPieces" === "") {
            $numberOfPiecesError = "Number Of Pieces Required";
            $errorResult = false;
        } else if("$numberOfPieces" < 1 || "$numberOfPieces" > 2000) {
            $numberOfPiecesError = "Number of pieces must be between 1 to 2000";
            $errorResult = false;
        }
        if("$flavorId" === "0") {
            $flavorIdError = "Flavor Required";
            $errorResult = false;
        }
        if("$decorId" === "0") {
            $decorIdError = "Decor Required";
            $errorResult = false;
        }
        if("$statusId" === "0") {
            $statusIdError = "Status Required";
            $errorResult = false;
        }
        if("$price" === "") {
            $priceError = "Price Required";
            $errorResult = false;
        } else if("$price" < 1 || "$price" > 200 ) {
            $priceError = "Price must be between 1 to 200";
            $errorResult = false;
        }
        if("$deliveryDate" === "") {
            $deliveryDateError = "Delivery Date Required";
            $errorResult = false;
        }
        if($errorResult === true){    
            
            //echo($customerName.' '.$customerPhone.' '.$numberOfPieces.' '.$flavorId.' '.$decorId.' '.$price.' '.$statusId.' '.$deliveryDate .' '. $orderId);
            $myQuery = mysqli_query( $con,"UPDATE orders SET customerName = '$customerName',customerPhone = '$customerPhone',numberOfPieces = $numberOfPieces,flavorId = $flavorId,".
            "decorId = $decorId, price = $price, statusId = $statusId, deliveryDate = '$deliveryDate' WHERE id = $orderId;" )
            or die('Error');
            
            //header('location:index.php', true, 307); // back to index page
            echo("<script>  window.location.href = 'index.php'; </script>"); // back to index page
        }
    } else {
        $myQuery = mysqli_query($con,"SELECT o.createdDate, o.id, o.customerName, o.customerPhone, o.numberOfPieces, f.id, de.id, o.price, st.id, o.deliveryDate ".
        "FROM orders o JOIN flavor AS f ON o.flavorId = f.id JOIN decors AS de ON o.decorId = de.id JOIN statuses AS st ON o.statusId = st.id where o.id = ".$orderId );
        if( $row = mysqli_fetch_array($myQuery)) {
            $_POST['customerName'] = $row[2];
            $_POST['customerPhone'] = $row[3];
            $_POST['numberOfPieces'] = $row[4];
            $_POST['flavor'] = $row[5];
            $_POST['decor'] = $row[6];
            $_POST['price'] = $row[7];
            $_POST['status'] = $row[8];
            $_POST['deliveryDate'] =  date("Y-m-d H:i", strtotime($row[9]));
            $_POST['deliveryDate'] = str_replace(" ","T",$_POST['deliveryDate']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('headers.php'); ?>
    <title>Edit</title>
</head>
<body>
    <?php include('navBar.php'); ?>
    <div class = 'container'>
        <form method = 'POST'>
            <div class = "row">
                <div class = 'col-md-6'>
                    <div class="form-group">
                        <label for="customerName">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" name='customerName' placeholder="Customer Name" value = <?php echo($_POST['customerName']); ?>>
                        <small id="customerNameHelp" class="form-text text-danger"><?php echo($customerNameError); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="customerPhone">Customer Phone</label>
                        <input type="phone" class="form-control" id="customerPhone" name='customerPhone' placeholder="Customer Phone" value = <?php echo($_POST['customerPhone']); ?>>
                        <small id="customerPhoneHelp" class="form-text text-danger"><?php echo($customerPhoneError); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="numberOfPieces">Number Of Pieces</label>
                        <input type="number" class="form-control" id="numberOfPieces" name="numberOfPieces" placeholder="Number Of Pieces" value = <?php echo($_POST['numberOfPieces']); ?>>
                        <small id="numberOfPiecesHelp" class="form-text text-danger"><?php echo($numberOfPiecesError); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name = "price" placeholder="Price" value = <?php echo($_POST['price']); ?>>
                        <small id="priceHelp" class="form-text text-danger"><?php echo($priceError); ?></small>
                    </div>
                </div>
                <div class = "col-md-6">
                <div class="form-group">
                        <label for="flavor">Flavor</label>
                        <select class="form-select" aria-label="Default select example" id= "flavor" name = "flavor">
                            <option value = "0">-- Please Select Flavor --</option>
                            <?php 
                                $myQuery = mysqli_query($con,"SELECT * FROM flavor");
                                while( $row = mysqli_fetch_array($myQuery))
                                {
                                    $selected = "";
                                { 
                                        if($_POST['flavor'] == $row[0]) $selected = " selected";
                                    }
                                    echo("<option value='".$row[0]."'".$selected.">".$row[1]."</option>");
                                }                    
                            ?>
                        </select>
                        <small id="flavorHelp" class="form-text text-danger"><?php echo($flavorIdError); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="decor">Decor</label>
                        <select class="form-select" aria-label="Default select example" id= "decor" name = "decor">
                            <option value = "0">-- Please Select Decore --</option>
                            <?php 
                                $myQuery = mysqli_query($con,"SELECT * FROM decors");
                                while( $row = mysqli_fetch_array($myQuery))
                                {
                                    $selected = "";
                                { 
                                        if($_POST['decor'] == $row[0]) $selected = " selected";
                                    }
                                    echo("<option value='".$row[0]."'".$selected.">".$row[1]."</option>");
                                }                      
                            ?>
                        </select>
                        <small id="decorHelp" class="form-text text-danger"><?php echo($decorIdError); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" aria-label="Default select example" id= "status" name = "status">
                            <option value = "0">-- Please Select Status --</option>
                            <?php 
                                $myQuery = mysqli_query($con,"SELECT * FROM statuses");
                                while( $row = mysqli_fetch_array($myQuery))
                                {
                                    $selected = "";
                                { 
                                        if($_POST['status'] == $row[0]) $selected = " selected";
                                    }
                                    echo("<option value='".$row[0]."'".$selected.">".$row[1]."</option>");
                                }                        
                            ?>
                        </select>
                        <small id="statusHelp" class="form-text text-danger"><?php echo($statusIdError); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="deliveryDate">Delivery Date</label>
                        <input type="datetime-local" class="form-control" id="deliveryDate" name = "deliveryDate" placeholder="delivery Date" value = <?php echo($_POST['deliveryDate']); ?>>
                        <small id="deliveryDateHelp" class="form-text text-danger"><?php echo($deliveryDateError); ?></small>
                    </div>
                    
                </div>
                <div class = "col-md-6">
                    <button type="submit" class="btn btn-primary" name='save'><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>