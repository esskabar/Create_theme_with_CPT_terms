<?php



add_action('wp_enqueue_scripts', 'dev_test_scripts');

function dev_test_scripts()
{
    wp_enqueue_script('jquery-scripts', get_template_directory_uri() . '/assets/jquery-1.12.4.min.js');

    wp_enqueue_style('dev_test-style', get_stylesheet_uri());

    wp_enqueue_script('dev_test-scripts', get_template_directory_uri() . '/assets/theme-js.js');

    wp_register_style('users-css2', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
    wp_enqueue_style('users-css2');
   
    wp_register_script('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
    wp_enqueue_script('prefix_bootstrap');
    
    wp_register_style('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
    wp_enqueue_style('prefix_bootstrap');

    echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url('admin-ajax.php') . '";
            </script>';
}


add_action('init', 'shops_post_type');
function shops_post_type()
{
    register_post_type('branchs',
        array(
            'labels' => array(
                'name' => __('Branch'),
                'singular_name' => __('Branch')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Branchs'),
        )
    );
    $labels = array(
        'name' => _x('locations', 'taxonomy general name'),
        'singular_name' => _x('location', 'taxonomy singular name'),
        'search_items' => __('Search location'),
        'all_items' => __('All location'),
        'parent_item' => __('Parent location'),
        'parent_item_colon' => __('Parent location:'),
        'edit_item' => __('Edit location'),
        'update_item' => __('Update location'),
        'add_new_item' => __('Add New location'),
        'new_item_name' => __('New location Name'),
        'menu_name' => __('location'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'location'),
    );

    register_taxonomy('location', array('branchs'), $args);
}


function get_locations()
{
    $args = array(
        'taxonomy' => 'location',
        'orderby' => 'id',
        'order' => 'ASC',
        'hide_empty' => true,
    );

    return get_terms($args);
}


add_action('wp_ajax_country_filter', 'country_list_select');
add_action('wp_ajax_nopriv_country_filter', 'country_list_select');
function country_list_select()
{
    $term_id = $_POST['country'];
    $html = '';
    if ((int)$term_id !== 0) {
        $country = get_term($term_id, 'location');
        ob_start();
        include(get_stylesheet_directory() . '/template-part/tamplate-country.php');
        $html .= ob_get_contents();
        ob_end_clean();
    } else {
        foreach (get_locations() as $country) {
            ob_start();
            include(get_stylesheet_directory() . '/template-part/tamplate-country.php');
            $html .= ob_get_contents();
            ob_end_clean();
        }
    }
    echo $html;
    exit;
}

add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){

    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings

}
