<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

// get svg
if (!function_exists('getSvg')) :
    function getSvg($idName, $className = 'default')
    {
        $iconsSvg = ARINA_THEME_URI . "dev/sprites/icons.svg";
        $svgs = sprintf('<svg class="svg %s" role="img">
        <use href="%s#%s"></use>
        </svg>', $className, $iconsSvg, $idName);

        return $svgs;
    }
endif;


// get attachment image
if (!function_exists('getImage')) :
    function getImage($id, $classname = 'img', $sizes = 'full')
    {
        return wp_get_attachment_image( $id, $sizes, false, ['class' => $classname] );
    }
endif;

// get icon
if (!function_exists('getIcon')) :
    function getIcon($id, $classname = 'default')
    {
        $iconMeta = wp_get_attachment_metadata($id);
        if ( !isset($iconMeta['width']) ) return false;

        $iconUrl = wp_get_attachment_image_url($id, 'full');

        return "<i class='icon $classname' style='--iurl:url($iconUrl);--iw:{$iconMeta['width']}px;--ih:{$iconMeta['height']}px'></i>";
    }
endif;

// Element switch class name
if (!function_exists('getClassName')) :
    function getClassName($settings, $classname)
    {
        return ($settings === "yes") ? " $classname" : "";
    }
endif;

// Get Taxonomy Name
if (!function_exists('getTaxonomy')) :
    function getTaxonomy($taxonomy = 'category')
    {
        $categories = get_categories(['taxonomy' => $taxonomy]);

        foreach ($categories as $category) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        return $category_dropdown ?? [];
    }
endif;

// Get Pages Name
if (!function_exists('getPages')) :
    function getPages()
    {
        $pages = get_pages();

        foreach ($pages as $page) {
            $page_dropdown[$page->ID] = $page->post_title;
        }

        return $page_dropdown;
    }
endif;

// Redux Global Option
if (!function_exists('arina_option')) :
    function arina_option($id = NULL, $sub = NULL, $default = NULL)
    {
        $result = "";

        if ($id) {
            global $arina;

            if (isset($arina[$id])) {
                $result = $sub !== null ? $arina[$id][$sub] : $arina[$id];
            }
        }

        if ($default) {
            $result = $default;
        }

        return $result;
    }
endif;

// Post excerpt
if (!function_exists('arina_the_excerpt')) :
    function arina_the_excerpt($length)
    {
        $contentX = get_the_content();
        $contentX = preg_replace('#\[[^\]]+\]#', '', $contentX);

        echo wp_trim_words( $contentX , $length );
    }
endif;

// Show Pagination
if (!function_exists('arina_pagination')) :
    function arina_pagination($wp_query = NULL, $pagex = NULL)
    {
        if (!$wp_query) :
            global $wp_query;
        endif;

        $total = $wp_query->max_num_pages;
        $big = 999999999;

        if ($total > 1) {

            $format = 'page/%#%/';
            $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));

            if ($pagex === NULL) :
                $page = max(1, get_query_var('paged'), get_query_var('page', 1));
            else :
                $page = $pagex;
            endif;

            echo '<div class="pagination">';
            ob_start();
            echo paginate_links(array(
                'base' => $base,
                'format' => $format,
                'current' => max(1, $page),
                'total' => $total,
                'mid_size' => 3,
                'type' => 'list',
                'prev_text' => '',
                'next_text' => '',
            ));
            $pagination = ob_get_contents();
            ob_end_clean();
            echo str_replace('page/1/', '', $pagination);
            echo '</div>';
        }
    }
endif;

// Menu custom template
if (!function_exists('menu_nav')) :
    function menu_nav($menu_id, $classx = null)
    {
        $menu_class = \ARINA_THEME\Inc\Menus::get_instance();
        $get_menu = $menu_class->get_menu_id($menu_id);
        $menus = wp_get_nav_menu_items($get_menu);

        $li_class = ($classx !== null) ? $classx : "menu-item-has-children";

        if (!empty($menus) && is_array($menus)) {
            foreach ($menus as $menu_item) {
                if (!$menu_item->menu_item_parent) {
                    $child_menu_items = $menu_class->get_child_menu_items($menus, $menu_item->ID);
                    $has_children = !empty($child_menu_items) && is_array($child_menu_items);

                    if (!$has_children) :
                        $link_class = !empty($menu_item->classes[0]) ? $menu_item->classes[0] : "nb";
                        ?>
                        <li>
                            <a class="<?php echo $link_class; ?>" href="<?php echo esc_url($menu_item->url); ?>">
                                <?php esc_html_e($menu_item->title); ?>
                            </a>
                        </li>
                    <?php
                    else :
                        ?>
                        <li class="<?php echo $li_class; ?>">
                            <a href="<?php echo esc_url($menu_item->url); ?>"><?php esc_html_e($menu_item->title); ?></a>
                            <ul class="sub-menu">
                                <?php
                                foreach ($child_menu_items as $child_menu) :
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url($child_menu->url); ?>"><?php esc_html_e($child_menu->title); ?></a>
                                    </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </li>
                    <?php
                    endif;
                }
            }
        }
    }
