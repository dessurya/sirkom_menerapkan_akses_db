<?php
require_once('model/dbMainCRUD.php');
class Tarif
{
    protected $table = 'tarif';
    public function __construct() {
        $this->crud = new dbMainCRUD();
    }
    public function getData($param)
    {
        return $this->crud->select($param,$this->table);
    }
}
