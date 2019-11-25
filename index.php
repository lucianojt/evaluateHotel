<?php
ob_start();
include("database/database.php"); 
$connection = mysqli_connect($localhost,$username,$pass,$database);
mysqli_set_charset($connection,'utf8');
?>
<!doctype html>
<html lang="en">
  <head>
    <title>แบบประเมิน</title>
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
  .pic{
    text-align: center;
   }
   .text{
      text-align: center;
    }
    input[type="radio"]:checked {
      border-color: #08445B;
    }
    input[type='radio']:before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        margin: 20% auto;
        border-radius: 50%;
    }

   input[type="radio"]:checked:before {
        background: #08445B;   
    }
    input[type='radio'] {
        -webkit-appearance: none;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        outline: none;
        border: 3px solid #E78620;
    }
    input[type='radio']:hover {
      background: #501C07;
      border: 3px solid #501C07;
      /* border: 3px solid blue; */
    }
   </style>
<div class="container">
<div class="pic">
  <img src="image/Logo-PSU.png"  width="300" height="190">
</div>
<div class="text">
      <h4>แบบประเมินโปรแกรม “เว็บแอพพลิเคชั่นสอนภาษาจีนเพื่อการโรงแรม”</h4>
</div>
<br>


<?php
$sql = "SELECT * FROM object";
$result = mysqli_query($connection,$sql);
if(!$result){
    ?><br>
    <div class="alert alert-danger" role="alert">
    เกิดข้อผิดพลาดบางอย่าง ไม่สามารถเรียกดูได้
    </div>
    <?php
}else{
    $k=1;
    while($row = mysqli_fetch_assoc($result)){
        ?>
<div class="table-responsive">
<table class="table  table-bordered table-striped"> 
<thead class="thead-light">
    <tr>
      <th scope="col"></th>
      <th style="width: 45%;" scope="col"><?php echo $row['data_object']; ?></th>
      <th style="text-align: center;" scope="col">5</th>
      <th style="text-align: center;" scope="col">4</th>
      <th style="text-align: center;" scope="col">3</th>
      <th style="text-align: center;" scope="col">2</th>
      <th style="text-align: center;" scope="col">1</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ob = $row['id_object'];
    $sql2 = "SELECT * FROM detail WHERE id_object = $ob";
    $result2 = mysqli_query($connection,$sql2);
    $i=1;
    while($row2 = mysqli_fetch_assoc($result2)){
        ?>
    <tr>
      <td style="text-align: center;" ><?php echo $i;?></td>
      <td><?php echo $row2['data']; ?></td>
      <td style="text-align: center;"><input type="radio" value="5" name="choose<?php echo $k; ?>" required > </td>
      <td style="text-align: center;"><input type="radio" value="4" name="choose<?php echo $k; ?>" required ></td>
      <td style="text-align: center;"><input type="radio" value="3" name="choose<?php echo $k; ?>" required ></td>
      <td style="text-align: center;"><input type="radio" value="2" name="choose<?php echo $k; ?>" required ></td>
      <td style="text-align: center;"><input type="radio" value="1" name="choose<?php echo $k; ?>" required ></td>
    </tr>
        <?php
        $i++;
        $k++;
    }
    ?>
  </tbody>
</table>
</div><br>
        <?php
    }
}
?>




<!-- ปิด container -->
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
ob_end_flush(); 
?>