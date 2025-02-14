<?php
/*
* Plugin Name: Plink URL Shortener
* Plugin URI: http://blog.plink.ir/wordpress-shorten-url-plugin/
* Description: Shortens URLS of your blog posts via plink.ir service for twitter and can be used to hide referer
* Version: 1.0
* Author: alisaleem252, PersianLink
* Author URI: https://studio.envato.com/users/alisaleem252
* Text Domain: plink
* Domain Path: /languages/
*/

add_filter( 'plugin_row_meta', 'plink_plugin_row_meta', 10, 2 );

function plink_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'plink_shorturl.php' ) !== false ) {
		$new_links = array(
					'<a href="http://plink.ir/advertise" target="_blank">'.__('Advertise' , 'plink').'</a>',
					'<a href="http://plink.ir/user/" target="_blank">'.__('Get API' , 'plink').'</a>',
					
				);
		
		$links = array_merge( $links, $new_links );
	}
	
	return $links;
}


// use Api key input
$var_Apikey = get_option('new_Api_key');

define('DEFAULT_API_URL', 'http://plink.ir/api?api='.$var_Apikey.'&format=text&url=%s');
define('plink_plugin_path', plugin_dir_path(__FILE__) );
define('plink_plugin_url', plugin_dir_url(__FILE__) );
/* returns a result from url */
if ( ! function_exists( 'plink_curl_get_url' ) ){
  function plink_curl_get_url($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
 }
}

if ( ! function_exists( 'get_plink_url' ) ){ /* what's the odds of that? */
function get_plink_url($url,$format='txt') {
   global $var_Apikey;
   $connectURL = 'http://plink.ir/api?api='.$var_Apikey.'&format=text&url='.$url;
   return plink_curl_get_url($connectURL);
   
 }
}

if ( ! function_exists( 'plink_show_url' ) ){
 function plink_show_url($showurl) { /* use with echo statement */
  $url_create = get_plink_url(get_permalink( $id ));

  $kshort .= '<a href="'.$url_create.'" target="_blank">'.$url_create.'</a>';
  return $kshort;
 }
}

if ( ! function_exists( 'plink_shortcode_handler' ) ){
 function plink_shortcode_handler( $atts, $text = null, $code = "" ) {
	extract( shortcode_atts( array( 'u' => null ), $atts ) );
	
	$url = get_plink_url( $u );
	$rurl = plink_show_url($showurl); 

	if( !$u )
		return $rurl;
	if( !$text )
		return '<a href="' .$url. '">' .$url. '</a>';
	
	return '<a href="' .$url. '">' .$text. '</a>';
 }
}
add_shortcode('plink-url', 'plink_shortcode_handler');

class plink_Short_URL
{
    const META_FIELD_NAME='Shorter link';	
	
    /**
     * List of short URL website API URLs (only plink.ir for now)
     */
    function api_urls()
    {
		$var_Apikey = get_option('new_Api_key');
        return array(
            array(
                'name' => 'plink.ir Safe Url Shortener',
                'url'  => 'http://plink.ir/api?api='.$var_Apikey.'&format=text&url=%s',
                )
            );
    }

    /**
     * Create short URL based on post URL
     */
    function create($post_id)
    {
        if (!$apiURL = get_option('plinkShortUrlApiUrl')) {
            $apiURL = DEFAULT_API_URL;
        }

        // For some reason the post_name changes to /{id}-autosave/ when a post is autosaved
        $post = get_post($post_id);
        $pos = strpos($post->post_name, 'autosave');
        if ($pos !== false) {
            return false;
        }
        $pos = strpos($post->post_name, 'revision');
        if ($pos !== false) {
            return false;
        }

        $apiURL = str_replace('%s', urlencode(get_permalink($post_id)), $apiURL);

        $result = false;

        if (ini_get('allow_url_fopen')) {
            if ($handle = @fopen($apiURL, 'r')) {
                $result = fread($handle, 4096);
                fclose($handle);
            }
        } elseif (function_exists('curl_init')) {
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $result = @curl_exec($ch);
            curl_close($ch);
        }

        if ($result !== false) {
            delete_post_meta($post_id, 'plinkShortURL');
            $res = add_post_meta($post_id, 'plinkShortURL', $result, true);
            return true;
        }
    }

    /**
     * Option list (default settings)
     */
    
