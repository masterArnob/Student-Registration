<?php 
include("database.php");
if(isset($_GET['deleteid'])){
    $ID =$_GET['deleteid'];
    $sql = "DELETE FROM studentform WHERE id = $ID";
    if(mysqli_query($con, $sql) == true){
       
        header('location:display.php');
        echo "Successfully deleted";

        $sql2 = "SELECT picture FROM studentform WHERE id = $ID";
        while(mysqli_query($con, $sql2)){
            $picture = $data['picture'];
            echo $picture;
            unlink("images/".$picture);
        }
    }

  
    
  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        img{
            width:100px;
        }
    </style>

</head>
<body>
   
    <section class="display-data">
        <div class="container">
            <div class="text-center">
                <h2 class="display-4">User Data</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                <table class="table table-dark table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">SL NO</th>
      <th scope="col">Picture</th>
      <th scope="col">Email address</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Subject</th>
      <th scope="col">Address</th>
      <th scope="col">Registration Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  $sql = "SELECT * FROM studentform";
  $query = mysqli_query($con, $sql);
  while($data = mysqli_fetch_assoc($query)){
  $id = $data['id'];

  $email = $data['email'];

  $name = $data['name'];

  $phone = $data['phone'];
 
  $subject = $data['subject'];

  $address = $data['address'];

  $picture = $data['picture'];
  $img ="<img src='images/$picture'>";

  $reg = $data['reg_date'];


  echo ' <tr>
  <td>'.$id.'</td>
  <td>'.$img.'</td>
  <td>'.$email.'</td>
  <td>'.$name.'</td>
  <td>'.$phone.'</td>
  <td>'.$subject.'</td>
  <td>'.$address.'</td>
  <td>'.$reg.'</td>
  <td>
      <span class="btn btn-outline-success border-decoration-none text-white"> 
           <a href="edit.php?id='. $id . '" class="text-white text-decoration-none"> Edit </a>
      </span>
      <span class="btn btn-outline-danger">
           <a href="display.php?deleteid='.$id.'"class="text-white text-decoration-none"> Delete </a>
      </span>
      </td>
 
</tr>';


  }
  ?>
   
    
     
</table>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>