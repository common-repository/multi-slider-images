<?php
/**
 * Plugin Name: Routating Slider
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description:The plugin support upload 4 images in one slider
 * Version: 1.0
 * Author: Anh Nguyen
 */
/* Create post type*/
add_action('init', 'msi_na_init');
function msi_na_init(){
	$labels = array(
		'name'               => _x( 'Multi Slider', 'post type general name', 'rotating_slider' ),
		'singular_name'      => _x( 'Multi Slider', 'post type singular name', 'rotating_slider' ),
		'menu_name'          => _x( 'Multi Slider', 'admin menu', 'rotating_slider' ),
		'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'rotating_slider' ),
		'add_new'            => _x( 'Add New', 'video', 'rotating_slider' ),
		'add_new_item'       => __( 'Add New Slider', 'rotating_slider' ),
		'new_item'           => __( 'New Slider', 'rotating_slider' ),
		'edit_item'          => __( 'Edit Slider', 'rotating_slider' ),
		'view_item'          => __( 'View Slider', 'rotating_slider' ),
		'all_items'          => __( 'All Slider', 'rotating_slider' ),
		'search_items'       => __( 'Search Slider', 'rotating_slider' ),
		'parent_item_colon'  => __( 'Parent Slider:', 'rotating_slider' ),
		'not_found'          => __( 'No Slider found.', 'rotating_slider' ),
		'not_found_in_trash' => __( 'No Slider found in Trash.', 'rotating_slider' ),
	);
	$args = array(
		'labels' => $labels,
	    'public' => true,
	    'menu_icon' => 'dashicons-format-gallery',
	    'supports' => array(
	        'title',
	    ),
	    
	);
	register_post_type('rotating_slider', $args);
}
 
add_action("admin_init", "msi_add_product");
function msi_add_product(){
	add_meta_box("product_details", "Info Image", "msi_product_options", "rotating_slider", "normal", "low");
 }
function msi_product_options(){
	global $post;
	$product_name = get_post_meta($post->ID,'product_name');
	$purchase_url = get_post_meta($post->ID,'purchase_url');
	$product_image1 = get_post_meta($post->ID,'product_image1');
	$product_image2 = get_post_meta($post->ID,'product_image2');
	$product_image3 = get_post_meta($post->ID,'product_image3');
	$product_image4 = get_post_meta($post->ID,'product_image4');
?>
<div id="product-options">
<!-- Image 1-->
 <label>URL:</label><br><input size="100" name="purchase_url[]" value="<?php echo $purchase_url[0][0]; ?>" /><br>
 <label>Name:</label><br><input size="100" name="product_name[]" value="<?php echo $product_name[0][0]; ?>" /><br>
 <label>Image:</label><br><input type="file" size="100" name="product_image1" value="<?php echo $product_image1[0]; ?>" /></br>
 <?php
 	if($product_image1[0]){
 		?>
 		<img src="<?php echo $product_image1[0]; ?>" width="200px" height="200px"><br>
 		<?php
 	}
 ?>
 <!-- Image 2-->
 <label>URL:</label><br><input size="100" name="purchase_url[]" value="<?php echo $purchase_url[0][1]; ?>" /><br>
 <label>Name:</label><br><input size="100" name="product_name[]" value="<?php echo $product_name[0][1]; ?>" /><br>
 <label>Image:</label><br><input type="file" size="100" name="product_image2" value="<?php echo $product_image2[0]; ?>" /></br>
 <?php
 	if($product_image2[0]){
 		?>
 		<img src="<?php echo $product_image2[0]; ?>" width="200px" height="200px"><br>
 		<?php
 	}
 ?>
 <!-- Image 3-->
 <label>URL:</label><br><input size="100" name="purchase_url[]" value="<?php echo $purchase_url[0][2]; ?>" /><br>
 <label>Name:</label><br><input size="100" name="product_name[]" value="<?php echo $product_name[0][2]; ?>" /><br>
 <label>Image:</label><br><input type="file" size="100" name="product_image3" value="<?php echo $product_image3[0]; ?>" /></br>
 <?php
 	if($product_image3[0]){
 		?>
 		<img src="<?php echo $product_image3[0]; ?>" width="200px" height="200px"><br>
 		<?php
 	}
 ?>
 <!-- Image 4-->
 <label>URL:</label><br><input size="100" name="purchase_url[]" value="<?php echo $purchase_url[0][3]; ?>" /><br>
 <label>Name:</label><br><input size="100" name="product_name[]" value="<?php echo $product_name[0][3]; ?>" /><br>
 <label>Image:</label><br><input type="file" size="100" name="product_image4" value="<?php echo $product_image4[0]; ?>" /></br>
 <?php
 	if($product_image4[0]){
 		?>
 		<img src="<?php echo $product_image4[0]; ?>" width="200px" height="200px"><br>
 		<?php
 	}
 ?>
 </div><!--end product-options-->
<?php
}
add_action('save_post', 'msi_update_purchase_url');
function msi_update_purchase_url()
{
	global $post;
	update_post_meta($post->ID, "purchase_url", $_POST["purchase_url"]);
	update_post_meta($post->ID, "product_name", $_POST["product_name"]);
	
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
 	$override['action'] = 'editpost';
 	if($_FILES['product_image1']['name'])
 	{
 		$uploaded_file1 = wp_handle_upload($_FILES['product_image1'], $override);
 		update_post_meta($post->ID, "product_image1",$uploaded_file1['url']);
 	}
	if($_FILES['product_image2']['name'])
 	{
 		$uploaded_file2 = wp_handle_upload($_FILES['product_image2'], $override);
 		update_post_meta($post->ID, "product_image2",$uploaded_file2['url']);
 	}
 	if($_FILES['product_image3']['name'])
 	{
 		$uploaded_file3 = wp_handle_upload($_FILES['product_image3'], $override);
 		update_post_meta($post->ID, "product_image3",$uploaded_file3['url']);
 	}
 	if($_FILES['product_image4']['name'])
 	{
 		$uploaded_file4 = wp_handle_upload($_FILES['product_image4'], $override);
 		update_post_meta($post->ID, "product_image4",$uploaded_file1['url']);
 	}
	
}
	?>
	<?php
