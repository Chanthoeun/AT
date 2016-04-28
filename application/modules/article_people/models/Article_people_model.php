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
class Article_people_model extends MY_Model {
    public $_table = 'article_people';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_all_records($where = FALSE, $get_people = TRUE)
    {
        if($get_people == TRUE)
        {
            $this->db->select($this->_table.'.*, people.name, people.position,  people.telephone, people.organization, people_group.caption as group, people.social_media');
            $this->db->join('people', $this->_table.'.people_id = people.id', 'left');
            $this->db->join('people_group', 'people.people_group_id = people_group.id', 'left');
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
