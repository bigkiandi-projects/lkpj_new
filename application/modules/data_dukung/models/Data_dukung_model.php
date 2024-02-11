<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Data_dukung_model extends CI_Model
{

    public $table = 'data_dukung';
    public $id = 'id_data_dukung';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_exist(){
        $this->db->order_by($this->id, $this->order);
        $this->db->group_by('id_opd');
        return $this->db->get($this->table)->result();
    }

    // get all berkas by id
    function cek_triwulan($idnya) {
        $this->db->select('triwulan');
        $this->db->where('id_opd', $idnya);
        $result = $this->db->get($this->table)->result();

        $dataa = array('I', 'II', 'III', 'IV');

        if($result) {
            foreach($result as $a) {
                $hasil[] = $a->triwulan;
            }
            return array_diff($dataa, $hasil);
        } else {
            return $dataa;
        }
    }

    // get data by id
    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_berkas($id) {
        $this->db->where('id_triwulan', $id);
        return $this->db->get('data_dukung_berkas')->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_data_dukung', $q);
	$this->db->or_like('triwulan', $q);
	$this->db->or_like('tahun', $q);
	$this->db->or_like('id_opd', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_data_dukung', $q);
	$this->db->or_like('triwulan', $q);
	$this->db->or_like('tahun', $q);
	$this->db->or_like('id_opd', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // insert data
    function save_berkas($data) {

        $this->db->insert('data_dukung_berkas', $data);
        return true;
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update data
    function update_berkas($id, $data)
    {
        $this->db->where('id_data_dukung_berkas', $id);
        $this->db->update('data_dukung_berkas', $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete berkas
    function hapus_berkas($id, $berkas) {

        $a = 'assets/upload/dokumen/'.$berkas->dok_perencanaan;
        $b = 'assets/upload/dokumen/'.$berkas->lap_evaluasi;
        $c = 'assets/upload/dokumen/'.$berkas->lap_lkpj;
        $d = 'assets/upload/dokumen/'.$berkas->data_sektoral;

        if(file_exists($a)) {
            unlink($a);
        }
        if(file_exists($b)) {
            unlink($b);
        }
        if(file_exists($c)) {
            unlink($c);
        }
        if(file_exists($d)) {
            unlink($d);
        }

        $this->db->where('id_triwulan', $id);
        $this->db->delete('data_dukung_berkas');
    }

    public function get_opd_user($id_user) {

        $this->db->select('id_user, nama_user');
        $this->db->from('user');
        $this->db->order_by('id_user');
        $this->db->where_in('id_user', $id_user);

        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_triwulan($p_cat->id_user);
            $i++;
        }
        return $categories;
    }

    public function get_triwulan($id_user) {

        $this->db->select('*');
        $this->db->from('data_dukung');
        $this->db->order_by('triwulan');
        $this->db->where('id_opd', $id_user);

        $parent = $this->db->get();
        
        $categories = $parent->result();
        
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_berkas($p_cat->id_data_dukung);
            $i++;
        }
        return $categories;
    }

    public function get_berkas($id_triwulan) {

        $this->db->select('*');
        $this->db->from('data_dukung_berkas');
        $this->db->where('id_triwulan', $id_triwulan);

        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;

        return $categories;
    }

}

/* End of file Data_dukung_model.php */
/* Location: ./application/models/Data_dukung_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-02-06 17:32:27 */
/* http://harviacode.com */