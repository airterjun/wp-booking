<?php

/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 10:33 PM
 */
if (!defined('ABSPATH')) {
	exit;
}


class GoSurfCPT
{

	public $resultPage = 'booking';

	public function init()
	{

		if ( is_admin() ) {
			add_action('init', array($this, 'register_post_types'));
			add_action('add_meta_boxes', array($this, 'register_post_meta_box'));
			add_action('save_post', array($this, 'save_post_meta'));
		}


	}

	public function register_post_types()
	{

		register_post_type( 'lesson',
			array(
				'label' 				=> __('Surf Lesson'),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'menu_position' 		=> 5,
				'map_meta_cap'			=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false, // Hierarchical causes memory issues - WP loads all records!
				'query_var' 			=> true,
				'has_archive'           => false,
				'supports' 				=> array( 'title','thumbnail','editor'),
				'show_in_nav_menus' 	=> true,
				'taxonomies'          	=> array( 'prod-category' ),
			)
		);

		register_post_type( 'tours',
			array(
				'label' 				=> __('Surf Tours'),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'menu_position' 		=> 5,
				'map_meta_cap'			=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false, // Hierarchical causes memory issues - WP loads all records!
				'query_var' 			=> true,
				'has_archive'           => false,
				'supports' 				=> array( 'title','thumbnail','editor'),
				'show_in_nav_menus' 	=> true,
				'taxonomies'          => array( 'prod-category' ),
			)
		);

		register_post_type( 'board',
			array(
				'label' 				=> __('Board Rental'),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'menu_position' 		=> 5,
				'map_meta_cap'			=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false, // Hierarchical causes memory issues - WP loads all records!
				'query_var' 			=> true,
				'has_archive'           => false,
				'supports' 				=> array( 'title','thumbnail','editor'),
				'show_in_nav_menus' 	=> true,
				'taxonomies'          => array( 'prod-category' ),
			)
		);
	}

	public function register_post_meta_box(){
		add_meta_box( 'leason_category',__( 'Lesson type', 'leason_category_domain' ),array($this, 'create_leason_type'),'lesson','side','core');

		add_meta_box( 'leason_price',__( 'Price', 'leason_price_domain' ),array($this, 'create_leason_price'), array('lesson', 'tours'),'side','core');

		add_meta_box( 'board_price',__( 'Price', 'board_price_domain' ),array($this, 'create_board_price'), array('board'),'side','core');
	}



	public function create_leason_type($post){

		wp_nonce_field( plugin_basename( __FILE__ ), 'lalala_nonce_id' );

		$get_lesson_attr 	= get_post_meta(  $post->ID, '__lesson_post_attr', $single = true );

		$leason_types = array(
			'lesson_intermediate' => 'Intermediate Lesson',
			'lesson_private' => 'Private Lesson',
			'lesson_group' => 'Group Lesson',
			'lesson_kids_private' => 'Kids Private Lesson',
			'lesson_semi_private' => 'Semi Private Lesson',
			'lesson_kids_semi_private' => 'Kids Semi Private Lesson',
		)

		?>

		<select name="lesson[type]">
			<?php

			foreach ($leason_types as $id => $lesson){
				if($get_lesson_attr['type'] == $id)
					echo '<option selected value="'.$id.'">'.$lesson.'</option>';	
				else
					echo '<option value="'.$id.'">'.$lesson.'</option>';
			}

			?>
		</select>

		<?php
	}

	public function create_leason_price($post){

		wp_nonce_field( plugin_basename( __FILE__ ), 'lalala_nonce_id' );

		$get_lesson_attr 	= get_post_meta(  $post->ID, '__lesson_post_attr', $single = true );
		(isset($get_lesson_attr['price'])) ? $price = $get_lesson_attr['price'] : $price = '';
		?>
		<div>
			<label>USD :</label>
			<input type="text" value="<?php echo $price ?>" name="lesson[price]">
		</div>
		

		<?php
	}

