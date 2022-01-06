<?php

require_once('model/Tarif.php');

$getTarif = new Tarif;
$getTarif = $getTarif->getData(['order' => ['field' => 'id_tarif', 'value' => 'asc']]);
$getTarif = $getTarif['data'];

// $table_config
    $table_config = array();
    $table_config['table_id'] = 'list_pelanggan';
    $table_config['table_title'] = 'List Pelanggan';
    $table_config['table_http'] = array('url'=>'http_request.php','mode'=>'getData','configure'=>'pelanggan');
    $table_config['table_info'] = null;
    $table_config['data_field_count'] = 6;
    $table_config['data_field_key'] = 'id_pelanggan';
    $table_config['data_order'] = array('field'=>'nama_pelanggan','value'=>'asc');
    $table_config['data_set'] = array();
    $table_config['data_set'][] = array('field' => 'tools', 'label' => 'Aksi', 'order' => false, 'search' => false, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'nomor_kwh', 'label' => 'No. Alat', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'nama_pelanggan', 'label' => 'Nama', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'daya', 'label' => 'Daya', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['data_set'][] = array('field' => 'tarifperkwh', 'label' => 'Tarif', 'order' => true, 'search' => true, 'search_type' => 'text');
    $table_config['tools'] = array();
    $table_config['tools'][] = array('label' => 'Tambah Pelanggan', 'function' => "addPelanggan()");
// $table_config

$param_on_script['table_list'] = $table_config;
$arr_script[] = '<script src="script/table-list.js"></script>';
$arr_script[] = '<script src="script/master-pelanggan.js"></script>';