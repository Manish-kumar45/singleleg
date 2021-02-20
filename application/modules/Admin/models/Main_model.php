<?php

class Main_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_single_record($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_single_record_desc($table, $where, $select) {
        $this->db->select($select);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_records($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }
    public function get_limit_records($table, $where, $select , $limit , $offset) {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->limit($limit , $offset);
        $query = $this->db->get($table);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function get_sum($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_object();
        return $res->sum;
    }

    public function get_incomes($table, $where, $select) {
        $this->db->select($select);
        $this->db->group_by('type');
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
        return $res;
    }

    public function getIncomeType(){
        $this->db->select('type');
        $this->db->group_by('type');
        $this->db->where(['amount >' => 0,'type !=' => 'bank_transfer']);
        $query = $this->db->get('tbl_income_wallet');
        return $query->result_array();
    }

    public function users_wallet_sum($table, $where , $having = false) {
        $this->db->select('ifnull(sum(amount),0) as balance ,user_id');
        $this->db->group_by('user_id');
        $this->db->order_by('balance','desc');
        if($having)
        $this->db->having('balance >','500');
        $query = $this->db->get_where($table, $where);
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }
    public function users_wallet_sum_total($table, $where , $having = false) {
        $this->db->select('ifnull(sum(amount),0) as balance ,user_id');
        $this->db->order_by('balance','desc');
        if($having)
        $this->db->having('balance >','500');
        $query = $this->db->get_where($table, $where);
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
        return $res;
    }

    public function get_chat_users() {
        $this->db->select('tbl_users.id,tbl_users.user_id,tbl_users.first_name,tbl_users.last_name,tbl_users.phone,tbl_users.sponser_id,tbl_users.image,tbl_support_message.*');
        $this->db->from('tbl_users');
        $this->db->group_by('tbl_users.user_id');
        $this->db->join('tbl_support_message', 'tbl_users.user_id = tbl_support_message.user_id', 'inner');
        $this->db->where(array());
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function get_all_users() {
        $this->db->select('tbl_users.id,tbl_users.user_id,tbl_users.name,tbl_users.first_name,tbl_users.last_name,tbl_users.phone,tbl_users.sponser_id,tbl_users.created_at');
        $this->db->from('tbl_users');
        // $this->db->join('countries', 'tbl_users.country = countries.id');
        $this->db->where(array());
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function retopup_users() {
        //SELECT sum(amount) , user_id FROM `tbl_income_wallet` where amount > 0 group by user_id ORDER BY `sum(amount)` DESC
        $this->db->select('tbl_users.retopup_count,sum(tbl_income_wallet.amount) as income, tbl_income_wallet.user_id');
        $this->db->from('tbl_income_wallet');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_income_wallet.user_id', 'inner');
        $this->db->where(array('tbl_income_wallet.amount > ' => 0));
        $this->db->group_by('tbl_income_wallet.user_id');
        $this->db->having('income >' , 5000 );
        $query = $this->db->get();
        $res = $query->result_array();
        // echo $this->db->last_query();
        return $res;
    }

    public function get_single_object($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function add($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $where, $data) {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function update_directs($user_id) {
        $this->db->set('directs', 'directs' . ' + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
//        echo $this->db->last_query();
    }
    public function update_count($position, $user_id) {
        $this->db->set($position, $position . ' + 1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
//        echo $this->db->last_query();
    }

    public function delete($table, $id) {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }
    public function delete_roi($table, $where) {
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function get_tree_user($user_id) {
        $this->db->select('tbl_user_positions.user_id,tbl_user_positions.sponser_id,tbl_user_positions.upline_id,tbl_user_positions.created_at as topup_date,tbl_user_positions.position,tbl_user_positions.left_node,tbl_user_positions.right_node,tbl_user_positions.left_count,tbl_user_positions.right_count,tbl_users.first_name,tbl_users.last_name,tbl_users.courtesy_title,tbl_users.email,tbl_users.created_at as joining_date');
        $this->db->from('tbl_user_positions');
        $this->db->join('tbl_users', 'tbl_user_positions.user_id = tbl_users.user_id');
        $this->db->where(array('tbl_user_positions.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->row_object();
//        echo $this->db->last_query();
        return $res;
    }

    public function update_bv($position, $user_id, $bv) {
        $this->db->set($position, $position . ' + ' . $bv, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_user_positions');
//        echo $this->db->last_query();
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

    public function user_chat($user_id) {
        $this->db->select('tbl_support_message.*,tbl_users.first_name,tbl_users.last_name,tbl_users.image');
        $this->db->from('tbl_support_message');
        $this->db->join('tbl_users', 'tbl_support_message.user_id = tbl_users.user_id', 'inner');
        $this->db->where(array('tbl_support_message.user_id' => $user_id));
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }
    public function rewards_users() {
        $this->db->select('count(a.id) as directs,a.sponser_id , b.name');
        $this->db->from('tbl_users a');
        $this->db->join('tbl_users b', 'a.sponser_id = b.user_id');
        $this->db->where(array('a.paid_status' => 1));
        $this->db->group_by('a.sponser_id');
        $this->db->having(array('directs >=' => 50));
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }


    public function datewise_payout($limit,$offset) {
        $this->db->select('sum(amount) as payout,date(created_at) as date');
        $this->db->from('tbl_income_wallet');
        $this->db->group_by('date(created_at)');
        $this->db->limit($limit , $offset);
        $this->db->order_by('date(created_at)','desc');
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function payout_dates_count() {
        $this->db->select('ifnull(count(date(created_at)),0) as record_count');
        $this->db->from('tbl_income_wallet');
        $this->db->group_by('date(created_at)');
        $query = $this->db->get();
        $res = $query->num_rows();
        return $res;
    }

    public function user_epins($where = '') {
        $this->db->select('ifnull(count(id),0) as pin_count , user_id');
        $this->db->group_by('user_id');
        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get('tbl_epins');
        $res = $query->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    public function checkRoiLevel(){
        $this->db->select('user_id');
        $this->db->from('tbl_roi');
        $this->db->group_by('user_id');
        $query = $this->db->get();
        return $query->result_array();
    }

}
