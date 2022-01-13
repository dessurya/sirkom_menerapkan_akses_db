<?php
// Pembuatan Main Class
// Untuk koneksi ke database utama
// Serta membuat fungsi umum secara garis besar ( CRUD )

class dbMainCRUD // pendefinisian nama class
{
    protected $connDB;

    public function __construct() { // pembuatan class construct yang langsung di eksekusi ketika class di panggil
        $this->connToDb();
    }
    
    private function connToDb()
    {
        $conn = new mysqli('localhost', 'u5017997_adm_asd', '1sampai10', 'u5017997_sirkom'); // mengakses database
        if ($conn->connect_error) { // pengecekan akses database
            echo json_encode([
                'res' => false,
                'msg' => 'Fail, connected on db main!'
            ]); die(); // pesan error jika gagal mengakses database
        }
        $this->connDB = $conn;
    }

    // pembuatan fungsi select dengan 2 paramater $params & $table
    // $params : berisiakan array
    // $table : berisikan string
    public function select($params, $table)
    {
        $result = []; // parameter penampung nilai
        // Pembentukan query
        $sql = "SELECT * FROM ".$table;
        if (isset($params['condition']) and $params['condition'] != null) {
            $sql .= $this->getWhereCondition($params['condition']); // pemanggilan fungsi untuk string where
        }
        if (isset($params['group_by']) and $params['group_by'] != null) {
            $sql .= " GROUP BY ".$params['group_by'];
        }
        if (isset($params['order']) and $params['order'] != null) {
            $sql .= " ORDER BY `".$params['order']['field']."` ".$params['order']['value'];
        }
        if (isset($params['limit']) and $params['limit'] != null) {
            $sql .= " LIMIT ".$params['limit'];
        }
        if (isset($params['offset']) and $params['offset'] != null) {
            $sql .= " OFFSET ".$params['offset'];
        }
        // Pembentukan query

        if($result_query = $this->connDB->query($sql)){
            while ($row = $result_query->fetch_array(MYSQLI_ASSOC)) { $result[] = $row; }
            return [
                'res' => true,
                'sql' => $sql,
                'data' => $result
            ];
        } else {
            return [
                'res' => false,
                'sql' => $sql
            ];
        }
    }

    public function selectCount($params, $table)
    {
        $sql = "SELECT COUNT(*) AS count_data FROM ".$table;
        if (isset($params['condition']) and $params['condition'] != null) { $sql .= $this->getWhereCondition($params['condition']); }
        $result_query = $this->connDB->query($sql);
        while ($row = $result_query->fetch_array(MYSQLI_ASSOC)) { 
            $count_data = $row['count_data'];
        }
        return [
            'sql' => $sql,
            'data' => $count_data,
        ];
    }

    public function paginate($params, $table)
    {
        $call_data = $this->select($params, $table);
        // return $call_data;
        // return [
        //     'from' => 1,
        //     'to' => 1,
        //     'total' => 1,
        //     'current_page' => $params['page'],
        //     'last_page' => 1,
        //     'data' => $call_data['data'],
        // ];
        mysqli_close($this->connDB);
        $this->connToDb();
        $count_all_data = $this->selectCount($params, $table);
        $count_all_data = $count_all_data['data'];
        $to = $params['offset']+$params['limit'];
        if ($to > $count_all_data) { $to = $count_all_data; }
        $max_page = $count_all_data/$params['limit'];
        $max_page = ceil($max_page);
        if ($max_page == 0) { $max_page = 1; }
        return [
            'from' => $params['offset']+1,
            'to' => $to,
            'total' => $count_all_data,
            'current_page' => $params['page'],
            'last_page' => $max_page,
            'data' => $call_data['data'],
        ];
    }

    private function getWhereCondition($condition)
    {
        $query_condition = "";
        foreach ($condition as $row) { 
            if ($row['value'] != '' and $row['value'] != null and $row['value'] != '\'%%\'') {
                $query_condition .= " `".$row['field']."` ".$row['operator']." ".$row['value']." ".$row['andor'];
            }
        }
        if ($query_condition != "") { $query_condition = " WHERE ".$query_condition; }
        return $query_condition;
    }

    public function delete($params, $table)
    {
        $sql = "DELETE FROM `".$table."` ";
        if (isset($params['condition']) and $params['condition'] != null) {
            $sql .= $this->getWhereCondition($params['condition']);
        }
        $this->connDB->query($sql);
        return array('sql'=>$sql);
    }

    public function insert($params, $table)
    {
        $field = [];
        $values = [];
        $valid = 0;
        foreach ($params['set'] as $row) { 
            if (isset($row['field']) and isset($row['value'])) {
                $field[] = " `".$row['field']."`";
                $values[] = " '".$row['value']."'";
                $valid++;
            }
        }
        if ($valid > 0) {
            $field = implode(", ",$field);
            $values = implode(", ",$values);
            $sql = "INSERT INTO `".$table."` (".$field.") VALUES (".$values.")";
            $this->connDB->query($sql);
            return array('sql'=>$sql);
        } else{ return array('id'=>null,'sql'=>null, 'error' => true); }
    }

    public function update($params, $table)
    {
        $set = [];
        foreach ($params['set'] as $row) { $set[] = $row['field']." = '".$row['value']."'"; }
        $set = implode(", ",$set);
        $sql = "UPDATE `".$table."` SET ".$set;
        if (isset($params['condition']) and $params['condition'] != null) {
            $sql .= $this->getWhereCondition($params['condition']);
        }
        $this->connDB->query($sql);
        return array('sql'=>$sql);
    }
}
