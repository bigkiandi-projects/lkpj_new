<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Capaian_model extends CI_Model
{

    public $table = 'cp_kinerja';
    public $id = 'idCapai';
    public $order = 'ASC';

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
        $this->db->like('idCapai', $q);
	$this->db->or_like('idOpd', $q);
	$this->db->or_like('kd', $q);
	$this->db->or_like('target', $q);
	$this->db->or_like('real_target', $q);
	$this->db->or_like('alokasi_ang', $q);
	$this->db->or_like('real_ang', $q);
	$this->db->or_like('presentasi', $q);
	$this->db->or_like('permasalahan', $q);
	$this->db->or_like('upaya', $q);
	$this->db->or_like('tl', $q);
	$this->db->or_like('tahun', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idCapai', $q);
    	$this->db->or_like('idOpd', $q);
    	$this->db->or_like('kd', $q);
    	$this->db->or_like('target', $q);
    	$this->db->or_like('real_target', $q);
    	$this->db->or_like('alokasi_ang', $q);
    	$this->db->or_like('real_ang', $q);
    	$this->db->or_like('presentasi', $q);
    	$this->db->or_like('permasalahan', $q);
    	$this->db->or_like('upaya', $q);
    	$this->db->or_like('tl', $q);
    	$this->db->or_like('tahun', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data){
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return true;
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function get_bidang($opd, $ur) {

        if(!empty($ur)) {
            $ar = array('opd_id' => $ur);
        } else {
            $ar = array('opd_id' => $opd);
        }

        $this->db->select('*');
        $this->db->from('bidang');
        $this->db->where($ar);

        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->program($p_cat->kdBid);
            $i++;
        }
        return $categories;
    }

    public function program($id){
        $ar = array('p_id' => $id);

        $this->db->select('*');
        $this->db->from('program');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->kegiatan($p_cat->kdProg);
            $i++;
        }
        return $categories;       
    }

    public function kegiatan($id){
        $ar = array('p_id' => $id);

        $this->db->select('*');
        $this->db->from('kegiatan');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_kegiatan($p_cat->kdKeg);
            $i++;
        }
        return $categories;       
    }

    public function sub_kegiatan($id){
        $ar = array('p_id' => $id);

        $this->db->select('*');
        $this->db->from('subkegiatan');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_kegiatan($p_cat->kdSubkeg);
            $i++;
        }
        return $categories;       
    }

    function passProg($data) {
        $this->db->select('*');
        $this->db->from('program');  
        $this->db->where_in('kdProg' , $data);
        return $this->db->get()->result();
    }

    function passKeg($data) {
        $this->db->select('*');
        $this->db->from('kegiatan');  
        $this->db->where_in('kdKeg' , $data);
        return $this->db->get()->result();
    }

    function passSubKeg($data) {
        $this->db->select('*');
        $this->db->from('subkegiatan');  
        $this->db->where_in('kdSubkeg' , $data);
        return $this->db->get()->result();
    }

    function kd_exist($kd, $id, $th) {
        $cond = array('kd' => $kd, 'idOpd' => $id, 'tahun' => $th);
        $this->db->where($cond);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0){
            return false;
        }
        else{
            return true;
        }
    }

    function save_prog($data){
        $this->db->insert($this->table, $data);
    }


    // ====== view prog / opd =====

    public function get_view_opd($kdUr, $idOpd, $th) {
        $this->db->select('*');
        $this->db->from('opd');
        $this->db->where('idOpd', $idOpd);

        $parent = $this->db->get();
        
        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_view_bidang($kdUr, $idOpd, $th);
            $i++;
        }
        return $categories;
    }

    public function get_view_bidang($kdUr, $idOpd, $th) {
        $this->db->select('*');
        $this->db->from('bidang');
        $this->db->where_in('opd_id', $kdUr);

        $parent = $this->db->get();
        
        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_program($p_cat->kdBid, $idOpd, $th);
            $i++;
        }
        return $categories;
    }

    public function get_program($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

    public function get_kegiatan($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat) {

            $categories[$i]->sub = $this->get_sub_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

    public function get_sub_kegiatan($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);
        $this->db->order_by('kd');

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_sub_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

        // ====== view all opd =====
    // ====== view prog / opd =====

    public function get_all_opd($kdUr, $th) {
        $this->db->select('*');
        $this->db->from('opd');

        $parent = $this->db->get();
        
        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_all_bidang($kdUr, $p_cat->idOpd, $th);
            $i++;
        }
        return $categories;
    }

    public function get_all_bidang($kdUr, $idOpd, $th) {
        $this->db->select('*');
        $this->db->from('bidang');
        $this->db->where_in('opd_id', $kdUr);

        $parent = $this->db->get();
        
        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat) {

            $categories[$i]->sub = $this->get_all_program($p_cat->kdBid, $idOpd, $th);
            $i++;
        }
        return $categories;
    }

    public function get_all_program($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_all_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

    public function get_all_kegiatan($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat) {

            $categories[$i]->sub = $this->get_all_sub_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

    public function get_all_sub_kegiatan($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);
        $this->db->order_by('kd');

        $child = $this->db->get();
        $categories = $child->result();

        return $categories;       
    }

        // ====== view rekap =====
    // ====== view prog / opd =====

    public function get_rekap_opd($kdUr, $th) {
        $this->db->select('*');
        $this->db->from('opd');

        $parent = $this->db->get();
        
        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->bid = $this->get_rekap_bidang($kdUr, $p_cat->idOpd, $th);
            $i++;
        }
        return $categories;
    }

    public function get_rekap_bidang($kdUr, $idOpd, $th) {
        $this->db->select('*');
        $this->db->from('bidang');
        $this->db->where_in('opd_id', $kdUr);

        $parent = $this->db->get();
        
        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat) {

            $categories[$i]->prg = $this->get_rekap_program($p_cat->kdBid, $idOpd, $th);
            $i++;
        }
        return $categories;
    }

    public function get_rekap_program($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->keg = $this->get_rekap_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

    public function get_rekap_kegiatan($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat) {

            $categories[$i]->subkeg = $this->get_rekap_sub_kegiatan($p_cat->kd, $idOpd, $th);
            $i++;
        }
        return $categories;       
    }

    public function get_rekap_sub_kegiatan($id, $idOpd, $th){
        $ar = array('idOpd' => $idOpd ,'p_id' => $id, 'tahun' => $th);

        $this->db->select('*');
        $this->db->from('cp_kinerja');  
        $this->db->where($ar);
        $this->db->order_by('kd');

        $child = $this->db->get();
        $categories = $child->result();

        return $categories;       
    }


}

/* End of file Capaian_model.php */
/* Location: ./application/models/Capaian_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 21:58:49 */
/* http://harviacode.com */