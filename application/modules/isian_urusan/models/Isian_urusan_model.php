<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Isian_urusan_model extends CI_Model
{

    public $table = 'isian_urusan';
    public $id = 'id_isian_urusan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_isian_urusan', $q);
	$this->db->or_like('kode_urusan', $q);
	$this->db->or_like('opd', $q);
	$this->db->or_like('tahun', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_isian_urusan', $q);
	$this->db->or_like('kode_urusan', $q);
	$this->db->or_like('opd', $q);
	$this->db->or_like('tahun', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function get_program($urusan_id){
        $ar = array('p_id' => $urusan_id);
        $this->db->select('*');
        $this->db->from('permendagri');
        $this->db->where($ar);

        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->kegiatan($p_cat->Kode);
            $i++;
        }
        return $categories;
    }

    public function kegiatan($id){
        $ar = array('p_id' => $id);

        $this->db->select('*');
        $this->db->from('permendagri');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_kegiatan($p_cat->Kode);
            $i++;
        }
        return $categories;       
    }

    public function sub_kegiatan($id){
        $ar = array('p_id' => $id);

        $this->db->select('*');
        $this->db->from('permendagri');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_kegiatan($p_cat->Kode);
            $i++;
        }
        return $categories;       
    }

}

/* End of file Isian_urusan_model.php */
/* Location: ./application/models/Isian_urusan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-31 20:21:25 */
/* http://harviacode.com */