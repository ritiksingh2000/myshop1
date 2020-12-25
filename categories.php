<?php

session_start();
include "_include/_header.php";
?>

<section class="container">
    <div class="row">
        <div class="col-10 card-body rounded bg-light mx-auto my-3 shadow">
            <div class="card-header h2">All Categories</div>
            <div class="p-3">
                
            <?php 

                $connection = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
                $sql = $connection->prepare("SELECT * FROM category");
                $result = $sql->execute();
                if(isset($result)){
                    $catgries = $sql->fetchAll();
                    foreach ($catgries as $catgry) {
                        echo '<a href="catgry_page.php?cat_id=' . $catgry['id'] . '&cat_name=' . $catgry['category'] . '" class="btn shadow m-3 btn-outline-info">'.$catgry['category'].'</a>';
                    }
                }else{
                    echo '<div class="container px-md-3 mt-3">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> Unable To Fetch Categories List. PLease Try Again Later </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
                ';
                }

            ?>
            

            </div>
        </div>
    </div>
</section>

<?php
include "_include/_footer.php";
?>