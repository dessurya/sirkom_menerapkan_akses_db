<?php
require_once('model/dbMainCRUD.php');
class Pelanggan
{
    protected $table = 'pelanggan';
    public function __construct() {
        $this->crud = new dbMainCRUD();
    }
    public function getData($param)
    {
        return $this->crud->select($param,$this->table);
    }
}
