<?php
include "_include/_header.php";
?>

<section>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1600x400/?product,phone" class="d-block w-100 img-fluid" alt="...">

            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1600x400/?product,earphone" class="d-block w-100 img-fluid" alt="...">

            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1600x400/?product,beauty" class="d-block w-100 img-fluid" alt="...">

            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    
</section>


<section>
    <div class="container">
        <div class="row bg-light rounded my-2">
            <p class="h2 text-center mt-2"> Featured Products</p>
            <hr><?php
                $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                $sql = $dbcon->prepare("select * from products");
                $sql->execute();
                $products = $sql->fetchAll();

                foreach ($products as $p) {
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



                ?>

                

        </div>
    </div>
</section>






<?php
include "_include/_footer.php";
?>