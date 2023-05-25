<?php
include("database.php");
$emailError = $nameError = $phoneError = $addressError = $imageError = ""; // Define and initialize $emailError variable outside the if block

if (isset($_POST['submit'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fileName = $_FILES['upfile']['name'];
        $oldLocation =  $_FILES['upfile']['tmp_name'];
        $newLocation =  "images/" . $fileName;
        $fileType =  $_FILES['upfile']['type'];
        $fileSize =  $_FILES['upfile']['size'];
        $uniqueFileName;

        echo "<br>FileName: ";
        echo $fileName;

        echo "<br>Old Location: ";
        echo $oldLocation;

        echo "<br>New Location: ";
        echo $newLocation;

        echo "<br>File Type: ";
        echo $fileType;
        echo "<br>File Size ";
        echo $fileSize;

        $permitted = array('jpg', 'jpeg', 'png');
        $div = explode('.', $fileName);
        $fileExtension = strtolower(end(($div)));

        $uniqueFileName = substr(md5(time()), 0, 10) . '.' . $fileExtension;
        echo "<br>Unique File Name:";
        echo $uniqueFileName;

        $email = test_input($_POST["email"]);
        $name = test_input($_POST['name']);
        $phone = test_input($_POST['phone']);
        $subject = $_POST['subject'];
        $address = test_input($_POST['address']);


        
        if (empty($_POST["name"])) {
            $nameError = "*Name is required";
        }
        if (empty($_POST["email"])) {
            $emailError = "*Email is required";
        }
        if (empty($_POST["address"])) {
            $queryError = "*address is required";
        }
        if (empty($_POST['phone'])) {
            $phoneError = "*Phone is required";
        }
        if (empty($_POST['address'])) {
            $addressError = "*Address is required";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "*Invalid email format";
            } else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameError = "*Only letters and white space allowed";
            } else {
                if (in_array($fileExtension, $permitted) == true) {
                    if ($fileSize <= 1048576) {
                        if (move_uploaded_file($oldLocation, $uniqueFileName)) {
                            $sql = "INSERT INTO studentForm(email, name, phone, subject, address, picture) 
                                    VALUES('$email', '$name', '$phone', '$subject', '$address', '$uniqueFileName')";
                            try {
                                mysqli_query($con, $sql);
                                echo "<br>saved in database";
                                header('location:display.php');
                            } catch (mysqli_sql_exception) {
                                echo "<br>could not save in database";
                            }
                            echo "<br>File is saved";
                        } else {
                            echo "<br>File is not saved";
                        }
                    } else {
                        echo "<br>Image cannot be more than 1 MB";
                    }
                } else {
                    echo "<br>Image must be in JPG, JPEG, or PNG format";
                }
            }
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <div class="container mt-4">
        <div class="text-center">
            <h2 class="display-5">Student Registration</h2>
            <p class="lead">Registration for new Courses</p>
        </div>


        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>



            <div class="row justify-content-center">
                <div class="col-lg-6">








                    <label for="image" class="form-label mt-3">Upload Image:</label>
                    <input type="file" name="upfile" class="form-control shadow" required>
                    <small class="invalid-feedback">Please upload image</small>
                    <p class="text-danger"><?php echo $imageError ?></p>



                    <label for="email" class="form-label">Email address:</label>
                    <div class="input-group">
                        <span class="input-group-text shadow">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="email" name="email" class="form-control shadow" required>
                        <small class="invalid-feedback">Please enter your email</small>
                    </div>
                    
                    
                   

                    <p class="text-danger"><?php echo $emailError ?></p>



                    <label for="name" class="form-label">Name:</label>
                    <div class="input-group ">
                        <span class="input-group-text shadow">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" name="name" class="form-control shadow" required>
                        <small class="invalid-feedback">Please enter your name</small>
                    </div>
                    <p class="text-danger"><?php echo $nameError ?></p>




                    <label for="phone" class="form-label">Phone:</label>
                    <div class="input-group">
                        <span class="input-group-text shadow">
                            <i class="bi bi-telephone-fill"></i>
                        </span>
                        <input type="text" name="phone" class="form-control shadow" required>
                        <small class="invalid-feedback">Please enter your phone</small>
                    </div>
                    <p class="text-danger"><?php echo $phoneError ?></p>



                    <label for="subject" class="form-label">Courses:</label>
                    <div class="input-group shadow">
                        <span class="input-group-text">
                            <i class="bi bi-bookmarks-fill"></i>
                        </span>
                        <select name="subject" class="form-select">
                            <option value="Math" selected>Math</option>
                            <option value="English">English</option>
                            <option value="C++">C++</option>
                            <option value="Pytho">Python</option>
                        </select>
                    </div>







                    <div class="form-floating mt-4">
                        <textarea name="address" style="height: 140px;" class="form-control shadow" required></textarea>
                        <label for="address" class="form-label">Address:</label>
                        <small class="invalid-feedback">Please enter your address</small>
                    </div>
                    <p class="text-danger"><?php echo $addressError ?></p>



                    <div class="text-center">
                        <button class="btn btn-outline-danger my-3 shdaow" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>


<?php 
$sql = "SELECT * FROM studentForm";
$rs = mysqli_query($con, $sql);
while($data = mysqli_fetch_assoc($rs)){

$Q = $data['name'];
echo "<img src='images/$Q'>";
}
?>