<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include "_include/_header.php";
    echo '<div class="container rounded shadow p-3 my-3 bg-light">
    <h1 class="h3 text-center">Search result for '.$keywoard.'</h1>
    ';
    
    $c_id = $_POST['c_id'];
    $keywoard = strtolower($_POST['keywoard']);
    $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
    $sql = $dbcon->prepare("select * from products where category='$c_id'");
    $sql->execute();
    $products = $sql->fetchAll();
    foreach ($products as $p){
        $p_name = strtolower($p['name']);
        if(strpos($p_name, $keywoard) !== false){
            echo "found";
        }
    
    }
    echo '</div>';
    include "_include/_footer.php";
}else{
    header("location: /ecommerce");
}


?>

