<?php if ( function_exists('register_sidebars') ) register_sidebars(5); ?>
<?php 

register_sidebar(array(
  'name' => 'Home - Upper',
  'id' => 'sidebar_home_u',
  'description' => 'Widgets in this area will be shown on the right-hand side.',
  'before_title' => '<h1>',
  'after_title' => '</h1>'
));

/**
*MEMEBURN FEED RSS
*@author Ryan Gordon
*@date   30Sept11
*@usage  http://memeburn.com/?feed=memeburn_rss
**/
function create_memeburn_rss() {
load_template( TEMPLATEPATH . '/memeburn_rss.php');
}
add_action('do_feed_memeburn_rss', 'create_memeburn_rss', 10, 1);
/* ==================================== */
/**
*MEMEBURN iPAD Ads RSS
*@author Ryan Gordon
*@date   2Feb12
*@usage  http://memeburn.com/?feed=iphone_feed_ads
**/
function create_iphone_feed_ads() {
load_template( TEMPLATEPATH . '/iphone_feed_ads.php');
}
add_action('do_feed_iphone_feed_ads', 'create_iphone_feed_ads', 10, 1);
/* ==================================== */
/**
*MEMEBURN iPAD Ads RSS
*@author Dan Bailey
*@usage  http://memeburn.com/?feed=iafrica_feed
**/
function create_my_customfeed() {
load_template( TEMPLATEPATH . '/iafrica_feed.php');
}
add_action('do_feed_iafrica_feed', 'create_my_customfeed', 10, 1);
/* ==================================== */
/**
*MEMEBURN iPhone feed
*@author Uzair McCrazy
*@usage  http://memeburn.com/?feed=iphone_feed
**/
function create_my_customifeed() {
load_template( TEMPLATEPATH . '/iphone_feed.php'); 
}
add_action('do_feed_iphone_feed', 'create_my_customifeed', 10, 1);
/* ==================================== */
/**
*MEMEBURN iPhone feed 
*@author Ryan Gordon
*@usage  http://memeburn.com/?feed=iphone_feed_subs&umb=all@page=1 (check rss doc)
**/
function create_my_customifeedsubs() {
load_template( TEMPLATEPATH . '/iphone_feed_subs.php'); 
}
add_action('do_feed_iphone_feed_subs', 'create_my_customifeedsubs', 10, 1); 
/* ==================================== */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 150, 150, true ); // Normal post thumbnails
add_image_size( 'single-post-thumbnail', 300, 9999 ); // Permalink thumbnail size
add_image_size( 'mobile-single', 150, 112 ); // Permalink thumbnail size
add_image_size( 'mobile', 640, 120, true ); // Permalink thumbnail size
add_image_size( 'mobile-thumb', 213, 158 ); // Permalink thumbnail size
?>
<?php function widget_mytheme_search() { ?>
<li>
<h2 class="widgettitle">Search</h2>
<form method="get" id="widget-searchform" action="<?php bloginfo('home'); ?>/">
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s2" />
<input type="submit" id="widget-searchsubmit" value="Search" />
</div>
</form>
</li>
<?php add_theme_support( 'post-thumbnails' ); ?>

<?php function snippet($text,$length=64,$tail="...") { 
    //$stringcount = $text;
	$text = trim($text);
    $txtl = strlen($text); 
	//$txtl = strlen($stringcount);
    if($txtl > $length) { 
        for($i=1;$text[$length-$i]!=" ";$i++) { 
            if($i == $length) { 
                return substr($text,0,$length) . $tail; 
            } 
        } 
        $text = substr($text,0,$length-$i+1) . $tail; 
    } 
    return $text; 
} ?>

<?php }	
function add_twitter_contactmethod( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);// Add Twitter
  $contactmethods['publicemail'] = 'Public Email';
  $contactmethods['twitter'] = 'Twitter';
  $contactmethods['facebook'] = 'Facebook';
  $contactmethods['buzz'] = 'Google Buzz';
  $contactmethods['flickr'] = 'Flickr';
  $contactmethods['linkedin'] = 'Linked In';
  return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);

function gearburn_category_link($link)
{
	if ($link == 'http://memeburn.com/category/gearburn/') return 'http://gearburn.com/';
	return $link;
}
add_filter('category_link', 'gearburn_category_link');

