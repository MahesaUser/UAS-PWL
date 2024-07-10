<?php
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conn = mysqli_connect("localhost", "root", "", "db_penduduk");
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $username;
        header("Location: form.php");
    }else{
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(to bottom, #f2f2f2, #fff);
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">SELAMAT DATANG</h2>
                        <h4 class="card-title text-center">Login</h4>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control rounded-pill" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control rounded-pill" id="password" name="password" required>
                            </div>
                            <?php if(isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $error ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <button type="submit" name="submit" class="btn btn-primary btn-block rounded-pill">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>