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
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->lang->load('home'); 
        $this->load->helper(array('text', 'video'));
        
        $this->load->library('form_validation');
        
        if($this->uri->segment(2) != FALSE && is_numeric($this->uri->segment(2)))
        {
            $uri = $this->uri->segment(2);
            $this->data['checkId'] = $uri;
        }
        else
        {
            $this->data['checkId'] = FALSE;
        }
        
        // get adervertise
        $this->data['advertises'] = Modules::run('advertises/get_advertises', array('ap.slug' => $this->uri->segment(1)));
        
        //dump($this->data['advertises']);
        
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
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
        // process template
        $title = $this->lang->line('home_headding');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['content']     = 'index';
        $layout_property['template']    = 'one_col';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, FALSE);

        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function news($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 1);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('news/'.$cat->id.'/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 22, 2, 4);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.published_on' => 'desc', 'article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('news/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id))), 22, 2, 3);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id), array('article.published_on' => 'desc', 'article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        $this->data['categories'] = Modules::run('categories/get_news_categories', array('category.article' => TRUE), 'order');
        
        // process template
        $title =  isset($cat) && $cat != FALSE ? $type->caption.' <small>'.$cat->caption.'</small>' : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('news' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'article_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_news'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('news_meta_description'), $this->lang->line('news_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('news/'.$cat->id) : site_url('news'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function techniques($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 2);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('technique/'.$cat->id.'/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 22, 2, 4);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('technique/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id))), 22, 2, 3);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        $this->data['categories'] = Modules::run('categories/get_technique_categories', array('category.article' => TRUE), 'order');
        
        // process template
        $title =  isset($cat) && $cat != FALSE ? $type->caption.' <i class="fa fa-angle-double-right"></i> <small>'.$cat->caption.'</small>' : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('techniques' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'article_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_technique'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('technique_meta_description'), $this->lang->line('techniques_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('techniques/'.$cat->id) : site_url('techniques'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function publications($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 3);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('publications/'.$cat->id.'/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 22, 2, 4);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.published_on' => 'desc', 'article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('publications/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id))), 22, 2, 3);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id), array('article.published_on' => 'desc', 'article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        $this->data['categories'] = Modules::run('categories/get_publication_categories', array('category.document' => TRUE), 'order');
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $type->caption.' <i class="fa fa-angle-double-right"></i> <small>'.$cat->caption.'</small>' : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('publications' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'article_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_pubish'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('publish_meta_description'), $this->lang->line('publication_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('publications/'.$cat->id) : site_url('publications'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function health($cat_id = FALSE)
    {
        $type = Modules::run('article_types/get', 4);
        
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
            $pagination = get_pagination('health/'.$cat->id.'/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id))), 22, 2, 4);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id, 'category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('health/page', count(Modules::run('articles/get_all_records', array('article_type_id' => $type->id))), 22, 2, 3);
            $articles = Modules::run('articles/get_all_records', array('article_type_id' => $type->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['articles'] = $articles;
        
        $this->data['categories'] = Modules::run('categories/get_health_categories', array('category.article' => TRUE), 'order');
        
        // process template
        $title =  isset($cat) && $cat != FALSE ? $type->caption.' <small>'.$cat->caption.'</small>' : $type->caption;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('news' => $type->caption, $cat->caption) : array($title);
        
        $layout_property['content']     = 'article_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_health'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('health_meta_description'), $this->lang->line('health_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('health/'.$cat->id) : site_url('health'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function view($id)
    {
        $article = Modules::run('articles/get_detail', $id);
        if($article == FALSE)
        {
            redirect('page-not-found', 'refresh');
        }
        
        //count view of this article
        get_count($article->id, 'articles', 'article');        
        
        $cat = Modules::run('categories/get', $article->category_id);
        if($cat == FALSE)
        {
            $catid = 0;
        }
        else
        {
            $catid = $cat->id;
        }
        $this->data['article'] = $article;
        if($article->article_type_id == 3)
        {
            $this->data['document'] = Modules::run('article_libraries/get_detail', array('article_id' => $article->id));
        }
        else
        {
            $this->data['details'] = Modules::run('article_details/get_many_by', array('article_id' => $article->id));
            $this->data['documents'] = Modules::run('article_libraries/get_all_records', array('article_id' => $article->id), get_library_type());
            $this->data['audios'] = Modules::run('article_libraries/get_all_records', array('article_id' => $article->id), get_library_type(2));
            $this->data['videos'] = Modules::run('article_libraries/get_all_records', array('article_id' => $article->id), get_library_type(3));
        }
        
        if($article->keyword != FALSE)
        {
            $keyword_news = Modules::run('articles/get_similar_articles', array('article_type_id' => 1, 'article.id != ' => $article->id), generate_sql_where('title', $article->keyword), array('created_at' => 'random'), 6);
            $keyword_technique = Modules::run('articles/get_similar_articles', array('article_type_id' => 2, 'article.id != ' => $article->id), generate_sql_where('title', $article->keyword), array('created_at' => 'random'), 6);
            $keyword_publication = Modules::run('articles/get_similar_articles', array('article_type_id' => 3, 'article.id != ' => $article->id), generate_sql_where('title', $article->keyword), array('created_at' => 'random'), 6);
            $keyword_videos = Modules::run('videos/get_all_records', generate_sql_where('title', $article->keyword), array('created_at' => 'random'), 6);
        }
        else
        {
            $keyword_news = FALSE;
            $keyword_technique = FALSE;
            $keyword_publication = FALSE;
            $keyword_videos = FALSE;
        }
        $this->data['related_news'] = $keyword_news != FALSE ? $keyword_news : Modules::run('articles/get_all_records', array('article_type_id' => 1, 'category_id' => $catid, 'article.id != ' => $article->id), array('created_at' => 'random'), 6);
        $this->data['related_techniques'] = $keyword_technique != FALSE ? $keyword_technique : Modules::run('articles/get_all_records', array('article_type_id' => 2, 'category_id' => $catid, 'article.id != ' => $article->id), array('created_at' => 'random'), 6);
        $this->data['related_publications'] = $keyword_publication != FALSE ? $keyword_publication : Modules::run('articles/get_all_records', array('article_type_id' => 3, 'category_id' => $catid, 'article.id != ' => $article->id), array('created_at' => 'random'), 6);
        $this->data['related_videos'] = $keyword_videos != FALSE ? $keyword_videos :Modules::run('videos/get_all_records', array('category_id' => $catid), array('created_at' => 'random'), 6);
        
        //get linked data
        $this->data['products'] = Modules::run('article_products/get_all_records', array('article_id' => $this->data['article']->id), TRUE, array('article.created_at' => 'random'), 6);
        $this->data['real_estates'] = Modules::run('article_real_estates/get_all_records', array('article_id' => $this->data['article']->id), TRUE, array('article.created_at' => 'random'), 6);
        $this->data['jobs'] = Modules::run('article_jobs/get_all_records', array('article_id' => $this->data['article']->id), TRUE, array('article.created_at' => 'random'), 6);
        $this->data['people'] = Modules::run('article_people/get_all_records', array('article_id' => $this->data['article']->id), TRUE, array('article_people.id'=> 'asc'), 6);
        $this->data['abs'] = Modules::run('article_agribooks/get_all_records', array('article_id' => $this->data['article']->id), TRUE, array('article.created_at' => 'random'), 6);
        
        $this->data['check_related'] = check_related_article($this->data['products'], $this->data['real_estates'], $this->data['jobs'], $this->data['abs']);
        
        //get url
        if($article->article_type_id == 1)
        {
            $url = 'news';
            $label = $this->lang->line('news_label');
            $this->data['menu_news'] = TRUE;
        }
        else if($article->article_type_id == 2)
        {
            $url = 'techniques';
            $label = $this->lang->line('techniques_label');
            $this->data['menu_technique'] = TRUE;
        }
        else
        {
            $url = 'publications';
            $label = $this->lang->line('publish_label');
            $this->data['menu_pubish'] = TRUE;
        }
        
        
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? NULL : $this->validation_errors['post_data']['name']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? NULL : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? NULL : $this->validation_errors['post_data']['email']
        );
        
        $this->data['comment'] = array(
            'name'  => 'comment',
            'id'    => 'comment',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['comment']) ? NULL : $this->validation_errors['post_data']['comment']
        );
        
        // process template
        $title = $article->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        if($cat == FALSE)
        {
            $layout_property['breadcrumb'] = array($url => $label, $title);
        }
        else
        {
            if($cat->parent_id == FALSE)
            {
                $layout_property['breadcrumb'] = array($url => $label, $title);
            }
            else 
            {
                $layout_property['breadcrumb'] = array($url => $label, $url.'/'.$cat->id => $cat->caption, $title);
            }
        }        
        
        
        $layout_property['content']     = 'article_view';
        
        $meta = $this->_generate_meta($title, $article->detail, $title, base_url(get_uploaded_file($article->picture)), site_url('view/'.$article->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function product_sale_rent($cat_id = FALSE)
    {
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
        
            $pagination = get_pagination('product-sale-rent/'.$cat->id.'/page', count(Modules::run('products/get_all_records', array('category_id' => $cat->id))), 22, 2, 4);
            $products = Modules::run('products/get_all_records', array('category_id' => $cat->id), array('product.created_at' => 'desc', 'agribook.member_type_id' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('product-sale-rent/page', count(Modules::run('products/get_all_records')), 22, 2, 4);
            $products = Modules::run('products/get_all_records', FALSE, array('product.created_at' => 'desc', 'agribook.member_type_id' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['products'] = $products;
        
        $this->data['categories'] = Modules::run('categories/get_product_categories', array('category.market' => TRUE), 'order');
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $this->lang->line('sale_rent_product_label').' <i class="fa fa-angle-double-right"></i> <small>'.$cat->caption.'</small>' : $this->lang->line('sale_rent_product_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('product-sale-rent' => $this->lang->line('sale_rent_product_label'), $cat->caption) : array($title);
        
        $layout_property['content']     = 'product_item';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_product'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('product_meta_description'), $this->lang->line('product_sale_rent_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('product-sale-rent/'.$cat->id) : site_url('product-sale-rent'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function product_detail($id)
    {
        $product = Modules::run('products/get_detail', $id);
        
        if($product == FALSE)
        {
            redirect('page-not-found', 'refresh');
        }
        
        //count view of this products
        get_count($product->id, 'products', 'product');  
        
        $cat = Modules::run('categories/get', $product->category_id);
        $this->data['product'] = $product;
        $this->data['prices'] = Modules::run('product_prices/get_all_records', array('product_id' => $this->data['product']->id));
        $this->data['pictures'] = Modules::run('product_pictures/get_many_by', array('product_id' => $this->data['product']->id));
        $this->data['company'] = Modules::run('products/get_contact', $product->id);
        
        $this->data['similar_products'] = Modules::run('products/get_all_records', array('category_id' => $cat->id, 'product.id != ' => $product->id), array('created_at' => 'desc'), 12);
        
        if($this->data['company'] != FALSE && $this->data['company']->name != FALSE)
        {
            $getLoc = explode('/', $this->data['company']->location_id);
            switch (count($getLoc))
            {
                case 1:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $this->data['location'] = $province;
                    break;
                case 2:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getLoc[1])->caption;
                    $this->data['location'] = $khan.' / '.$province;
                    break;
                case 3:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                    $this->data['location'] = $sangkat.' / '.$khan.' / '.$province;
                    break;
                default:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                    $phum = Modules::run('locations/get',$getLoc[3])->caption;
                    $this->data['location'] = $phum.' / '.$sangkat.' / '.$khan.' / '.$province;
                    break;
            }
            
            
            $map_config = array(
                'center' => $this->data['company']->map,
                'zoom'  => '15',
                'height' => '300px'
            );

            $marker = array(
                'position' => $this->data['company']->map,
                'animation'=> 'Drop'
            );
            $this->data['map'] = get_google_map($map_config, $marker);
        }       
        
        // process template
        $title = $product->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css',
                                        'css/colorbox/colorbox.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/script.min.js', 'js/jquery.colorbox.min.js');
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        if($cat->parent_id == FALSE)
        {
            $layout_property['breadcrumb'] = array('product-sale-rent' => $this->lang->line('sale_rent_product_label'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array('product-sale-rent' => $this->lang->line('sale_rent_product_label'), 'product-sale-rent/'.$cat->id => $cat->caption, $title);
        }
        
        $layout_property['content']     = 'product_view';
        
        $this->data['menu_product'] = TRUE;
        
        $meta = $this->_generate_meta($title, $product->description, $title, base_url(get_uploaded_file($product->file)), site_url('product-detail/'.$product->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function land_sale_rent($cat_id = FALSE)
    {
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
        
            $pagination = get_pagination('land-sale-rent/'.$cat->id.'/page', count(Modules::run('real_estates/get_all_records', array('category_id' => $cat->id, 'expire_date >=' => date('Y-m-d')))), 22, 2, 4);
            $realestates = Modules::run('real_estates/get_all_records', array('category_id' => $cat->id, 'expire_date >=' => date('Y-m-d')), array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('land-sale-rent/page', count(Modules::run('real_estates/get_all_records', array('expire_date >=' => date('Y-m-d')))), 22, 2, 4);
            $realestates = Modules::run('real_estates/get_all_records', array('expire_date >=' => date('Y-m-d')), array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['realestates'] = $realestates;
        
        $this->data['categories'] = Modules::run('categories/get_land_categories', array('category.real_estate' => TRUE, 'category.parent_id !=' => FALSE));
                
        // process template
        $title =  isset($cat) && $cat != FALSE ?  $this->lang->line('sale_rent_land_label').' <i class="fa fa-angle-double-right"></i> <small>'.$cat->caption.'</small>' : $this->lang->line('sale_rent_land_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('land-sale-rent' => $this->lang->line('sale_rent_land_label'), $cat->caption) : array($title);;
        
        $layout_property['content']     = 'land_item';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_land'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('land_meta_description'), $this->lang->line('land_sale_rent_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('land-sale-rent/'.$cat->id) : site_url('land-sale-rent'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function land_detail($id)
    {
        $land = Modules::run('real_estates/get_detail', $id);
        
        if($land == FALSE)
        {
            redirect('page-not-found', 'refresh');
        }
        
        //count view of this real_estates
        get_count($land->id, 'real_estates', 'real_estate');  
        
        $cat = Modules::run('categories/get', $land->category_id);
        $this->data['land'] = $land;
        $this->data['pictures'] = Modules::run('real_estate_pictures/get_many_by', array('real_estate_id' => $land->id));
        $this->data['seller'] = Modules::run('real_estates/get_contact', $land->id);
        
        $this->data['similar_lands'] = Modules::run('real_estates/get_all_records', array('category_id' => $cat->id, 'real_estate.id != ' => $land->id), array('created_at' => 'desc'), 12);
        
        if($land->location_id != FALSE)
        {
            $getLoc = explode('/', $land->location_id);
            switch (count($getLoc))
            {
                case 1:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $this->data['location'] = $province;
                    break;
                case 2:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getLoc[1])->caption;
                    $this->data['location'] = $khan.' / '.$province;
                    break;
                case 3:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                    $this->data['location'] = $sangkat.' / '.$khan.' / '.$province;
                    break;
                default:
                    $province = Modules::run('locations/get',$getLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                    $phum = Modules::run('locations/get',$getLoc[3])->caption;
                    $this->data['location'] = $phum.' / '.$sangkat.' / '.$khan.' / '.$province;
                    break;
            }
        }
        if($land->map != FALSE)
        {
            $map_config = array(
                'center' => $land->map,
                'zoom'  => '15',
                'height' => '300px'
            );

            $marker = array(
                'position' => $land->map,
                'animation'=> 'Drop'
            );
            $this->data['map'] = get_google_map($map_config, $marker);
        }
        
        // process template
        $title = $land->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css',
                                        'css/colorbox/colorbox.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/script.min.js', 'js/jquery.colorbox.min.js');
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        if($cat->parent_id == FALSE)
        {
            $layout_property['breadcrumb'] = array('land-sale-rent' => $this->lang->line('sale_rent_land_label'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array('land-sale-rent' => $this->lang->line('sale_rent_land_label'), 'land-sale-rent/'.$cat->id => $cat->caption, $title);
        }
        
        $layout_property['content']     = 'land_view';
        
        $this->data['menu_land'] = TRUE;
        
        $meta = $this->_generate_meta($title, $land->description, $title, base_url(get_uploaded_file($land->file)), site_url('land-detail/'.$land->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function job($cat_id = FALSE)
    {
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
        
            $pagination = get_pagination('job/'.$cat->id.'/page', count(Modules::run('jobs/get_all_records', array('category_id' => $cat->id, 'expire_date >=' => date('Y-m-d')))), 22, 2, 4);
            $jobs = Modules::run('jobs/get_all_records', array('category_id' => $cat->id, 'expire_date >=' => date('Y-m-d')), array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('job/page', count(Modules::run('jobs/get_all_records', array('expire_date >=' => date('Y-m-d')))), 22, 2, 4);
            $jobs = Modules::run('jobs/get_all_records', array('expire_date >=' => date('Y-m-d')), array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['jobs'] = $jobs;
        
        $this->data['locations'] = Modules::run('locations/get_job_locations');
        
        $this->data['categories'] = Modules::run('categories/get_job_categories', array('category.job' => TRUE, 'category.parent_id !=' => FALSE));
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $this->lang->line('job_label') .' <i class="fa fa-angle-double-right"></i> <small>'.$cat->caption.'</small>' : $this->lang->line('job_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('job' => $this->lang->line('job_label'), $cat->caption) : array($title);;
        
        $layout_property['content']     = 'job_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_job'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('job_meta_description'), $this->lang->line('job_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('job/'.$cat->id) : site_url('job'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function job_detail($id)
    {
        $job = Modules::run('jobs/get_detail', $id);
        
        if($job == FALSE)
        {
            redirect('page-not-found', 'refresh');
        }
        
        $this->data['job'] = $job;
        
        $this->data['locations'] = Modules::run('locations/get_job_locations');
        $this->data['categories'] = Modules::run('categories/get_job_categories', array('category.job' => TRUE, 'category.parent_id !=' => FALSE));
        
        // process template
        $title = $job->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/script.min.js');
        
        $layout_property['breadcrumb'] = array('job' => $this->lang->line('job_label'), $title);
        
        $layout_property['content']     = 'job_view';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_job'] = TRUE;
        
        $meta = $this->_generate_meta($title, $job->description, $title, base_url(get_uploaded_file($job->logo)), site_url('job-detail/'.$job->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function filter_location($lid)
    {
        $location = Modules::run('locations/get', $lid);
        $pagination = get_pagination('job/page', count(Modules::run('jobs/get_all_records', array('location_id' => $lid, 'expire_date >=' => date('Y-m-d')))), 22, 2, 4);
        $jobs = Modules::run('jobs/get_all_records', array('location_id' => $lid, 'expire_date >=' => date('Y-m-d')), array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));

        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['jobs'] = $jobs;
        
        $this->data['locations'] = Modules::run('locations/get_job_locations');
        
        $this->data['categories'] = Modules::run('categories/get_job_categories', array('category.job' => TRUE, 'category.parent_id !=' => FALSE));
                
        // process template
        $title =  $this->lang->line('job_label').' <i class="fa fa-angle-double-right"></i> <small>'.$location->caption.'</small>';
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = array('job' => $this->lang->line('job_label'), $location->caption);
        
        $layout_property['content']     = 'job_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_job'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('job_meta_description'), $this->lang->line('job_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('job/'.$cat->id) : site_url('job'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function video($cat_id = FALSE)
    {
        if(isset($cat_id) && $cat_id != FALSE && $cat_id != 'page')
        {
            $cat = Modules::run('categories/get', $cat_id);
        
            $pagination = get_pagination('video/'.$cat->id.'/page', count(Modules::run('videos/get_all_records', array('category_id' => $cat->id))), 22, 2, 4);
            $videos = Modules::run('videos/get_all_records', array('category_id' => $cat->id), array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('video/page', count(Modules::run('videos/get_all_records')), 22, 2, 3);
            $videos = Modules::run('videos/get_all_records', FALSE, array('created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['videos'] = $videos;
        
        $this->data['categories'] = Modules::run('categories/get_video_categories', array('category.article' => TRUE), 'order');
                
        // process template
        $title =  isset($cat) && $cat != FALSE ? $cat->caption : $this->lang->line('video_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('job' => $this->lang->line('job_label'), $cat->caption) : array($title);;
        
        $layout_property['content']     = 'video_list';
        $this->data['content_header']   = TRUE;
        
        $this->data['menu_video'] = TRUE;
        
        $meta = $this->_generate_meta($title, $this->lang->line('video_meta_description'), $this->lang->line('video_meta_keyword'), FALSE, isset($cat) && $cat != FALSE ? site_url('video/'.$cat->id) : site_url('video'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function video_detail($id)
    {
        $video = Modules::run('videos/get_detail', $id);
        
        if($video == FALSE)
        {
            redirect('page-not-found', 'refresh');
        }
        
        //count view of this videos
        get_count($video->id, 'videos', 'video');  
        
        $cat = Modules::run('categories/get', $video->category_id);
        $this->data['video'] = $video;

        if($cat == FALSE)
        {
            $catid = 0;
        }
        else
        {
            $catid = $cat->id;
        }
        
        if($video->keyword != FALSE)
        {
            $keyword_news = Modules::run('articles/get_similar_articles', array('article_type_id' => 1), generate_sql_where('title', $video->keyword), array('created_at' => 'random'), 6);
            $keyword_technique = Modules::run('articles/get_similar_articles', array('article_type_id' => 2), generate_sql_where('title', $video->keyword), array('created_at' => 'random'), 6);
            $keyword_videos = Modules::run('videos/get_all_records', generate_sql_where('title', $video->keyword), array('created_at' => 'random'), 6);
        }
        else
        {
            $keyword_news = FALSE;
            $keyword_technique = FALSE;
            $keyword_videos = FALSE;
        }
        
        $this->data['related_news'] = $keyword_news != FALSE ? $keyword_news : Modules::run('articles/get_all_records',  array('article_type_id' => 1, 'category_id' => $catid), array('created_at' => 'random'), 6);
        $this->data['related_techniques'] = $keyword_technique != FALSE ? $keyword_technique : Modules::run('articles/get_all_records', array('article_type_id' => 2, 'category_id' => $catid), array('created_at' => 'random'), 6);
        $this->data['related_videos'] = $keyword_videos != FALSE ? $keyword_videos : Modules::run('videos/get_all_records', array('category_id' => $catid, 'video.id !=' => $video->id), array('created_at' => 'random'), 6);
        
        // process template
        $title = $video->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js','js/script.min.js');
        
        if($cat == FALSE)
        {
            $layout_property['breadcrumb'] = array('videos' => $this->lang->line('video_label'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array('videos' => $this->lang->line('video_label'), 'videos/'.$cat->id => $cat->caption, $title);
        }        
        
        
        $layout_property['content']     = 'video_view';
        
        $this->data['menu_video'] = TRUE;
        
        $meta = $this->_generate_meta($title, $video->detail, $title, base_url(get_uploaded_file($video->picture)), site_url('video-detail/'.$video->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function search()
    {
        $this->load->helper('text');
        $this->form_validation->set_rules('search_title', $this->lang->line('form_search_title_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('search_type', $this->lang->line('form_search_type_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('province', $this->lang->line('form_search_province_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('khan', $this->lang->line('form_search_khan_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('sangkat', $this->lang->line('form_search_sangkat_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('phum', $this->lang->line('form_search_phum_label'), 'trim|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            $searchTitle = trim($this->input->post('search_title'));
            $get_searchType = trim($this->input->post('search_type'));
            $searchType = $get_searchType == FALSE ? 1 : $get_searchType;
            
            $province = trim($this->input->post('province'));
            $khan = trim($this->input->post('khan'));
            $sangkat = trim($this->input->post('sangkat'));
            $phum = trim($this->input->post('phum'));

            if($province != FALSE)
            {
                $getLoc = $province;
                if($khan != FALSE)
                {
                    $getLoc .= '/'.$khan;
                    if($sangkat != FALSE)
                    {
                        $getLoc .= '/'.$sangkat;
                        if($phum != FALSE)
                        {
                            $getLoc .= '/'.$phum;
                        }
                    }
                }
            }
            else
            {
                $getLoc = FALSE;
            }
            
            switch ($searchType)
            {
                case 2:
                    $this->data['get_result'] = $this->_search_product($searchTitle);
                    break;
                
                case 3:
                    $this->data['get_result'] = $this->_search_land($searchTitle, $getLoc);
                    break;
                
                case 4:
                    $this->data['get_result'] = $this->_search_job($searchTitle, $getLoc);
                    break;
                
                case 5:
                    $this->data['get_result'] = $this->_search_video($searchTitle);
                    break;

                default:
                    $this->data['get_result'] = $this->_search_article($searchTitle, $getLoc);
                    break;
            }
            
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['get_searchTitle'] = isset($searchTitle) ? $searchTitle : NULL;
        $this->data['get_searchType'] = isset($searchType) ? $searchType : NULL;
        
        // display form
        $this->data['search_title'] = array(
            'name'  => 'search_title',
            'id'    => 'search_title',
            'class' => 'form-control',
            'value' => set_value('search_title')
        );
        
        $search_type = array(
            1 => $this->lang->line('article_menu_label'),
            2 => $this->lang->line('sale_rent_product_label'),
            3 => $this->lang->line('sale_rent_land_label'),
            4 => 'ការងារ',
            5 => $this->lang->line('video_label'),
        );
        
        $this->data['search_type'] = form_dropdown('search_type', $search_type, set_value('search_type'), array('class' => 'form-control', 'id' => 'search_type'));
        
        if(isset($province) && $province != FALSE)
        {
            $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));

            $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $province)), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

            $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

            $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
            
            if(isset($khan) && $khan != FALSE)
            {
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));

                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $khan)), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
                
                if(isset($sangkat) && $sangkat != FALSE)
                {
                    $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));

                    $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

                    $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

                    $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $sangkat)), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
                }
            }
        }
        else
        {
            $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));
              
            $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

            $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

            $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
        }
        
        // process template
        $title = $this->lang->line('home_search_headding');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js', 'js/script.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'search';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('search'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function register()
    {
        $this->lang->load('auth/auth');
        
        $this->form_validation->set_rules('username', $this->lang->line('register_validation_username_label'), 'trim|required|is_unique[users.username]|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន', 'is_unique' => '%s នេះ​មាន​រួច​ហើយ'));
        $this->form_validation->set_rules('email', $this->lang->line('register_validation_email_label'), 'trim|required|valid_email|is_unique[users.email]|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន', 'is_unique' => '%s នេះ​មាន​រួច​ហើយ'));
        $this->form_validation->set_rules('password', $this->lang->line('regerter_validation_password_label'), 'trim|required|min_length[' .$this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]', array('required' => '%s តម្រូវ​ឲ្យ​មាន', 'min_length' => '%s មិនត្រូវ​តូចជាង​ '.$this->config->item('min_password_length', 'ion_auth').' តួអក្សរ', 'max_length' => '%s មិនត្រូវ​ធំជាង '.$this->config->item('max_password_length', 'ion_auth').' តួអក្សរ', 'matches' => '%s ពាក្យ​សំងាត់​មិន​ដូចគ្នា'));
        $this->form_validation->set_rules('password_confirm', $this->lang->line('register_validation_comfirm_password_label'), 'trim|required', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('captcha', $this->lang->line('captcha_validation_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        
        if($this->form_validation->run() == TRUE)
        {
            if(check_captcha($this->input->post('captcha')) == FALSE)
            {
                $this->session->set_flashdata('message', $this->lang->line('captcha_error_label'));
                redirect(current_url(), 'refresh');
            }
            
            $username = remove_special_character(strtolower(trim($this->input->post('username'))));
            $email    = strtolower($this->input->post('email'));
            $password = $this->input->post('password');
            $additional_data = array(
                'active'    => 1,
            );
            
            if (($uid = $this->ion_auth->register($username, $password, $email, $additional_data,array(2))) != FALSE){
                // set log
                set_log('Create User', array($username,$email,$password,'Member'), $username);
                
                //check people profile
                $userProfile = Modules::run('people/get_detail', array('email' => $email));
                if($userProfile == FALSE)
                {
                    // insert people profile
                    Modules::run('people/insert', array('email' => $email, 'people_group_id' => 1, 'user_id' => $uid), TRUE);
                }
                else
                {
                    //update people profile
                    Modules::run('poeple/update', $userProfile->id, array('people_group_id' => 1, 'user_id' => $uid), TRUE);
                }
                
                // redirect login
                if ($this->ion_auth->login($username, $password, FALSE)){  
                    // log activities
                    set_log('Log In');
                    
                    $userInfo = array(
                        'member_group' => 1,
                        'user_group' => 'Members'
                    );
                    
                    $this->session->set_userdata($userInfo);
                    
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect("members", 'refresh');
                }else{
                    //redirect them back to the login page
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect(current_url(), 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
                }
            }
        }
        
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        
        // display form
        $this->data['username'] = array(
            'name'  => 'username',
            'id'    => 'username',
            'type'  => 'text',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('register_validation_username_label'),
            'autocomplete' => 'off',
            'value' => $this->form_validation->set_value('username')
        );
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('register_validation_email_label'),
            'autocomplete' => 'off',
            'value' => $this->form_validation->set_value('email')
        );

        $this->data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'type'  => 'password',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('regerter_validation_password_label'),
            'value' => $this->form_validation->set_value('password')
        );
        $this->data['password_confirm'] = array(
            'name'  => 'password_confirm',
            'id'    => 'password_confirm',
            'type'  => 'password',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('register_validation_comfirm_password_label'),
            'value' => $this->form_validation->set_value('password_confirm')
        );
        
        $this->data['captcha'] = array(
            'name'  => 'captcha',
            'id'    => 'captcha',
            'type'  => 'text',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('captcha_validation_label'),
            'autocomplete' => 'off',
            'value' => $this->form_validation->set_value('captcha')
        );
        
        
        // process template
        $title = $this->lang->line('register_heading_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        $layout_property['content']     = 'register';
        $layout_property['template']    = 'one_col';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('register'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function about_us()
    {
        // process template
        $title = $this->lang->line('about_us_menu_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['content']     = 'about_us';
        $this->data['content_sidebar'] = FALSE;
        
        $this->data['menu_about_us'] = TRUE;
        $this->data['no_breadcrumb'] = TRUE;
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('contact-us'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function contact_us()
    {
        $this->form_validation->set_rules('fullname', $this->lang->line('contact_validation_fullname_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('contact_validation_email_label'), 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', $this->lang->line('contact_validation_telephone_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('comment', $this->lang->line('contact_validation_comment_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('captcha', $this->lang->line('captcha_validation_label'), 'trim|required|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            if(check_captcha($this->input->post('captcha')) == FALSE)
            {
                $this->session->set_flashdata('message', $this->lang->line('captcha_error_label'));
                redirect('contact-us', 'refresh');
            }
            
            $from   = $this->input->post('email');
            $name   = $this->input->post('fullname');
            $to     = array('info@agritoday.com');
            $bcc    = array('chanthoeun.kim@agritoday.com', 'sovathara.heng@agritoday.com', 'sideth.kang@agritoday.com', 'ctate.chhun@agritoday.com', 'kimhoeun.pann@agritoday.com');
            $subject= 'Send from page contact';
            $body   = $this->input->post('comment').'<br><br>'
                    . 'Sender Contact: <br>'
                    . 'Name: '.$name.'<br>'
                    . 'Email: '.$from.'<br>'
                    . 'Telephone: '.$this->input->post('telephone');
            
            if(ENVIRONMENT == 'production')
            {
                if(! send_email($from, $name, $to, $subject, $body, FALSE, FALSE, $bcc))
                {
                    $this->session->set_flashdata('message', $this->lang->line('contact_sent_error') );
                    redirect('contact-us', 'refresh');
                }
            }
            $this->session->set_flashdata('message', $this->lang->line('contact_sent_success') );
            redirect('contact-us', 'refresh');
        }
        
        // display form
        $this->data['message'] = validation_errors() == FALSE ? $this->session->flashdata('message') : validation_errors();
        
        $this->data['name'] = array(
            'name'  => 'fullname',
            'id'    => 'fullname',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('contact_validation_fullname_label'),
            'value' => set_value('fullname')
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('email_form_label'),
            'value' => set_value('email')
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('contact_validation_telephone_label'),
            'value' => set_value('telephone')
        );
        
        $this->data['comment'] = array(
            'name'  => 'comment',
            'id'    => 'comment',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('contact_validation_comment_label'),
            'value' => set_value('comment')
        );
        
        $this->data['captcha'] = array(
            'name'  => 'captcha',
            'id'    => 'captcha',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('captcha_validation_label'),
            'autocomplete' => 'off'
        );
        
        // map 
        $map_config = array(
            'center' => '11.525485395179993, 104.94450590310089',
            'zoom'  => '15',
            'height' => '300px'
        );

        $marker = array(
            'position' => '11.525485395179993, 104.94450590310089',
            'animation'=> 'Drop'
        );
        $this->data['map'] = get_google_map($map_config, $marker);

        // process template
        $title = $this->lang->line('contact_us_menu_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/font-awesome.min.css',
                                        'css/agritodayicon.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $this->data['no_breadcrumb'] = TRUE;
        
        $layout_property['content']     = 'contact_us';
        
        $this->data['menu_contact_us'] = TRUE; 
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('contact-us'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function _generate_meta($title, $description = FALSE, $keyword = FALSE, $image = FALSE, $url = FALSE)
    {
        // meta
        return $meta = array(
            array('name' => 'name', 'content' => strip_tags($title), 'type' => 'itemprop'),
            array('name' => 'description', 'content' => character_limiter(strip_tags($description == FALSE ? $this->lang->line('home_meta_description') : $description), 150), 'type' => 'itemprop'),
            array('name' => 'image', 'content' => $image == FALSE ? get_image('logo.png') : $image, 'type' => 'itemprop'),
            array('name' => 'description', 'content' => character_limiter(strip_tags($description == FALSE ? $this->lang->line('home_meta_description') : $description), 150)),
            array('name' => 'keywords', 'content' => $keyword == FALSE ? $this->lang->line('home_meta_keyword') : $keyword),
            array('name' => 'distribution', 'content' => 'global'),
            array('name' => 'resource-type', 'content' => 'document'),
            array('name' => 'language', 'content' => 'kh'),
            // Facebook Meta 
            array('name' => 'og:title', 'content' => strip_tags($title), 'type' => 'property'),
            array('name' => 'og:type', 'content' => "article", 'type' => 'property'),
            array('name' => 'og:image', 'content' => $image == FALSE ? get_image('logo.png') : $image, 'type' => 'property'),
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
            array('name' => 'twitter:image:src', 'content' => $image == FALSE ? get_image('logo.png') : $image),
            array('name' => 'twitter:image:width', 'content' => '484'),
            array('name' => 'twitter:image:height', 'content' => '252'),
            array('name' => 'twitter:widgets:csp', 'content' => 'on'),
        );
    }
    
    public function _search_article($title = FALSE, $location = FALSE)
    {
        if($title == FALSE && $location == FALSE)
        {
            return FALSE;
        }
        
        
        if($title != FALSE && $location == FALSE)
        {
            return Modules::run('articles/get_like', array('title' => $title), FALSE, 'after');
        }
        else if($title == FALSE && $location != FALSE)
        {
            if(strlen($location) > 2)
            {
                return Modules::run('articles/get_like', array('location_id' => $location), FALSE, 'after');
            }
            else
            {
                return Modules::run('articles/get_all_records', array('location_id' => $location));
            }
        }
        
        else 
        {
            if(strlen($location) > 2)
            {
                return Modules::run('articles/get_like', array('title' => $title, 'location_id' => $location), FALSE, 'after');
            }
            else
            {
                return Modules::run('articles/get_like', array('title' => $title), array('location_id' => $location), 'after');
            }
        }
    }
    
    public function _search_product($title)
    {
        if($title == FALSE)
        {
            return FALSE;
        }
        
        return Modules::run('products/get_like', array('title' => $title), FALSE, 'after');
    }
    
    public function _search_land($title = FALSE, $location = FALSE)
    {
        if($title == FALSE && $location == FALSE)
        {
            return FALSE;
        }
        
        if($title != FALSE && $location == FALSE)
        {
            return Modules::run('real_estates/get_like', array('title' => $title), FALSE, 'after');
        }
        else if($title == FALSE && $location != FALSE)
        {
            if(strlen($location) <= 2)
            {
                return Modules::run('real_estates/get_like', array('location_id' => $location), FALSE, 'after');
            }
            else
            {
                return Modules::run('real_estates/get_all_records', array('location_id' => $location));
            }
        }
        
        else 
        {
            if(strlen($location) <= 2)
            {
                return Modules::run('real_estates/get_like', array('title' => $title, 'location_id' => $location), FALSE, 'after');
            }
            else
            {
                return Modules::run('real_estates/get_like', array('title' => $title), array('location_id' => $location), 'after');
            }
        }
    }
    
    public function _search_job($title = FALSE, $location = FALSE)
    {
        if($title == FALSE && $location == FALSE)
        {
            return FALSE;
        }
        
        if($title != FALSE && $location == FALSE)
        {
            return Modules::run('jobs/get_like', array('title' => $title), FALSE, 'after');
        }
        else if($title == FALSE && $location != FALSE)
        {
            return Modules::run('jobs/get_all_records', array('location_id' => $location));
        }
        
        else 
        {
            return Modules::run('jobs/get_like', array('title' => $title), array('location_id' => $location), 'after');
        }
    }
    
    public function _search_video($title)
    {
        if($title == FALSE)
        {
            return FALSE;
        }
        return Modules::run('videos/get_like', array('title' => $title), FALSE, 'after');
    }
    
}