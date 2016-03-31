<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * MarcoMonteiro Video Helper
 *
 * Serdar Senay (Lupelius)
 * Fix applied where all methods had unnecessary if checks for checking
 * valid ID, removed those as youtube|vimeo_id functions already check that
 * Also added vimeo to _isValidID check, and added vimeo_fullvideo method
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Marco Monteiro
 * @link			www.marcomonteiro.net
 * @version 	1.0.5
 */

// ------------------------------------------------------------------------

/**
 * Get Youtube Id
 *
 * @access	public
 * @param	string	Youtube url
 * @return	string	Youtube ID
 */
if ( ! function_exists('youtube_id'))
{
	function youtube_id( $url = '')
	{
		if ( $url === '' )
		{
			return FALSE;
		}
		if (!_isValidURL( $url ))
		{
			return FALSE;
		}
                else 
                {
                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
                    return $matches[0];
                }
	}
}


/**
 * Get Vimeo Id
 *
 * @access	public
 * @param	string	Vimeo url
 * @return	string	Vimeo ID
 */
if ( ! function_exists('vimeo_id'))
{
	function vimeo_id( $url = '')
	{
		if ( $url === '' )
		{
			return FALSE;
		}
		if (_isValidURL( $url ))
		{
                    $arr = explode('/', $url);
                    $vimeo_id = array_pop($arr);
		}
		else {
			$vimeo_id = $url;
		}

		return $vimeo_id;
	}
}

/**
 * Get Facebook Id
 *
 * @access	public
 * @param	string	Facebook video url
 * @return	string	Facebook Video ID
 */
if(!function_exists('facebook_id'))
{
    function facebook_id($url = '')
    {
        if($url == '')
        {
            return FALSE;
        }
        if (_isValidURL( $url ))
        {
            if(strpos($url, '/?type=2&theater') === TRUE)
            {
                $query = parse_url($url, PHP_URL_PATH);
                $segments = array_filter(explode('/', $query));
                $facebook_id = array_pop($segments);
            }
            else if(strpos($url, '/?fref=nf') === TRUE)
            {
                $query = parse_url($url, PHP_URL_PATH);
                $segments = array_filter(explode('/', $query));
                $facebook_id = array_pop($segments);
            }
            else
            {
                if(strpos($url, '?') === TRUE)
                {
                    $query = parse_url($url, PHP_URL_QUERY);
                    parse_str($query, $vars);
                    $facebook_id = $vars['v'];
                }
                else
                {
                    $query = parse_url($url, PHP_URL_PATH);
                    $segments = array_filter(explode('/', $query));
                    $facebook_id = array_pop($segments);
                }
            }
            return $facebook_id;
        }
        else
        {
            return FALSE;
        }
    }
}

/**
 *Get youtube video page
 *
 * @access	public
 * @param	string	Youtube url || Youtube id
 * @return	$array	url's video
 */
 if ( ! function_exists('youtube_fullvideo'))
 {
 	function youtube_fullvideo( $url_id = '' )
 	{
 		if ( $url_id == '' )
		{
			return FALSE;
		}
		if ( _isValidID( $url_id ) )
		{
			$id = $url_id;
		}
		else{
			$id = youtube_id( $url_id );
		}
		return 'http://www.youtube.com/v/'.$id;
 	}
 }

 /**
 *Get vimeo video page
 *
 * @access	public
 * @param	string	Vimeo ID
 * @return	$array	url's video
 */
 if ( ! function_exists('vimeo_fullvideo'))
 {
 	function vimeo_fullvideo( $url_id = '' )
 	{
 		if ( $url_id == '' )
		{
			return FALSE;
		}
		if ( _isValidID( $url_id , 'vimeo') )
		{
			$id = $url_id;
		}
		else{
			$id = vimeo_id( $url_id );
		}
		return ($id) ? 'http://vimeo.com/'.$id : FALSE;
 	}
 }
 
 /**
 *Get facebook video page
 *
 * @access	public
 * @param	string	Facebook ID
 * @return	$array	url's video
 */
 if ( ! function_exists('facebook_fullvideo'))
 {
 	function facebook_fullvideo( $url_id = '' )
 	{
            if ( $url_id == '' )
            {
                return FALSE;
            }
            if ( _isValidID( $url_id , 'facebook') )
            {
                $id = $url_id;
            }
            else{
                $id = facebook_id( $url_id );
            }
            return ($id) ? 'https://www.facebook.com/video.php?v='.$id : FALSE;
 	}
 }

