<?php include('logic/login.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi Pembayaran</title>
    <?php
        foreach ($arr_style as $row) { echo $row; }
        foreach ($arr_script as $row) { echo $row; }
    ?>
</head>
<body style="margin: 0; padding:10vh 0;">
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                Selamat Datang! Silahkan Login!
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="input-username">Username</label>
                                <input type="text" class="form-control" id="input-username" placeholder="Enter username" name="username" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="input-password">Password</label>
                                <input type="password" class="form-control" id="input-password" placeholder="Enter password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>