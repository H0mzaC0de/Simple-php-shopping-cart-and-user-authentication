<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}  
if (!empty($_SESSION['user'])) {
    require_once '../PHP/dbh.php';
    $userId = $_SESSION['user'];
    $sqlC = "SELECT * from cart where user_id=$userId";
    $resultC = mysqli_query($conn, $sqlC) or die(mysqli_error($conn));
    $num = mysqli_num_rows($resultC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <title>User Dashboard</title>
</head>

<body>
    <div class="container">
    <a href="logout.php" class="btn btn-warning">Logout</a>
        <a href="myCart.php" style="color:black"><i class="fas fa-shopping-cart" id="cart"></i></a>
        <span class="numberOrder" id="itemsNum"><?php echo $num; ?></span>
        <!-- product -->
        <?php
        $sql = "SELECT * FROM products";
        require_once '../PHP/dbh.php';
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (!empty($_SESSION['user'])) {
            if (mysqli_num_rows($result) > 0) {
                while ($line = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-xs-12 col-md-6 bootstrap snippets bootdeys"><div class="product-content product-wrap clearfix">
                <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image"> 
                                <img src="https://www.bootdey.com/image/194x228/87CEFA" alt="194x228" class="img-responsive"> 
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-deatil">
                                <h5 class="name">
                                    <a href="#">
                                        ' . $line["product_name"] . '
                                    </a>
                                </h5>
                                <p class="price-container">
                                    <span>$' . $line["price"] . '</span>
                                </p>
                                <span class="tag1"></span> 
                        </div>
                        <div class="description">
                            <p>' . $line["description"] . ' </p>
                        </div>
                        <div class="product-info smart-form">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> 
                                    <a href="javascript:void(0);" onclick="addToCart(' . $line["product_id"] . ')" class="btn btn-success">Add to cart</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="rating">
                                        <label for="stars-rating-5"><i class="fa fa-star"></i></label>
                                        <label for="stars-rating-4"><i class="fa fa-star"></i></label>
                                        <label for="stars-rating-3"><i class="fa fa-star text-primary"></i></label>
                                        <label for="stars-rating-2"><i class="fa fa-star text-primary"></i></label>
                                        <label for="stars-rating-1"><i class="fa fa-star text-primary"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>';
                }
            }
        }
        ?>


        <!-- end product -->
    </div>

    </div>
</body>
<script>
    function addToCart(idPro) {
        var idPro = idPro;
        var userId = <?php echo $_SESSION['user']; ?>;
        $.post("addToCart.php", {
                idPro: idPro,
                userId: userId
            },
            function(result, success) {
                if (result == 0) {
                    alert("product Already exists in Your cart!");

                } else if (result == 1) {
                    alert("product Added to Your cart!");

                    var span = $('#itemsNum').html();
                    var number = parseInt(span);
                    number++;
                    $('#itemsNum').html(number);
                } else if (result == 2) {
                    alert('error');

                }
            })
    }
</script>

</html>