<?php
include "_include/_header.php";
$p_id = $_GET['product'];
$dbcon = new PDO("mysql:gost=localhost;dbname=ecom", 'root', '');
$sql = $dbcon->prepare("SELECT * FROM products WHERE id=$p_id");
$sql->execute();
$product = $sql->fetch();
$num = $sql->rowCount();
if ($product['in_stock'] == 0) {
    $status = 'Out Of Stock';
} else {
    $status = 'In Stock';
}

if ($num == 1) {
    echo '
<div class="container p-3">
    <div class="card-body bg-light rounded">
        <div class="row p-0 m-0">
            <div class="col-md-5">
                <div class="border border-2 border-secondary rounded shadow">
                <img src="' . $product['img'] . '" alt="" class="img-fluid rounded">
                <div class="row m-0 p-0">
                    <div class="col p-2">
                        <div class="d-grid gap-2">
                            <a href="' . $product['id'] . '" class="btn fw-bold btn-outline-success my-3 lead">Buy Now</a>
                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="d-grid gap-2">
                            <a href="_act.php?act=addtocart&val=' . $product['id'] . '" class="btn btn-outline-success fw-bold my-3 lead">Add To Cart</a>
                        </div>

                    </div>
                </div>
                </div>
            </div>
            <div class="col p-2 rounded ">
                <p class="text-muted mb-0 fw-bold">Product :</p>
                <h1 class="display-6 fw-bold">' . $product['name'] . '</h1>
                <br>
                <p class="h1 fw-normal"><span class="text-muted">Price:</span> &#8377;' . $product['price'] . '</p>
                <br>
                <p class="text-muted my-1 fw-bold">Category :</p>
                <p class="lead fw-bold">' . $product['category'] . ' </p>
                <br>
                <p class="text-muted my-1 fw-bold">Status :</p>
                <p class="lead fw-bold">' . $status . '</p>
                
            </div>
        </div>
        <div class="card-body">
            <p class="text-muted my-1 lead fw-bold">Description :</p>
        <p class="p-3 border shadow rounded" style="background-color: rgba(0,0,0,0.1);">' . $product['p_desc'] . '</p>
        </div>
    </div>
</div>
    ';
}
echo '<div class="container p-3">
    <div class="card-body bg-light rounded">
        <div class="row m-0 p-0">';
$category = $product['category'];
$sql = $dbcon->prepare("SELECT * FROM products WHERE category='$category'");
$sql->execute();
$num = $sql->rowCount();
if ($num >= 1) {
    $products = $sql->fetchAll();
    foreach ($products as $p) {
        $desc = substr($p['p_desc'], 0, 230);
        echo '<div class="col-sm-6 col-md-4">
                <div class="card shadow">
                    <img src="' . $p['img'] . '" class="card-img-top shadow" alt="...">
                    <div class="card-body">
                        <h5 class="h2 pl-2">' . $p['name'] . '</h5>
                        <p class="h3">&#8377;' . $p['price'] . '</p>
                        <p class="card-text">' . $desc . '...</p>
                        <a href="productpage.php?product=' . $p['id'] . '" class="btn btn-outline-dark">View Product</a>
                    </div>
                </div>
            </div>';
    }
}

echo '
</div>
    </div>
</div>

';

?>



            
        
<?php
include "_include/_footer.php";
?>