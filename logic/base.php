<?php

    if(session_id() == '') { session_start(); }
    if (!isset($_SESSION['sess_user'])) { header("location: login.php"); die(); }
    $title_page = 'Pembayaran Listrik';
    $arr_style = [
        '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">',
    ];
    $arr_script = [
        '<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>',
        '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>',
        '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>',
        '<script src="script/base.js"></script>',
    ];
    $param_on_script = [];

    $arr_menu = [
        'staff' => [
            ['link'=>'?page=master-pelanggan','label'=>'MST. PELANGGAN'],
            ['link'=>'?page=master-tarif','label'=>'MST. TARIF'],
            ['link'=>'?page=list-tagihan','label'=>'RIWAYAT TAGIHAN'],
            ['link'=>'?page=list-pembayaran','label'=>'RIWAYAT PEMBAYARAN'],
        ],
        'pelanggan' => [
            ['link'=>'?page=list-tagihan-pelanggan','label'=>'RIWAYAT TAGIHAN'],
            ['link'=>'?page=list-pembayaran-pelanggan','label'=>'RIWAYAT PEMBAYARAN'],
        ],
    ];

    $body_content = 'body_content/profile.php';
    if (isset($_GET['page'])) { 
        $cek_body_content = 'body_content/'.$_GET['page'].'.php';
        if (file_exists($cek_body_content)) {
            $title_content = str_replace('-',' ',$_GET['page']);
            $body_content = $cek_body_content;
        }else{ header("location: index.php"); die(); }
        $cek_logic = 'logic/before_render/'.$_GET['page'].'.php';
        if (file_exists($cek_logic)) { require_once($cek_logic); }
    }else{
        require_once('logic/before_render/profile.php');
    }