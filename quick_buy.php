<?php

session_start();
include "_include/_header.php";

?>

<section class="container">
    <div class="row">
        <div class="col-10 card-body bg-light rounded shadow my-3">
            <div class="card-header h2">
                Buy - <?php echo $_GET['p_name']; ?>
            </div>
            <div class="row">
                <?php
                $p_id = $_GET['p_id'];
                $connection = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                $sql = $connection->prepare("SELECT * FROM products WHERE id=$p_id");
                $result = $sql->execute();
                if ($result) {
                    $product = $sql->fetch();
                    echo '
                <div class="col-md-3">
                    <img src="' . $product['img'] . '" alt="" class="img-fluid my-2" alt="...">
                </div>
                <div class="col">

                <form method="POST" action="" class="my-2">
                            <div class="mb-3">
                                <label for="ProductName" class="form-label fw-bold">Product Name</label>
                                <input type="text" class="form-control" id="ProductName" readonly value="' . $product['name'] . '" >
                            </div>
                            <div class="mb-3">
                                <label for="ProductPrice" class="form-label fw-bold">Product Price</label>
                                <input type="text" class="form-control" id="ProductPrice" readonly value="Rs.' . $product['price'] . '" >
                            </div>
                            <div class="mb-3">
                                <label for="ProductPrice" class="form-label fw-bold">Product Quantity</label>
                                <input type="text" maxlength="1" placeholder="Between 0-9" class="form-control" id="ProductPrice" value="1">
                            </div>

                            <button type="submit" class="btn btn-success">Proceed To Payment →</button>
                        </form>';
                }

                ?>

            </div>

        </div>
    </div>
    </div>
</section>

<?php
include "_include/_footer.php";
?>