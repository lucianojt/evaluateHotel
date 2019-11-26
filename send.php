<?php
ob_start();
if(isset($_POST['submit'])){
include("database/database.php"); 
$connection = mysqli_connect($localhost,$username,$pass,$database);
mysqli_set_charset($connection,'utf8');
?>
<!doctype html>
<html lang="en">
  <head>
    <title>send</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
<style>
 body{
font-family: 'Kanit', sans-serif;
background-color: #FAFAFA;
  }
</style>
<div class="container">
<?php
//var_dump($_POST);

$sql2 = "SELECT * FROM vote";
$result2 = mysqli_query($connection,$sql2);
if(!$result2){
    ?>
    <br>
    <div class="alert alert-danger" role="alert">
    เกิดข้อผิดพลาดบางอย่าง 
    </div>
    <?php
}else{
    $q = 1;
    while($q<=16){
        $i=1;
        while($i<=5){
        $sql = "SELECT counts FROM vote WHERE id_detail = '$q' AND score = '$i' ";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row['counts'] == 0){
            if($_POST["choose".$q] == $i){
            $sql = "UPDATE vote SET counts = 1 WHERE id_detail = '$q' AND score = '$i'";
            $result = mysqli_query($connection,$sql);
            }
        }else{
            if($_POST["choose".$q] == $i){
                $k = 1;
                $k += $row['counts'];
                $sql = "UPDATE vote SET counts = $k WHERE id_detail = '$q' AND score = '$i'";
                $result = mysqli_query($connection,$sql);
            }
        }
        $i++;
        }
    $q++;
    }
}


$sql2 = "SELECT * FROM voteoption";
$result2 = mysqli_query($connection,$sql2);
if(!$result2){
    ?><br>
    <div class="alert alert-danger" role="alert">
    เกิดข้อผิดพลาดบางอย่าง 
    </div>
    <?php
}else{
    $qq = array('Y','N');
    $x = 1;
    while($x<=5){
        $n = 0;
        while($n<=1){
            $sql = "SELECT counts FROM voteoption WHERE opinion_id = '$x' AND options = '$qq[$n]' ";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            if($row['counts'] == 0){
                if($_POST['opin'.$x] == $qq[$n]){
                    $sql = "UPDATE voteoption SET counts = 1 WHERE opinion_id = '$x' AND options = '$qq[$n]'";
                    $result = mysqli_query($connection,$sql);
                }
            }else{
                if($_POST['opin'.$x] == $qq[$n]){
                    $kk = 1;
                    $kk += $row['counts'];
                    $sql = "UPDATE voteoption SET counts = $kk WHERE opinion_id = '$x' AND options = '$qq[$n]'";
                    $result = mysqli_query($connection,$sql);
                }
            }
        $n++;
        }
    $x++;
    }  
}
?>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
}else{
    header("location:index.php"); 
}
ob_end_flush(); 
?>