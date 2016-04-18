<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of copy_model
 *
 * @author Chanthoeun
 */
class Advertise_page_layout_model extends MY_Model {
    public $_table = 'advertise_page_layout';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, ap.caption as page, al.caption as layout, al.amount, al.width, al.height, al.price');
        $this->db->join('advertise_page as ap', $this->_table.'.page_id = ap.id', 'left');
        $this->db->join('advertise_layout as al', $this->_table.'.layout_id = al.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, ap.caption as page, al.caption as layout, al.amount, al.width, al.height, al.price');
        $this->db->join('advertise_page as ap', $this->_table.'.page_id = ap.id', 'left');
        $this->db->join('advertise_layout as al', $this->_table.'.layout_id = al.id', 'left');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_dropdown($key, $value, $option_label = FALSE, $where = FALSE) {
        $this->db->select(array($key, $value));
        $this->db->join('advertise_layout as al', $this->_table.'.layout_id = al.id', 'left');
        
        if($where != FALSE)
        {
            $this->db->where($where);
        }
        
        $query = $this->db->get($this->_table);
        $option_label == FALSE ? $options = array() : $options = array('' => $option_label);

        
        foreach ($query->result() as $row)
        {
            $options[$row->{$key}] = $row->{$value};
        }

        return $options;
    }
}
