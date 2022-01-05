<?php
$false_response = array(
    "response" => false,
    "msg" => "undefine request"
);

if (!isset($_POST['mode']) or $_POST['mode'] == null or $_POST['mode'] == '' or !isset($_POST['configure']) or $_POST['configure'] == null or $_POST['configure'] == '') {
    echo json_encode($false_response); die();
}

$post_mode = $_POST['mode'];
$post_configure = $_POST['configure'];

$configuration = array(
    "tagihan" => array(
        "logic" => "logic/tagihan.php",
        "in_array" => array(
            "getData"
        )
    ),
    "pembayaran" => array(
        "logic" => "logic/pembayaran.php",
        "in_array" => array(
            "getData"
        )
    ),
);


if (in_array($post_mode, $configuration[$post_configure]['in_array'])) { require_once($configuration[$post_configure]['logic']); }
else{ echo json_encode($false_response); }