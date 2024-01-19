<?php
require 'config.php';
$msg = '';

$select = $conn->query('SELECT * FROM urls');
$select->execute();
$data = $select->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['submit'])){

    $urlName = $_POST['urlName'];

    if($urlName == ''){
        $msg = '<div class="alert alert-danger text-center">Url Required</div>';
    }else{

        $insert = $conn->prepare("INSERT INTO urls (urlName) VALUES (:name)");
        $insert->bindParam(":name",$urlName);
        if($insert->execute()){
            $msg = "<div class='alert alert-success'>Data Inserted</div>";
        }

    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .form-control:focus{
            box-shadow: none;
        }
        .btn{
            white-space: nowrap;
        }
    </style>
  </head>
  <body>
    
    <div class="container">
        <form action="" method="post">
            <div class="col-5 mx-auto mt-3"><?php echo $msg; ?></div>
            <div class="d-flex col-8 mx-auto">
                <input type="text" name="urlName" class="form-control" placeholder="Enter Url">
                <button type="submit" name="submit" class="btn btn-success px-4 mx-2 py-3">Add Url</button>
            </div>
        </form>
    </div>

    <div class="container-fluid" id="refresh">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Long Url</th>
                    <th>Short Url</th>
                    <th>Clicks</th>
                    <th>Delete</th>
                </tr>
            </thead>    
            <tbody>
                
            <?php foreach($data as $row) : ?>
                    
                <tr>
                    <td><?php echo $row->urlName ?></td>
                    <td><a href="http://localhost/Udemy%20My%20Learning/shorturl/u?id=<?php echo $row->id ?>" target="_blank">http://localhost/Udemy%20My%20Learning/shorturl/u?id=<?php echo $row->id ?></a></td>
                    <td><?php echo $row->clicks ?></td>
                    <td>
                        <a href=""><span class="badge text-bg-danger py-2">Danger</span></a>
                    </td>
                </tr>

            <?php endforeach; ?>
                    
            </tbody>    
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $("#refresh").click(function(){
                setInterval(function(){
                    $("body").load('index.php')
                }, 5000);
            });
        });
    </script>
  </body>
</html>