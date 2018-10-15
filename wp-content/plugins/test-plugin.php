<?php
/*
Plugin Name: Vikas's Test Plugin
Plugin URI: http://inheritx.com
Description: Plugin for displaying learning
Author: Vikas Pandey
Version: 1.0
Author URI: http://inheritx.com
*/

add_action('admin_menu', 'vtest_plugin_setup_menu');
 
function vtest_plugin_setup_menu(){
        add_menu_page( 'Test Plugin Page', 'Test Plugin', 'manage_options', 'vtest-plugin', 'display_users_table' );
}

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
  wp_enqueue_script( 'vtest-plugin-custom-js', plugins_url('test-plugin')."/js/custom.js", array( 'jquery' ) );
}



if (!class_exists('WP_List_Table')) {

    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Formdata_List_table extends WP_List_Table {

	function __construct() {

        global $status, $page;

        parent::__construct(array(
            'singular' => 'user',
            'plural' => 'users',
        ));
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'uname':
			case 'umail' :
			case 'umsg' :
            return $item[$column_name];
           default:
            //    return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    /*function column_name($item) {
	    $actions = array(
	        'edit' => sprintf('<a href="?page=%s&action=%s& id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
	        'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
	    );
	    return sprintf('%1$s %2$s', $item['Name'], $this->row_actions($actions) );
	}*/

      function column_uname($item) {

          $actions = array(
            /*'edit' => sprintf('<a href="?page=vtest-plugin&id=%s">%s</a>', $item['id'], __('Edit', 'user')),*/
            'delete' => sprintf('<a href="?page=vtest-plugin&id=%s&action=delete">%s</a>', $item['id'], __('Delete', 'user'))
        );
       return sprintf('%s %s', $item['uname'], $this->row_actions($actions)
      ); 

    }

/* [REQUIRED] this is how checkbox column renders */	
	    function column_cb($item) {

        return sprintf(

                '<input type="checkbox" name="id[]" value="%s" />', $item['id']
        );
    }

    function get_columns($columns = '') {

        $columns = array(

            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text

            'uname' => __('User Name', 'Formdata_List_table'),			
					
			'umail' => __('User E-mail', 'Formdata_List_table'),							

            'umsg' => __('Message', 'Formdata_List_table')
        );

        return $columns;
    }


	function get_sortable_columns() {

        $sortable_columns = array(
			
			'uname' => array('uname', true),
			
			'umail' => array('umail', true),			
			
            'umsg' => array('umsg', false)
        );

        return $sortable_columns;
    }

    function get_bulk_actions() {
		  $actions = array(
		    'delete'    => 'Delete'
		  );
		  return $actions;
	}


    function prepare_items($search ='') {

        global $wpdb;

        $table_name = $wpdb->prefix . 'vtest_form'; // do not forget about tables prefix

        $per_page = 5; // constant, how much records will be shown per page

        $columns = $this->get_columns();

        $hidden = array();

        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods

        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any

        $this->process_bulk_action();

        // will be used in pagination settings

        if(!empty($search)) { 
        	$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE uname LIKE '%{$search}%' OR umail LIKE '%{$search}%'");

        } else {

        	$total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");
    	}

        // prepare query params, as usual current page, order by and order direction

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged'] -1) * 5) : 0;

        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';

        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'ASC';


        // notice that last argument is ARRAY_A, so we will retrieve array
        
        if(!empty($search)){
        	$query = "SELECT * FROM $table_name WHERE (uname LIKE '%{$search}%' OR umail LIKE '%{$search}%' ) ORDER BY $orderby $order LIMIT %d OFFSET %d";
        	        	
    	}else {
    		$query = "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d";
    	}
        $this->items = $wpdb->get_results($wpdb->prepare($query, $per_page, $paged), ARRAY_A);

        // [REQUIRED] configure pagination

        $this->set_pagination_args(array(

            'total_items' => $total_items, // total items defined above

            'per_page' => $per_page, // per page constant defined at top of method

            'total_pages' => ceil($total_items / $per_page) // calculate pages count

        ));

    }


   	function search_box( $text, $input_id ) {
        if ( empty( $_REQUEST['s'] ) && !$this->has_items() )
            return;
 
        $input_id = $input_id . '-search-input';
 
        if ( ! empty( $_REQUEST['orderby'] ) )
            echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
        if ( ! empty( $_REQUEST['order'] ) )
            echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
        if ( ! empty( $_REQUEST['post_mime_type'] ) )
            echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
        if ( ! empty( $_REQUEST['detached'] ) )
            echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
?>
		<p class="search-box">
		    <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo $text; ?>:</label>
		    <input type="search" id="<?php echo esc_attr( $input_id ); ?>" name="s" value="<?php _admin_search_query(); ?>" />
		    <?php submit_button( $text, '', '', false, array( 'id' => 'search-submit' ) ); ?>
		</p>
<?php
    }

}

function display_users_table() {	

    global $wpdb;

    $table = new Formdata_List_table();

    $table->prepare_items();    

    $message = '';

    if ('delete' === $table->current_action()) {


                $table_name = $wpdb->prefix . 'vtest_form';
                $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
                //var_dump($ids);
                    if (is_array($ids)) $ids = implode(',', $ids);
                    if (!empty($ids)) {
                        $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
                }

        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted : %d', 'Formdata_List_table'), count($_REQUEST['id'])) . '</p></div>';
    }

?>
<div class="wrap">  	

  <h2> <?php _e('Users Listing', 'Formdata_List_table') ?> </h2>

<?php echo $message;  ?>

	  <form id="video-table" method="GET">
	  	<?php //$table->search_box('search', 'search_id'); ?>
	    <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>"/>

<?php 
 		if( isset($_GET['s']) ){
		 	$table->prepare_items($_GET['s']);
		 } else {
			$table->prepare_items();
		 }
			 $table->search_box( 'search', 'search_id' ); 

	    $table->display() ?>

	  </form>
</div>
<?php

}	

/*
* Create database when plugin activates
*/

function create_plugin_database_table() {
 global $wpdb;
 $table_name = $wpdb->prefix . 'vtest_form';
 $sql = "CREATE TABLE $table_name (
	 id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
	 uname varchar(50) NOT NULL,
	 umail varchar(50) NOT NULL,
	 umsg varchar(255) NOT NULL,
	 PRIMARY KEY  (id)
 );";
 
 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 dbDelta( $sql );
}
 
register_activation_hook( __FILE__, 'create_plugin_database_table' );

/*
* Form
*/

function vtest_form(){  ?>        

<div class="wrapper">
    <form action="#" method="post" id="test_form">
	  <div>
	    <label for="name">Name:</label>
	    <input type="text" id="vname" name="uname" required="required">
	  </div>
	  <div>
	    <label for="mail">E-mail:</label>
	    <input type="email" id="vmail" name="umail" required="required">
	  </div>
	  <div>
	    <label for="msg">Message:</label>
	    <textarea id="vmsg" name="umsg"></textarea>
	  </div>
	  <input type="hidden" id="ajaxurl" name="ajaxurl" value="<?php echo admin_url( 'admin-ajax.php' ); ?>">
	  <div>		    
	    <input type="submit" name="Submit" value="Submit" id="Submit">
	  </div>
	  <div class="Message"></div>
	</form>
</div>

<?php
}

add_shortcode( 'vtest_plugin_form', 'vtest_form' );

add_action('wp_ajax_vtest_form_submit', 'vtest_form_submit');
add_action('wp_ajax_nopriv_vtest_form_submit', 'vtest_form_submit');

function vtest_form_submit() {
	if((!empty($_POST)) && (isset($_POST))) 
	{		
		$uname = sanitize_text_field($_POST['name']);
		$umail = sanitize_text_field($_POST['email']);
		$umsg = sanitize_text_field($_POST['msg']);

		global $wpdb;  	
		$table = $wpdb->prefix . 'vtest_form';	
        //error with the query 
        if((!empty($uname)) || (!empty($umail)))
        {
        	$sql = "INSERT INTO $table (uname, umail, umsg) VALUES ('$uname', '$umail', '$umsg')";
        	if($wpdb->query($sql)) 
	           {
	           		echo "Form Submitted Successfully!!";
	           		
	           } else {
	           		echo "Form Submission Failed";	           		
	           }
    	}else{
    		echo "Name or email is empty!!";    		
    	}           
	} else {
				echo "Form data empty !!";			
	}
	die();
}
?>