/**
 * Get Youtube thumbs
 *
 * @access	public
 * @param	string	Youtube url || Youtube id
 * @param 	number	1 to 4 to return a specific thumb
 * @return	array		url's to thumbs or specific thumb
 */
if ( ! function_exists('youtube_thumbs'))
{
	function youtube_thumbs( $url_id = '', $thumb = 'default')
	{
		if ( $url_id === '' )
		{
			return FALSE;
		}
		
		if ( _isValidID( $url_id ) )
		{
			$id = $url_id;
		}
		else{
			$id = youtube_id( $url_id );
		}
                
                if($thumb == 'default')
                {
                    $thumb = 'default';
                }
                else if($thumb == 'hq')
                {
                    $thumb = 'hqdefault';
                }
                else if($thumb == 'mq')
                {
                    $thumb = 'mqdefault';
                }
                
                return 'https://img.youtube.com/vi/'.$id.'/'.$thumb.'.jpg';
	}
}

/**
 * Get Vimeo thumbs
 *
 * @access	public
 * @param	string		Vimeo url || Vimeo id
 * @param 	number 		1 to 3 to return a specific thumb
 * @return	array 		url's to thumbs or specific thumb
 */
if ( ! function_exists('vimeo_thumbs'))
{
	function vimeo_thumbs( $url_id = '', $thumb = '')
	{
		if ( $url_id == '' )
		{
			return FALSE;
		}
		if ( $thumb < 1 || $thumb > 3 )
		{
			return FALSE;
		}
		if ( !_isValidURL( $url_id ) )
		{
			$id = $url_id;
		}
		else{
			$id = vimeo_id( $url_id );
		}
                
		$data = json_decode(file_get_contents("http://vimeo.com/api/v2/video/{$id}.json"));
		$result = array(
			'1' => $data[0]->thumbnail_small,
			'2' => $data[0]->thumbnail_medium,
			'3' => $data[0]->thumbnail_large
		);
 		return $result[$thumb];
	}
}

/**
 * Get Facebook thumbs
 *
 * @access	public
 * @param	string	Facebook url || Facebook id
 * @param 	boolen	false to true to return a specific thumb
 * @return	array		url's to thumbs or specific thumb
 */
if ( ! function_exists('facebook_thumbs'))
{
	function facebook_thumbs( $url_id = '', $thumbs = FALSE)
	{
            if ( $url_id === '' )
            {
                return FALSE;
            }

            if ( _isValidID( $url_id, 'facebook' ) )
            {
                $id = $url_id;
            }
            else{
                $id = facebook_id( $url_id );
            }
            $data = json_decode(file_get_contents('https://graph.facebook.com/'.$id.'/'));
            //dump($data);
            
            if($thumbs == FALSE)
            {
                return 'https://graph.facebook.com/'.$id.'/picture';
            }
            else
            {
                return $data->format[1]->picture;
            }
            
	}
}

/**
 * Get Youtube embed
 *
 * @access	public
 * @param	string		Youtube url || Youtube id
 * @param 	number 		width
 * @param   number 		height
 * @param   boolean 		old embed / default = FALSE
 * @param   boolean 		HD / default = FALSE / The width and height will not be used if passed
 * @param   boolean 		https / default = FALSE
 * @param   boolean 		suggested videos / default = FALSE
 * @return	string   	embebed code
 */

