<?php

class Bl_News_Cms_Manager_Admin {

    private $version;

    private $data_model;

    private $cache_manager;

    private $options;

    function __construct( $version, $options, $data_model, $cache_manager )
    {

        $this->version = $version;

        $this->options = $options;

        $this->data_model = $data_model;

        $this->cache_manager = $cache_manager;

    }

    function register_bl_news_post_type() {

        $labels = array(
            'name'               => __( 'News', 'bl-news-cms' ),
            'singular_name'      => __( 'News', 'bl-news-cms' ),
            'menu_name'          => __( 'News', 'admin menu', 'bl-news-cms' ),
            'name_admin_bar'     => __( 'News', 'add new on admin bar', 'bl-news-cms' ),
            'add_new'            => __( 'Add New News', 'bl-news-cms' ),
            'add_new_item'       => __( 'Add New News', 'bl-news-cms' ),
            'new_item'           => __( 'New News', 'bl-news-cms' ),
            'edit_item'          => __( 'Edit News', 'bl-news-cms' ),
            'view_item'          => __( 'View News', 'bl-news-cms' ),
            'all_items'          => __( 'All News', 'bl-news-cms' ),
            'search_items'       => __( 'Search News', 'bl-news-cms' ),
            'parent_item_colon'  => __( 'Parent News:', 'bl-news-cms' ),
            'not_found'          => __( 'No news found.', 'bl-news-cms' ),
            'not_found_in_trash' => __( 'No news found in Trash.', 'bl-news-cms' )
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'news' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'map_meta_cap'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
        );

        register_post_type( 'bl-news', $args );

        $news_category_labels = array(
            'name' => __( 'Category', 'bl-news-cms' ),
            'singular_name' => __( 'Categoria', 'bl-news-cms' ),
            'search_items' =>  __( 'Search Category', 'bl-news-cms' ),
            'all_items' => __( 'All Categories', 'bl-news-cms' ),
            'parent_item' => __( 'Parent Category', 'bl-news-cms' ),
            'parent_item_colon' => __( 'Parent Category', 'bl-news-cms' ),
            'edit_item' => __( 'Edit Category', 'bl-news-cms' ),
            'update_item' => __( 'Update Category', 'bl-news-cms' ),
            'add_new_item' => __( 'Add New Category', 'bl-news-cms' ),
            'new_item_name' => __( 'New Category', 'bl-news-cms' ),
            'menu_name' => __( 'Category', 'bl-news-cms' ),
        );

        $news_category_args = array(
            'hierarchical' => true,
            'labels' => $news_category_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'news-category' ),
            'show_in_nav_menus' => true,
        );

        register_taxonomy('bl-news-category', array('bl-news'), $news_category_args);

        if( ! get_option( 'bl-news-default-category') ){

            $default_bl_news_category_cats = array('news', 'event', 'fair');

            foreach($default_bl_news_category_cats as $cat){

                if(!term_exists($cat, 'bl-news-category')) wp_insert_term($cat, 'bl-news-category');

            }

            add_option( 'bl-news-default-category', true );

        }

    }

    public function add_delete_cache_menu_link(){

        add_submenu_page( 'edit.php?post_type=bl-news', __( 'Briefinglab News CMS Cache', 'bl-news-cms' ), __( 'Delete Cache', 'bl-news-cms' ), 'manage_options', 'delete-cache', array( $this, 'delete_cache' ) );

    }

    public function delete_cache() {

        $delete_status = $this->cache_manager->delete_cache();

        ?>

        <div class="wrap">

            <h2><?php _e( 'News CMS Cache', 'bl-news-cms' ); ?>?></h2>

            <?php if( $delete_status ):?>

                <div class="update-nag">
                    <?php _e( 'Cache have been deleted successfully', 'bl-news-cms' ); ?>
                </div>

            <?php else: ?>

                <div class="update-nag">
                    <?php _e( 'There was an error trying to delete the cache. Please check write permission for the cache folder', 'bl-news-cms' ); ?>
                </div>

            <?php endif; ?>

        </div>

<?php
    }

    function load_textdomain() {

        load_plugin_textdomain( 'bl-news-cms', false, dirname( dirname( plugin_basename( __FILE__ ) ) )  . '/langs/' );

    }


}