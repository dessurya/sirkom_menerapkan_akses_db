<?php
    if(session_id() == '') { session_start(); }
    if (isset($_SESSION['sess_user'])) { 
        header("location: index.php"); 
        die(); }
    $arr_style = [
        '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">',
    ];
    $arr_script = [
        '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>',
        '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>',
        '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>',
    ];

    if (isset($_POST['username'])) { doLogin($_POST['username'], $_POST['password']); }

    function doLogin($username, $password)
    {
        $password = base64_encode($password);
        $getUser = cekStaff($username, $password);
        if (count($getUser['data']) > 0) { 
            setSessionLogin($getUser['data'][0],'staff'); 
        }else {
            $getPelanggan = cekPelanggan($username, $password);
            if (count($getPelanggan['data']) > 0) { 
                setSessionLogin($getPelanggan['data'][0],'pelanggan'); 
            }else {
                echo json_encode([
                    'res' => false,
                    'msg' => 'Fail, your username and password is incorret!'
                ]); die();
            }
        }
    }

    function cekPelanggan($username, $password)
    {
        require_once('model/Pelanggan.php');
        $pelanggan = new Pelanggan;
        return $pelanggan->getData([
            'condition' => [
                [
                    'field' => 'username',
                    'operator' => '=',
                    'value' => '\''.$username.'\'',
                    'andor' => 'AND'
                ],[
                    'field' => 'password',
                    'operator' => '=',
                    'value' => '\''.$password.'\'',
                    'andor' => ''
                ],
            ], 'limit' => 1
        ]);
    }

    function cekStaff($username, $password)
    {
        require_once('model/User.php');
        $user = new User;
        return $user->getData([
            'condition' => [
                [
                    'field' => 'username',
                    'operator' => '=',
                    'value' => '\''.$username.'\'',
                    'andor' => 'AND'
                ],[
                    'field' => 'password',
                    'operator' => '=',
                    'value' => '\''.$password.'\'',
                    'andor' => ''
                ],
            ], 'limit' => 1
        ]);
    }

    function setSessionLogin($sess,$role)
    {
        $_SESSION['sess_user'] = [
            'user' => $sess,
            'role' => $role,
        ];
        header("location: index.php");
    }