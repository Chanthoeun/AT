<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of copy
 *
 * @author Chanthoeun
 */
class Home_page extends Front_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->lang->load('home'); 
        $this->load->helper('text');
        
        $this->load->library('form_validation');
    }
    
    public function _remap($method, $params = array())
    {   
        $get_method = str_replace('-', '_', $method);
        
        if (method_exists($this, $get_method))
        {
            return call_user_func_array(array($this, $get_method), $params);
        }
        show_404();
    }
    
    public function index()
    {
        $request = 'http://api.openweathermap.org/data/2.5/weather?q=phnompenh,cambodia&appid=95a773208982939f4b1177bf0e59991b';
        $response = file_get_contents($request);
        $weather = json_decode($response);
        
        dump($weather);
        
        $this->data['items'] = Modules::run('categories/get_many_by', array('display' => 1));

        // process template
        $title = $this->lang->line('home_headding');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['content']     = 'home';
        $layout_property['template']    = 'one_col';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, FALSE);

        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function articles($id)
    {
        $cat = Modules::run('categories/get', $id);
        $this->data['cat'] = $cat;
        $this->data['types'] = Modules::run('article_types/get_all');
        
        $this->_default();
                
        // process template
        $title = ($cat->parent_id != 0 && $cat->parent_id == 1) ? 'ដំណាំ'.$cat->caption : $cat->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'article';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('article/'.$cat->id));

        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function view($id)
    {
        $article = Modules::run('articles/get', $id);
        $cat = Modules::run('categories/get', $article->category_id);
        $this->data['article'] = $article;
        $this->data['article_medias'] = Modules::run('article_medias/get_many_by', array('article_id' => $article->id));
        $this->data['related_articles'] = Modules::run('articles/get_many_by', array('category_id' => $cat->id, 'article_type_id' => $article->article_type_id), array('created_at' => 'RANDOM'), 5);
        $this->data['product_articles'] = Modules::run('classified_article_categories/get_all_with_classified', array('article_category_id' => $article->category_id), array('created_at' => 'RANDOM'), 10);
        
        $this->_default();
        
        // process template
        $title = $article->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css',
                                        'css/colorbox/colorbox.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/jquery.colorbox.min.js');
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        $layout_property['breadcrumb'] = array('article/'.$cat->id => $cat->caption,$title);
        
        $layout_property['content']     = 'article_view';
        
        $meta = $this->_generate_meta($title, $article->detail, $cat->caption, base_url(get_uploaded_file($article->picture)), site_url('view/'.$article->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function more($catid, $typeid)
    {        
        $pagination = get_pagination('more/'.$catid.'/'.$typeid.'/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $typeid, 'category_id' => $catid))), 20, 5, 5);
        $articles = Modules::run('articles/get_many_by', array('article_type_id' => $typeid, 'category_id' => $catid), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        
        $this->_default();
                
        // process template
        $title = $this->lang->line('home_more');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'news_items';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('more/'.$catid.'/'.$typeid));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function news($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 1);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('news/'.$cat->id.'/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 20, 5, 4);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('news/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id))), 20, 5, 3);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        
        $this->_default();
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $cat->caption : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('news' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'news_items';
        
        $this->data['menu_news'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, isset($cat) && $cat != FALSE ? site_url('news/'.$cat->id) : site_url('news'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function technique($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 2);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('technique/'.$cat->id.'/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 20, 5, 4);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('technique/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id))), 20, 5, 3);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        
        $this->_default();
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $cat->caption : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('technique' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'news_items';
        
        $this->data['menu_technique'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, isset($cat) && $cat != FALSE ? site_url('technique/'.$cat->id) : site_url('technique'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function problem_solutions($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 3);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('problem-solutions/'.$cat->id.'/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 20, 5, 4);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('problem-solutions/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id))), 20, 5, 3);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        
        $this->_default();
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $cat->caption : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('problem-solutions' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'news_items';
        
        $this->data['menu_problem'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, isset($cat) && $cat != FALSE ? site_url('problem-solutions/'.$cat->id) : site_url('problem-solutions'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function policy_regulation($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 5);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('policy-regulation/'.$cat->id.'/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 20, 5, 4);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('policy-regulation/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id))), 20, 5, 3);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        
        $this->_default();
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $cat->caption : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('policy-regulation' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'news_items';
        
        $this->data['menu_policy_regulation'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, isset($cat) && $cat != FALSE ? site_url('policy-regulation/'.$cat->id) : site_url('policy-regulation'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function books($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 4);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('books/'.$cat->id.'/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 20, 5, 4);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('books/page', count(Modules::run('articles/get_many_by', array('article_type_id' => $type->id))), 20, 5, 3);
            $articles = Modules::run('articles/get_many_by', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        $this->_default();
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $cat->caption : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('books' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'news_items';
        
        $this->data['menu_book'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, isset($cat) && $cat != FALSE ? site_url('books/'.$cat->id) : site_url('books'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function buy_sell($cat_id = FALSE)
    {
        $cat = Modules::run('categories/get', $cat_id);
        
        $pagination = get_pagination('buy-sell/'.$cat->id.'/page', count(Modules::run('classifieds/get_many_by', array('category_id' => $cat->id, 'classifieds.type' => 0))), 20, 5, 4);
        $classifieds = Modules::run('classifieds/get_many_by', array('category_id' => $cat->id, 'classifieds.type' => 0), array('classifieds.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['classifieds'] = $classifieds;
        
        $this->_default();
                
        // process template
        $title = $cat->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'classified_item';
        
        $this->data['menu_buy_sell'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('buy-sell'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function classified_detail($id)
    {
        $classified = Modules::run('products/get_with_category', $id);
        $this->data['classified'] = $classified;
        $this->data['medias'] = Modules::run('classified_medias/get_many_by', array('classified_id' => $classified->id));
        $this->data['membership'] =Modules::run('memberships/get_with_user', array('membership.id' => $classified->membership_id));
        
        $map_config = array(
            'center' => $this->data['membership']->map,
            'zoom'  => '15',
            'height' => '300px'
        );
        
        $marker = array(
            'position' => $this->data['membership']->map,
            'animation'=> 'Drop'
        );
        $this->data['map'] = get_google_map($map_config, $marker);
        
        $this->_default();
        
        // process template
        $title = $classified->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css',
                                        'css/colorbox/colorbox.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/jquery.colorbox.min.js');
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        $layout_property['breadcrumb'] = array('buy-sell/'.$classified->category_id => $classified->caption,$title);
        
        $layout_property['content']     = 'classified_detail';
        
        $this->data['menu_buy_sell'] = TRUE;
        
        $meta = $this->_generate_meta($title, $classified->description, $classified->caption, base_url(get_uploaded_file($classified->file)), site_url('classified-detail/'.$classified->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function real_estate($cat_id)
    {
        $cat = Modules::run('categories/get', $cat_id);
        
        $pagination = get_pagination('real-estate/'.$cat->id.'/page', count(Modules::run('classifieds/get_many_by', array('category_id' => $cat->id, 'classifieds.type' => 1))), 20, 5, 4);
        $realestates = Modules::run('classifieds/get_many_by', array('category_id' => $cat->id, 'classifieds.type' => 1), array('classifieds.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['realestates'] = $realestates;
        
        $this->_default();
                
        // process template
        $title = $cat->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'real_estate_item';
        
        $this->data['menu_real_estate'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('real-estate'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function real_estate_detail($id)
    {
        $real_estate = Modules::run('real_estates/get_with_category', $id);
        $this->data['classified'] = $real_estate;
        $this->data['medias'] = Modules::run('classified_medias/get_many_by', array('classified_id' => $real_estate->id));
        $this->data['membership'] =Modules::run('memberships/get_with_user', array('membership.id' => $real_estate->membership_id));
        
        $map_config = array(
            'center' => $this->data['membership']->map,
            'zoom'  => '15',
            'height' => '300px'
        );
        
        $marker = array(
            'position' => $this->data['membership']->map,
            'animation'=> 'Drop'
        );
        $this->data['map'] = get_google_map($map_config, $marker);
        
        $this->_default();
        
        // process template
        $title = $real_estate->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css',
                                        'css/colorbox/colorbox.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/jquery.colorbox.min.js');
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        $layout_property['breadcrumb'] = array('real-estate/'.$real_estate->category_id => $real_estate->caption,$title);
        
        $layout_property['content']     = 'real_estate_detail';
        
        $this->data['menu_real_estate'] = TRUE;
        
        $meta = $this->_generate_meta($title, $real_estate->description, $real_estate->caption, base_url(get_uploaded_file($real_estate->file)), site_url('classified-detail/'.$real_estate->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function member($id)
    {
        $membership = Modules::run('memberships/get_with_user', array('membership.id' => $id));

        $this->data['membership'] = $membership;
        $this->data['classifieds'] = Modules::run('classifieds/get_many_by', array('membership_id' => $membership->id, 'classifieds.type' => 0), array('created_at' => 'desc'));
        $this->data['realestates'] = Modules::run('classifieds/get_many_by', array('membership_id' => $membership->id, 'classifieds.type' => 1), array('created_at' => 'desc'));
        
        $map_config = array(
            'center' => $membership->map,
            'zoom'  => '15',
            'height' => '300px'
        );
        
        $marker = array(
            'position' => $membership->map,
            'animation'=> 'Drop'
        );
        $this->data['map'] = get_google_map($map_config, $marker);
        
        $this->_default();
        
        // process template
        $title = $membership->name;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css',
                                        'css/colorbox/colorbox.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/jquery.colorbox.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'membership';
        
        $meta = $this->_generate_meta($title, $membership->desc, FALSE, get_uploaded_file($membership->image) == FALSE ? FALSE : base_url(get_uploaded_file($membership->image)), site_url('member/'.$membership->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function login()
    {
        // check if logged in
        if($this->ion_auth->logged_in())
        {
            if($this->ion_auth->is_admin()){
                    redirect('control', 'refresh');
                }else{
                    redirect('memberships/member', 'refresh');
                }
        }
        
        // auto login if remember login user
        if($this->ion_auth->login_remembered_user() == TRUE)
        {
            // log activities
            set_log('Log In');

            //redirect them back to the home page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            if($this->ion_auth->is_admin()){
                redirect('control', 'refresh');
            }else{
                redirect('memberships/member', 'refresh');
            }
        }
        
        // Login
        $this->form_validation->set_rules('identity', $this->lang->line('home_login_username'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('home_login_password'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('captcha', $this->lang->line('home_signup_validation_captcha'), 'trim|required|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            // check captcha
            if(check_captcha($this->input->post('captcha')) == FALSE)
            {
                $this->session->set_flashdata('message', $this->lang->line('home_signup_captcha_invalid'));
                redirect('login', 'refresh');
            }
            
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
                
                // log activities
                set_log('Log In');
                
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                if($this->ion_auth->is_admin()){
                    redirect('control', 'refresh');
                }else{
                    redirect('memberships/member', 'refresh');
                }
            }else{
                //redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        
        // form display
        $this->_default();
        
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'autocomplete'  => 'off',
                'class' => 'form-control',
                'placeholder'   => $this->lang->line('home_login_username'),
                'value' => set_value('identity'),
        );
        $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder'   => $this->lang->line('home_login_password'),
        );
        
        $this->data['captcha'] = array(
            'name'  => 'captcha',
            'id'    => 'captcha',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('home_signup_placeholder_captcha'),
            'autocomplete' => 'off'
        );
        
        // process template
        $title = $this->lang->line('home_menu_login');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'login';
        
        $this->data['menu_login'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('login'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function signup()
    {
        // Validation error
        $validation_errors = $this->session->flashdata('validation_errors');
        //set the flash data error message if there is one
        $this->data['message'] = ($validation_errors['errors'] ? $validation_errors['errors'] : $this->session->flashdata('message'));

        $this->_default();

        // Account Information
        $this->data['username'] = array(
            'name'  => 'username',
            'id'    => 'username',
            'class' => 'form-control',
            'value' => (isset($validation_errors['post_data']['username']) ? $validation_errors['post_data']['username'] : NULL)
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'class' => 'form-control',
            'value' => (isset($validation_errors['post_data']['email']) ? $validation_errors['post_data']['email'] : NULL)
        );
        
        $this->data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'class' => 'form-control',
            'value' => (isset($validation_errors['post_data']['password']) ? $validation_errors['post_data']['password'] : NULL)
        );
        
        $this->data['cpassword'] = array(
            'name'  => 'cpassword',
            'id'    => 'cpassword',
            'class' => 'form-control',
            'value' => (isset($validation_errors['post_data']['cpassword']) ? $validation_errors['post_data']['cpassword'] : NULL)
        );
        
        // Company Information
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => (isset($validation_errors['post_data']['name']) ? $validation_errors['post_data']['name'] : NULL)
        );
        
        
        // Personal        
        $this->data['fullname'] = array(
            'name' => 'fullname',
            'id' => 'fullname',
            'class' => 'form-control',
            'value' => (isset($validation_errors['post_data']['fullname']) ? $validation_errors['post_data']['fullname'] : NULL)
        );
        
        $this->data['captcha'] = array(
            'name'  => 'captcha',
            'id'    => 'captcha',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('home_signup_placeholder_captcha'),
            'autocomplete' => 'off'
        );
        
        // process template
        $title = $this->lang->line('home_menu_signup');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'signup';
        
        $this->data['menu_signup'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('signup'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function signup_company()
    {
        $this->form_validation->set_rules('username', $this->lang->line('form_company_validation_username_label'), 'trim|required|is_unique[users.username]|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('form_company_validation_email_label'), 'trim|required|valid_email|is_unique[users.email]|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('form_company_validation_password_label'), 'trim|required|min_length[8]|max_length[20]|matches[cpassword]');
        $this->form_validation->set_rules('cpassword', $this->lang->line('form_company_validation_cpassword_label'), 'trim|required');
        
        $this->form_validation->set_rules('name', $this->lang->line('form_company_validation_name_label'), 'trim|required|is_unique[membership.name]|xss_clean');
        $this->form_validation->set_rules('captcha', $this->lang->line('home_signup_validation_captcha'), 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            // check captcha
            if(check_captcha($this->input->post('captcha')) == FALSE)
            {
                $this->session->set_flashdata('message', $this->lang->line('home_signup_captcha_invalid'));
                redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
            }
            
            // data
            $data = array(
                'username'  => $this->input->post('username', TRUE),
                'email'     => $this->input->post('email', TRUE),
                'password'  => $this->input->post('password'),
                'name'      => $this->input->post('name', TRUE),
            );
            
            // create company
            $company_data = array(
                'name' => $data['name'],
                'slug' => strtolower(url_title($data['name'])),
                'member_type_id' => 1
            );
            
            if(($mid = Modules::run('memberships/insert', $company_data, TRUE)) != FALSE)
            {                
                // create user
                if(($user_id = $this->ion_auth->register($data['username'], $data['password'], $data['email'], array('active' => 1),array(2))) != FALSE)
                {
                    // create company user
                    Modules::run('user_memberships/insert', array('membership_id' => $mid, 'user_id' => $user_id), TRUE);
                }
                else
                {
                    Modules::run('memberships/delete', $mid);
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
                }
                
                // set log
                array_unshift($company_data, $mid);
                set_log('Created Company Membership', $company_data, $data['username']);
                
                // login
                if($this->ion_auth->login($data['username'], $data['password'], FALSE))
                {
                    // log activities
                    set_log('Log In');

                    //redirect them back to the home page
                    $this->session->set_flashdata('message', $this->lang->line('home_signup_success'));
                    redirect('memberships/member', 'refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('message', $this->lang->line('home_signup_error'));
                redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
            }
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
        }
    }
    
    public function signup_personal()
    {
        $this->form_validation->set_rules('username', $this->lang->line('form_personal_validation_username_label'), 'trim|required|is_unique[users.username]|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('form_personal_validation_email_label'), 'trim|required|valid_email|is_unique[users.email]|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('form_personal_validation_password_label'), 'trim|required|min_length[8]|max_length[20]|matches[cpassword]');
        $this->form_validation->set_rules('cpassword', $this->lang->line('form_personal_validation_cpassword_label'), 'trim|required');
        $this->form_validation->set_rules('fullname', $this->lang->line('form_personal_validation_fullname_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('captcha', $this->lang->line('home_signup_validation_captcha'), 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            // check captcha
            if(check_captcha($this->input->post('captcha')) == FALSE)
            {
                $this->session->set_flashdata('message', $this->lang->line('home_signup_captcha_invalid'));
                redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
            }
            
            
            $email = $this->input->post('email');
            $username = trim($this->input->post('username'));
            $password = $this->input->post('password');
            if(($user_id = $this->ion_auth->register($username, $password, $email, array('active' => 1), array(2))) != FALSE)
            {
                $personal_data = array(
                    'name' => trim($this->input->post('fullname')),
                    'slug' => str_replace(' ', '-', strtolower(trim($this->input->post('fullname')))),
                    'member_type_id' => 2
                    
                );
                if(($pid = Modules::run('memberships/insert', $personal_data, TRUE)))
                {
                    // create personal user
                    Modules::run('user_memberships/insert', array('membership_id' => $pid, 'user_id' => $user_id), TRUE);
                    
                    // set log
                    array_unshift($personal_data, $pid);
                    set_log('Created Personal Membership', $personal_data, $username);
                    
                    // login
                    if($this->ion_auth->login($username, $password, FALSE))
                    {
                        // log activities
                        set_log('Log In');

                        //redirect them back to the home page
                        $this->session->set_flashdata('message', $this->lang->line('home_signup_success'));
                        redirect('memberships/member', 'refresh');
                    }
                }
                else
                {
                    // delete account
                    $this->ion_auth->delete_user($user_id);
                    $this->session->set_flashdata('message', $this->lang->line('home_signup_error'));
                    redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
                }
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
            }
        }
        redirect_form_validation(validation_errors(), $this->input->post(), 'signup');
    }
    
    public function search()
    {
        $this->form_validation->set_rules('search', $this->lang->line('home_search_headding'), 'trim|required|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            $search_keywords = $this->input->post('search', TRUE);
            if(empty($search_keywords))
            {
                $this->data['search_result'] = $this->lang->line('home_search_result_not_found');
            }
            else
            {
                $this->data['result_articles'] = Modules::run('articles/get_like', array('title' => $search_keywords), array('created_at' => 'desc'));
                
                $this->data['result_products'] = Modules::run('classifieds/get_like', array('title' => $search_keywords), array('classifieds.type' => 0), array('created_at' => 'desc'));
                
                $this->data['result_real_estates'] = Modules::run('classifieds/get_like', array('title' => $search_keywords), array('classifieds.type' => 1), array('created_at' => 'desc'));
                
                $count_all_result = count($this->data['result_articles']) + count($this->data['result_products']) + count($this->data['result_real_estates']);
                
                $this->data['search_result'] = sprintf($this->lang->line('home_search_result_found'), $count_all_result);
            }
        }
        
        if(!isset($search_keywords))
        {
            $this->data['search_result'] = $this->lang->line('home_search_result_not_found');
        }
        
        $this->_default();
        // process template
        $title = $this->lang->line('home_search_headding');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'search';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('search'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function about_us()
    {
        $this->underconstruction();
    }
    
    public function contact_us()
    {
        $this->form_validation->set_rules('name', $this->lang->line('home_contact_fullname_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('home_contact_email_lable'), 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', $this->lang->line('home_contact_telephone_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('subject', $this->lang->line('home_contact_subject_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('comment', $this->lang->line('home_contact_comment_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('captcha', $this->lang->line('home_signup_validation_captcha'), 'trim|required|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            if(check_captcha($this->input->post('captcha') == FALSE))
            {
                $this->session->set_flashdata('message', $this->lang->line(''));
                redirect('contact-us', 'refresh');
            }
            
            $from   = $this->input->post('email', TRUE);
            $name   = $this->input->post('name', TRUE);
            $to     = array('info@agritoday.com', 'chanthoeunkim@gmail.com');
            $subject= $this->input->post('subject', TRUE);
            $body   = $this->input->post('comment', TRUE).'<br><br>'
                    . 'Sender Contact: <br><br>'
                    . 'Name: '.$name.'<br>'
                    . 'Email: '.$from.'<br>'
                    . 'Telephone: '.$this->input->post('telephone');
            
            if(ENVIRONMENT == 'production')
            {
                if(! send_email($from, $name, $to, $subject, $body))
                {
                    $this->session->set_flashdata('message', $this->lang->line('home_contact_sent_error') );
                    redirect('contact-us', 'refresh');
                }
            }
            $this->session->set_flashdata('message', $this->lang->line('home_contact_sent_success') );
            redirect('contact-us', 'refresh');
        }
        
        // display form
        $this->data['message'] = validation_errors() == FALSE ? $this->session->flashdata('message') : validation_errors();
        
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => set_value('name')
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => set_value('email')
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => set_value('telephone')
        );
        
        $this->data['subject'] = array(
            'name'  => 'subject',
            'id'    => 'subject',
            'class' => 'form-control',
            'value' => set_value('subject')
        );
        
        $this->data['comment'] = array(
            'name'  => 'comment',
            'id'    => 'comment',
            'class' => 'form-control',
            'value' => set_value('comment')
        );
        
        $this->data['captcha'] = array(
            'name'  => 'captcha',
            'id'    => 'captcha',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('home_signup_placeholder_captcha'),
            'autocomplete' => 'off'
        );
        
        $this->_default();
        // process template
        $title = $this->lang->line('home_menu_contact_us');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'contact_us';
        
        $this->data['menu_contact_us'] = TRUE; 
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('contact-us'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function policy()
    {
        $this->underconstruction();
    }
    
    public function condition()
    {
        $this->underconstruction();
    }
    
    public function weather()
    {
        $this->_default();
        // process template
        $title = $this->lang->line('home_menu_weather');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'weather';
        
        $this->data['menu_weather'] = TRUE; 
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('weather'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }

    public function blank()
    {
        $this->data['categories'] = Modules::run('categories/get_many_by', array('type' => 0));
        // process template
        $title = $this->lang->line('home_blank');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'blank';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('blank'));

        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function underconstruction()
    {
        $this->_default();
        // process template
        $title = $this->lang->line('home_underconstruction');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'underconstruction';
        
        generate_template($this->data, $layout_property);
    }
    
    public function _generate_meta($title, $description = FALSE, $keyword = FALSE, $image = FALSE, $url = FALSE)
    {
        // meta
        return $meta = array(
            array('name' => 'description', 'content' => character_limiter(strip_tags($description == FALSE ? $this->lang->line('home_meta_description') : $description), 150)),
            array('name' => 'keywords', 'content' => $keyword == FALSE ? $this->lang->line('home_meta_keyword') : $keyword),
            array('name' => 'distribution', 'content' => 'global'),
            array('name' => 'resource-type', 'content' => 'document'),
            array('name' => 'language', 'content' => 'kh'),
            // Facebook Meta 
            array('name' => 'og:title', 'content' => strip_tags($title), 'type' => 'property'),
            array('name' => 'og:type', 'content' => "article", 'type' => 'property'),
            array('name' => 'og:image', 'content' => $image == FALSE ? get_image('logo-white.png') : $image, 'type' => 'property'),
             array('name' => 'og:image:width', 'content' => '620', 'type' => 'property'),
            array('name' => 'og:image:height', 'content' => '340', 'type' => 'property'),
            array('name' => 'og:url', 'content' => $url == FALSE ? site_url() : $url, 'type' => 'property'),
            array('name' => 'og:description', 'content' => character_limiter(strip_tags($description == FALSE ? $this->lang->line('home_meta_description') : $description), 150), 'type' => 'property'),
            array('name' => 'og:site_name', 'content' => site_name(), 'type' => 'property'),
            array('name' => 'og:admins', 'content' => "1534352553487668", 'type' => 'property'),
            
            // Twitter
            array('name' => 'twitter:card', 'content' => 'summary_large_image'),
            array('name' => 'twitter:site', 'content' => '@chanthoeunkim'),
            array('name' => 'twitter:creator', 'content' => '@chanthoeunkim'),
            array('name' => 'twitter:domain', 'content' => 'agritoday.com'),
            array('name' => 'twitter:url', 'content' => $url == FALSE ? site_url() : $url),
            array('name' => 'twitter:title', 'content' => strip_tags($title)),
            array('name' => 'twitter:description', 'content' => character_limiter(strip_tags($description == FALSE ? $this->lang->line('home_meta_description') : $description), 150)),
            array('name' => 'twitter:image:src', 'content' => $image == FALSE ? get_image('logo-white.png') : $image),
            array('name' => 'twitter:image:width', 'content' => '484'),
            array('name' => 'twitter:image:height', 'content' => '252'),
            array('name' => 'twitter:widgets:csp', 'content' => 'on'),
        );
    }
    
    public function _default()
    {
        $this->data['categories'] = Modules::run('categories/get_all');
    }
    
}