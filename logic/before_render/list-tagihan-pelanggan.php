<?php
// $table_config
    $table_config = array();
    $table_config['table_id'] = 'list_riwayat_tagihan';
    $table_config['table_title'] = 'List Riwayat Tagihan';
    $table_config['table_http'] = array('url'=>'http_request.php','mode'=>'getData','configure'=>'tagihan');
    $table_config['table_info'] = null;
    $table_config['data_field_count'] = 6;
    $table_config['data_field_key'] = 'id_tagihan';
    $table_config['data_order'] = array('field'=>'periode','value'=>'desc');
    $table_config['data_set'] = array();
    $table_config['data_set'][] = array('field' => 'status', 'label' => 'Keterangan', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'periode', 'label' => 'Periode', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'meter_awal', 'label' => 'Kwh Dari', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'meter_akhir', 'label' => 'Kwh Sampai', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'jumlah_meter', 'label' => 'Penggunaan (Kwh)', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'biaya', 'label' => 'Total Biaya', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['tools'] = array();
// $table_config

$param_on_script['table_list'] = $table_config;
$param_on_script['id_pelanggan'] = $_SESSION['sess_user']['user']['id_pelanggan'];
$arr_script[] = '<script src="script/table-list.js"></script>';
$arr_script[] = '<script src="script/list-tagihan-pelanggan.js"></script>';