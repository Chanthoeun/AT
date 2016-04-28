<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article
 *
 * @author Chanthoeun
 */
class Articles extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('article_model', 'article');
        $this->lang->load(array('article', 'products/product', 'real_estates/real_estate', 'people/people', 'agribooks/agribook', 'jobs/job'));
        
        $this->load->library('upload');
        $this->load->helper(array('menu','video','string'));
        
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
        parent::check_login();
        $this->data['articles'] = $this->get_all_records(FALSE, array('created_at' => 'desc'), 300);
        
        // process template
        $title = $this->lang->line('index_article_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['article_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create()
    {
        parent::check_login();        
        // display form
        $this->data['article_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? NULL : $this->validation_errors['post_data']['title']
        );
        
        $this->data['keyword'] = array(
            'name'  => 'keyword',
            'id'    => 'keyword',
            'class' => 'form-control',
            'placeholder' => 'ពាក្យ​គន្លឹះទី១, ពាក្យ​គន្លឹះទី២',
            'value' => empty($this->validation_errors['post_data']['keyword']) ? NULL : $this->validation_errors['post_data']['keyword']
        );
        
        $this->data['detail'] = array(
            'name'  => 'detail',
            'id'    => 'detail',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['detail']) ? NULL : $this->validation_errors['post_data']['detail']
        );
        
        $this->data['publish'] = array(
            'name'  => 'publish',
            'id'    => 'publish',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['publish']) ? date('Y-m-d') : $this->validation_errors['post_data']['publish']
        );
        
        $this->data['source'] = array(
            'name'  => 'source',
            'id'    => 'source',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['source']) ? NULL : $this->validation_errors['post_data']['source']
        );
        
        
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE), 'order')), 'ជ្រើស​ក្រុមអត្ថបទ');
        $this->data['category'] = form_dropdown('category', $categories, empty($this->validation_errors['post_data']['category']) ? FALSE : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        $articleTypes = get_dropdown(prepareList(Modules::run('article_types/get_dropdown')), 'ជ្រើស​ប្រភេទ​អត្ថបទ');
        $this->data['type'] = form_dropdown('type', $articleTypes, empty($this->validation_errors['post_data']['type']) ? NULL : $this->validation_errors['post_data']['type'], 'class="form-control" id="type"');
        
        $this->data['pcaption'] = array(
            'name'  => 'pcaption',
            'id'    => 'pcaption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['pcaption']) ? NULL : $this->validation_errors['post_data']['pcaption']
        );
        
        $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? FALSE : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
        
        if(!empty($this->validation_errors['post_data']['province']))
        {
            $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $this->validation_errors['post_data']['province'])), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
        }
        else
        {
            $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
        }
        
        if(!empty($this->validation_errors['post_data']['khan']))
        {
            $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $this->validation_errors['post_data']['khan'])), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
        }
        else
        {
            $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
        }
        
        if(!empty($this->validation_errors['post_data']['sangkat']))
        {
            $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $this->validation_errors['post_data']['sangkat'])), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
        }
        else
        {
            $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
        }
        
        $this->data['fb'] = array(
            'name'  => 'fb',
            'id'    => 'fb',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fb']) ? NULL : $this->validation_errors['post_data']['fb']
        );
        
        $this->data['fbp'] = array(
            'name'  => 'fbp',
            'id'    => 'fbp',
            'value' => 1
        );
        
        // process template
        $title = $this->lang->line('form_article_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        $layout_property['script'] = '$(\'#publish\').datepicker()';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['article_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        
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
        $fbpost = $this->input->post('fbp');
        $slug = str_replace(' ', '-', strtolower(trim($this->input->post('title'))));
        $data = array(
            'title'     => trim($this->input->post('title')),
            'slug'      => $slug,
            'keyword'     => trim($this->input->post('keyword')),
            'detail'    => $this->input->post('detail'),
            'published_on'  => $this->input->post('publish'),
            'source'    => utf8_encode($this->input->post('source')),
            'pcaption'  => trim($this->input->post('pcaption')),
            'article_type_id' => $this->input->post('type'),
            'category_id' => $this->input->post('category'),
            'location_id'   => $getLoc,
            'fb_quote' => trim($this->input->post('fb'))
        );
        
        // add article picture
        if(check_empty_field('picture'))
        {
            $uploaded = upload_file('picture', 'image', random_string());

            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'articles/create');
            }
            else
            {
                $data['picture'] = $uploaded;
            }
        }
        
        if(($aid = $this->insert($data)) != FALSE)
        {     
            // Post to Facebook
            if($fbpost == TRUE)
            {
                //code here
            }
            
            // set log
            array_unshift($data, $aid);
            set_log('Created Article', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_article_report_success'));
            redirect('articles/view/'.$aid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'articles/create');
        }
    }


    // edit
    public function edit($id)
    {
        parent::check_login();
        $article = $this->get($id);
        $this->data['article_id'] = array('article_id' => $article->id);
        $this->data['article'] = $article;
        // set log
        set_log('View Update Article', $article);
        
        // display form
        $this->data['article_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? $article->title : $this->validation_errors['post_data']['title']
        );
        
        $this->data['keyword'] = array(
            'name'  => 'keyword',
            'id'    => 'keyword',
            'class' => 'form-control',
            'placeholder' => 'ពាក្យ​គន្លឹះទី១, ពាក្យ​គន្លឹះទី២',
            'value' => empty($this->validation_errors['post_data']['keyword']) ? $article->keyword : $this->validation_errors['post_data']['keyword']
        );
        
        $this->data['detail'] = array(
            'name'  => 'detail',
            'id'    => 'detail',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['detail']) ? $article->detail : $this->validation_errors['post_data']['detail']
        );
        
        $this->data['publish'] = array(
            'name'  => 'publish',
            'id'    => 'publish',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['publish']) ? $article->published_on : $this->validation_errors['post_data']['publish']
        );
        
        $this->data['source'] = array(
            'name'  => 'source',
            'id'    => 'source',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['source']) ? utf8_decode($article->source) : $this->validation_errors['post_data']['source']
        );
        
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE), 'order')), 'ជ្រើស​ក្រុមអត្ថបទ');
        $this->data['category'] = form_dropdown('category', $categories, empty($this->validation_errors['post_data']['category']) ? $article->category_id : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        $articleTypes = get_dropdown(prepareList(Modules::run('article_types/get_dropdown')), 'ជ្រើស​ប្រភេទ​អត្ថបទ');
        $this->data['type'] = form_dropdown('type', $articleTypes, empty($this->validation_errors['post_data']['type']) ? $article->article_type_id : $this->validation_errors['post_data']['type'], 'class="form-control" id="type"');
        
        $this->data['pcaption'] = array(
            'name'  => 'pcaption',
            'id'    => 'pcaption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['pcaption']) ? $article->pcaption : $this->validation_errors['post_data']['pcaption']
        );
        
        $getLoc = explode('/', $article->location_id);
        
        switch (count($getLoc))
        {
            case 1:
                $province = $getLoc[0];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
                
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
            case 2:
                $province = $getLoc[0];
                $khan = $getLoc[1];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
                
                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
            case 3:
                $province = $getLoc[0];
                $khan = $getLoc[1];
                $sangkat = $getLoc[2];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? $sangkat : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
                
                $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $sangkat)), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));

                break;
            case 4:
                $province = $getLoc[0];
                $khan = $getLoc[1];
                $sangkat = $getLoc[2];
                $phum = $getLoc[3];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat',Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? $sangkat : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $sangkat)), empty($this->validation_errors['post_data']['phum']) ? $phum : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;

            default:
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? FALSE : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
        }
        
        $this->data['fb'] = array(
            'name'  => 'fb',
            'id'    => 'fb',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fb']) ? $article->fb_quote : $this->validation_errors['post_data']['fb']
        );
        
        $this->data['fbp'] = array(
            'name'  => 'fbp',
            'id'    => 'fbp',
            'value' => 1
        );
        
        // process template
        $title = $this->lang->line('form_article_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        $layout_property['script'] = '$(\'#publish\').datepicker()';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['article_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = trim($this->input->post('article_id'));
        
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
        $fbpost = $this->input->post('fbp');
        $slug = str_replace(' ', '-', strtolower(trim($this->input->post('title'))));
        $data = array(
            'title'     => trim($this->input->post('title')),
            'slug'      => $slug,
            'keyword'     => trim($this->input->post('keyword')),
            'detail'    => $this->input->post('detail'),
            'published_on'  => $this->input->post('publish'),
            'source'    => utf8_encode($this->input->post('source')),
            'pcaption' => trim($this->input->post('pcaption')),
            'article_type_id' => $this->input->post('type'),
            'category_id' => $this->input->post('category'),
            'location_id' => $getLoc, 
            'fb_quote' => trim($this->input->post('fb'))
        );
        
        // add article picture
        if(check_empty_field('picture'))
        {
            $uploaded = upload_file('picture', 'image', random_string());

            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'articles/create');
            }
            else
            {
                $data['picture'] = $uploaded;
            }
        }
        
        $this->article->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data) != FALSE)
        {     
            // Post to Facebook
            if($fbpost == TRUE)
            {
                //code here
            }
            
            // set log
            array_unshift($data, $id);
            set_log('Updated Article', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_article_report_success'));
            redirect('articles/view/'.$id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'articles/edit/'.$id);
        }
    }
    
    // view
    public function view($id)
    {
        parent::check_login();
        $article = $this->get_detail($id);
        $this->data['article'] = $article;
        $this->data['documents'] = Modules::run('article_libraries/get_all_records', array('article_id' => $article->id), get_library_type());
        $this->data['audios'] = Modules::run('article_libraries/get_all_records', array('article_id' => $article->id), get_library_type(2));
        $this->data['videos'] = Modules::run('article_libraries/get_all_records', array('article_id' => $article->id), get_library_type(3));
        $this->data['details'] = Modules::run('article_details/get_many_by', array('article_id' => $article->id));
        
        //get linked data
        $this->data['products'] = Modules::run('article_products/get_all_records', array('article_id' => $this->data['article']->id));
        $this->data['real_estates'] = Modules::run('article_real_estates/get_all_records', array('article_id' => $this->data['article']->id));
        $this->data['jobs'] = Modules::run('article_jobs/get_all_records', array('article_id' => $this->data['article']->id));
        $this->data['people'] = Modules::run('article_people/get_all_records', array('article_id' => $this->data['article']->id));
        $this->data['abs'] = Modules::run('article_agribooks/get_all_records', array('article_id' => $this->data['article']->id));
        
        if($article->location_id != FALSE){
            $getLoc = explode('/', $article->location_id);

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
        
        // process template
        $title = $article->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/colorbox/colorbox.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery.colorbox.min.js'
                                        );
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'view';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['dashboad_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // delete
    public function destroy($id)
    {
         parent::check_login();
        $article = $this->get($id);
        $details = Modules::run('article_details/get_many_by', array('article_id'=> $id));
        
        // delete article
        if($this->delete($article->id))
        {
            // delete picture
            delete_uploaded_file($article->picture);
            
            // delete detail            
            foreach ($details as $detail)
            {
                if($detail->picture != FALSE)
                {
                    delete_uploaded_file($detail->picture);
                }
            }
            
            //delete article detail
            Modules::run('article_details/delete_by', array('article_id' => $article->id));
            
            // Delete article library
            Modules::run('article_libraries/delete_by', array('article_id' => $article->id));
            
            
            
            // set log
            set_log('Deleted Article', $article);
            
            $this->session->set_flashdata('message', $this->lang->line('del_article_report_success'));   
        }
        else
        {            
            $this->session->set_flashdata('message', $this->lang->line('del_article_report_error'));
        }
        redirect('articles', 'refresh');
    }
    
    public function link_library($aid)
    {
        parent::check_login();
        $article = $this->get_detail($aid);
        $this->data['article'] = $article;
        $search = FALSE;
        
        $this->form_validation->set_rules('group', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('group'));
            $this->data['libraries'] = Modules::run('library/get_all_records', array('library_group_id' => $search));
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        $library_groups = get_dropdown(prepareList(Modules::run('library_groups/get_dropdown')), 'ជ្រើស​ក្រុម');
        $this->data['group'] = form_dropdown('group', $library_groups, empty($this->validation_errors['post_data']['group']) ? $search : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $title = $this->lang->line('article_link_library_menu_label');
        $this->data['title'] = $title;
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'link_library';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['link_library_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function save_link_library()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $this->form_validation->set_rules('lid[]', 'ប្រអប់', 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​ធិច'));
        if($this->form_validation->run() == TRUE)
        {
            $lids = $this->input->post('lid');
            foreach ($lids as $lid)
            {
                $data = array(
                    'article_id'    => $articleId,
                    'library_id'    => $lid,
                    'order'       => Modules::run('article_libraries/get_next_order', 'order', array('article_id' => $articleId))
                );
                Modules::run('article_libraries/insert', $data, TRUE);
            }
        }
        redirect('articles/view/'.$articleId, 'refresh');
    }
    
    public function link_product($aid)
    {
        parent::check_login();
        $article = $this->get_detail($aid);
        $this->data['article'] = $article;
        $search = FALSE;
        
        $this->form_validation->set_rules('category', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        $this->form_validation->set_rules('all_products', 'All Products', 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('category'));
            $allProducts = $this->input->post('all_products');
            if($allProducts == TRUE)
            {
                $this->data['products'] = Modules::run('products/get_all_records', array('category_id' => $search));
            }
            else
            {
                $this->data['products'] = Modules::run('products/get_all_records', array('category_id' => $search, 'member_type_id' => 3));
            }
            
        }
        
        // message error
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('market' => TRUE))), 'ជ្រើស​ក្រុម');
        $this->data['category'] = form_dropdown('category', $categories, set_value('category'), 'class="form-control" id="category"');
        
        $this->data['all_products'] = array(
            'name' => 'all_products',
            'id'    => 'all_products',
            'value' => 1
        );
        
        $title = $this->lang->line('article_link_product_menu_label');
        $this->data['title'] = $title;
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'link_product';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['link_product_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function save_link_product()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $this->form_validation->set_rules('pid[]', 'ប្រអប់', 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​ធិច'));
        if($this->form_validation->run() == TRUE)
        {
            $pids = $this->input->post('pid');
            foreach ($pids as $pid)
            {
                $data = array(
                    'article_id'    => $articleId,
                    'product_id'    => $pid,
                    'order'       => Modules::run('article_products/get_next_order', 'order', array('article_id' => $articleId))
                );
                Modules::run('article_products/insert', $data, TRUE);
            }
        }
        redirect('articles/view/'.$articleId, 'refresh');
    }
    
    public function link_real_estate($aid)
    {
        parent::check_login();
        $article = $this->get_detail($aid);
        $this->data['article'] = $article;
        $search = FALSE;
        
        $this->form_validation->set_rules('category', $this->lang->line('search_caption_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('province', $this->lang->line('form_agribook_validation_province_label'), 'trim|xss_clean') ;
        $this->form_validation->set_rules('khan', $this->lang->line('form_agribook_validation_khan_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('sangkat', $this->lang->line('form_agribook_validation_sangkat_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('phum', $this->lang->line('form_agribook_validation_phum_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('category'));
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
            
            if($search != FALSE && $getLoc == FALSE)
            {
                $this->data['real_estates'] = Modules::run('real_estates/get_all_records', array('category_id' => $search));
            }
            else if($search == FALSE && $getLoc != FALSE)
            {
                if(strlen($getLoc) > 2)
                {
                    $this->data['real_estates'] = Modules::run('real_estates/get_like', array('location_id' => $getLoc), FALSE, 'after');
                }
                else
                {
                    $this->data['real_estates'] = Modules::run('real_estates/get_all_records', array('location_id' => $getLoc));
                }
            }
            else if($search != FALSE && $getLoc != FALSE)
            {
                if(strlen($getLoc) > 2)
                {
                    $this->data['real_estates'] = Modules::run('real_estates/get_like', array('location_id' => $getLoc), array('category_id' => $search), 'after');
                }
                else
                {
                    $this->data['real_estates'] = Modules::run('real_estates/get_all_records', array('category_id' => $search ,'location_id' => $getLoc));
                }
            }
            
        }
        
        // message error
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id','caption', 'ជ្រើស​ក្រុម', array('real_estate' => TRUE, 'parent_id !=' => FALSE)), set_value('category'), 'class="form-control" id="category"');
        
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
        
        $title = $this->lang->line('article_link_real_estate_menu_label');
        $this->data['title'] = $title;
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'link_real_estate';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['link_real_estate_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function save_link_real_estate()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $this->form_validation->set_rules('rsid[]', 'ប្រអប់', 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​ធិច'));
        if($this->form_validation->run() == TRUE)
        {
            $rsids = $this->input->post('rsid');
            foreach ($rsids as $rsid)
            {
                $data = array(
                    'article_id'    => $articleId,
                    'real_estate_id'    => $rsid,
                    'order'       => Modules::run('article_real_estates/get_next_order', 'order', array('article_id' => $articleId))
                );
                Modules::run('article_real_estates/insert', $data, TRUE);
            }
        }
        redirect('articles/view/'.$articleId, 'refresh');
    }
    
    public function link_job($aid)
    {
        parent::check_login();
        $article = $this->get_detail($aid);
        $this->data['article'] = $article;
        $search = FALSE;
        
        $this->form_validation->set_rules('category', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('category'));
            $this->data['jobs'] = Modules::run('jobs/get_all_records', array('category_id' => $search));
        }
        
        // message error
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id','caption', 'ជ្រើស​ក្រុម', array('job' => TRUE, 'parent_id !=' => FALSE)), set_value('category'), 'class="form-control" id="category"');
        
        $title = $this->lang->line('article_link_job_menu_label');
        $this->data['title'] = $title;
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'link_job';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['link_job_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function save_link_job()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $this->form_validation->set_rules('jid[]', 'ប្រអប់', 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​ធិច'));
        if($this->form_validation->run() == TRUE)
        {
            $jids = $this->input->post('jid');
            foreach ($jids as $jid)
            {
                $data = array(
                    'article_id'    => $articleId,
                    'job_id'    => $jid,
                    'order'       => Modules::run('article_jobs/get_next_order', 'order', array('article_id' => $articleId))
                );
                Modules::run('article_jobs/insert', $data, TRUE);
            }
        }
        redirect('articles/view/'.$articleId, 'refresh');
    }
    
    public function link_people($aid)
    {
        parent::check_login();
        $article = $this->get_detail($aid);
        $this->data['article'] = $article;
        $search = FALSE;
        
        $this->form_validation->set_rules('group', $this->lang->line('search_caption_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('go', $this->lang->line('form_people_validation_go_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('province', $this->lang->line('form_agribook_validation_province_label'), 'trim|xss_clean') ;
        $this->form_validation->set_rules('khan', $this->lang->line('form_agribook_validation_khan_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('sangkat', $this->lang->line('form_agribook_validation_sangkat_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('phum', $this->lang->line('form_agribook_validation_phum_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('group'));
            $go = trim($this->input->post('go'));
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
            
            if($search != FALSE && $getLoc == FALSE)
            {
                $this->data['people'] = Modules::run('people/get_all_records', array('people_group_id' => $search, 'go_id' => $go));
            }
            else if($search == FALSE && $getLoc != FALSE)
            {
                if(strlen($getLoc) > 2)
                {
                    $this->data['people'] = Modules::run('people/get_like', array('location_id' => $getLoc), FALSE, 'after');
                }
                else
                {
                    $this->data['people'] = Modules::run('people/get_all_records', array('location_id' => $getLoc));
                }
            }
            else if($search != FALSE && $getLoc != FALSE)
            {
                if(strlen($getLoc) > 2)
                {
                    $this->data['people'] = Modules::run('people/get_like', array('location_id' => $getLoc), array('people_group_id' => $search, 'go_id' => $go), 'after');
                }
                else
                {
                    $this->data['people'] = Modules::run('people/get_all_records', array('people_group_id' => $search, 'go_id' => $go, 'location_id' => $getLoc));
                }
            }
            
        }
        
        // message error
        $this->data['group'] = form_dropdown('group', Modules::run('people_groups/dropdown', 'id','caption', 'ជ្រើស​ក្រុម'), set_value('group'), 'class="form-control" id="group"');
        $gos = get_dropdown(prepareList(Modules::run('government_organization/get_dropdown')), 'ជ្រើស​'.$this->lang->line('government_organization_menu_label'));
        $this->data['go'] = form_dropdown('go', $gos, set_value('go'), 'class="form-control" id="go"');
        
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
        
        $title = $this->lang->line('article_link_people_menu_label');
        $this->data['title'] = $title;
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'link_people';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['link_people_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function save_link_people()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $this->form_validation->set_rules('pid[]', 'ប្រអប់', 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​ធិច'));
        if($this->form_validation->run() == TRUE)
        {
            $pids = $this->input->post('pid');
            foreach ($pids as $pid)
            {
                $data = array(
                    'article_id'    => $articleId,
                    'people_id'    => $pid,
                    'order'       => Modules::run('article_people/get_next_order', 'order', array('article_id' => $articleId))
                );
                Modules::run('article_people/insert', $data, TRUE);
            }
        }
        redirect('articles/view/'.$articleId, 'refresh');
    }
    
    public function link_agribook($aid)
    {
        parent::check_login();
        $article = $this->get_detail($aid);
        $this->data['article'] = $article;
        $search = FALSE;
        
        $this->form_validation->set_rules('group', $this->lang->line('search_caption_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('province', $this->lang->line('form_agribook_validation_province_label'), 'trim|xss_clean') ;
        $this->form_validation->set_rules('khan', $this->lang->line('form_agribook_validation_khan_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('sangkat', $this->lang->line('form_agribook_validation_sangkat_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('phum', $this->lang->line('form_agribook_validation_phum_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('group'));
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
            
            if($search != FALSE && $getLoc == FALSE)
            {
                $this->data['abs'] = Modules::run('agribooks/get_all_records', array('agribook_group_id' => $search));
            }
            else if($search == FALSE && $getLoc != FALSE)
            {
                if(strlen($getLoc) > 2)
                {
                    $this->data['abs'] = Modules::run('agribooks/get_like', array('location_id' => $getLoc), FALSE, 'after');
                }
                else
                {
                    $this->data['abs'] = Modules::run('agribooks/get_all_records', array('location_id' => $getLoc));
                }
            }
            else if($search != FALSE && $getLoc != FALSE)
            {
                if(strlen($getLoc) > 2)
                {
                    $this->data['abs'] = Modules::run('agribooks/get_like', array('location_id' => $getLoc), array('agribook_group_id' => $search), 'after');
                }
                else
                {
                    $this->data['abs'] = Modules::run('agribooks/get_all_records', array('agribook_group_id' => $search ,'location_id' => $getLoc));
                }
            }
            
        }
        
        // message error
        $this->data['group'] = form_dropdown('group', Modules::run('agribook_group/dropdown', 'id','caption', 'ជ្រើស​ក្រុម'), set_value('group'), 'class="form-control" id="group"');
        
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
        
        $title = $this->lang->line('article_link_agribook_menu_label');
        $this->data['title'] = $title;
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'link_agribook';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['link_agribook_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function save_link_agribook()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $this->form_validation->set_rules('aid[]', 'ប្រអប់', 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​ធិច'));
        if($this->form_validation->run() == TRUE)
        {
            $aids = $this->input->post('aid');
            foreach ($aids as $aid)
            {
                $data = array(
                    'article_id'    => $articleId,
                    'agribook_id'    => $aid,
                    'order'       => Modules::run('article_agribooks/get_next_order', 'order', array('article_id' => $articleId))
                );
                Modules::run('article_agribooks/insert', $data, TRUE);
            }
        }
        redirect('articles/view/'.$articleId, 'refresh');
    }
    
    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $this->data['articles'] = $this->get_like(array('title' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['search'] = array(
            'name'  => 'search',
            'id'    => 'search',
            'class' => 'form-control',
            'style' => 'width: 700px;',
            'placeholder' => $this->lang->line('search_placeholder_label'),
            'value' => set_value('search')
        );
        
        // process template
        $title = $this->lang->line('search_heading_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/jquery-ui.css', 'js/jquery-ui.min.js');
        
        $field = array_to_string($this->get_field('title'),'title');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['search_article_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function filter_by_type()
    {
        parent::check_login();
        $this->form_validation->set_rules('type', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('type'));
            $this->data['articles'] = $this->get_all_records(array('article_type_id' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['type'] = form_dropdown('type', Modules::run('article_types/dropdown', 'id', 'caption', $this->lang->line('filter_type_caption_label')), set_value('type'), 'class="form-control" id="type"');
        
        // process template
        $title = $this->lang->line('filter_type_heading_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'filter_by_type';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['article_filter_type_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function filter_by_category()
    {
        parent::check_login();
        $this->form_validation->set_rules('category', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('category'));
            $this->data['articles'] = $this->get_all_records(array('category_id' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE), 'order')), $this->lang->line('filter_cat_caption_label'));
        $this->data['category'] = form_dropdown('category', $categories, set_value('category'), 'class="form-control" id="category"');
        
        // process template
        $title = $this->lang->line('filter_cat_heading_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'filter_by_category';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['article_filter_category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function change_category()
    {
        parent::check_login();
        $this->form_validation->set_rules('category', $this->lang->line('search_caption_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('category'));
            $this->data['category_id'] = array('category_id' => $search != FALSE ? $search : FALSE);
            $this->data['articles'] = $this->get_all_records(array('category_id' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $categories_all = get_dropdown(prepareList(Modules::run('categories/get_dropdown', FALSE, 'order')), $this->lang->line('filter_cat_caption_label'));
        $this->data['category'] = form_dropdown('category', $categories_all, set_value('category'), 'class="form-control" id="category"');
        
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE), 'order')), $this->lang->line('filter_cat_caption_label'));
        $this->data['category_update'] = form_dropdown('category_update', $categories, empty($this->validation_errors['post_data']['category_update']) ? NULL : $this->validation_errors['post_data']['category_update'], 'class="form-control" id="category_update"');
        
        // process template
        $title = $this->lang->line('change_cat_heading_label');
        $this->data['title'] = $title;
        
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'change_category';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['article_change_category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function update_category()
    {
        parent::check_login();
        $this->form_validation->set_rules('category_update', $this->lang->line('change_cat_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        $this->form_validation->set_rules('art_id[]', $this->lang->line('change_cat_article_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $category_update = trim($this->input->post('category_update'));
            $category_id = trim($this->input->post('category_id'));
            $articleIds = $this->input->post('art_id');
            
            if($articleIds == FALSE)
            {
                $arts = $this->get_many_by(array('category_id' => $category_id));
                foreach ($arts as $art){
                    $this->update($art->id, array('category_id' => $category_update), TRUE);
                }
            }
            else
            {
                foreach ($articleIds as $articleId)
                {
                    $this->update($articleId, array('category_id' => $category_update), TRUE);
                }
            }
            
             // set log
            set_log('Updated Article Category', array($category_id, $category_update));

            $this->session->set_flashdata('message', $this->lang->line('change_cat_success_label'));
            redirect('articles/change-category', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'articles/change-category');
        }
    }
    
    public function details($id)
    {
        parent::check_login();
        $this->load->helper('text');
        $article = $this->get($id);
        $this->data['article'] = $article;
        $this->data['details'] = Modules::run('article_details/get_many_by', array('article_id' => $article->id));
        
        // process template
        $title = $this->lang->line('index_article_detail_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js');
        
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'details';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['detail_menu'] = TRUE; 
        generate_template($this->data, $layout_property);
    }
    
    public function add_detail($id)
    {
        parent::check_login();
        $article = $this->get($id);
        $this->data['article'] = $article;
        $this->form_validation->set_rules('title', $this->lang->line('form_article_detail_validation_title_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('desc', $this->lang->line('form_article_detail_detail_validation_desc_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('caption', $this->lang->line('form_article_detail_validation_pcaption_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $data = array(
                'title'     => trim($this->input->post('title')),
                'detail'    => trim($this->input->post('desc')),
                'pcaption'  => trim($this->input->post('caption')), 
                'article_id'=> $article->id
            );
            
            if(check_empty_field('picture'))
            {
                $uploaded = upload_file('picture', 'image', url_title(utf8_decode($data['pcaption']), '-', TRUE));

                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), current_url());
                }
                else
                {
                    $data['picture'] = $uploaded;
                }
            }
            
            if(($did = Modules::run('article_details/insert', $data, TRUE)) != FALSE)
            {                
                //set log
                array_unshift($data, $did);
                set_log('Added Detail', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_article_detail_report_success'));
                redirect('articles/details/'.$id, 'refresh');
            }
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['detail_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => set_value('title')
        );
        
        $this->data['desc'] = array(
            'name'  => 'desc',
            'id'    => 'desc',
            'class' => 'form-control',
            'value' => set_value('desc')
        );
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => set_value('caption')
        );
        
        // process template
        $title = $this->lang->line('form_article_detail_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );
        
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$article->id => $article->title, $title);
        
        $layout_property['content']  = 'add_detail';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['detail_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function edit_detail($id)
    {
        parent::check_login();
        $detail = Modules::run('article_details/get', $id);
        $this->data['article'] = $this->get($detail->article_id);
        
        $this->form_validation->set_rules('title', $this->lang->line('form_article_detail_validation_title_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('desc', $this->lang->line('form_article_detail_detail_validation_desc_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('caption', $this->lang->line('form_article_detail_validation_pcaption_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $data = array(
                'title'     => trim($this->input->post('title')),
                'detail'    => trim($this->input->post('desc')),
                'pcaption'  => trim($this->input->post('caption'))
            );
            
            if(check_empty_field('picture'))
            {
                $uploaded = upload_file('picture', 'image', url_title(utf8_decode($data['pcaption']), '-', TRUE));

                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), current_url());
                }
                else
                {
                    $data['picture'] = $uploaded;
                }
            }
            
            if(Modules::run('article_details/update', $detail->id, $data, TRUE) != FALSE)
            {                
                //set log
                array_unshift($data, $detail->id);
                set_log('Updated Detail', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_article_detail_report_success'));
                redirect('articles/details/'.$detail->article_id, 'refresh');
            }
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['detail_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => set_value('title', $detail->title)
        );
        
        $this->data['desc'] = array(
            'name'  => 'desc',
            'id'    => 'desc',
            'class' => 'form-control',
            'value' => set_value('desc', $detail->detail)
        );
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => set_value('caption', $detail->pcaption)
        );
        
        // process template
        $title = $this->lang->line('form_article_detail_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), 'articles/view/'.$this->data['article']->id => $this->data['article']->title, $title);
        
        $layout_property['content']  = 'edit_detail';
        $layout_property['sidebar']  = 'sidebar';
        
        // menu
        $this->data['detail_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function del_detail($id)
    {
        parent::check_login();
        $detail = Modules::run('article_details/get', $id);
        
        if(Modules::run('article_details/delete', $detail->id))
        {
            // delate picture
            if($detail->picture != FALSE)
            {
                delete_uploaded_file($detail->picture);
            }
            
            // set log
            set_log('Deleted Article Detail', $detail);
            $this->session->set_flashdata('message', $this->lang->line('del_article_detail_report_success'));
            redirect('articles/details/'.$detail->article_id, 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_article_detail_report_error'));
            redirect('articles/details/'.$detail->article_id, 'refresh');
        }
    }
    
    public function get($id)
    {
        return $this->article->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->article->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article->as_array()->get_by($where);
        }
        return $this->article->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->article->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_all();
    }
    
    public function get_all_records($where = FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_all_records($where);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_many_by($where);
    }
    
    public function get_similar_articles($where = FALSE, $spcial_where = FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0) {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_similar_articles($where, $spcial_where);
    }

    public function get_like($like, $where = FALSE, $condition = 'both')
    {
        return $this->article->get_like($like, $where, $condition);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->article->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->article->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->article->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->article->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->article->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->article->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->article->count_all();
    }
    
    public function count_by($where)
    {
        return $this->article->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->article->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->article->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->article->get_next_order($field, $where);
    }
}