<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

	// get data by id
    function get_by_id($id) {
        $this->db->where('id_user', $id);
        return $this->db->get('user')->row();
    }

	public function get_user_json()
	{
		$this->datatables->select('id_user, nama_user, jk, alamat, telepon, email, gambar, nama_role, status');
		$this->datatables->from('user');
		$this->datatables->join('role', 'id_role', 'left');
		$this->datatables->where('nama_user !=', 'SUPERADMIN');
		return $this->datatables->generate();
	}

	public function get_user_ar()
	{
		$this->db->select('id_user, nama_user, jk, alamat, telepon, email, gambar, nama_role, status');
		$this->db->from('user');
		$this->db->join('role', 'id_role', 'left');
		$this->db->where('nama_user !=', 'SUPERADMIN');
		return $this->db->get()->result_array();
	}

	public function get_user($id = '')
	{
		if ($id == '') {
			$this->db->join('role', 'id_role', 'left');
			return $this->db->get('user')->result_array();
		}else {
			$this->db->join('role', 'id_role', 'left');
			$this->db->where('id_user', $id);
			return $this->db->get('user')->row_array();
		}
	}

	public function delete($id)
	{
		delImage('user', $id);
		$this->db->delete('user', ['id_user' => $id]);
	}

	public function insert($post)
	{
		$data = [
			'id_user' => htmlspecialchars($post['id_user']),
			'nama_user' => htmlspecialchars($post['nama_user']),
			'jk' => htmlspecialchars($post['jk']),
			'alamat' => htmlspecialchars($post['alamat']),
			'telepon' => htmlspecialchars($post['telepon']),
			'email' => htmlspecialchars($post['email']),
			'password' => password_hash(htmlspecialchars($post['pw1']), PASSWORD_DEFAULT),
			'gambar' => _upload('gambar', 'user/tambah', 'user'),
			'id_role' => htmlspecialchars($post['id_role'])
		];

		$this->db->insert('user', $data);
	}

	public function update($id, $post)
	{
		$data = [
			'nama_user' => htmlspecialchars($post['nama_user']),
			'jk' => htmlspecialchars($post['jk']),
			'alamat' => htmlspecialchars($post['alamat']),
			'email' => htmlspecialchars($post['email']),
			'telepon' => htmlspecialchars($post['telepon']),
			'id_role' => htmlspecialchars($post['id_role'])
		];

		if ($_FILES['gambar']['name']) {
			$data['gambar'] = _upload('gambar', 'user/ubah/' . $id, 'user');
			delImage('user', $id);
		}

		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
	}

	public function update_status($id, $val) {
		$data = ['status' => $val];
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
	}

}

/* End of file user_model.php */
/* Location: ./application/modules/user/models/user_model.php */ ?>
