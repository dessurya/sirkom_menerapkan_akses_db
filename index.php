<?php include('logic/base.php'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title_page?></title>
    <style>
        .hide{
            display:none;
        }
    </style>
    <?php foreach ($arr_style as $row) { echo $row; } ?>
</head>
<body>
    <?php include('body_content/component/navbar.php') ?>
    <div class="container" style="padding:5vh 0;">
        <div class="card">
            <div class="card-body">
                <?php include($body_content) ?>
            </div>
        </div>
    </div>

    <script>
        const param_on_script = '<?=base64_encode(json_encode($param_on_script))?>'
    </script>
    <?php foreach ($arr_script as $row) { echo $row; } ?>
</body>
</html>