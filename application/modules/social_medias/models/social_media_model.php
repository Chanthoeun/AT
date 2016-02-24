<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Classified_price_model
 *
 * @author Chanthoeun
 */
class Social_media_model extends MY_Model {
    public $_table = 'social_media';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'facebook',
            'label' => 'lang:form_membership_validation_facebook_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'google',
            'label' => 'lang:form_membership_validation_google_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'twitter',
            'label' => 'lang:form_membership_validation_twitter_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'linkedin',
            'label' => 'lang:form_membership_validation_linkedin_label',
            'rules' => 'trim||xss_clean'
        ),
        array(
            'field' => 'skype',
            'label' => 'lang:form_membership_validation_skype_label',
            'rules' => 'trim|xss_clean'
        )
    );
}
