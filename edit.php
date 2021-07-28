<?php
include('include/config.php');

//get id
if (!is_numeric(trim($_REQUEST['id']))) {
    header('Location: ./index.php');
} else {
    $id = trim($_REQUEST['id']);
}

// getb record from table users 
$qry = "SELECT * from users where `id`= ?;";
$stmt = mysqli_prepare($conn, $qry);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
if ($result = mysqli_stmt_get_result($stmt)) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo 'query unsuccessful';
}

//update code
if (isset($_REQUEST['submit'])) {
    //get variables
    $name = trim($_REQUEST['name']);
    $email = trim($_REQUEST['email']);

    //validate 
    //name aphanumeric
    if (!ctype_alnum($name)) {
        echo '<br>';
        echo $error['name'] = '<h5 class="text-center">name should be alpha numeric</h5>';
    } else {
        if (is_numeric(substr($name, 0, 1))) {
            echo '<br>';
            echo $error['name'] = '<h5 class="text-center">first letter of name should be alphabetical</h5>';
        }
    }

    //email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<br>';
        echo $error['email'] = '<h5 class="text-center">Invalid email format</h5>';
    }

    if (empty($error)) {
        //code for insert
        $qry = "UPDATE `users` SET `name`=?,`email`=? WHERE `id`=?;";
        $stmt=mysqli_prepare($conn,$qry);
        mysqli_stmt_bind_param($stmt,'ssi',$name,$email,$id);
        mysqli_stmt_execute($stmt);
        if(mysqli_affected_rows($conn) > 0){
            echo '<br>';
            echo '<h5 class="text-center">record updated successfully<a href="index.php"  class="btn btn-primary mx-5">Back</a></h5>';
        } else {
            echo '<br>';
            echo '<h5 class="text-center">record update  unsuccessful<a href="index.php"  class="btn btn-primary mx-5">Back</a></h5>';
        }
    } else {
        echo '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD</title>

    <!-- google fonts -->



    <!-- bootstrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>



</head>

<body>
    <div class="container">
        <!-- form card -->
        <br>
        <div class="card text-center m-auto">
            <div class="card-header">
                Simple CRUD App
            </div>
            <div class="card-body">
                <h5 class="card-title">Edit Form</h5>
                <!-- form -->
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value=<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : $row['name']  ?>>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value=<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : $row['email']  ?>>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                </form>
            </div>
            <div class="card-footer">
                All rights Reserved
            </div>
        </div>
    </div>
</body>

</html>