    function options()
    {
        return array(
           'ApiUrl'         => DEFAULT_API_URL,
           'Display'        => 'Y',
           'TwitterLink'    => 'Y',
		   'Domain'			=> 'plink.ir'
           );
    }
    
    /**
     * Plugin settings
     *
     */
    
    function settings()
    {
        $apiUrls = $this->api_urls();
        $options = $this->options();
        $opt = array();

        if (!empty($_POST)) {
            foreach ($options AS $key => $val)
            {
                if (!isset($_POST[$key])) {
                    continue;
                }
                update_option('plinkShortURL' . $key, $_POST[$key]);
            }
			update_option('new_Api_key', $_POST['new_Api_key']);
        }
        foreach ($options AS $key => $val)
        {
            $opt[$key] = get_option('plinkShortURL' . $key);
        }
        include plink_plugin_path . 'template/settings.tpl.php';
    }
    
    /**
     *
     */
    
    function admin_menu()
    {
//        add_options_page('WP Short URLs by Plink.ir', 'WP URLs Shortener', 10, 'plink_shorturl-settings', array(&$this, 'settings'));
	add_menu_page(''.__('Plink.ir Plugin Settings').'', ''.__('WP Url Shortener' , 'plink').'', 'administrator','plink_short_link_settings_page', 'plink_short_link_settings_page',plugins_url('icon.png', __FILE__));
	add_submenu_page( 'plink_short_link_settings_page', ''.__('WP Short URLs by PLINK.IR' , 'plink').'',''.__('Statistics' , 'plink').'' , 'administrator', 'plink_short_link_settings_page',plugins_url('icon.png', __FILE__)); 
	add_submenu_page( 'plink_short_link_settings_page', ''.__('WP Short URLs by PLINK.IR' , 'plink').'',''.__('Settings' , 'plink').'' , 'manage_options', 'plink_short_link_settings_page2', array(&$this, 'settings') );

    }
    
    /**
     * Display the short URL
     */
    function display($content)
    {

        global $post;

        if ($post->ID <= 0) {
            return $content;
        }

        $options = $this->options();
	//$options = array();

        foreach ($options AS $key => $val)
        {
            $opt[$key] = get_option('plinkShortURL' . $key);
        }

        $shortUrl = get_post_meta($post->ID, 'plinkShortURL', true);

        if (empty($shortUrl)) {
            return $content;
        }
		
		$shortUrl = str_replace('plink.ir','plink.ir', $shortUrl);
        $shortUrlEncoded = urlencode($shortUrl);
		
		$domain = $opt['Domain'];
		//str_replace('plink.ir',$domain,$shortUrlEncoded);

        ob_start();
        include plink_plugin_path . 'template/public.tpl.php';
        $content .= ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function pre_get_shortlink($false, $id, $context=null, $allow_slugs=null) /* Thanks to Rob Allen */
    {
        // get the post id
        global $wp_query;
        if ($id == 0) {
            $post_id = $wp_query->get_queried_object_id();
        } else {
            $post = get_post($id);
            $post_id = $post->ID;
        }

        $short_link = get_post_meta($post_id, self::META_FIELD_NAME, true);
        if('' == $short_link) {
            $short_link = $post_id;
        }

        $url = get_plink_url(get_permalink( $id ));
        if (!empty($url)) {
            $short_link = $url;
        } else {
            $short_link = home_url($short_link);
        }
        return $short_link;
    }

}

$plink = new plink_Short_URL;

if (is_admin()) {
    add_action('edit_post', array(&$plink, 'create'));
    add_action('save_post', array(&$plink, 'create'));
    add_action('publish_post', array(&$plink, 'create'));
    add_action('admin_menu', array(&$plink, 'admin_menu'));
    add_filter('pre_get_shortlink',  array(&$plink, 'pre_get_shortlink'), 10, 4);
} else {
    add_filter('the_content', array(&$plink, 'display'));
}
add_action('admin_enqueue_scripts','plink_admin_scripts');
add_action('admin_head','plink_head');

function plink_admin_scripts(){
	wp_enqueue_script('plink-table','//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js',array('jquery'));
	wp_enqueue_style('plink-table','//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css');
}
function plink_head(){
	echo '<script>
	jQuery(document).ready(function(){
    jQuery("#myTable").DataTable();
});
</script>
';
	
	
}

