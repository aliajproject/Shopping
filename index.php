<?php

session_start();

include 'my_connect.php';




                    // if(isset($_GET['action'])) {
                    //     if($_GET['action'] = 'clearall') {
                    //         unset($_SESSION['shopping']);
                    //     }
                    // }
                    
if(isset($_POST["add"])){
    if(isset($_SESSION["shopping"])){
        $item_array_id = array_column($_SESSION["shopping"],"product_id");
        if(!in_array($_GET["id"],$item_array_id)){ //id al =!
            $count = count($_SESSION["shopping"]);
            $item_array = array(
                'product_id' => $_GET["id"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'product_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping"][$count] = $item_array;
            print '<script>window.location="index.php"</script>';
        }else{
            print '<script>alert("Məhsul artıq səbətdədir")</script>';
            print '<script>window.location="index.php"</script>';
        }
        // mehul sebetde
    }else{
        $item_array = array(
            'product_id' => $_GET["id"],
            'product_name' => $_POST["hidden_name"],
            'product_price' => $_POST["hidden_price"],
            'product_quantity' => $_POST["quantity"],
        );
        $_SESSION["shopping"][0] = $item_array;
        // print "Mehsul artiq sebetdedir.";
    }
}

if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
        foreach($_SESSION["shopping"] as $keys => $value){
            if($value["product_id"] == $_GET["id"]){
                unset($_SESSION["shopping"][$keys]); // get sebetden mesulu sil
                print '<script>alert("Məhsul silindi")</script>';
                print '<script>window.location="index.php"</script>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="az">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Alış-veriş</title>
    <link rel="style" href="./style.css"/>

     <!-- more -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>

<body>

</body>
</html>

<body>
<div class="container" style="width: 65%">

<hr/>

<h2 style="text-transform: uppercase;">Alış-veriş</h2>

<hr size="12"/>

<?php
$query = "select * from product order by id asc";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0){
 
    // messulari seyfede gosdermek ucun isledmim
    while($row = mysqli_fetch_array($result)){
        ?>   
        <div class="col-md-3" style="float: left;">
            <form method="post" action="index.php?action=add&id=<?php print $row["id"];?>">
                <div class="product">
                    <img src="img/<?php print $row["image"];?>" width="190px" height="200px" class="img-responsive" style="border-radius: 10px;">
                    <h5 class="text-info"><?php print $row["description"];?></h5>
                    <h6 class="text-danger"><?php print $row["price"];?>.00 AZN</h6>
                    <input type="text" name="quantity" class="form-control" value="1">
                    <input type="hidden" name="hidden_name" value="<?php print $row["description"];?>">
                    <input type="hidden" name="hidden_price" value="<?php print $row["price"];?>">
                    <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Səbətə əlavə et">
                </div>
            </form>
        </div>
        <?php
    }
}
?>

<div style="clear: both"></div>
<hr/>
<h3 class="title2" style="text-transform: uppercase;">Alış-veriş Səbətinin Təfərrüatları</h3>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered" style="font-family: monospace;">
        <tr>
            <th width="30%">Məhsul təsviri</th>
            <th width="10%">Kəmiyyət</th>
            <th width="13%">Qiymət Detalları</th>
            <th width="10%">Ümumi Qiymət</th>
            <th width="17%">Elementi Sil</th>
        </tr>
        <?php
        if(!empty($_SESSION["shopping"])){
            // ilk qiymeti sifirdir mesulun
            $total=0;
            foreach($_SESSION["shopping"] as $key => $value){
                ?>
                <tr>
                    <td><?php print $value["product_name"];?></td>
                    <td><?php print $value["product_quantity"];?></td>
                    <td><?php print $value["product_price"];?></td>
                    
                    <td><?php print number_format($value["product_quantity"]*$value["product_price"],2);?></td>
                    <td><a href="index.php?action=delete&id=<?php print $value["product_id"]; ?>"><span class="text-danger"><button>Elementi Sil</button></span></a></td>
                </tr>
                <?php
                // mesulari cemle
                $total = $total + ($value["product_quantity"]*$value["product_price"]);
            }
            ?>
            <tr>
                <td colspan="3" align="right">Cəmi</td>
                <td align="right"><?php print number_format($total,2);?></td>
                <td></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

</div>

</body>
</html>