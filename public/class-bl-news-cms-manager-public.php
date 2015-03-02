<?php

class Bl_News_Cms_Manager_Public {

    private $version;

    private $data_model;

    private $cache_manager;

    private $options;

    function __construct( $version, $options, $data_model, $cache_manager ) {

        $this->version = $version;

        $this->options = $options;

        $this->data_model = $data_model;

        $this->cache_manager = $cache_manager;

    }

    function create_shortcode_bl_news( $atts ){

        add_shortcode( 'bl-news', array( $this, 'render_bl_news_shortcode') );

    }

    public function render_bl_news_shortcode( $atts ){

        $atts = $this->get_bl_news_shortcode_atts( $atts );

        $bl_news = $this->data_model->get_news_posts( $atts );

        return $this->render_bl_news( $bl_news, $atts );

    }


    private function render_bl_news( $bl_news, $atts ){

        global $bl_news_printed;

        //$id_cache = $this->data_model->create_id_cache_html( serialize($atts) );
        $id_cache = $this->cache_manager->create_id_cache_html( 'bl-news-' . serialize($atts) );

        //$html_carousel = $this->data_model->has_cached_html( $id_cache );
        $html_carousel = $this->cache_manager->has_cached_html( $id_cache );

        if( false === $html_carousel ){

            ob_start();

            $this->include_start_bl_news_template( $bl_news, $atts );

            foreach( $bl_news as $bl_news_index => $bl_news_item ){

                $this->include_item_bl_news_template( $bl_news_item, $bl_news_index, $atts );

            }

            $this->include_end_bl_news_template( $bl_news, $atts );

            $html_carousel = ob_get_clean();

            //$this->data_model->cache_html( $html_carousel, $id_cache );
            $this->cache_manager->cache_html( $html_carousel, $id_cache );

        }

        return $html_carousel;

        // store atts for each news carousel printed.it could be used in the template to
        // implement specific code when gallery are printed like include JS, or execute JS initiazations
        $bl_news_printed[] = $atts;

    }

    private function get_bl_news_shortcode_atts( $atts ){

        $a = shortcode_atts( array(
            'categories' => null,
            'limit' => 5,
            'template' => null
        ), $atts, 'bl-news');

        return $a;

    }


    private function include_start_bl_news_template( $bl_news, $atts ){

        include $this->locate_template_bl_news( 'start-news.php', $atts );

    }


    private function include_end_bl_news_template( $bl_news, $atts ){

        include $this->locate_template_bl_news( 'end-news.php', $atts );

    }

    private function include_item_bl_news_template( $bl_news_item, $bl_news_index, $atts ){

        include $this->locate_template_bl_news( 'item-news.php', $atts );

    }

    private function locate_template_bl_news( $template, $atts ){

        global $post;

        $custom_template_folder = get_template_directory() . '/' . $this->options['bl-news-custom-template-folder'];

        $check_templates = array();

        if( isset( $atts['template'] ) ) {}{

            $check_templates[] =  $custom_template_folder . '/' . substr( $template, 0, -4 ) . '-' . $atts['template'] . '.php';

        }

        if($post) {

            $check_templates[] = $custom_template_folder . '/' . substr($template, 0, -4) . '-' . $post->post_name . '.php';

        }

        if( isset( $atts['categories'] ) ) {}{

            $check_templates[] =  $custom_template_folder . '/' . substr( $template, 0, -4 ) . '-' . $atts['categories'] . '.php';

        }

        $check_templates[] =  $custom_template_folder . '/' . $template;

        foreach( $check_templates as $file_path ){

            if( file_exists( $file_path ) ){

                return $file_path;

            }

        }

        return dirname( __FILE__) . '/partials/' . $template;

    }

}