if ( ! function_exists('youtube_embed'))
{
	function youtube_embed( $url_id = '', $width = '', $height = '',
	$old_embed = FALSE, $hd = FALSE, $https = FALSE, $suggested = FALSE)
	{
		if ( $url_id == '' )
		{
			return FALSE;
		}

		if ( _isValidID( $url_id ) )
		{
			$id = $url_id;
		}
		else{
			$id = youtube_id( $url_id );
		}

		//Contruct the old embed code
		if ( $old_embed )
		{
			if ( $hd )
			{
				$embed = '<object width="1280" height="720">';
			}
			else
			{
				$embed = '<object width="'.$width.'" height="'.$height.'">';
			}
			$embed .= '<param name="movie" value="';
			if( $https )
			{
				$embed .= 'https';
			}
			else{
				$embed .= 'http';
			}
			$embed .= '://www.youtube-nocookie.com/v/'.$id.'?version=3&amp;hl=en_US&amp;';
			if ( $suggested )
			{
				$embed .= 'rel=0&amp;';
			}
			if ( $hd )
			{
				$embed .= 'hd=1';
			}
			$embed .= '"></param>';
			$embed .= '<param name="allowFullScreen" value="true"></param>';
			$embed .= '<param name="allowscriptaccess" value="always"></param>';
			$embed .= '<embed src="';
			if( $https )
			{
				$embed .= 'https';
			}
			else
			{
				$embed .= 'http';
			}
			$embed .= '://www.youtube-nocookie.com/v/'.$id.'?version=3&amp;hl=en_US';
			if ( $hd )
			{
				$embed .= '&amp;hd=1';
			}
			$embed .= '" type="application/x-shockwave-flash" ';
			if ( $hd )
			{
				$embed .= 'width="1280" height="720" ';
			}
			else
			{
				$embed .= 'width="'.$width.'" height="'.$height.'" ';
			}
			$embed .= 'allowscriptaccess="always" allowfullscreen="true"></embed>';
			$embed .= '</object>';
		}
		//Contruct the new embed code
		else
		{
			$embed = '<iframe ';
			if ( $hd )
			{
				$embed .= 'width="1280" height="720" ';
			}
			else
			{
				$embed .= 'width="'.$width.'" height="'.$height.'" ';
			}
			$embed .= 'src="';
			if ( $https )
			{
				$embed .= 'https';
			}
			else
			{
				$embed .= 'http';
			}
			//$embed .= '://www.youtube-nocookie.com/embed/'.$id;
                        $embed .= '://www.youtube.com/embed/'.$id;
			if ( $suggested OR $hd )
			{
				$embed .= '?';
			}
			if ( $suggested )
			{
				$embed .= 'rel=0&amp;';
			}
			if ( $hd )
			{
				$embed .= 'hd=1';
			}
			$embed .= '" frameborder="0" allowfullscreen></iframe>';
		}
		return $embed;
	}
}


/**
 * Get Vimeo embed
 *
 * @access	public
 * @param	string		Vimeo url || Vimeo id
 * @param 	number 		width
 * @param   number 		height
 * @param   boolean 		color
 * @param   boolean 		autoplay / default = FALSE
 * @return	string   	embebed code
 */

if ( ! function_exists('vimeo_embed'))
{
	function vimeo_embed( $url_id = '', $width = '600', $height = '500')
	{
            if ( $url_id == '' )
            {
                    return FALSE;
            }
            if ( !_isValidURL( $url_id ) )
            {
                    $id = $url_id;
            }
            else
            {
                    $id = vimeo_id( $url_id );
            }
            $embed = '<iframe src="http://player.vimeo.com/video/'.$id.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';

            return $embed;
	}
}

/**
 * Get Facebook embed
 *
 * @access	public
 * @param	string		Facebook url || Facebook id
 * @param 	number 		width
 * @return	string   	embebed code
 */

if ( ! function_exists('facebook_embed'))
{
	function facebook_embed( $url_id = '', $width = '')
	{
            if ( $url_id == '' )
            {
                    return FALSE;
            }
            if ( _isValidURL( $url_id ) )
            {
                $url = $url_id;
            }
            else
            {
                $url = facebook_fullvideo( $url_id );
            }

            $embed = '<div class="fb-video" data-href="'.$url.'" data-allowfullscreen="true" data-width="'.$width.'"></div>';
            return $embed;
	}
}


if(!function_exists('youtube_info'))
{
    function youtube_info($url_id){
        if ( $url_id == '' )
        {
            return FALSE;
        }
        if ( _isValidID( $url_id ) )
        {
            $id = $url_id;
        }
        else{
            $id = youtube_id($url_id);
        }
        
        $data = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$id.'&key=AIzaSyCY4uyCfTg2UAEdGJmZ7iCvsZLsit-6ukk&part=snippet,contentDetails,statistics,status'));
        
        if($data->items == FALSE){
            return FALSE;
        }
        
        //dump($data);
        $output = array(
            'id'        => $data->items[0]->id,
            'title'     => isset($data->items[0]->snippet->title) ? $data->items[0]->snippet->title : 'No Title',
            'desc'      => isset($data->items[0]->snippet->description) ? $data->items[0]->snippet->description : (isset($data->items[0]->snippet->title) ? $data->items[0]->snippet->title : 'No Decription'),
            'p_date'    => date('Y-m-d', strtotime($data->items[0]->snippet->publishedAt)),
            'thumb'     => $data->items[0]->snippet->thumbnails->high->url,
        );
        return $output;
    }
}

