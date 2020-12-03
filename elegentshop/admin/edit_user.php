<?php
include('includs/connection.php');
// make the action when user click on Save Button
if (isset($_POST['update'])) {

    // get image data
    $image_name = $_FILES['user_image']['name'];
    $tmp_name   = $_FILES['user_image']['tmp_name'];
    $path       = 'img/user_image/';


    // move image to folder
    move_uploaded_file($tmp_name, $path . $image_name);

    // Take Data From Web Form 
    $email    = $_POST['user_email'];
    $password = $_POST['user_password'];
    $fullname = $_POST['user_name'];

    $query = "update user set 
    user_password   = '$password',
    user_name       = '$fullname',
    user_image      = '$path$image_name',
    user_email      = '$email'
    where user_id   = {$_GET['id']}";

    mysqli_query($conn, $query);
    header("location:manage_user.php");
}
?>
<?php
include('includs/header.php');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Form Start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Full Name</label>
                                        <input type="text" name="user_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Email address</label>
                                        <input type="email" name="user_email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Password</label>
                                        <input type="password" name="user_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <label for="img"></label>
                            <input class="btn btn-primary col-md-6" name="user_image" type="file" id="img" name="img" accept="image/*">
                            <button type="submit" class="btn btn-primary pull-right" name="update">Update User</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includs/footer.php');
?>