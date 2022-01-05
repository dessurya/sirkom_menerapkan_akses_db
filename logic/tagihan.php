<?php
if ($post_mode == "getData") {
    $input = array(
        'show' => $_POST['show'],
        'order_key' => $_POST['order_key'],
        'order_val' => $_POST['order_val'],
        'page' => $_POST['page'],
        'condition' => array(),
    );
    if (isset($_POST['condition'])) { $input['condition'] = $_POST['condition']; }
    getData($input);
}

function getData($input)
{
    require_once('model/tagihanV.php');
    $tagihan = new tagihanV;
    $params = [];
    if (count($input['condition']) > 0) {
        $params['condition'] = [];
        foreach ($input['condition'] as $key => $value) {
            $params['condition'][] = [
                "field" => $key,
                "operator" => 'LIKE',
                "value" => '\'%'.$value.'%\'',
                "andor" => 'AND',
            ];
        }
        $params['condition'][count($input['condition'])-1]['andor'] = '';
    }
    $params['limit'] = $input['show'];
    $params['page'] = $input['page'];
    $params['offset'] = $input['show']*($input['page']-1);
    $params['order'] = array('field'=>$input['order_key'],'value'=>$input['order_val']);
    echo json_encode([
        'res' => true,
        'data' => $tagihan->paginate($params)
    ]); die();
}