if(!function_exists('vimeo_info'))
{
    function vimeo_info($url_id){
        if ( $url_id == '' )
        {
            return FALSE;
        }
        if ( !_isValidURL( $url_id ) )
        {
            $id = $url_id;
        }
        else{
            $id = vimeo_id( $url_id );
        }

        $data = json_decode(file_get_contents("http://vimeo.com/api/v2/video/{$id}.json"));
        
        //dump($data);
        $output = array(
            'id'        => $data[0]->id,
            'title'     => isset($data[0]->title) ? $data[0]->title : 'No Title',
            'desc'      => isset($data[0]->description) ? $data[0]->description : (isset($data[0]->title) ? $data[0]->title : 'No Decription'),
            'p_date'    => date('Y-m-d', strtotime($data[0]->upload_date)),
            'thumb'     => $data[0]->thumbnail_large,
        );
        return $output;
    }
}

if(!function_exists('facebook_info'))
{
    function facebook_info($url_id){
        if ( $url_id == '' )
        {
            return FALSE;
        }
        if ( _isValidID( $url_id, 'facebook' ) )
        {
            $id = $url_id;
        }
        else{
            $id = facebook_id( $url_id );
        }
        //dump($id);
        $data = json_decode(file_get_contents('https://graph.facebook.com/'.$id.'/'));
        //dump($data);
        $output = array(
            'id'        => $data->id,
            'title'     => isset($data->name) ? $data->name : 'No Title',
            'desc'      => isset($data->description) ? $data->description : (isset($data->name) ? $data->name : 'No Decription'),
            'p_date'    => date('Y-m-d', strtotime($data->created_time)),
            'thumb'     => $data->format[1]->picture,
        );
        return $output;
    }
}

/**
 * Watermark
 * 
 * @param string $source
 * @param string $overlayimage
 * @return boolean or error message
 */
if(!function_exists('watermark'))
{
    function watermark($source, $type = 'overlay', $overlayimage = 'play-button.png', $text =  'Copyrights by AgriToday.Com', $v_align = 'middle', $h_align = 'center')
    {
        $CI =& get_instance();
        $CI->load->library( 'image_lib' );

        $CI->image_lib->clear(); 
        
        $config['image_library']    = 'gd2';
        $config['source_image']     = $source;
        $config['new_image']        = $source;
        $config['wm_type']          = $type;
        if($type == 'overlay')
        {
            $config['wm_overlay_path']  = $overlayimage; //the overlay image
            $config['wm_opacity']       = 10;
        }
        else 
        {
            $config['wm_text'] = $text;
            $config['wm_font_path'] = '../system/fonts/KhmerOSbattambang.ttf';
            $config['wm_font_size'] = '16';
            $config['wm_font_color'] = 'ffffff';
        }
        $config['wm_vrt_alignment'] = $v_align;
        $config['wm_hor_alignment'] = $h_align;
        
        $CI->image_lib->initialize( $config);
        
        if (!$CI->image_lib->watermark()) {
            return $CI->image_lib->display_errors();
        }
        else
        {
            return TRUE;
        }
    }
}

/**
 * Get Video Thumbnail
 * 
 * @param string $video_thumb
 * @param boolen $watermark
 * @param string $play_icon
 * @param string $path
 * @return image string
 */