function twitter_buzz () {
	$mykey_value1 = get_post_custom_values('_mcf_twittertag1');

	if (isset($_REQUEST['search_submit'])){
			$search_value = $_REQUEST['search_tag'];
	}elseif(isset($mykey_value1[0]) || $mykey_value1[0] != ""){
			$mykey_value1 = get_post_custom_values('_mcf_twittertag1');
			$mykey_value2 = get_post_custom_values('_mcf_twittertag2');
			$mykey_value3 = get_post_custom_values('_mcf_twittertag3');
			$search_value = '"'. $mykey_value1[0] . '"';
			if($mykey_value2[0] != ""){$search_value .= ' OR "'. $mykey_value2[0] . '"';}
			if($mykey_value3[0] != ""){$search_value .= ' OR "'. $mykey_value3[0] . '"';}
	}else{
			$posttags = get_the_tags();
			if ($posttags) {
				foreach($posttags as $tag) {
					$search_value .= '"'. $tag->name . '" OR '; 
				}
			}
	}
?>
<div class="TwitterBox">
	<div class="buzzheader">
		<form method="POST" class="search_bar">
			<div id="search_tag_img">		
				<input id='search_tag' type='text' name='search_tag' value='<?php echo $search_value;?>'/>
			</div>
			<input id="search_submit" name="search_submit" type="submit" value=""/>
		</form>
	</div>
	<div class="buzzcontent">
	<script src="http://widgets.twimg.com/j/2/widget.js"></script><script>new TWTR.Widget({ version: 2, type: 'search', search: '<?php echo $search_value;
	 ?>', interval: 4000, title: '', subject: '', width: 'auto', height: 110, theme: { shell: { background: '#ffffff', color: '#ffffff' }, tweets: { background: '#ffffff', color: '#444444', links: '#980000' } }, features: { scrollbar: true, loop: true, live: true, hashtags: true, timestamp: true, avatars: true, behavior: 'default' }}).render().start();</script><style>.twtr-ft, .twtr-hd{display:none;} .twtr-tweet-text p * {font-size:12px;}</style>
	 </div>
	 <div class="buzzfooter"></div>
</div>
	<?php
	}
//widget text

if ( !class_exists('myCustomFields') ) {

	class myCustomFields {
		/**
		* @var  string  $prefix  The prefix for storing custom fields in the postmeta table
		*/
		var $prefix = '_mcf_';
		/**
		* @var  array  $customFields  Defines the custom fields available
		*/
		var $customFields =	array(
			array(
				"name"			=> "block-of-text",
				"title"			=> "A block of text",
				"description"	=> "",
				"type"			=> "textarea",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_pages"
			),
		/*	array(
				"name"			=> "short-text",
				"title"			=> "A short bit of text",
				"description"	=> "",
				"type"			=>	"text",
				"scope"			=>	array( "post" ),
				"capability"	=> "edit_posts"
			),*/
			array(
				"name"			=> "twitterbuzz",
				"title"			=> "Dont Show Twitter Buzz",
				"description"	=> "",
				"type"			=> "checkbox",
				"scope"			=>	array( "post", "page" ),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "twittertag1",
				"title"			=> "Twitter Tag Priority 1",
				"description"	=> "",
				"type"			=> "",
				"scope"			=>	array( "post", "page" ),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "twittertag2",
				"title"			=> "Twitter Tag Priority 2",
				"description"	=> "",
				"type"			=> "",
				"scope"			=>	array( "post", "page" ),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "twittertag3",
				"title"			=> "Twitter Tag Priority 3",
				"description"	=> "",
				"type"			=> "",
				"scope"			=>	array( "post", "page" ),
				"capability"	=> "manage_options"
			)
		);
		/**
		* PHP 4 Compatible Constructor
		*/
		function myCustomFields() { $this->__construct(); }
		/**
		* PHP 5 Constructor
		*/
		function __construct() {
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
			// Comment this line out if you want to keep default custom fields meta box
			add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultCustomFields( $type, $context, $post ) {
			foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
				remove_meta_box( 'postcustom', 'post', $context );
				remove_meta_box( 'postcustom', 'page', $context );
				//Use the line below instead of the line above for WP versions older than 2.9.1
				//remove_meta_box( 'pagecustomdiv', 'page', $context );
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				add_meta_box( 'my-custom-fields', 'Twitter buzz about Article', array( &$this, 'displayCustomFields' ), 'page', 'normal', 'high' );
				add_meta_box( 'my-custom-fields', 'Twitter buzz about Article', array( &$this, 'displayCustomFields' ), 'post', 'normal', 'high' );
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post;
			?>
			<div class="form-wrap">
				<?php
				wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" )
									$output = true;
								break;
							}
							case "page": {
								// Output on any page screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="page" )
									$output = true;
								break;
							}
						}
						if ( $output ) break;
					}
					// Check capability
					if ( !current_user_can( $customField['capability'], $post->ID ) )
						$output = false;
					// Output if allowed
					if ( $output ) { ?>
						<div class="form-field form-required">
							<?php
							switch ( $customField[ 'type' ] ) {
								case "checkbox": {
									// Checkbox
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" ){
										echo ' checked="checked"';
									}elseif( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" ){
										echo ' checked="checked"';
										update_post_meta( $post->ID, $this->prefix . $customField['name'], "yes" );
									}elseif( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" ){
										echo ' checked="checked"';
										update_post_meta( $post->ID, $this->prefix . $customField['name'], "yes" );
									}
									echo '" style="width: auto;" />';
									break;
								}
								case "textarea": {
									// Text area
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									break;
								}
								default: {
									// Plain text field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									break;
								}
							}
							?>
							<?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
						</div>
					<?php
					}
				} ?>
			</div>
			<?php
		}
		/**
		* Save the new Custom Fields values
		*/
		function saveCustomFields( $post_id, $post ) {
			if ( !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
				return;
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			if ( $post->post_type != 'page' && $post->post_type != 'post' )
				return;
			foreach ( $this->customFields as $customField ) {
				if ( current_user_can( $customField['capability'], $post_id ) ) {
					if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
						update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $_POST[ $this->prefix . $customField['name'] ] );
					} else {
						delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
					}
				}
			}
		}

	} // End Class

} // End if class exists statement
// Instantiate the class
if ( class_exists('myCustomFields') ) {
	$myCustomFields_var = new myCustomFields();
}






