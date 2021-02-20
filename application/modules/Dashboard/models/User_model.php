<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_single_record($table, $where, $select, $queryshow = false) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
        if ($queryshow == true)
            echo $this->db->last_query();
        return $res;
    }

    public function get_records($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function paid_members($table, $where, $select) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by('topup_date','asc');
        $query = $this->db->get();
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }
    public function top_directs() {
        $this->db->select('count(a.id) as directs,a.sponser_id , b.name');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_users b', 'a.sponser_id = b.user_id');
        $this->db->where(array('a.paid_status' => 1));
        $this->db->group_by('a.sponser_id');
        $this->db->having(array('directs >' => 50));
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function get_limit_records($table, $where, $select, $limit, $offset) {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->limit($offset, $limit);
        $query = $this->db->get($table);
        $res = $query->result_array();
        return $res;
    }

    public function count_cookies($user_id) {
        $this->db->select('ifnull(count(id),0) as cookie_count,sponser_refferal_count');
        $this->db->where(array('sponser_id' => $user_id));
        $this->db->from('tbl_users');
        $this->db->group_by('sponser_refferal_count');
        $query = $this->db->get();
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function calculate_team($user_id, $status) {
        $this->db->select('ifnull(count(tbl_downline_count.downline_id),0) as team, tbl_users.paid_status');
        $this->db->from('tbl_users');
        $this->db->join('tbl_downline_count', 'tbl_users.user_id = tbl_downline_count.downline_id');
        $this->db->where(array('tbl_downline_count.user_id' => $user_id, 'tbl_users.paid_status' => $status, 'tbl_downline_count.level !=' => 1));
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }

    public function royalty_achievers() {
        $this->db->select('id,count(user_id) as new_directs,sponser_id  ');
        $this->db->where(array('paid_team_count >=' => 80));
        $this->db->from('tbl_users');
        $this->db->group_by('sponser_id');
        $this->db->having('new_directs >=', 3);
        $query = $this->db->get();
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_user_package_commison($user_id) {
        $this->db->select('tbl_user_positions.sponser_id,tbl_package.commision');
        $this->db->from('tbl_user_positions');
        $this->db->join('tbl_package', 'tbl_user_positions.package = tbl_package.id');
        $this->db->where(array('tbl_user_positions.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function update_directs($user_id) {
        $this->db->set('directs', 'directs + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
    }

    public function total_team_update($id) {
        $this->db->set('total_user_after_paid', 'total_user_after_paid + 1', FALSE);
        $this->db->where(['paid_status' => 1,'id !=' => $id]);
        $this->db->update('tbl_users');
    }


    public function update_paid_team($where) {
        $this->db->set('total_user_after_paid', 'total_user_after_paid + 1', FALSE);
        $this->db->where($where);
        $this->db->update('tbl_users');
    }

    public function update_count($where,$field) {
        $this->db->set($field, $field.' + 1', FALSE);
        $this->db->where($where);
        $this->db->update('tbl_users');
        echo $this->db->last_query();
    }
    public function waster_count($where) {
        $this->db->set('waste_count', 'waste_count + 1', FALSE);
        $this->db->where($where);
        $this->db->update('tbl_users');
    }
    public function get_single_object($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_object();
//        echo $this->db->last_query();
        return $res;
    }

    public function leadership_members($user_id) {
        $this->db->select('id,user_id,name,phone,directs,paid_team_count,created_at,email');
        $this->db->where(array('sponser_id' => $user_id));
        $this->db->limit(3);
        $this->db->order_by('paid_team_count', 'desc');
        $this->db->from('tbl_users');
        $query = $this->db->get();
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_tree_user($user_id) {
        $this->db->select('tbl_user_positions.user_id,tbl_user_positions.sponser_id,tbl_user_positions.upline_id,tbl_user_positions.created_at as topup_date,tbl_user_positions.position,tbl_user_positions.left_node,tbl_user_positions.right_node,tbl_user_positions.left_count,tbl_user_positions.right_count,tbl_users.first_name,tbl_users.last_name,tbl_users.courtesy_title,tbl_users.email,tbl_users.created_at as joining_date,tbl_package.commision');
        $this->db->from('tbl_user_positions');
        $this->db->join('tbl_users', 'tbl_user_positions.user_id = tbl_users.user_id');
        $this->db->join('tbl_package', 'tbl_user_positions.package = tbl_package.id');
        $this->db->where(array('tbl_user_positions.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->row_object();
//        echo $this->db->last_query();
        return $res;
    }

    public function add($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $where, $data) {
        $this->db->where($where);
        $res = $this->db->update($table, $data);
//        echo $this->db->last_query();
        return $res;
    }

//     public function update_count($position, $user_id) {
//         $this->db->set($position, $position . ' + 1', FALSE);
//         $this->db->where('user_id', $user_id);
//         $this->db->update('tbl_user_positions');
// //        echo $this->db->last_query();
//     }

    public function update_team_count($position, $user_id) {
        $this->db->set($position, $position . ' + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
        // echo $this->db->last_query();
    }

    public function update_bv($position, $user_id, $bv) {
        $this->db->set($position, $position . ' + ' . $bv, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_user_positions');
//        echo $this->db->last_query();
    }

    public function user_chat($user_id) {
        $this->db->select('tbl_support_message.*,tbl_users.first_name,tbl_users.last_name,tbl_users.image');
        $this->db->from('tbl_support_message');
        $this->db->join('tbl_users', 'tbl_support_message.user_id = tbl_users.user_id', 'inner');
        $this->db->where(array('tbl_support_message.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function magic_users() {
        $this->db->select('sum(amount) as total_amount,user_id');
        $this->db->from('tbl_repurchase_income');
        $this->db->having('total_amount > ', 3600);
        $this->db->group_by('user_id');
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function delete($table, $where) {
        $this->db->where($where);
        return $this->db->delete($table);
    }

}
