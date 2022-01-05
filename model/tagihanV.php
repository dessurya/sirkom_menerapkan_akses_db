<?php
require_once('model/dbMainCRUD.php');
class tagihanV
{
    protected $table = 'v_tagihan';
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
