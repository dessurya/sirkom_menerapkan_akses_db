<?php
require_once('model/dbMainCRUD.php');
class User
{
    protected $table = 'user';
    public function __construct() {
        $this->crud = new dbMainCRUD();
    }
    public function getData($param)
    {
        return $this->crud->select($param,$this->table);
    }
}
