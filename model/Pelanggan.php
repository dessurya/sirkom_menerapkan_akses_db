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
    public function paginate($param)
    {
        return $this->crud->paginate($param,$this->table);
    }
    public function delete($param)
    {
        return $this->crud->delete($param,$this->table);
    }
    public function insert($params)
    {
        return $this->crud->insert($params, $this->table);
    }
    public function update($params)
    {
        return $this->crud->update($params, $this->table);
    }
}