/* RECENT_VIDEO_FIX  */

define("CS_W3_NAMESPACE", "memeburn");
define("CS_W3_TTL", 600);
//if(!defined("W3TC_DIR")) define('W3TC_DIR','/usr/www/users/kykneytqsk/wp-content/plugins/w3-total-cache');
//require_once W3TC_DIR . '/lib/W3/ObjectCache.php';
//require_once W3TC_DIR . '/inc/define.php';

//$w3_obcache
        
function simple_xml_cached($url,$callback){
    $w3_obcache = & W3_ObjectCache::instance();
    $polyid=cs_w3_key($url);
    
    // RETURN AND EXIT IF CACHED
    //if($output=$w3_obcache->get($polyid, CS_W3_NAMESPACE)!==false) return $output.$w3_obcache->stats();
    $output=$w3_obcache->get($polyid, CS_W3_NAMESPACE);
    if(isset($output)) return $output;

    $data=$callback($url);
    $w3_obcache->set($polyid, $data, CS_W3_NAMESPACE, CS_W3_TTL);
    $data.=$w3_obcache->stats();
    return $data;
}

function cs_w3_key($seed){
    $polynomial4=crc32($seed);
    return sprintf("%s_%s_%s",CS_W3_NAMESPACE,$polynomial4,crc32($seed.$polynomial4));
}

function recent_vid_html($url){
    $xml = simplexml_load_file($url);
    $items = $xml->channel->item;

    foreach ($items as $item){
	$gear["title"][] = $item->title;
	$gear["permalink"][] = $item->link;

	$image = $item->image_url_lrg;
	$gear["image_url"][] = $image;

    }

    $arr_rand_num = array(1,2,3,4,5,6,7,8);
    shuffle($arr_rand_num);
    $buf='<div id="video_widget" class="widget" style="padding: 5px 4px 5px 6px;">
	<h2 class="widgettitle">Gearburn Gadget Reviews</h2>
        <a href="http://clk.atdmt.com/SAM/go/363661685/direct/01/" rel="external" target="_blank"><img src="/campaigns/microsoft201111/img/300x50.jpg" width="300" height="50" /></a>
	<div id="featurevid" style="background: url('.$gear["image_url"][$arr_rand_num[0]].') top left no-repeat; background-size: cover;">
	   <a href="'.$gear["permalink"][$arr_rand_num[0]].'"><img class="play_overlay" src="' . get_bloginfo("stylesheet_directory") . '/images/play_overlay.png" /></a>
	   <div class="headline">
	
	  	 <h2><a href="'.$gear["permalink"][$arr_rand_num[0]].'">'.$gear["title"][$arr_rand_num[0]].'</a></h2>
	
	   </div>

    </div>
    
    
    <div class="sub_video">
    	<div class="video_item">
    		<a href="'.$gear["permalink"][$arr_rand_num[1]].'"><img style="width: 90px; height: 65px;" src="'.$gear["image_url"][$arr_rand_num[1]].'" /></a>
    		<a href="'.$gear["permalink"][$arr_rand_num[1]].'">'.$gear["title"][$arr_rand_num[1]].'</a>
    	</div>
    	
    	<div class="video_item">
    		<a href="'.$gear["permalink"][$arr_rand_num[2]].'"><img style="width: 90px; height: 65px;" src="'.$gear["image_url"][$arr_rand_num[2]].'" /></a>
    		<a href="'.$gear["permalink"][$arr_rand_num[2]].'">'.$gear["title"][$arr_rand_num[2]].'</a>
    	</div>
    	
    	<div class="video_item">
    		<a href="'.$gear["permalink"][$arr_rand_num[3]].'"><img style="width: 90px; height: 65px;" src="'.$gear["image_url"][$arr_rand_num[3]].'" /></a>
    		<a href="'.$gear["permalink"][$arr_rand_num[3]].'">'.$gear["title"][$arr_rand_num[3]].'</a>
          
    	</div>
    	
    	<br style="clear: both;" />
    
    </div>
    
    <div class="video_link">
    	<a id="nb" href="http://www.gearburn.com/category/videos">[ See all the videos ]</a>
    </div>
</div>	'
        ;
return $buf;
}
/* ------------------- */
















