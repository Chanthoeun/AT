<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of video_model
 *
 * @author Chanthoeun
 */
class Video_model extends MY_Model {
    public $_table = 'video';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'title',
            'label' => 'lang:form_video_validation_title_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'detail',
            'label' => 'lang:form_video_validation_detail_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'publish',
            'label' => 'lang:form_video_validation_publish_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'source',
            'label' => 'lang:form_video_validation_source_label',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'category',
            'label' => 'lang:form_video_validation_category_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'fb',
            'label' => 'lang:form_video_validation_fb_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'fbp',
            'label' => 'lang:form_video_validation_fbp_label',
            'rules' => 'trim|xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, category.caption as catcaption, l.id as lid, l.file, l.picture');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        $this->db->join('video_library as vl', $this->_table.'.id = vl.video_id', 'left');
        $this->db->join('library as l', 'vl.library_id = l.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, category.caption as catcaption, l.file, l.picture');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        $this->db->join('video_library as vl', $this->_table.'.id = vl.video_id', 'left');
        $this->db->join('library as l', 'vl.library_id = l.id', 'left');
        
        if($where == FALSE)
        {
            return parent::get_all();
        }
        
        return parent::get_many_by($where);
    }
    
    public function get_like($like, $where = FALSE)
    {
        $this->db->like($like);
        return $this->get_all_records($where);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        if(is_array($field))
        {
            $selectField = $this->_table.'.'.array_shift($field);
            foreach ($field as $f)
            {
                $selectField .= ', '.$this->_table.'.'.$f;
            }
        }
        else
        {
            $selectField = $this->_table.'.'.$field;
        }
        $this->db->select($selectField);
        
        if($where != FALSE)
        {
            return $array == TRUE ? parent::as_array()->get_many_by($where)  : parent::as_object()->get_many_by($where);
        }
        return $array == TRUE ? parent::as_array()->get_all() : parent::as_object()->get_all();
    }
}
