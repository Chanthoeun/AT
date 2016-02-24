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
class Video_library_model extends MY_Model {
    public $_table = 'video_library';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, l.caption, l.file, l.picture, l.library_group_id, lg.caption as group, v.title, v.published_at, v.source');
        $this->db->join('library as l', $this->_table.'.library_id = l.id', 'left');
        $this->db->join('library_group as lg', 'l.library_group_id = lg.id', 'left');
        $this->db->join('video as v', $this->_table.'.video_id = v.id', 'left');
        
        if(is_numeric($where)){
            return parent::get_by(array($this->_table.'.id' => $where));
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, l.caption, l.file, l.picture, l.library_group_id, lg.caption as group, v.title, v.published_at, v.source');
        $this->db->join('library as l', $this->_table.'.library_id = l.id', 'left');
        $this->db->join('library_group as lg', 'l.library_group_id = lg.id', 'left');
        $this->db->join('video as v', $this->_table.'.video_id = v.id', 'left');
        
        if($where == FALSE){
            return parent::get_all();
        }
        return parent::get_many_by($where);
        
    }
}
