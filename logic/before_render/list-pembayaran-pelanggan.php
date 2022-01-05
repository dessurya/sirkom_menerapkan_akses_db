<?php
// $table_config
    $table_config = array();
    $table_config['table_id'] = 'list_riwayat_pembayaran';
    $table_config['table_title'] = 'List Riwayat Pembayaran';
    $table_config['table_http'] = array('url'=>'http_request.php','mode'=>'getData','configure'=>'pembayaran');
    $table_config['table_info'] = null;
    $table_config['data_field_count'] = 6;
    $table_config['data_field_key'] = 'id_pembayaran';
    $table_config['data_order'] = array('field'=>'periode','value'=>'desc');
    $table_config['data_set'] = array();
    $table_config['data_set'][] = array('field' => 'tanggal_pembayaran', 'label' => 'Tanggal', 'order' => true, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'periode', 'label' => 'Periode', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'biaya_admin', 'label' => 'Biaya Admin', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'total_bayar', 'label' => 'Biaya Penggunaan', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'biaya_keseluruhan', 'label' => 'Total Biaya', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'nama_admin', 'label' => 'Dibayarkan Ke', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['tools'] = array();
// $table_config

$param_on_script['table_list'] = $table_config;
$param_on_script['id_pelanggan'] = $_SESSION['sess_user']['user']['id_pelanggan'];
$arr_script[] = '<script src="script/table-list.js"></script>';
$arr_script[] = '<script src="script/list-pembayaran-pelanggan.js"></script>';