function recent_videos(){
//$xml = simplexml_load_file('http://www.gearburn.com/category/videos?feed=iphone_feed');

$xml = simplexml_load_file('http://www.gearburn.com/category/videos?feed=iphone_feed');
$items = $xml->channel->item;

foreach ($items as $item){
	$gear["title"][] = $item->title;
	$gear["permalink"][] = $item->link;

	$image = $item->image_url;
	$gear["image_url"][] = $image;

}

$arr_rand_num = array(1,2,3,4,5,6,7,8);
shuffle($arr_rand_num);
?>


<div id="video_widget" class="widget" style="padding: 5px 4px 5px 6px;">
	<h2 class="widgettitle">Gearburn Gadget Reviews</h2>
	<!--
	<div class="recentvid_head">
 		<div class="recentvid_top">
 			<img src="<?php bloginfo("stylesheet_directory");?>/images/recentvideo_leftwidget.png" />
 			<a href="http://www.samsungsmarttv.co.za"><img src="<?php bloginfo("stylesheet_directory");?>/images/recentvideo_rightwidget.png" /></a>
 		</div>
 		<div class="recentvid_bot"><img src="<?php bloginfo("stylesheet_directory");?>/images/recentvideo_subheadwidget.png" /></div>
	</div>
	-->
	<div id="featurevid" style="background: url(<?php echo $gear["image_url"][$arr_rand_num[0]]; ?>) top left no-repeat; background-size: cover;">
	   <a href="<?php echo $gear["permalink"][$arr_rand_num[0]]; ?>"><img class="play_overlay" src="<?php bloginfo("stylesheet_directory");?>/images/play_overlay.png" /></a>
	   <div class="headline">
	
	  	 <h2><a href="<?php echo $gear["permalink"][$arr_rand_num[0]]; ?>"><?php echo $gear["title"][$arr_rand_num[0]]; ?></a></h2>
	
	   </div>

    </div>
    
    
    <div class="sub_video">
    	<div class="video_item">
    		<a href="<?php echo $gear["permalink"][$arr_rand_num[1]]; ?>"><img style="width: 90px; height: 65px;" src="<?php echo $gear["image_url"][$arr_rand_num[1]]; ?>" /></a>
    		<a href="<?php echo $gear["permalink"][$arr_rand_num[1]]; ?>"><?php echo $gear["title"][$arr_rand_num[1]]; ?></a>
    	</div>
    	
    	<div class="video_item">
    		<a href="<?php echo $gear["permalink"][$arr_rand_num[2]]; ?>"><img style="width: 90px; height: 65px;" src="<?php echo $gear["image_url"][$arr_rand_num[2]]; ?>" /></a>
    		<a href="<?php echo $gear["permalink"][$arr_rand_num[2]]; ?>"><?php echo $gear["title"][$arr_rand_num[2]]; ?></a>
    	</div>
    	
    	<div class="video_item">
    		<a href="<?php echo $gear["permalink"][$arr_rand_num[3]]; ?>"><img style="width: 90px; height: 65px;" src="<?php echo $gear["image_url"][$arr_rand_num[3]]; ?>" /></a>
    		<a href="<?php echo $gear["permalink"][$arr_rand_num[3]]; ?>"><?php echo $gear["title"][$arr_rand_num[3]]; ?></a>
    	</div>
    	
    	<br style="clear: both;" />
    
    </div>
    
    <div class="video_link">
    	<a id="nb" href="http://www.gearburn.com/category/videos">[ See all the videos ]</a>
    </div>
    
</div>	
	
	
<?php 	
}

function get_the_views() {
  return the_views(false);
}



function tmo_feed($num){
//$xml = simplexml_load_file('http://www.gearburn.com/category/videos?feed=iphone_feed');

$xml = simplexml_load_file('http://themediaonline.co.za/category/digital-media?feed=rss2');
$items = $xml->channel->item;

echo "<ul>";
$count = 0;
    foreach ($items as $item){
	    $title = $item->title;
	    $link = $item->link;

	    echo "<li><a href=$link>$title</a></li>";
	    $count++;
	    if ($count>=$num) break;
    }
echo "</ul>";
}
?>
