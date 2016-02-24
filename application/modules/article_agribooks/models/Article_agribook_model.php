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
class Article_agribook_model extends MY_Model {
    public $_table = 'article_agribook';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_all_records($where = FALSE, $get_agribook = TRUE)
    {
        if($get_agribook == TRUE)
        {
            $this->db->select($this->_table.'.*, agribook.name, agribook.name_en, agribook.contact_person, agribook.telephone, agribook.logo, agribook_group.caption as group');
            $this->db->join('agribook', $this->_table.'.agribook_id = agribook.id', 'left');
            $this->db->join('agribook_group', 'agribook.agribook_group_id = agribook_group.id', 'left');
        }
        else
        {
            $this->db->select($this->_table.'.*, a.title as atitle, a.source as asource, a.picture as apicture, at.caption as atype, ac.caption as acategory');
            $this->db->join('article as a', $this->_table.'.article_id = a.id', 'left');
            $this->db->join('article_type as at', 'a.article_type_id = at.id', 'left');
            $this->db->join('category as ac', 'a.category_id = ac.id', 'left');
        }
        
        if($where == FALSE){
            return parent::get_all();
        }
        return parent::get_many_by($where);        
    }
}
