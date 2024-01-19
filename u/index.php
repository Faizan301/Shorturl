<?php

require '../config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = $conn->prepare("SELECT * FROM urls WHERE id = :id");
    $select->bindParam(":id", $id);
    $select->execute();
    $data = $select->fetch(PDO::FETCH_OBJ);

    $clicks = $data->clicks + 1;

    $update = $conn->prepare("UPDATE urls SET clicks = :clicks WHERE id = :id");
    $update-> bindParam(":id", $id);
    $update-> bindParam(":clicks", $clicks);
    $update->execute();

    header("Location: ".$data->urlName." ");

}


?>