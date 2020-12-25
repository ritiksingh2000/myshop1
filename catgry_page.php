<?php

session_start();
include "_include/_header.php";
?>

<section class="container">
    <div class="row">
        <div class="col-10 card-body rounded bg-light mx-auto my-3 shadow">
            <div class="card-header h2">Products From <?php echo $_GET['cat_name']; ?> Category</div>
            <div class="row p-3">

                <?php
                $catgry = $_GET['cat_name'];
                $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                $sql = $dbcon->prepare("SELECT * FROM products");
                $sql->execute();
                $products = $sql->fetchall();
                foreach ($products as $p) {
                    if ($catgry==$p['category']){
                    echo '<div class="col-md-4 p-4">
                    <div class="card shadow" style="font-family:Noto-Sans;">
                        <img src="' . $p['img'] . '" class="card-img-top shadow" alt="...">
                        <div class="card-body text-center">
                            <a href="productpage.php?product=' . $p['id'] . '" class="text-decoration-none text-dark">
                            <p class="h4 py-0">' . $p['name'] . '</p>
                            <p class="h5 fw-normal py-0">Price - &#8377;' . $p['price'] . '</p>
                            </a>
                            <hr>
                            <a href="#" class="btn btn-outline-dark">Buy Now</a>
                            <a href="_act.php?act=addtocart&val=' . $p['id'] . '" class="btn btn-outline-dark">Add To Cart</a>
                        </div>
                    </div>
                </div>';
                    }
                }

                ?>


            </div>
        </div>
    </div>
</section>

<?php
include "_include/_footer.php";
?>