function msi_fileupload_metabox_header(){
?>
<script type="text/javascript">
	 jQuery(document).ready(function(){
	 jQuery('form#post').attr('enctype','multipart/form-data');
	 jQuery('form#post').attr('encoding','multipart/form-data');
	 });
</script>
<?php }
add_action('admin_head', 'msi_fileupload_metabox_header');

/* Register script and css*/
add_action('wp_print_scripts','msi_na_register_script');
function msi_na_register_script(){
	if(!is_admin()){
		wp_register_script('moder_script',plugins_url('js/modernizr.custom.63321.js',__FILE__));
		wp_register_script('UI_script','http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
		wp_register_script('cat_script',plugins_url('js/jquery.catslider.js',__FILE__));
		
		wp_enqueue_script('moder_script');
		wp_enqueue_script('UI_script');
		wp_enqueue_script('cat_script');
		
	}
}
add_action('wp_print_styles','msi_na_register_styles');
function msi_na_register_styles(){
	wp_register_style('na_style',plugins_url('css/style.css',__FILE__));
	wp_enqueue_style('na_style');
}
/* Create shortcode*/
add_shortcode('multislider', 'msi_shortcode_function');
function msi_shortcode_function($type='np_function'){
	$args = array(
        'post_type' => 'rotating_slider',
    );
    $navigation ="";
	$result ='<div class="container">	
				<div class="main">
				<div id="mi-slider" class="mi-slider">';
	$loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
        $result .= '<ul>';
        $product_image1 = get_post_meta(get_the_ID(),'product_image1');
        $product_image2 = get_post_meta(get_the_ID(),'product_image2');
		$product_image3 = get_post_meta(get_the_ID(),'product_image3');
		$product_image4 = get_post_meta(get_the_ID(),'product_image4');
        $product_names = get_post_meta(get_the_ID(),'product_name');
        $purchase_urls = get_post_meta(get_the_ID(),'purchase_url');
        foreach ($product_names as $product_name) {
        	foreach($product_name as $key => $value) {
        		$result .='<li><a href="'.$purchase_urls[0][$key].'">';
        		if($key ==0){
        			if($product_image1[0]){
        				$result .='<img src="'.$product_image1[0].'" alt="'.$value.'">';
        			}
        		}
        		if($key ==1){
        			if($product_image2[0]){
        				$result .='<img src="'.$product_image2[0].'" alt="'.$value.'">';
        			}
        		}
        		if($key ==2){
        			if($product_image3[0]){
        				$result .='<img src="'.$product_image3[0].'"  alt="'.$value.'">';
        			}
        		}
        		if($key ==3){
        			if($product_image4[0]){
        				$result .='<img src="'.$product_image4[0].'"  alt="'.$value.'">';
        			}
        		}
        		$result .='<h4>'.$value.'</h4></a></li>';
        	}

        }
        
		
        $result .= '</ul>';
        if($product_image1 ||$product_image2||$product_image3||$product_image4)
        {
        	$navigation.= '<a href="#">'.get_the_title().'</a>';
        }
   
     
    }
    $result .='<nav>';
    $result.=$navigation;
		$result .='</nav>';
		$result .=' 	
				</div>
			</div>
		</div>
		<script>
			$(function() {

				$( "#mi-slider" ).catslider();

			});
		</script>';
		return $result;
}