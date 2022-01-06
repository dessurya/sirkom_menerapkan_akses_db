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
} elseif ($post_mode == "deletePelanggan") {
    deletePelanggan($_POST['id_pelanggan']);
} elseif ($post_mode == "storePelanggan") {
    storePelanggan($_POST['data']);
}

function storePelanggan($input)
{
    require_once('model/Pelanggan.php');
    $pelanggan = new Pelanggan;
    $setParam = [
        [ 
            'field'=>'username',
            'value' => $input['username']
        ],
        [ 
            'field'=>'nama_pelanggan',
            'value' => $input['nama_pelanggan']
        ],
        [ 
            'field'=>'nomor_kwh',
            'value' => $input['nomor_kwh']
        ],
        [ 
            'field'=>'id_tarif',
            'value' => $input['id_tarif']
        ],
        [ 
            'field'=>'alamat',
            'value' => $input['alamat']
        ],
        [ 
            'field'=>'password',
            'value' => base64_encode('asdqwe123')
        ],
    ];
    if ($input['id_pelanggan'] == null OR $input['id_pelanggan'] == '') {
        $query = $pelanggan->insert([
            'set' => $setParam
        ]);
        $msg = 'Success, insert data';
    }else{
        $query = $pelanggan->update([
            'set' => $setParam,
            'condition' => [
                [
                    "field" => 'id_pelanggan',
                    "operator" => '=',
                    "value" => $input['id_pelanggan'],
                    "andor" => '',
                ]
            ]
        ]);
        $msg = 'Success, update data';
    }
    echo json_encode([
        'res' => true,
        'query' => $query,
        'msg' => $msg,
    ]); die();
}

function deletePelanggan($id_pelanggan)
{
    require_once('model/Pelanggan.php');
    $pelanggan = new Pelanggan;
    $pelanggan->delete([
        'condition' => [
            [
                "field" => 'id_pelanggan',
                "operator" => '=',
                "value" => $id_pelanggan,
                "andor" => '',
            ]
        ]
    ]);
    echo json_encode([
        'res' => true,
        'msg' => 'Success delete data'
    ]); die();
}

function getData($input)
{
    require_once('model/pelangganV.php');
    $pelanggan = new pelangganV;
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
        'data' => $pelanggan->paginate($params)
    ]); die();
}
