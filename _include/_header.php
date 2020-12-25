<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="_include/styles.css">

</head>

<body style="background-color: rgba(0, 0, 0, 0.3);">

    <!-- Just an image -->
    <nav class="navbar py-2 navbar-expand-md navbar-dark" style="background-color: #003434;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="h2 text-decoration-none text-light" href="#">
                MyShop
            </a>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link active text-decoration-none text-light" aria-current="page" href="categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-decoration-none text-light" aria-current="page" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-decoration-none text-light" aria-current="page" href="account.php">Account</a>
                    </li>
                </ul>

            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#search" class="ml-2 btn btn-light mx-md-1 text-dark p-1"><img src="images/search.png" width="25" alt=""></button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#cart" class="btn mx-md-1 btn-warning text-dark mx-1 p-1"><img src="images/cart.png" width="25" alt=""></button>
        </div>
    </nav>





    <!-- Modal -->
    <div class="modal fade" id="cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgba(0, 0, 0, 0.1);">
                    <h5 class="modal-title" id="cartLabel">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Available</th>
                                <th scope="col">Remove</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                            $sql = $dbcon->prepare("select * from cart_item where user_ip='$ip'");
                            $sql->execute();
                            $products = $sql->fetchAll();
                            $num = $sql->rowCount();
                            $t_price = 0;
                            $q = 0;
                            if ($num <= 0) {
                                echo '<p class="lead text-danger text-dark">No Product Added To Cart.</p>';
                            } else {
                                foreach ($products as $p) {
                                    $id = $p['product_id'];
                                    $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                                    $sql = $dbcon->prepare("select * from products where id='$id'");
                                    $sql->execute();
                                    $product = $sql->fetch();
                                    $t_price = $t_price + $product['price'];
                                    $q = $q + 1;
                                    if ($product['in_stock'] == 1) {
                                        $stat = "✅";
                                    } else {
                                        $stat = "⛔";
                                    }
                                    echo '<tr>
                                    <td>' . $product['name'] . '</td>
                                    <td>&#8377; ' . $product['price'] . '</td>
                                    <td>' . $stat . '</td>
                                    <td><a href="_act.php?act=p_remove&val=' . $p['id'] . '" class="btn btn-outline-danger px-2 py-0">Remove</a></td>

                                    </tr>';
                                }
                            }

                            echo '</tbody>
                    </table>';
                            echo '<p class="lead fw-bold">Total Cart Price = &#8377;' . $t_price . ' | Total Products = ' . $q . '</p>';

                            ?>



                </div>
                <div class="modal-footer" style="background-color: rgba(0, 0, 0, 0.1);">
                    <a href="#" class="btn btn-outline-success btn-lg fw-bold">Checkout →</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgba(0, 0, 0, 0.1);">
                    <h5 class="modal-title" id="searchLabel">Search Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="px-md-5">
                        <form action="search.php" class="my-2 px-md-3" method="post">
                            <label for="search" class="form-label h2 mb-3">Search</label>
                            <input type="search" require id="search" name="keywoard" class="form-control shadow" aria-describedby="search">

                            <select require class="form-select shadow my-2" name="c_id" aria-label="Default select example">
                                <option selected disabled>Select Product Category</option>
                                <?php
                                $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                                $sql = $dbcon->prepare("select * from category");
                                $sql->execute();
                                $category = $sql->fetchAll();

                                foreach ($category as $c) {
                                    echo '
                                <option value="'.$c['id'].'">'.$c['category'].'</option>';
                                }

                                ?>

                            </select>
                            <button type="submit" class=" shadow btn mx-auto mt-3 px-4 btn-outline-dark fw-bold">Search </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>