   //Api key input admin menu page
// create custom plugin settings menu
add_action('admin_menu', 'plink_shortlink_create_menu');
function plink_shortlink_create_menu() {

	//create new top-level menu
//	add_menu_page('Plink.ir Plugin Settings', 'WP Url Shortener', 'administrator', __FILE__, 'plink_short_link_settings_page',plugins_url('icon.png', __FILE__));
	//call register settings function
//	add_action( 'admin_init', 'plink_register_mysettings' );
}
function plink_register_mysettings() {
	//register our settings
	register_setting( 'shortlink-settings-group', 'new_Api_key' );
	
}
add_action( 'admin_init', 'plink_register_mysettings' );

function  plink_short_link_settings_page() {
?>
<div class="wrap">
<h2><?php echo __('Api key Setting' , 'plink') ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'shortlink-settings-group' ); ?>
    <?php do_settings_sections( 'shortlink-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo __('Enter Api key' , 'plink') ?></th>
        <td><input type="text" name="new_Api_key" value="<?php echo get_option('new_Api_key');?>" /> <a href="http://plink.ir/user/register" target="_blank"><?php echo __('Get API Key?' , 'plink') ?></a></td>
        </tr>
    </table>
<?php submit_button(); ?>
</form>
<div>
<h2><?php echo __('Statistics' , 'plink') ?></h2>
<?php
$posts = get_posts('posts_per_page=5');
global $wpdb;
$allurls = $wpdb->get_results( "SELECT * FROM  $wpdb->postmeta WHERE  meta_key =  'plinkShortURL'", OBJECT);
//print_r($allurls);
echo '<table id="myTable">';
echo '<thead>';
echo '<th>'.__('Long URL' , 'plink').'</th>';
echo '<th>'.__('Short URL' , 'plink').'</th>';
echo '<th>'.__('Details' , 'plink').'</th>';
echo '<th>'.__('Clicks' , 'plink').'</th>';
echo '</thead>';
echo '<tbody>';
if (!empty($allurls)){
foreach($allurls as $singleurl){
	$short = $singleurl->meta_value;//get_post_meta($post->ID,'plinkShortURL',true);
	$short = str_replace('plink.ir','plink.ir',$short);
	$clicks = file_get_contents('http://plink.ir/api?api='.get_option('new_Api_key').'&short='.$short);
	$clicks = json_decode($clicks);
	if ($clicks->error != 1){
	echo '<tr>';
	echo '<td>'.$clicks->long.'</td>';
	echo '<td>'.$short.'</td>';
	echo '<td><a target="_blank" href="'.$short.'+">'.__('More Details' , 'plink').'..</a></td>';
	echo '<td>'.$clicks->click.'</td>';
	echo '</tr>';
	} // if no error
//	http://plink.ir/api?api=UCKfnNSQiiKk&short=http://plink.ir/bEZnF
}
}
echo '</tbody>';
echo '</table>';
?>
</div>

</div>

<?php } 

function plink_add_meta_box() {

		add_meta_box(
			'plink_sectionid',
			__( 'Short Link Stats', 'plink' ),
			'plink_meta_box_callback',
			'post','side','high'
		);
	
}
function plink_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$short = get_post_meta( $post->ID, 'plinkShortURL', true );

	echo '<h2>';
	$clicks = file_get_contents('http://plink.ir/api?api='.get_option('new_Api_key').'&short='.$short);
	$clicks = json_decode($clicks);
	echo isset($clicks->click) ? $clicks->click : '0';
	_e( ' Clicks', 'plink' );
	echo '</h2> ';
	echo '<a target="_blank" href="'.$short.'+">'. __('More Details' , 'plink').'..</a>';

}
add_action( 'add_meta_boxes', 'plink_add_meta_box' );


/* ACTIVATION */
register_activation_hook(__FILE__, 'plink_plugin_activate');
add_action('admin_init', 'plink_plugin_redirect');

function plink_plugin_activate() {
    add_option('plink_plugin_do_activation_redirect', true);
}

function plink_plugin_redirect() {
    if (get_option('plink_plugin_do_activation_redirect', false)) {
        delete_option('plink_plugin_do_activation_redirect');
        wp_redirect('admin.php?page=plink_short_link_settings_page2');
    }
}

add_action('plugins_loaded', 'plink_wan_load_textdomain');
function plink_wan_load_textdomain() {
	load_plugin_textdomain( 'plink', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

?>