endif;

// Menu nav wrapper
if (!function_exists('arina_nav_wrap')) :
    function arina_nav_wrap() {
        $wrap  = '<ul id="%1$s" class="%2$s">%3$s';
        $wrap .= '</ul>';

        return $wrap;
    }
endif;

// Add Breadcrumbs
if( ! function_exists( 'arina_breadcrumbs' )) :
    function arina_breadcrumbs(){
        $home_text   = 'Arina';
        $before      = '<li class="link"><span>';
        $after       = '</span></li>';
        $breadcrumbs = [];

        // bbPress breadcrumbs
        if  ( ! is_home() && ! is_front_page() || is_paged() ){

            $post     = get_post();
            $home_url = esc_url(home_url( '/' ));

            // Home
            $breadcrumbs[] = array(
                'url'   => $home_url,
                'name'  => $home_text,
            );

            // Category
            if ( is_category() ){

                $category = get_query_var( 'cat' );
                $category = get_category( $category );

                if( $category->parent !== 0 ){

                    $parent_categories = array_reverse( get_ancestors( $category->cat_ID, 'category' ) );

                    foreach ( $parent_categories as $parent_category ) {
                        $breadcrumbs[] = array(
                            'url'  => get_term_link( $parent_category, 'category' ),
                            'name' => get_cat_name( $parent_category ),
                        );
                    }
                }

                $breadcrumbs[] = array(
                    'name' => get_cat_name( $category->cat_ID ),
                );
            }

            // Author
            elseif ( is_author() ){
                global $author;
                $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                $x_bread = $curauth->display_name;

                $breadcrumbs[] = array(
                    'name' => $x_bread
                );
            }

            // Day
            elseif ( is_day() ){

                $breadcrumbs[] = array(
                    'url'  => get_year_link( get_the_time( 'Y' ) ),
                    'name' => get_the_time( 'Y' ),
                );

                $breadcrumbs[] = array(
                    'url'  => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
                    'name' => get_the_time( 'F' ),
                );

                $breadcrumbs[] = array(
                    'name' => get_the_time( 'd' ),
                );
            }

            // Month
            elseif ( is_month() ){

                $breadcrumbs[] = array(
                    'url'  => get_year_link( get_the_time( 'Y' ) ),
                    'name' => get_the_time( 'Y' ),
                );

                $breadcrumbs[] = array(
                    'name' => get_the_time( 'F' ),
                );
            }

            // Year
            elseif ( is_year() ){

                $breadcrumbs[] = array(
                    'name' => get_the_time( 'Y' ),
                );
            }

            // Tag
            elseif ( is_tag() ){

                $breadcrumbs[] = array(
                    'name' => get_the_archive_title(),
                );
            }

            // Search
            elseif ( is_search() ){

                $breadcrumbs[] = array(
                    'name' => sprintf( esc_html__( '"%s" Arama Sonuçları', ARINA_TEXT ),  get_search_query() ),
                );
            }

            // 404
            elseif ( is_404() ){

                $breadcrumbs[] = array(
                    'name' => esc_html__( 'Hiçbirşey Bulunamadı', ARINA_TEXT ),
                );
            }

            // Pages
            elseif ( is_page() ){

                if ( $post->post_parent ){

                    $parent_id   = $post->post_parent;
                    $page_parents = array();

                    while ( $parent_id ){
                        $get_page  = get_page( $parent_id );
                        $parent_id = $get_page->post_parent;

                        $page_parents[] = array(
                            'url'  => get_permalink( $get_page->ID ),
                            'name' => get_the_title( $get_page->ID ),
                        );
                    }

                    $page_parents = array_reverse( $page_parents );


                    foreach( $page_parents as $single_page ){
                        if ($single_page['name'] === 'Kurumsal') {
                            $breadcrumbs[] = array(
                                'name' => $single_page['name'],
                            );
                        } else {
                            $breadcrumbs[] = array(
                                'url'  => $single_page['url'],
                                'name' => $single_page['name'],
                            );
                        }
                    }
                }

                $breadcrumbs[] = array(
                    'name' => get_the_title(),
                );
            }

            // Attachment
            elseif ( is_attachment() ){

                if( ! empty( $post->post_parent ) ){
                    $parent = get_post( $post->post_parent );

                    $breadcrumbs[] = array(
                        'url'  => get_permalink( $parent ),
                        'name' => $parent->post_title,
                    );
                }

                $breadcrumbs[] = array(
                    'name' => get_the_title(),
                );
            }

            // Single Posts
            elseif ( is_singular() ){

                // Single Post
                if ( get_post_type() == 'post' ){

                    $category = get_the_category();
                    $useCatLink = true;
                    // If post has a category assigned.
                    if ($category){
                        $category_display = '';
                        $category_link = '';
                        if ( class_exists('WPSEO_Primary_Term') ) {
                            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
                            $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
                            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                            $term = get_term( $wpseo_primary_term );
                            if (is_wp_error($term)) {
                                // Default to first category (not Yoast) if an error is returned
                                $category_display = $category[0]->name;
                                $category_link = get_category_link( $category[0]->term_id );
                            } else {
                                // Yoast Primary category
                                $category_display = $term->name;
                                $category_link = get_category_link( $term->term_id );
                            }
                        }
                        else {
                            // Default, display the first category in WP's list of assigned categories
                            $category_display = $category[0]->name;
                            $category_link = get_category_link( $category[0]->term_id );
                        }

                    }

                    if( ! empty( $category ) ){

                        $category = get_category( $category );

                        if( $category->parent !== 0 ){
                            $parent_categories = array_reverse( get_ancestors( $category->term_id, 'category' ) );

                            foreach ( $parent_categories as $parent_category ) {
                                $breadcrumbs[] = array(
                                    'url'  => $category_link,
                                    'name' => htmlspecialchars($category_display),
                                );
                            }
                        }

                        $breadcrumbs[] = array(
                            'url'  => $category_link,
                            'name' => htmlspecialchars($category_display),
                        );
                    }
                }

                // Custom Post Type
                else{

                    // Get the main Post type archive link
                    if( $archive_link = get_post_type_archive_link( get_post_type() ) ){

                        $post_type = get_post_type_object( get_post_type() );

                        $breadcrumbs[] = array(
                            'url'  => $archive_link,
                            'name' => $post_type->labels->singular_name,
                        );
                    }

                    // Get custom Post Types taxonomies
                    $taxonomies = get_object_taxonomies( $post, 'objects' );

                    if( ! empty( $taxonomies ) && is_array( $taxonomies ) ){
                        foreach( $taxonomies as $taxonomy ){
                            if( $taxonomy->hierarchical ){
                                $taxonomy_name = $taxonomy->name;
                                break;
                            }
                        }
                    }

                    if( ! empty( $taxonomy_name ) ){
                        $custom_terms = get_the_terms( $post, $taxonomy_name );

                        if( ! empty( $custom_terms ) && ! is_wp_error( $custom_terms )){

                            foreach ( $custom_terms as $term ){

                                $breadcrumbs[] = array(
                                    'url'  => get_term_link( $term ),
                                    'name' => $term->name,
                                );

                                break;
                            }
                        }
                    }
                }

                $breadcrumbs[] = array(
                    'name' => get_the_title(),
                );
            }

            // Print the BreadCrumb
            if( ! empty( $breadcrumbs ) ){

                ?>
                <nav class="breadcrubs">
                    <ul class="breadList align-items-center">
                            <?php

                                foreach( $breadcrumbs as $key => $item ) :
                                    $class_home = $key === 0 ? ' home' : '';

                                    if( !empty( $item['url'] )){
                                        echo sprintf( '<li class="link%s"><a href="%s">%s</a></li>',
                                            $class_home, esc_url($item['url']), $item['name']
                                        );
                                    } else {
                                        echo ( $before . $item['name'] . $after );
                                    }
                                endforeach;

                            ?>
                        </ul>
                </nav>
                <?php

            }
        }

        wp_reset_postdata();
    }
endif;
