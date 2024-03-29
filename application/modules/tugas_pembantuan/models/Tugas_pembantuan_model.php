<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Tugas_pembantuan_model extends CI_Model
{

    public $table = 'tugas_pembantuan';
    public $id = 'id';
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
        $this->db->like('id', $q);
    	$this->db->or_like('instansi_pemberi_tugas', $q);
    	$this->db->or_like('dasar_hukum', $q);
    	$this->db->or_like('program_keg_output', $q);
    	$this->db->or_like('lokasi', $q);
    	$this->db->or_like('skpd_pelaksana', $q);
        $this->db->where('tahun', $this->session->userdata('ta'));
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_data() {
        $this->db->order_by($this->id, $this->order);
    	$this->db->where('tahun', $this->session->userdata('ta'));
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

}

/* End of file Tugas_pembantuan_model.php */
/* Location: ./application/models/Tugas_pembantuan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-02-12 19:11:57 */
/* http://harviacode.com */