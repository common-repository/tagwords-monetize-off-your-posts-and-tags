<?php
/*
Plugin Name: tagwords - monetize off of your posts and tags
Plugin URI: http://tagwords.uintu.com/2010/05/17/tagwords-with-tagsoda-and-wordpress-documentation/
Description: Allows you to make money on your blogs traffic by PPC.  tagsoda is a PPC engine which turns your tags into ads, and provides you with clean inline text ads.
Version: 2.0
Author: tagsoda llc
Author URI: http://www.tagsoda.com
License: GPL2
    Copyright 2010  tagsoda llc  (email : support@tagsoda.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

function tgs_options() {
  add_menu_page('tagsoda', 'tagsoda', 8, basename(__FILE__), 'tgs_options_page');
  add_submenu_page(basename(__FILE__), 'Settings', 'Settings', 8, basename(__FILE__), 'tgs_options_page');
}

function tgs_options_page() {
?>
    <div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div><h2>Settings for tagsoda Integration</h2>
    <p>To monetize off of your tags use tagsodas tagwords. tagwords link your content tags to ads where people can find out more about the subject you are talking about. Every time someone clicks on an ad you make money.  You will need an active tagsoda account to use this plugin. To open a free account <a href="http://www.tagsoda.com/" target="_blank">click here</a>  Its free and easy.
    </p>
    <form method="post" action="options.php">
    <?php
        // New way of setting the fields, for WP 2.7 and newer
        if(function_exists('settings_fields')){
            settings_fields('tgs-options');
        } else {
            wp_nonce_field('update-options');
            ?>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="tgs_user_id,tgs_catalog_url,tgs_style,tgs_where,tgs_api,tgs_powered,tgs_links,tgs_tagwords,tgs_js_root,tgs_api_root,tgs_root,tgs_num_links,tgs_channel_id" />
            <?php
        }
    ?>
        <table class="form-table">
            <tr>
               <th scope="row">
                    <label for="tgs_add_tags"><b>Instructions</b></label>
                </th>
                <td>
                   <p>tagsoda allows you to make money with your website tags and content.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tgs_user_id">tagsoda ID</label>
                </th>
                <td>
                  <p>This can be retrieved by logging into your tagsoda account and clicking on My Profile</p>
                    <p>
                        <input type="text" value="<?php echo get_option('tgs_user_id'); ?>" name="tgs_user_id" id="tgs_user_id" />
                    </p>
                    <span class="setting-description">Your tagsoda User ID, available from <a href="http://www.tagsoda.com/" target="_blank">tagsoda</a></span>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tgs_api">tagsoda API Token</label>
                </th>
                <td>
                  <p>This can be retrieved by logging into your tagsoda account and clicking on My Profile</p>
                    <p>
                        <input type="text" value="<?php echo get_option('tgs_api'); ?>" name="tgs_api" id="tgs_api" />
                    </p>
                    <span class="setting-description">Your tagsoda API Token, available from <a href="http://www.tagsoda.com/" target="_blank">tagsoda</a></span>
                </td>
            </tr>
            <tr>
            <th scope="row">
                    tagsoda tagwords
                </th>
                <td>
                <p>Turn your tags into links to a listing of tag related ads.</p>
                  <p>
                    <select name="tgs_tagwords">
                      <option <?php if (get_option('tgs_tagwords') == '0') echo 'selected="selected"'; ?> value="0">No</option>
                      <option <?php if (get_option('tgs_tagwords') == '1') echo 'selected="selected"'; ?> value="1">Yes</option>
                    </select>
                  </p>
                </td>
             </tr>
            <tr>
            <th scope="row">
                    Position
                </th>
                <td>
                <p>This tells us where to put the tagwords links on your post</p>
                  <p>
                    <select name="tgs_where">
                      <option <?php if (get_option('tgs_where') == 'before') echo 'selected="selected"'; ?> value="before">Before</option>
                      <option <?php if (get_option('tgs_where') == 'after') echo 'selected="selected"'; ?> value="after">After</option>
                      <option <?php if (get_option('tgs_where') == 'beforeandafter') echo 'selected="selected"'; ?> value="beforeandafter">Before and After</option>
                      <option <?php if (get_option('tgs_where') == 'shortcode') echo 'selected="selected"'; ?> value="shortcode">Shortcode [tagwords]</option>
                      <option <?php if (get_option('tgs_where') == 'manual') echo 'selected="selected"'; ?> value="manual">Manual</option>
                    </select>
                  </p>
                </td>
             </tr>
             <tr>
                <th scope="row"><label for="tm_style">Styling</label></th>
                <td>
                    <input type="text" value="<?php echo htmlspecialchars(get_option('tgs_style')); ?>" name="tgs_style" id="tgs_style" />
                    <span class="setting-description">Add style to the div that surrounds the tagword code E.g. <code>float: left; margin-right: 10px;</code></span>
                </td>
            </tr>   
            <tr>
            <th scope="row">
                    by tagsoda
                </th>
                <td>
                <p>Show "by tagsoda" link on your listing and tagwords codes</p>
                  <p>
                    <select name="tgs_powered">
                      <option <?php if (get_option('tgs_powered') == '0') echo 'selected="selected"'; ?> value="0">No</option>
                      <option <?php if (get_option('tgs_powered') == '1') echo 'selected="selected"'; ?> value="1">Yes</option>
                    </select>
                  </p>
                </td>
             </tr>
              <tr>
            <th scope="row">
                    tagsoda in-line ads
                </th>
                <td>
                <p>Create in-line text ads in your posts.</p>
                  <p>
                    <select name="tgs_links">
                      <option <?php if (get_option('tgs_links') == '0') echo 'selected="selected"'; ?> value="0">No</option>
                      <option <?php if (get_option('tgs_links') == '1') echo 'selected="selected"'; ?> value="1">Yes</option>
                    </select>
                  </p>
                </td>
             </tr>
             <tr>
            <th scope="row">
                    # of tagsoda in-line ads
                </th>
                <td>
                <p>If you have in-line text ads turned on how many would you like displayed in your post?</p>
                  <p>
                    <select name="tgs_num_links">
                      <option <?php if (get_option('tgs_num_links') == '1') echo 'selected="selected"'; ?> value="1">1</option>
                      <option <?php if (get_option('tgs_num_links') == '2') echo 'selected="selected"'; ?> value="2">2</option>
                      <option <?php if (get_option('tgs_num_links') == '3') echo 'selected="selected"'; ?> value="3">3</option>
                      <option <?php if (get_option('tgs_num_links') == '4') echo 'selected="selected"'; ?> value="4">4</option>
                      <option <?php if (get_option('tgs_num_links') == '5') echo 'selected="selected"'; ?> value="5">5</option>
                      <option <?php if (get_option('tgs_num_links') == '6') echo 'selected="selected"'; ?> value="6">6</option>
                      <option <?php if (get_option('tgs_num_links') == '7') echo 'selected="selected"'; ?> value="7">7</option>
                      <option <?php if (get_option('tgs_num_links') == '8') echo 'selected="selected"'; ?> value="8">8</option>
                      <option <?php if (get_option('tgs_num_links') == '9') echo 'selected="selected"'; ?> value="9">9</option>
                      <option <?php if (get_option('tgs_num_links') == '10') echo 'selected="selected"'; ?> value="10">10</option>
                    </select>
                  </p>
                </td>
             </tr>
             <tr>
                <th scope="row">
                    <label for="tgs_user_id">tagsoda listing page url</label>
                </th>
                <td>
                  <p>If you would like to keep the ad listing that matches the tag clicked from your posts on your blog set this url.  You will need to add the full url of your listing page otherwise the tags will link back to tagsoda. URL must include http:// or https://. The listing page must include the shortcode [tagwords-listing] where you want your ads to appear.</p>
                    <p>
                        <input type="text" value="<?php echo get_option('tgs_catalog_url'); ?>" name="tgs_catalog_url" size="65" id="tgs_catalog_url" />
                    </p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tgs_user_id">tagsoda channel id</label>
                </th>
                <td>
                  <p>If you would like to create channels for your blogs to keep track of with your tagsoda stats.  Go into your tagsoda publisher account create a channel.  On the channel listing you should see an id.  Enter the id here. This will help organize your stats so you can see where your clicks are coming from.</p>
                    <p>
                        <input type="text" value="<?php echo get_option('tgs_channel_id'); ?>" name="tgs_channel_id" size="15" id="tgs_channel_id" />
                    </p>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
        </p>
        <input type="hidden" name="tgs_api_root" value="http://www.tagsoda.com/request">
        <input type="hidden" name="tgs_js_root" value="http://www.tagsoda.com/javascripts/plugins">
        <input type="hidden" name="tgs_root" value="http://www.tagsoda.com">
    </form>
    </div>
<?php
}

function send_get_tagsoda($action_url, $params){
  
  if (function_exists('curl_init')) {
      $ch = curl_init();

    // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL,$action_url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);  // tell it to make a POST, not a GET 
			  curl_setopt($ch, CURLOPT_POSTFIELDS,$params);  // put the query string here starting with "?" 
			  curl_setopt($ch, CURLOPT_TIMEOUT, 360); 
			  curl_setopt($ch, CURLOPT_HEADER, 0); // Header control 
				curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);	
        // grab URL and pass it to the browser
        $data = curl_exec($ch);
        // close cURL resource, and free up system resources
        curl_close($ch);

        return $data;
    }
  return false;
}

function tgs_validip($ip) {
 
        if (!empty($ip) && ip2long($ip)!=-1) {
                $reserved_ips = array (
                    array('0.0.0.0','2.255.255.255'),
                    array('10.0.0.0','10.255.255.255'),
                    array('127.0.0.0','127.255.255.255'),
                    array('169.254.0.0','169.254.255.255'),
                    array('172.16.0.0','172.31.255.255'),
                    array('192.0.2.0','192.0.2.255'),
                    array('192.168.0.0','192.168.255.255'),
                    array('255.255.255.0','255.255.255.255'));
 
 
                foreach ($reserved_ips as $r) {
                        $min = ip2long($r[0]);
                        $max = ip2long($r[1]);
                    if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) 
                        return false;
                }
                return true;
 
        }else{
             return false;
 
        }
   }
 
   function tgs_get_ip_address() {
 
        if (tgs_validip($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
 
        foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
            if (tgs_validip(trim($ip))) {
                return $ip;
            }
        }
 
        if (tgs_validip($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (tgs_validip($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (tgs_validip($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } elseif (tgs_validip($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
   }

function tgs_get_tagword_display($tags,$content){
   
   if ((get_option('tgs_where') == 'manual') && !($links)) {
        return $content;
   }
  
   if(get_option("tgs_links")==1){
      $content=tgs_get_links($content);
   }
   
  $where = get_option('tgs_where');
  $code = tgs_get_tagword_code($tags);
  
  if ($where == 'shortcode') {
    return str_replace('[tagwords]', $code, $content);
  } else if ($where == 'beforeandafter') {
        return $code . $content . $code;
  } else if ($where == 'before') {
        return $code . $content;
  } else if($where == 'after') {
        return $content . $code;
  } else {
      return $content;
  }
  
  return $content;
}

function tgs_get_links($content){
    $title = the_title();
    $data['secret_word']=get_option("tgs_api");
    $data['user_id']=get_option("tgs_user_id");
    $data['content']=$content;
    $data['limit']=get_option("tgs_num_links");
    $tagsoda_api_url = get_option("tgs_api_root");
    $channel_id=get_option('tgs_channel_id');
    
    global $post;
    $url = get_permalink($post->ID);
    
    $action = $tagsoda_api_url."/content";
    $params = "api_token=".$data['secret_word']."&user_id=".$data['user_id']."&content=".urlencode($data['content'])."&page_url=".urlencode($url)."&title=".urlencode($title)."&user_agent=".urlencode($_SERVER['HTTP_USER_AGENT'])."&ip_address=".tgs_get_ip_address()."&limit=".$data['limit']."&channel_id=".$channel_id;
    
    $content=send_get_tagsoda($action,$params);
    
    return $content;
}

function tgs_get_tagword_code($tags){
	  global $post;
    $url = urlencode(get_permalink($post->ID));
    $user_id=get_option("tgs_user_id");
   $tagsoda_main_url =get_option('tgs_root'); 
   if(get_option('tgs_catalog_url')){
     $base_url=get_option('tgs_catalog_url')."?";
   }else{
     $base_url=$tagsoda_main_url."/tag/?afid=".$user_id."&ref=".$url."&";
   }
    
   $code ="<div style=\"".get_option('tgs_style')."\">";
   $code .="tagwords: ";
   foreach($tags as $id => $tag){
     $url=$base_url."tagword=".urlencode($tag);  
     $code .="<a href='".$url."'>".$tag."</a>&nbsp;&nbsp;";
   }
   if(get_option('tgs_powered')==1)
   $code .="<a href='".$tagsoda_main_url."?afid=".$user_id."' target='_blank'>by tagsoda</a>";
   $code .="</div>";
   
   return $code;
}


function tgs_get_tagwords($content){
    $user_id=get_option("tgs_user_id");
    $secret_word=get_option("tgs_api");
    $tagsoda_api_url = get_option("tgs_api_root");
    global $post;
    $url = get_permalink($post->ID);
    
    if($user_id && $url){
      //get tagwords from account
      $params = "user_id=".$user_id."&api_token=".$secret_word."&page_url=".urlencode($url)."&title=".urlencode($post->post_title)."&content=".urlencode($post->post_content);
      $action = $tagsoda_api_url."/tags";
      $tags=send_get_tagsoda($action,$params);
     
      //parse content of post and create 
      $tags = explode(",",$tags);
      $found_tags = array();
      $key = 0;
      if(count($tags)>0){
        foreach($tags as $tag){
          if(strlen($tag)>0){
           if(strpos($content,$tag)>0){
            $found_tags[$key]=$tag;
             $key++;
           }
         }
        }
      }
      
      if(count($found_tags)>0){
        $content=tgs_get_tagword_display($found_tags,$content);
      }     
    }
   
    return urldecode($content);
}

function tgs_analyze(){
	  $post_id=$_REQUEST['post_ID'];
    $tagsoda_api_url = get_option("tgs_api_root");
    $user_id=get_option("tgs_user_id");
    $secret_word=get_option("tgs_api");
    
    if($user_id && $secret_word){
      //title
       $title = $_REQUEST['post_title'];
       
      //description
       $content=$_REQUEST['content']; 
   
      //url
      if($post_id)
        $url = get_permalink($post_id);
      else
        $url = get_permalink();
      
      $params="user_id=".$user_id."&api_token=".$secret_word."&title=".urlencode($title)."&content=".urlencode($content)."&page_url=".urlencode($url);
      $action=$tagsoda_api_url."/analyze";
      send_get_tagsoda($action,$params);
    }
}

function tgs_get_listing(){
  $tag=urldecode($_REQUEST['tagword']);
  $user_id=get_option("tgs_user_id");
  $secret_word=get_option("tgs_api");
  $tagsoda_api_url = get_option("tgs_api_root");
  $channel_id=get_option('tgs_channel_id');
  $html ="";  
  global $post;
    $url = get_permalink($post->ID); 
      
    if($user_id && $tag){
    	$action = $tagsoda_api_url."/ads";
      $params = "user_id=".$user_id."&api_token=".$secret_word."&tag=".$tag."&page_url=".urlencode($url)."&user_agent=".urlencode($_SERVER['HTTP_USER_AGENT'])."&ip_address=".tgs_get_ip_address()."&channel_id=".$channel_id;
      $data = send_get_tagsoda($action,$params);
      
      $count=0;
     
      if(!empty($data)){
        $xmlparse = simplexml_load_string($data);
       
        foreach($xmlparse as $ad){
        	 $tmp   = split("X",$ad->size);
        	 $html .="<div>"; 
           $html .="<a href='".html_entity_decode($ad->url)."'>".stripslashes(html_entity_decode($ad->title))."</a><br>".stripslashes(html_entity_decode($ad->content))."<br><a href='".html_entity_decode($ad->url).">".html_entity_decode($ad->display_url)."</a><br>";
           
           if($ad->has_image)
        	 $html .="<a href='".html_entity_decode($ad->url)."'><img src='" .$ad->image_url. "' height=".$tmp[1]." width=".$tmp[0]." border=0></a><br>";    
           $html .="<hr size=1 width=90%>";
           $html .="</div>";
           $count++;
        }
          if($count==0){
            $html .="<div align='center'>No listings found for tagword: ".$tag."</div>";
          }
           if(get_option('tgs_powered')==1)
            $html .="<div align='left'><a href='".$tagsoda_main_url."/?afid=".$user_id."' target='_blank'>Listing by tagsoda</a></div>";
      }else{
           $html .="<div align='center'>No listings found for tagword: ".$tag."</div>";
      }  
    } 
   
   return $html; 
}

function tgs_add_header(){
   $tgs_plugin_url = get_option("tgs_js_root");
   if(!is_admin()){
      wp_enqueue_script('tgs_header_script', $tgs_plugin_url.'/toggletagsoda.js');
   }
}

function tgs_sanitize_username($username){
    return preg_replace('/[^0-9_]/','',$username);
}

// Only all the admin options if the user is an admin
if(is_admin()){
    add_action('admin_menu', 'tgs_options');
    add_action('admin_init', 'tgs_init');
}

// Set the default options when the plugin is activated
function tgs_activate(){
    register_setting('tgs-options', 'tgs_user_id');
}

// On access of the admin page, register these variables (required for WP 2.7 & newer)
function tgs_init(){
    if(function_exists('register_setting')){
        register_setting('tgs-options','tgs_user_id','tgs_sanitize_username');
        register_setting('tgs-options','tgs_catalog_url');
        register_setting('tgs-options','tgs_api');
        register_setting('tgs-options','tgs_style');
        register_setting('tgs-options','tgs_where');
        register_setting('tgs-options','tgs_cost');
        register_setting('tgs-options','tgs_word');
        register_setting('tgs-options','tgs_links');
        register_setting('tgs-options','tgs_tagwords');
        register_setting('tgs-options','tgs_powered');
        register_setting('tgs-options','tgs_api_root');
        register_setting('tgs-options','tgs_root');
        register_setting('tgs-options','tgs_js_root');
        register_setting('tgs-options','tgs_num_links');
        register_setting('tgs-options','tgs_channel_id');
    }
}

add_action('wp_print_scripts', 'tgs_add_header');
add_filter('the_content', 'tgs_get_tagwords');
add_action('publish_post', 'tgs_analyze', 9);
add_shortcode('tagwords-listing', 'tgs_get_listing');

register_activation_hook( __FILE__, 'tgs_activate');

?>