	public function create_board_price($post){
		wp_nonce_field( plugin_basename( __FILE__ ), 'lalala_nonce_id' );

		$get_lesson_attr 	= get_post_meta(  $post->ID, '__lesson_post_attr', $single = true );
		//var_dump($get_lesson_attr);die;
		$board_prices = array(
			'1-hour' => '1 Hour',
			'2-hours' => '2 Hours',
			'1-day' => '1 Day',
			'2-days' => '2 Days',
			'3-days' => '3 Days',
		)
		?>
		<div class="inline-form" id="bd-price-wrapper">
			<?php
				if($get_lesson_attr != ''){
					foreach ($get_lesson_attr as $type => $price) {
						$j = 0;
						?>
							<div class="dyn-form">
							<select name="board_price[<?php echo $j ?>][type]" id="price-type" class="board-dyn-price">	
						<?php	
								foreach ($board_prices as $index => $desc){
									if($index == $type)
										echo '<option selected value="'.$index.'">'.$desc.'</option>';
									else
										echo '<option value="'.$index.'">'.$desc.'</option>';
								}
						?>
							</select>
							<input type="text" value="<?php echo $price ?>" placeholder="Price in USD" name="board_price[<?php echo $j ?>][value]" id="board-price">
							<input type="button" class="board-remove" value="x"/>
							</div>
						<?php			
						$j++;
					}
				}else{
			?>
				<select name="board_price[0][type]" id="price-type" class="board-dyn-price">
					<?php
						foreach ($board_prices as $index => $desc){
							echo '<option value="'.$index.'">'.$desc.'</option>';
						}
					?>
				</select>
				<input type="text" placeholder="Price in USD" name="board_price[0][value]" id="board-price">
			<?php	
			}

			?>
								
		</div>
		<input type="button" id="add-board-price" value="more price"/>

		<?php
	}

	public function save_post_meta(){
		// verify if this is an auto save routine.
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( !isset( $_POST['lalala_nonce_id'] ) || !wp_verify_nonce( $_POST['lalala_nonce_id'], plugin_basename( __FILE__ ) ) )
			return;


		// Check permissions
		if ( !current_user_can( 'edit_post', $_POST['post_ID'] ) )
			return;

		$post_ID = $_POST['post_ID'];

		if(isset($_POST['lesson'])){
			$featured_home = $_POST['lesson'];
			//var_dump($featured_home);die;
		}
		
		if(isset($_POST['board_price'])){
			foreach ($_POST['board_price'] as $key => $value) {
				$featured_home[$value['type']] = $value['value'];
			}			
			//var_dump($featured_home);die;
		}
		add_post_meta($post_ID, '__lesson_post_attr', $featured_home, true) or
		update_post_meta( $post_ID, '__lesson_post_attr', $featured_home );

	}


	public function get_lesson_meta($postId = ''){
		global $post;

		$id = $post->ID;

		if( $postId ){
			$id = $postId;
		}

		$get_lesson_attr = get_post_meta(  $id, '__lesson_post_attr', $single = true );

		return $get_lesson_attr;
	}
}

 function product_category()
{
	register_taxonomy('prod-category', array('product'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x('Product Category', 'taxonomy general name'),
			'singular_name' => _x('Product-Category', 'taxonomy singular name'),
			'search_items' => __('Search Product-Categories'),
			'all_items' => __('All Product-Categories'),
			'parent_item' => __('Parent Product-Category'),
			'parent_item_colon' => __('Parent Product-Category:'),
			'edit_item' => __('Edit Product-Category'),
			'update_item' => __('Update Product-Category'),
			'add_new_item' => __('Add New Product-Category'),
			'new_item_name' => __('New Product-Category Name'),
			'menu_name' => __('Product Categories'),
		),

		'query_var' => true,

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'catalogue',
			'with_front' => false,
			'hierarchical' => true 
		),
	));
}


function gsCPT(){

	$gs = new GoSurfCPT();

	$gs->init();
	
	return $gs;
}

$GLOBALS['gosurf'] = gsCPT();
