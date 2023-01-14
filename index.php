<?php 
    include('conn.php'); 
    session_start();
    if(!isset($_SESSION['userInfo'])) {
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('headers.php'); ?>
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-family: Montserrat, sans-serif;
        }
        .navbar {
            margin-bottom: 2%;
        }
        .navbar-brand {
            background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgZGF0YS1uYW1lPSJMYXllciAxIiBpZD0iTGF5ZXJfMSIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZmlsbD0id2hpdGUiIGQ9Ik01MDQuMzMsNDQ5Yy0xLjc3LTYuOC00NC43My0xNjcuNTItMTY0LjIxLTIzMi45MS00NC42NS0yNC40My05Ni4yLTQxLjQ1LTE0Ni01Ny45MUMxMTUsMTMyLjA4LDQwLjI5LDEwNy40MiwyNiw1OS42NWE2LjIyLDYuMjIsMCwwLDAtMTIsLjI0Yy0uOSwzLjUtMjEuNTMsODYuMzgsMTUuNjUsMTM3Ljk0LDE2LjgsMjMuMjksNDIuNjYsMzYuMzMsNzYuODUsMzguNzUsMi44OC4yLDUuNjEuNDIsOC40NC42Myw0LjE1LDE1LjE2LDIyLjE0LDYwLjYzLDg5LjYxLDY2LDEyLjI1LDEsMjQuMTcsMi4yNSwzNS45LDMuNjUsNC45MiwxNC4xNiwyNi44NCw1Ny42LDExNCw3My4wNyw2Mi43OCwxMS4xNCwxMTQsMzEuMTgsMTMxLjIxLDUxLjI1LDQuMzksMTIuNjgsNi41MywyMC42Miw2LjYzLDIxYTYuMiw2LjIsMCwwLDAsNiw0LjY1LDYuNTYsNi41NiwwLDAsMCwxLjU3LS4yQTYuMjMsNi4yMywwLDAsMCw1MDQuMzMsNDQ5Wk0zOS43NCwxOTAuNThDMTYsMTU3LjczLDE4Ljc1LDEwOC41MiwyMi41NSw4MS44M2MyNi4wNyw0MS40Myw5Mi4zNCw2My4zMSwxNjcuNjIsODguMTYsNDkuMzIsMTYuMjksMTAwLjMzLDMzLjEzLDE0NCw1NywzMS40NiwxNy4yMSw1Ny41Myw0MS44LDc4LjgsNjguNDRDMzcyLDI2OS4zOCwzMDUuNTgsMjM4LjIyLDEwNy4zNSwyMjQuMTgsNzcsMjIyLDU0LjI4LDIxMC43MywzOS43NCwxOTAuNThabTg4LjM2LDQ3LjY0YzIwMi4zOCwxNi40MiwyNTQuMzYsNTEuNDYsMjkyLjY0LDc3LjI4LDQuMzYsMi45NSw4LjU4LDUuOCwxMi44NCw4LjUxLDUuMDksNy43Nyw5LjgxLDE1LjU1LDE0LjE4LDIzLjIyLTM4LjM3LTE5Ljc4LTExNS42OS00MS40Mi0yMDEuMTktNTIuMTUtLjE0LDAtLjI5LDAtLjQ0LS4wNi0xMy4zOS0xLjY3LTI2Ljk0LTMuMTMtNDAuNjEtNC4yMkMxNTAuNDksMjg2LjQzLDEzMy4yMSwyNTMuNTMsMTI4LjEsMjM4LjIyWk0zNTYuNjMsMzY3LjY4Yy03MC44My0xMi41Ny05NC41MS00My43OS0xMDItNTkuMTEsMTEwLjI0LDE0Ljg3LDE5Mi43Nyw0Ni4yNywyMDUuNjEsNjIsNi43NSwxMy41NSwxMi4yOSwyNi4yNSwxNi44MSwzNy41QzQ1MS4xLDM5MS40OSw0MDcuOTQsMzc2Ljc4LDM1Ni42MywzNjcuNjhaIi8+PC9zdmc+");
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            width: 48px;
            height: 48px;
        }
        
        .navbar-nav .nav-item:hover {
            background-color: rgba(180, 190, 203, 0.4);
        }
        .middleContent {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <?php include('navBar.php'); ?>
    <div class='container'>
        <form method = "GET">
            <div class = "row">
                <div class = "col-md-5">
                    <div class="d-flex">
                        <button name = "searchBtn" class="btn btn-primary" type="submit">Search </button>
                        <input class="border border-3 border-top-0 border-start-0 border-end-0" 
                            value = "<?php if(isset($_GET['searchBtn'])) echo($_GET['search']); ?>" name = "search" type="search" placeholder="Search" aria-label="Search" style=" outline: none;">
                    </div>
                </div>
                <div class = "col-md-3">                
                    <label for="status">Status</label>
                    <select class="form-select" aria-label="Default select example" id= "status" name = "status">
                        <option value = "0">-- Please Select Status --</option>
                        <?php 
                            $myQuery = mysqli_query($con,"SELECT * FROM statuses");
                            while( $row = mysqli_fetch_array($myQuery))
                            {
                                $selected = "";
                                if($_GET['status'] == $row[0]) $selected = " selected";
                                echo("<option value='".$row[0]."'".$selected.">".$row[1]."</option>");
                            }                        
                        ?>
                    </select>
                </div>
                <div class = "col-md-3">
                <label for="deliveryDate">Delivery Date</label>
                    <input type="datetime-local" class="form-control" id="deliveryDate" name = "deliveryDate" placeholder="delivery Date" value = <?php if(isset($_GET['searchBtn'])) echo($_GET['deliveryDate']); ?>>
                </div>
            </div>
        </form>
        <br>
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Created Date</th>
            <th scope="col">Order No</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer Phone</th>
            <th scope="col">Peices No</th>
            <th scope="col">Flavor</th>
            <th scope="col">Decor</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Delivery Date</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT o.createdDate, o.id, o.customerName, o.customerPhone, o.numberOfPieces, f.flavorName, de.decorName, o.price, st.id, st.statusName, o.deliveryDate "
                ."FROM orders o JOIN flavor AS f ON o.flavorId = f.id JOIN decors AS de ON o.decorId = de.id JOIN statuses AS st ON o.statusId = st.id ";
                
                if(isset($_GET['searchBtn'])) {
                    //$search  = '';
                    $search  = $_GET['search'];
                    $statusId = $_GET['status'];
                    $deliveryDate = $_GET['deliveryDate'];
                    if($deliveryDate != '') {
                        $_GET['deliveryDate'] =  date("Y-m-d H:i", strtotime($deliveryDate));
                        $_GET['deliveryDate'] = str_replace(" ","T",$_GET['deliveryDate']);
                    }
                    //echo("Baroooa ". $search."<br>");
                    if($search != '' || $statusId != 0 || $deliveryDate != '')
                        $sql = $sql ." WHERE ";

                    if($search != '')
                        $sql = $sql ."(o.customerName like '%$search%' OR o.customerPhone like '%$search%') ";
                    if($statusId != 0) {
                        if($search != '')
                            $sql = $sql ." AND ";
                        $sql = $sql ." o.statusId like '%$statusId%' ";
                    }
                    if($deliveryDate != '') {
                        if($search != '' || $statusId != 0)
                            $sql = $sql ." AND ";
                        $deliveryDate = str_replace("T"," ",$deliveryDate);
                        $sql = $sql ." o.deliveryDate like '%$deliveryDate%' ";
                    }
                        
                    //echo($sql);
                
                }
                $sql = $sql ."ORDER BY o.id DESC";
                $result = mysqli_query($con,$sql);
                while( $row = mysqli_fetch_array($result)) {
                    ?>
                    <tr 
                    style = "background-color: <?php 
                    if($row[8] == 2)
                        echo('#FFF112; color: #404040'); 
                    else if($row[8] == 3)
                        echo('#8DC15C; color: #404040'); 
                    else if ($row[8] == 4)
                        echo('#A4A5A5; color: #404040'); 
                    else if ($row[8] == 5)
                        echo('#E02A1B; color: white'); 
                    ?>">
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[0]); ?> </th>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[1]); ?> </th>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[2]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[3]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[4]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[5]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[6]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[7]. ' $' ); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[9]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'><?php echo($row[10]); ?></td>
                        <td style = 'vertical-align: middle; font-weight: bold'> <a href="editOrder.php?id=<?php echo($row[1]); ?>" class= "btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> </td>
                    </tr>
             <?php } ?>
        </tbody>
        </table>
    </div>
</body>
</html>