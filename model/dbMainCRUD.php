<?php
class dbMainCRUD
{
    public function __construct() {
        $conn = new mysqli('localhost', 'root', '', 'sirkom_aplp');
        if ($conn->connect_error) {
            echo json_encode([
                'res' => false,
                'msg' => 'Fail, connected on db main!'
            ]); die();
        }
        $this->connDB = $conn;
    }

    public function select($params, $table)
    {
        $result = [];
        $sql = "SELECT * FROM ".$table;
        if (isset($params['condition']) and $params['condition'] != null) {
            $sql .= " WHERE ".$this->getWhereCondition($params['condition']);
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
        if (isset($params['condition']) and $params['condition'] != null) { $sql .= " WHERE ".$this->getWhereCondition($params['condition']); }
        $result_query = $this->connDB->query($sql);
        while ($row = $result_query->fetch_array(MYSQLI_ASSOC)) { $count_data = $row['count_data']; }
        return [
            'sql' => $sql,
            'data' => $count_data,
        ];
    }

    public function paginate($params, $table)
    {
        $call_data = $this->select($params, $table);
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
        foreach ($condition as $row) { $query_condition .= " `".$row['field']."` ".$row['operator']." ".$row['value']." ".$row['andor']; }
        return $query_condition;
    }

    public function delete($params, $table)
    {
        $sql = "DELETE FROM `".$table."` ";
        if (isset($params['condition']) and $params['condition'] != null) {
            $sql .= " WHERE ".$this->getWhereCondition($params['condition']);
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
            $sql .= " WHERE ".$this->getWhereCondition($params['condition']);
        }
        $this->connDB->query($sql);
        return array('sql'=>$sql);
    }
}
