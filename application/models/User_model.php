<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model User_model_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class User_model extends CI_Model
{
  public $table = 'user';

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }


  // ------------------------------------------------------------------------
  // ------------------------------------------------------------------------
  public function update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }
  public function updateGlobal($table, $where,$on, $data )
  {
    $this->db->where($on, $where);
    $this->db->update($table, $data);
  }
  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }
  public function insert_global($where, $data)
  {
    $this->db->insert($where, $data);
    return $this->db->insert_id();
  }
  public function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
    return $this->db->affected_rows();
  }
  // ------------------------------------------------------------------------
  function Is_already_register($email)
  {
    $query = $this->db->get_where('user', array('email' => $email));
    $result = $query->result();
    // echo ($query->num_rows() );
    if ($query->num_rows() > 0) {
      // Rows found, email exists
      return true;
    } else {
      
      return false;
    }
  }
  public function hapus_data($on ,$id,$table) {
    $this->db->where($on, $id);
    $this->db->delete($table);
}

  function Update_user_data($data, $id)
  {
    $this->db->where('id_user', $id);
    $this->db->update('user', $data);
  }

  function Insert_user_data($data)
  {
    $this->db->insert('user', $data);
  }
  function search_lowongan($table, $cariL, $lokasiL, $kategoriL)
  {
    if($cariL != ''){
      $this->db->like('lowongan', $cariL, 'after');
    }
    if ($kategoriL != '') {
      $this->db->where('kategori', $kategoriL);
    }
    if($lokasiL != ''){
      $this->db->where('lokasi', $lokasiL);
    }
    $querry = $this->db->get($table);

    return $querry->result();
  }
  function search_lowongan_company($table, $company)
  {
    $this->db->where('id_user',$company);
    $querry = $this->db->get($table);

    return $querry->result();
  }

  public function getWhereJoin($table, $tableJoin, $on, $where)
  {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->join($tableJoin, $table . '.' . $on . '=' . $tableJoin . '.' . $on, ' left');
    $this->db->where($table . '.' . $on, $where);

    $query = $this->db->get();
    $result = $query->row_array();
    return $result;
  }

  public function getwhere($table, $where, $id = null)
  {
    if ($id !== null) {
      $this->db->where($where, $id);
    } else {
      $this->db->where($where);
    }
    $query = $this->db->get($table);
    return $query->row(); // Use row() instead of result()
  }
 
  public function selectAll($table)
  {
    $query = $this->db->get($table);

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function selectcompany($table)
  {
    $this->db->where('role','company');
    $query = $this->db->get($table);
    
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function tampiltotal($table)
  {
    $query = $this->db->get($table);

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }
  }
 
  public function getWdistinct($table,$see)
  {
    $this->db->distinct($see);
    $query = $this->db->get($table);
    $result = $query->result();
    return $result;
  }

}




/* End of file User_model_model.php */
/* Location: ./application/models/User_model_model.php */