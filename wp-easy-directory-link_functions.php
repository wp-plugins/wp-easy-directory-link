<?php
/**
 * Main plugin file
 *
 * @link              http://www.barrahome.org/proyectos/
 * @since             1.0.0
 * @package           wp-easy-directory-link
 * @subpackage        wp-easy-directory-link_functions.php
 * Description:       A plugin that allows to create a directory link page. Make software tools lists, digital resources or business address, all organized by categories.
 * Version:           1.3
 * Author:            Alberto Ferrer
 * Author URI:        http://www.barraohme.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Language.
 *
 * @since 1.2
 */

function wp_easy_directory_link_languages() {
  load_plugin_textdomain( 'wp-easy-directory-link', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Draw Search, Categories, List Links.
 *
 * @since 1.2
 */

function wp_easy_directory_link_init($atts=''){
    $taxonomy = 'link_category';
    $title = 'Link Category: ';
    if($atts){
      $args = 'include='.$atts['include'];
    } else {
      $args = '';
    }
    $terms = get_terms( $taxonomy, $args );
    $category = get_query_var('cat',1);

    /* Search */
    echo '
    <form role="search" method="post" id="searchform" class="searchform" action="'.get_permalink().'">
      <div>
        <label class="screen-reader-text" for="s" id="s">'.__("SearchTitle", "wp-easy-directory-link").'</label>
        <input type="text" value="" name="query" id="query">
        <input type="submit" id="searchsubmit" value="'.__("SearchButton", "wp-easy-directory-link").'">
      </div>
    </form>';
    echo '<hr />';
    $search = esc_attr($_POST['query']);
    if($search){
      $myLinks = get_bookmarks('title_li=&category_before=&category_after=&search='.$search);
      foreach($myLinks as $myLink) {
  	    echo '
  	      <div class="linkBox">
  	        <h3><a href="'.$myLink->link_url.'">'.$myLink->link_name.'</a></h3>
  	        <p>'.$myLink->link_description.'</p>
  		    </div>
  			';
      }
      echo '<p><a href="javascript:window.history.back();"><small>&#8592;</small></a>';
    }
    /* Search */

    /* If Click on Category */
    if($category){
    $myLinks = get_bookmarks('title_li=&category_before=&category_after=&category='.$category);
    foreach($myLinks as $myLink) {
	    echo '
	      <div class="linkBox">
	        <h3><a href="'.$myLink->link_url.'">'.$myLink->link_name.'</a></h3>
	        <p>'.$myLink->link_description.'</p>
		    </div>
			';
    }
    echo '<p><a href="javascript:window.history.back();"><small>&#8592;</small></a>';
    /* If Click on Category */

    } else {

    /* Display Categories */
    if ($terms && $search == null) {
    echo '<div class="bookmark_categories">';
  	foreach($terms as $term) {
  	 if ($term->count > 0) {
  	  echo '<p><a href="?cat='.$term->term_id.'">' . $term->name . '</a> ('.$term->count.')</p> ';
     }
    }
    echo '</div>';
   }
   /* Display Categories */

  }
}

/**
 * Init the plugin.
 *
 * @since 1.2
 */

function wp_edl_init(){
   add_shortcode('wp_edl_init', 'wp_easy_directory_link_init');
}
