<?php
include('includs/connection.php');
// make the action when user click on Save Button
if (isset($_POST['add'])) {

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

    $query = "insert into user(user_email,user_password,user_name,user_image)
              values('$email','$password','$fullname','$path$image_name')";
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
                        <h4 class="card-title">Add new User</h4>
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
                            <button type="submit" class="btn btn-primary pull-right" name="add">Create User</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table Start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Users Table</h4>
                        <p class="card-category"> Here is a Users for this table</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $query  = "SELECT * FROM User";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['user_id']}</td>";
                                            echo "<td>{$row['user_name']}</td>";
                                            echo "<td>{$row['user_email']}</td>";
                                            echo "<td><img src='{$row['user_image']}' width='80px' height='80px'></td>";
                                            echo "<td><a href='edit_user.php?id={$row['user_id']}' class='nav-link btn btn-primary'><i class='material-icons'>create</i></a></td>";
                                            echo "<td><a href='delete_user.php?id={$row['user_id']}' class='nav-link btn btn-danger'><i class='material-icons'>delete_forever</i></a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includs/footer.php');
?>