if(!function_exists('get_video_thumbnail'))
{
    
    function get_video_thumbnail($video_thumb, $watermark = TRUE, $path = './assets/uploaded/image/')
    {
        $CI =& get_instance();
        
        // download thumbnail from url
        $filename = random_filename($video_thumb, '.jpg');
        file_put_contents ($path.$filename,file_get_contents($video_thumb));
        
        // resize image to 560px x 292px
        $CI->load->library('image_lib');

        $CI->image_lib->clear();

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $path.$filename;
        $config['new_image']        = $path.$filename;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 600;
        $config['height']           = 320;
        $CI->image_lib->initialize( $config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        
        //list($original_width, $original_height, $file_type, $attr) = getimagesize($path.$filename);

        // set our cropping limits.
//        $crop_x = ($original_width / 2) - (600 / 2);
//        $crop_y = ($original_height / 2) - (320 / 2);
//
//        // initialize our configuration for cropping
//        $config['source_image'] = $path.$filename;
//        $config['new_image'] = $path.$filename;
//        $config['x_axis'] = $crop_x;
//        $config['y_axis'] = $crop_y;
//        $config['maintain_ratio'] = FALSE;
//
//        $CI->image_lib->initialize($config);
//        $CI->image_lib->crop();
//        $CI->image_lib->clear();
        
        if($watermark == TRUE)
        {
            $source = $path.$filename;
            watermark($source);
        }
        return $filename;
    }
}

// get domain from url
if(!function_exists('get_domain'))
{
    function get_domain($url)
    {
        $check_domain = valid_domain($url);
        if($check_domain != FALSE){
            $domain = strtolower(str_ireplace('www', '', parse_url($url, PHP_URL_HOST)));
            $get_name = array_filter(explode('.', $domain));
            $name = array_shift($get_name);
            return $name;
        }
        return FALSE;
    }
}

// check valid domain
if(!function_exists('valid_domain'))
{
    function valid_domain($url)
    {
        if(valid_url($url) == FALSE)
        {
            return FALSE;
        }
        
        $domain = strtolower(str_ireplace('www', '', parse_url($url, PHP_URL_HOST)));
        $get_name = array_filter(explode('.', $domain));
        $name = array_shift($get_name);
        if($name == 'youtube' || $name == 'youtu')
        {
            return $url;
        }
        else if($name == 'facebook')
        {
            return $url;
        }
        else if($name == 'vimeo')
        {
            return $url;
        }
        return FALSE;
    }
}

if(!function_exists('valid_url'))
{
    /**
     * Check valid url
     * ------------------------------------------------
     * @param string $url
     * @return boolean
     */
    function valid_url($url)
    {
        if(!filter_var($url, FILTER_VALIDATE_URL))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}

// get vidoe information
if(!function_exists('get_video_info')){
    function get_video_info($url){
        $domain = get_domain($url);
        if($domain != FALSE)
        {
            if($domain == 'youtube' || $domain == 'youtu')
            {
                return youtube_info($url);
            }
            else if($domain == 'facebook')
            {
                return facebook_info($url);
            }
            else if($domain == 'vimeo')
            {
                return vimeo_info($url);
            }
        }
        return FALSE;
    }
}

// get embed video 
if(!function_exists('get_video'))
{
    function get_video($url)
    {
        $domain = get_domain($url);
        if($domain != FALSE)
        {
            if($domain == 'youtube' || $domain == 'youtu')
            {
                return youtube_embed($url, '100%', '300', FALSE, FALSE, TRUE);
            }
            else if($domain == 'facebook')
            {
                return facebook_embed($url);
            }
            else if($domain == 'vimeo')
            {
                return vimeo_embed($url);
            }
        }
        return FALSE;
    }
}
/**
 * Validate URL
 * This URL could have http or just www
 *
 * @access private
 * @param string 		Youtube URL
 * @return preg_match
 */
if ( ! function_exists('_isValidURL'))
{
	function _isValidURL($url = '')
	{
		return preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/i', $url);
	}
}


/**
 * Validate ID
 * Check if the id is valid or not
 *
 * @access private
 * @param string 		Youtube ID OR Vimeo ID
 * @return boolean
 */
if ( ! function_exists('_isValidID'))
{
	function _isValidID($id = '', $type='youtube')
	{
            if($type == 'youtube')
            {
                $headers = get_headers('http://gdata.youtube.com/feeds/api/videos/' . $id);
            }
            else if($type == 'vimeo')
            {
                $headers = get_headers('http://vimeo.com/' . $id);
            }
            else
            {
                $headers = get_headers('https://www.facebook.com/video.php?v=' . $id);
            }
		
            if (!strpos($headers[0], '200'))
            {
                return FALSE;
            }
            else{
                return TRUE;
            }
	}
}


// ------------------------------------------------------------------------

/* End of file video_helper.php */
/* Location: ./application/helpers/video_helper.php */