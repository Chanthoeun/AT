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
class Advertise_layout_model extends MY_Model {
    public $_table = 'advertise_layout';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_advertise_layout_validation_caption_label',
            'rules' => 'trim|required|is_unique[advertise_layout.caption]|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន',
                'is_unique' => '%s មាន​រួច​ហើយ'
            )
        ),
        array(
            'field' => 'amount',
            'label' => 'lang:form_advertise_layout_validation_amount_label',
            'rules' => 'trim|required|is_natural|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន',
                'is_natural'=> '%s អនុញ្ញាតតែ​លេខ​'
            )
        ),
        array(
            'field' => 'width',
            'label' => 'lang:form_advertise_layout_validation_width_label',
            'rules' => 'trim|required|is_natural|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន',
                'is_natural'=> '%s អនុញ្ញាតតែ​លេខ​'
            )
        ),
        array(
            'field' => 'height',
            'label' => 'lang:form_advertise_layout_validation_height_label',
            'rules' => 'trim|required|is_natural|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន',
                'is_natural'=> '%s អនុញ្ញាតតែ​លេខ​'
            )
        ),
        array(
            'field' => 'price',
            'label' => 'lang:form_advertise_layout_validation_price_label',
            'rules' => 'trim|required|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន'
            )
        ),
        array(
            'field' => 'position',
            'label' => 'lang:index_advertise_layout_position_th',
            'rules' => 'trim|xss_clean'
        ),
    );
    
    public function get_all_not_where_in($where) {
        $this->db->where_not_in('id', $where);
        return parent::get_all();
    }
}
