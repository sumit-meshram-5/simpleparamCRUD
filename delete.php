<?php
include('include/config.php');
if (!is_numeric(($_REQUEST['id']))) {
    header('Location: ./index.php');
} else {
    $id = trim($_REQUEST['id']);
}

if (isset($_REQUEST['yes'])) {
    $qry = "DELETE from users where `id`=?;";
    $stmt = mysqli_prepare($conn, $qry);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    if (mysqli_affected_rows($conn) > 0) {
        echo '<br>';
        echo '<h5 class="text-center">Record deleted successfully  <a href="index.php"  class="btn btn-primary mx-5">Back</a></h5>';
    } else {
        echo '<br>';
        echo '<h5 class="text-center">Record deletion unsuccessful <a href="index.php"  class="btn btn-primary mx-5">Back</a></h5>';
    }
}

if (isset($_REQUEST['no'])) {
    header('Location: ./index.php');
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
        <br>
        <div class="card text-center m-auto">
            <div class="card-header">
                Simple CRUD App
            </div>
            <div class="card-body">
                <h5 class="card-title">Delete Record</h5>
                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = "SELECT * from users where `id`=?;";
                        $stmt = mysqli_prepare($conn, $qry);
                        mysqli_stmt_bind_param($stmt, 'i', $id);
                        mysqli_stmt_execute($stmt);
                        if ($result = mysqli_stmt_get_result($stmt)) {
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result); ?>
                                <tr>
                                    <th scope="row"><?= $row['id']; ?></th>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo 'query unsuccessful';
                        } ?>
                    </tbody>
                </table>
                <h5 class="d-block">Are you sure to Delete this record</h5>
                <form action="" method="post">
                    <button type="submit" class="btn btn-danger" name="yes">YES</button>
                    <button type="submit" class="btn btn-primary" name="no">NO</button>
                </form>
            </div>
            <div class="card-footer ">
                All rights Reserved
            </div>
        </div>
    </div>
</body>

</html>