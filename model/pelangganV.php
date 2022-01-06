<?php
require_once('model/dbMainCRUD.php');
class pelangganV
{
    protected $table = 'v_pelanggan';
    public function __construct() {
        $this->crud = new dbMainCRUD();
    }
    public function getData($param)
    {
        return $this->crud->select($param,$this->table);
    }

    public function paginate($param)
    {
        return $this->crud->paginate($param,$this->table);
    }
}
