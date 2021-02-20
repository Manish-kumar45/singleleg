<?php

class Register_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_single_record($table, $where, $select, $queryshow = false) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
        return $res;
    }

    public function add($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $where, $data) {
        $this->db->where($where);
        $res = $this->db->update($table, $data);
        return $res;
    }

}