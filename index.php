<?php
include('include/config.php');
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
        <br>
        <div class="card text-center m-auto">
            <div class="card-header">
                Simple CRUD App
            </div>
            <div class="card-body">
                <h5 class="card-title">User Records<a href="add.php"  class="btn btn-primary float-end ">Add Records</a></h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $qry='SELECT * from users';
                        if($result=mysqli_query($conn,$qry)){
                            if(mysqli_num_rows($result)>0){
                                while($row=mysqli_fetch_assoc($result)){ ?>
                                <tr>
                                    <th scope="row"><?=$row['id'];?></th>
                                    <td><?=$row['name'];?></td>
                                    <td><?=$row['email'];?></td>
                                    <td>
                                        <a href="view.php?id=<?=$row['id'];?>" class="btn btn-primary">View</a>
                                        <a href="edit.php?id=<?=$row['id'];?>" class="btn btn-primary">Edit</a>
                                        <a href="delete.php?id=<?=$row['id'];?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php 
                                }
                            }
                        } else {
                            echo 'query unsuccessful';
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer ">
                All rights Reserved
            </div>
        </div>
    </div>
</body>
</html>