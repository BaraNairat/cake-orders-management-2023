<?php
    session_start();
    if(!isset($_SESSION['userInfo'])) {
        header('location:login.php');
    }
    
    include('conn.php');
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
            
            //echo($customerName.' '.$customerPhone.' '.$numberOfPieces.' '.$flavorId.' '.$decorId.' '.$price.' '.$statusId.' '.$deliveryDate);
            $myQuery = mysqli_query( $con,"insert into orders(customerName,customerPhone,numberOfPieces,flavorId,decorId, price, statusId, deliveryDate) ".
            "values('$customerName', '$customerPhone', $numberOfPieces, $flavorId, $decorId, $price, $statusId, '$deliveryDate');" )
            or die('Error');
            
            //header('location:index.php', true, 307); // back to index page
            echo("<script>  window.location.href = 'index.php'; </script>"); // back to index page
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
    <title>Create Order</title>
</head>
<body>
    <?php include('navBar.php'); ?>

    <div class = 'container'>
    <form method = 'POST'>
        <div class = "row">
            <div class = 'col-md-6'>
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name='customerName' placeholder="Customer Name" value = <?php if(isset($_POST['save'])) echo($_POST['customerName']); ?>>
                    <small id="customerNameHelp" class="form-text text-danger"><?php echo($customerNameError); ?></small>
                </div>

                <div class="form-group">
                    <label for="customerPhone">Customer Phone</label>
                    <input type="phone" class="form-control" id="customerPhone" name='customerPhone' placeholder="Customer Phone" value = <?php if(isset($_POST['save'])) echo($_POST['customerPhone']); ?>>
                    <small id="customerPhoneHelp" class="form-text text-danger"><?php echo($customerPhoneError); ?></small>
                </div>

                <div class="form-group">
                    <label for="numberOfPieces">Number Of Pieces</label>
                    <input type="number" class="form-control" id="numberOfPieces" name="numberOfPieces" placeholder="Number Of Pieces" value = <?php if(isset($_POST['save'])) echo($_POST['numberOfPieces']); ?>>
                    <small id="numberOfPiecesHelp" class="form-text text-danger"><?php echo($numberOfPiecesError); ?></small>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name = "price" placeholder="Price" value = <?php if(isset($_POST['save'])) echo($_POST['price']); ?>>
                    <small id="priceHelp" class="form-text text-danger"><?php echo($priceError); ?></small>
                </div>
            </div>
            <div class = 'col-md-6'>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sm-11">
                            <label for="flavor">Flavor</label>
                            <select class="form-select" aria-label="Default select example" id= "flavor" name = "flavor">
                                <option value = "0">-- Please Select Flavor --</option>
                                <?php 
                                    $myQuery = mysqli_query($con,"SELECT * FROM flavor");
                                    while( $row = mysqli_fetch_array($myQuery))
                                    {
                                        $selected = "";
                                        if(isset($_POST['save'])) { 
                                            if($_POST['flavor'] == $row[0]) $selected = " selected";
                                        }
                                        echo("<option value='".$row[0]."'".$selected.">".$row[1]."</option>");
                                    }                    
                                ?>
                                
                            </select>
                            <small id="flavorHelp" class="form-text text-danger"><?php echo($flavorIdError); ?></small>                            
                        </div>
                        <div class = "col-sm-1" style = "padding-top: 6.5%;padding-left: 0%;">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
            
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
                                if(isset($_POST['save'])) { 
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
                                if(isset($_POST['save'])) { 
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
                    <input type="datetime-local" class="form-control" id="deliveryDate" name = "deliveryDate" placeholder="delivery Date" value = <?php if(isset($_POST['save'])) echo($_POST['deliveryDate']); ?>>
                    <small id="deliveryDateHelp" class="form-text text-danger"><?php echo($deliveryDateError); ?></small>
                </div>
            </div>
            <div class = "col-md-6">
                <button type="submit" class="btn btn-primary" name='save'><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
        </form>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method = "POST" id = "flavorForm">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Flavor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="flavorName" class="col-form-label">Flavor Name</label>
                    <input type="text" class="form-control" id="flavorName" name = "flavorName">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id = "saveFlavor" name = "saveFlavor" onclick="saveData()" type="button" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </form>
    </div>
  </div>
</div>
<?php
    if(isset($_POST['flavorName'])) {
        if($_POST['flavorName'] != ''){
            saveFlavor($_POST['flavorName']);
        }
    }
    function saveFlavor($flavorName) {
        $myQuery = mysqli_query( $con,"insert into flavor (flavorName) values('$flavorName');" )
                    or die('Error');
        $output = array();
        $output[] = "message ".$flavorName;
        return json_encode($output);
    }
?>
</body>
</html>
<script>
    function saveData() {
        var name = document.getElementById('flavorName').value;
        var url = '/your/url';
        var formData = new FormData();
        formData.append('flavorName', name);

        fetch("createOrder.php", { method: 'POST', body: formData })
        .then(function (response) { return response.text();})
        .then(function (body) { console.log(body); });
        // fetch('createOrder.php', {
        //     method: 'POST',
        //     headers: {
        //         'Accept': 'application/json',
        //         'Content-Type': 'application/json'
        //     },
        //     body: JSON.stringify({ "flavorName": "78912" })
        // });
    }

</script>