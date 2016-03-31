<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of job_model
 *
 * @author Chanthoeun
 */
class Job_model extends MY_Model {
    public $_table = 'job';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'title',
            'label' => 'lang:form_job_title_label',
            'rules' => 'trim|required|xss_clean',
            'onerror' => array('required' => '%s តម្រូវ​ឲ្យ​មាន')
        ),
        array(
            'field' => 'description',
            'label' => 'lang:form_job_description_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'requirement',
            'label' => 'lang:form_job_requirement_label',
            'rules' => 'trim|required|xss_clean',
            'onerror' => array('required' => '%s តម្រូវ​ឲ្យ​មាន')
        ),
        array(
            'field' => 'apply',
            'label' => 'lang:form_job_apply_label',
            'rules' => 'trim|required|xss_clean',
            'onerror' => array('required' => '%s តម្រូវ​ឲ្យ​មាន')
        ),
        array(
            'field' => 'salary',
            'label' => 'lang:form_job_salary_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'location',
            'label' => 'lang:form_job_location_label',
            'rules' => 'trim|required|xss_clean',
            'onerror' => array('required' => '%s តម្រូវ​ឲ្យ​មាន')
        ),
        array(
            'field' => 'close_date',
            'label' => 'lang:form_job_expire_label',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'category',
            'label' => 'lang:form_job_category_label',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'company',
            'label' => 'lang:form_job_company_label',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'agri_pos',
            'label' => 'lang:from_job_agri_pos_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'agri_cat',
            'label' => 'lang:from_job_agri_cat_label',
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
        $this->db->select($this->_table.'.*, category.caption as catcaption, location.caption as location, agricat.caption as agricatcaption');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        $this->db->join('category as agricat', $this->_table.'.agri_cat_id = agricat.id', 'left');
        $this->db->join('location', $this->_table.'.location_id = location.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, category.caption as catcaption, location.caption as location, agricat.caption as agricatcaption');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        $this->db->join('category as agricat', $this->_table.'.agri_cat_id = agricat.id', 'left');
        $this->db->join('location', $this->_table.'.location_id = location.id', 'left');
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
