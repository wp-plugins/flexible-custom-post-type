<?php
/*
  Plugin Name: Flexible Custom Post Type
  Plugin URI: http://786.pe
  Description: Admin panel for creating custom post types and custom taxonomies in WordPress
  Author: 786.pe
  Version: 0.1.3
  Author URI:http://786.pe
  Tags: 786, custom, plugin, post type, taxonomy
 *
 * License: GNU General Public License, v2 (or newer)
 * License URI:  http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

class customPostType {

    protected $_version = '0.1.3';
    protected $_message = false;
    protected $_plugin_basename;
    protected $_fcpt_post_types = array();
    protected $_fcpt_taxonomies = array();

    public function __construct() {
        $this->_plugin_basename = dirname(plugin_basename(__FILE__));
        register_activation_hook(__FILE__, array($this, 'register_activation_hook'));
        load_plugin_textdomain('fcpt', false, $this->_plugin_basename . '/languages');
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_head', array($this, 'admin_head'));
        add_action('init', array($this, 'init'));
    }

    public function register_activation_hook() {
        /* if (!is_dir(WP_CONTENT_DIR . '/custom-post-types')) {
          mkdir(WP_CONTENT_DIR . '/custom-post-types');
          } */
    }

    public function get_icons() {
        $dir = WP_PLUGIN_DIR . '/' . $this->_plugin_basename . '/icons';
        $arr_files = array('default.png' => __('Default', 'fcpt'));
        $arr_extensions = array('png', 'jpg', 'gif');
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != 'default.png') {
                    $ext_name = strstr($file, '.');
                    if (in_array(str_replace('.', '', $ext_name), $arr_extensions)) {
                        $arr_files[$file] = ucwords(str_replace($ext_name, '', $file));
                    }
                }
            }
            closedir($handle);
        }
        return $arr_files;
    }

    public function create_custom_post_types() {
        $post_types = get_option('fcpt_custom_post_types');
        $this->_fcpt_post_types = $post_types;
        if (is_array($post_types)) {
            foreach ($post_types as $post_type) {
                if ($post_type['status'] == 'active') {
                    register_post_type($post_type['name'], array(
                        'label' => $post_type['label'],
                        'public' => $this->to_boolean($post_type['public']),
                        'singular_label' => $post_type['singular_label'],
                        'show_ui' => $this->to_boolean($post_type['show_ui']),
                        'capability_type' => $post_type['capability_type'],
                        'hierarchical' => $this->to_boolean($post_type['hierarchical']),
                        'rewrite' => array('slug' => $post_type['rewrite_slug']),
                        'query_var' => $this->to_boolean($post_type['query_var']),
                        'description' => $post_type['description'],
                        'menu_position' => $post_type['menu_position'],
                        'menu_icon' => WP_PLUGIN_URL . '/' . $this->_plugin_basename . '/icons/' . $post_type['menu_icon'],
                        'supports' => $post_type['supports'],
                        'taxonomies' => $post_type['taxonomies'],
                        'has_archive' => true,
                        'show_in_menu' => true
                    ));
                    add_action('admin_init', array($this, 'add_meta_box'));
                    add_action('save_post', array($this, 'save_post'));
                    add_action('manage_posts_custom_column', array($this, 'manage_posts_custom_columns'));
                    add_filter('manage_edit-' . $post_type['name'] . '_columns', array($this, 'custom_columns'));
                }
            }
        }
    }

    public function get_taxonomies_for_post_type($post_type) {
        foreach ($this->_fcpt_post_types as $pt) {
            if ($pt['name'] == $post_type) {
                $output = array();
                foreach ((array)$this->_fcpt_taxonomies as $taxonomy) {
                    if (in_array($taxonomy['name'], $pt['taxonomies'])) {
                        $output[] = $taxonomy;
                    }
                }
                return $output;
            }
        }
    }

    public function manage_posts_custom_columns($column) {
        global $post;
        $taxonomies = $this->get_taxonomies_for_post_type($post->post_type);
        switch ($column) {
            case 'taxonomy':
                $taxonomy_values = array();
                foreach ($taxonomies as $taxonomy) {
                    $terms = get_the_terms($post->ID, $taxonomy['name']);
                    if ($terms) {
                        $output = array();
                        foreach ($terms as $term) {
                            $output[] = '<a href="?' . $taxonomy['name'] . '=' . $term->slug . '&post_type=' . $post->post_type . '">' . $term->name . '</a>';
                        }
                    } else {
                        $output = array(__('None'));
                    }
                    echo $taxonomy['label'] . ': ' . implode(', ', $output) . '<br />';
                }
                break;
        }
    }

    public function custom_columns($columns) {
        return array(
            'cb' => '<input type=\'checkbox\' />',
            'title' => __('Title'),
            'author' => __('Author'),
            'taxonomy' => __('Taxonomies'),
            'date' => __('Date')
        );
    }

    public function create_custom_taxonomies() {
        $taxonomies = get_option('fcpt_custom_taxonomies');
        $this->_fcpt_taxonomies = $taxonomies;
        if (is_array($taxonomies)) {
            foreach ($taxonomies as $taxonomy) {
                register_taxonomy(
                        $taxonomy['name'],
                        $taxonomy['post_types'],
                        array(
                            'hierarchical' => $this->to_boolean($taxonomy['hierarchical']),
                            'label' => $taxonomy['label'],
                            'show_ui' => $this->to_boolean($taxonomy["show_ui"]),
                            'query_var' => $this->to_boolean($taxonomy["query_var"]),
                            'rewrite' => array('slug' => $taxonomy['rewrite_slug']),
                            'singular_label' => $taxonomy['singular_label'],
                        )
                );
            }
        }
    }

    public function add_meta_box($data) {
        foreach ($this->_fcpt_post_types as $fcpt_post_type) {
            add_meta_box($fcpt_post_type["name"] . '-custom-fields', __('Additional fields','fcpt'), array($this, 'render_meta_box'), $fcpt_post_type["name"], 'normal', 'high');
        }
    }

    public function render_meta_box($post = null) {
        foreach ($this->_fcpt_post_types as $fcpt_post_type) {
            if ($fcpt_post_type['name'] == $post->post_type) {
                if (is_array($fcpt_post_type['custom_fields'])) {
                    $output = '<table>';
                    foreach ($fcpt_post_type['custom_fields'] as $input) {
                        if ($input['name'] != '') {
                            $output .= '<tr><td style="width:100px"><label for="' . $input['name'] . '">' . __($input['title']) . '</label></td><td>';
                            switch ($input['type']) {
                                case 'text':
                                    $output .= '<input class="multilanguage-input" style="width:300px" rel="text" type="text" id="' . $input['name'] . '" name="' . $input['name'] . '" value="' . get_post_meta($post->ID, $input['name'], true) . '"/>';
                                    break;
                                case 'textarea':
                                    $output .= '<textarea class="multilanguage-input" style="width:300px" rel="textarea" rows="3" id="' . $input['name'] . '" name="' . $input['name'] . '">' . get_post_meta($post->ID, $input['name'], true) . '</textarea>';
                                    break;
                                case 'date':
                                    $output .= '<input style="width:300px" rel="date" type="text" id="' . $input['name'] . '" name="' . $input['name'] . '" value="' . get_post_meta(&$post->ID, $input['name'], true) . '"/>';
                            }
                            $output .= '<p>' . apply_filters('the_title',$input['description']) . '</p>';
                            $output .= '</td></tr>';
                        }
                    }
                    $output .= '</table>';
                    echo $output;
                }
            }
        }
?>        
<?php
        /* // Use nonce for verification
          wp_nonce_field(plugin_basename(__FILE__), 'myplugin_noncename'); */
    }

    public function save_post($post_id) {
        /* if (!wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename(__FILE__))) {
          return $post_id;
          } */

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        $post = get_post($post_id);

        foreach ($this->_fcpt_post_types as $fcpt_post_type) {
            if ($fcpt_post_type['name'] == $post->post_type) {
                if (is_array($fcpt_post_type['custom_fields'])) {
                    foreach ($fcpt_post_type['custom_fields'] as $input) {
                        update_post_meta($post_id, $input['name'], $_POST[$input['name']]);
                    }
                }
            }
        }
    }

    public function init() {
        $this->create_custom_taxonomies();
        $this->create_custom_post_types();
    }

    public function admin_init() {
        /* $this->delete_post_type();
          $this->register_settings(); */
    }

    public function admin_head() {
        /*    wp_register_script('date-select', WP_PLUGIN_URL . '/flexible-custom-post-type/js/dateSelect.js', array('jquery'));
          wp_enqueue_script('date-select');
          wp_register_script('date-select', WP_PLUGIN_URL . '/flexible-custom-post-type/js/flexible-custom-post-type.js', array('jquery', 'date-select'));
          wp_enqueue_script('flexible-custom-post-type'); */
?>
        <script src="<?php echo WP_PLUGIN_URL ?>/flexible-custom-post-type/js/dateSelect.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL ?>/flexible-custom-post-type/js/flexible-custom-post-type.js" type="text/javascript"></script>
<?php if (is_admin() && strpos($_SERVER['REQUEST_URI'], 'fcpt') != false) {
?>

<?php
        }
    }

    public function admin_menu() {
        add_menu_page('Custom Post Types', 'Post Types', 'administrator', 'fcpt', array($this, 'manage_elements'), WP_PLUGIN_URL . '/flexible-custom-post-type/icons/default.png');
        add_submenu_page('fcpt', 'Add Post Types', __('Add post types', 'fcpt'), 'administrator', 'fcpt-edit-post', array($this, 'edit_post'));
        add_submenu_page('fcpt', 'Add Taxonomies', __('Add taxonomies', 'fcpt'), 'administrator', 'fcpt-edit-taxonomy', array($this, 'edit_taxonomy'));
    }

    public function manage_elements() {
        if (!empty($_GET['id'])) {
            switch ($_GET['element']) {
                case 'post':
                    $this->delete_post_type($_GET['id']);
                    break;
                case 'taxonomy':
                    $this->delete_taxonomy($_GET['id']);
                    break;
            }
        }
        $custom_post_types = get_option('fcpt_custom_post_types');
        $custom_post_types = (!is_array($custom_post_types)) ? array() : $custom_post_types;
        $custom_taxonomies = get_option('fcpt_custom_taxonomies');
        $custom_taxonomies = (!is_array($custom_taxonomies)) ? array() : $custom_taxonomies;
        include('manage-elements.php');
    }

    public function delete_post_type($id) {
        $custom_post_types = get_option('fcpt_custom_post_types');
        if (isset($custom_post_types[$id])) {
            unset($custom_post_types[$id]);
            $i = 1;
            foreach ($custom_post_types as $post_type) {
                $new_post_types[$i] = $post_type;
                $i++;
            }
            update_option('fcpt_custom_post_types', $new_post_types);
        }
    }

    public function delete_taxonomy($id) {
        $custom_taxonomies = get_option('fcpt_custom_taxonomies');
        if (isset($custom_taxonomies[$id])) {
            unset($custom_taxonomies[$id]);
            $i = 1;
            foreach ($custom_taxonomies as $taxonomy) {
                $new_taxonomies[$i] = $taxonomy;
                $i++;
            }
            update_option('fcpt_custom_taxonomies', $new_taxonomies);
        }
    }

    public function message($message=false) {
        if ($message == false) {
            if ($this->_message != '') {
                echo '<div class="updated" id="message"><p>' . $this->_message . '</p></div>';
            }
        } else {
            $this->_message = $message;
        }
    }

    public function edit_post() {
        if (!empty($_POST)) {
            /* check_admin_referer('fcpt_edit_post_type'); */
            $id = $this->save_custom_post_type($_POST);
            $this->message(__('The post type was saved successfully'));
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        }
        if (isset($id)) {
            $custom_post_types = get_option('fcpt_custom_post_types');
            $custom_post_type = $custom_post_types[$id];
            $single = WP_CONTENT_DIR . str_replace(WP_CONTENT_URL, '', get_bloginfo('template_directory')) . '/single-' . $custom_post_type['name'] . '.php';
            $archive = WP_CONTENT_DIR . str_replace(WP_CONTENT_URL, '', get_bloginfo('template_directory')) . '/archive-' . $custom_post_type['name'] . '.php';
            if (!file_exists($single)) {
                $fp = fopen($single, 'a+');
                fwrite($fp, '<?php /* This is a autogenerated template by Flexible Custom Post Type  */ ?>');
                fclose($fp);
            }
            if (!file_exists($archive)) {
                $fp = fopen($archive, 'a+');
                fwrite($fp, '<?php /* This is a autogenerated template by Flexible Custom Post Type  */ ?>');
                fclose($fp);
            }
        } else {
            $custom_post_type = array();
        }
        include('edit-post.php');
    }

    public function edit_taxonomy() {
        if (!empty($_POST)) {
            /* check_admin_referer('fcpt_edit_post_type'); */
            $id = $this->save_custom_taxonomy($_POST);
            $message = __('');
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        }
        if (isset($id)) {
            $custom_taxonomies = get_option('fcpt_custom_taxonomies');
            $custom_taxonomy = $custom_taxonomies[$id];
            $taxonomy_uri = WP_CONTENT_DIR . str_replace(WP_CONTENT_URL, '', get_bloginfo('template_directory')) . '/taxonomy-' . $custom_taxonomy['name'] . '.php';
            if (!file_exists($taxonomy_uri)) {
                $fp = fopen($taxonomy_uri, 'a+');
                fwrite($fp, '<?php /* This is a autogenerated template by Flexible Custom Post Type  */ ?>');
                fclose($fp);
            }
        } else {
            $custom_taxonomy = array();
        }
        include('edit-taxonomy.php');
    }

    public function custom_select($name, $arr_values, $current_value, $select_one = true) {
        $output = '<select name="' . $name . '">';
        if ($select_one)
            $output .= '<option value="" ' . ('' == $current_value ? 'selected="selected"' : '') . '>' . __('Select one', 'fcpt') . '</option>';
        foreach ($arr_values as $value => $title) {
            $output .= '<option value="' . $value . '" ' . ($value == $current_value ? 'selected="selected"' : '') . '>' . __($title, 'fcpt') . '</option>';
        }
        $output .= '</select>';
        return $output;
    }

    public function custom_checkbox($name, $arr_values, $current_values=array(), $default_values=array()) {
        $output = '';
        if (empty($current_values)) {
            $current_values = $default_values;
        }
        foreach ($arr_values as $value => $title) {
            $output .= '<input type="checkbox" name="' . $name . '[]" id="' . $name . '-' . sanitize_title($value) . '" value="' . $value . '" ' . (in_array($value, $current_values) ? 'checked="checked"' : '') . '> <label for="' . $name . '-' . sanitize_title($value) . '">' . __($title, 'fcpt') . '</label><br/>';
        }

        return $output;
    }

    public function unset_values($array, $arr_values=array()) {
        foreach ($arr_values as $value) {
            unset($array[$value]);
        }
        return $array;
    }

    public function prepare_custom_post_type($post_type) {
        if ($post_type['rewrite_slug'] == '') {
            $post_type['rewrite_slug'] = str_replace('_', '-', $post_type['name']);
        }
        if (!is_array($post_type['taxonomies'])) {
            $post_type['taxonomies'] = array();
        }
        return $post_type;
    }

    public function save_custom_post_type($post_type) {
        $post_type = $this->prepare_custom_post_type($post_type);
        $custom_post_types = get_option('fcpt_custom_post_types');
        $custom_post_types = is_array($custom_post_types) ? $custom_post_types : array();
        if ($post_type['id'] == '') {
            $post_type['id'] = count($custom_post_types) + 1;
            $post_type['name'] = sanitize_title($post_type['name']);
        } else {
            $post_type['name'] = $custom_post_types[$post_type['id']]['name'];
        }
        $post_type['custom_fields'] = $this->validate_custom_fields($post_type['custom_fields']);
        $post_type = $this->unset_values($post_type, array('_wpnonce', '_wp_http_referer'));
        $custom_post_types[$post_type['id']] = $post_type;
        update_option('fcpt_custom_post_types', $custom_post_types);
        /* $this->create_translation_files($post_type['name'], $post_type['labels']); */
        return $post_type['id'];
    }

    public function prepare_custom_taxonomy($taxonomy) {
        if ($taxonomy['rewrite_slug'] == '') {
            $taxonomy['rewrite_slug'] = str_replace('_', '-', $taxonomy['name']);
        }
        if (!is_array($taxonomy['post_types'])) {
            $taxonomy['post_types'] = array();
        }
        return $taxonomy;
    }

    public function save_custom_taxonomy($taxonomy) {
        $taxonomy = $this->prepare_custom_taxonomy($taxonomy);
        $custom_taxonomies = get_option('fcpt_custom_taxonomies');
        $custom_taxonomies = is_array($custom_taxonomies) ? $custom_taxonomies : array();
        if ($taxonomy['id'] == '') {
            $taxonomy['id'] = count($custom_taxonomies) + 1;
            $taxonomy['name'] = sanitize_title($taxonomy['name']);
        } else {
            $taxonomy['name'] = $custom_taxonomies[$taxonomy['id']]['name'];
        }
        $taxonomy = $this->unset_values($taxonomy, array('_wpnonce', '_wp_http_referer'));
        $custom_taxonomies[$taxonomy['id']] = $taxonomy;
        update_option('fcpt_custom_taxonomies', $custom_taxonomies);
        /* $this->create_translation_files($_POST['name'], $_POST['labels']); */
        return $taxonomy['id'];
    }

    public function validate_custom_fields($custom_fields) {
        if (is_array($custom_fields)) {
            foreach ($custom_fields as $key => $field) {
                if ($custom_fields[$key]['name'] == '') {
                    unset($custom_fields[$key]);
                } else {
                    $custom_fields[$key]['name'] = sanitize_title($custom_fields[$key]['name']);
                }
            }
        }
        return $custom_fields;
    }

    public function create_translation_files($post_type, $labels) {
        /* $f = fopen(WP_CONTENT_DIR . '/custom_post_types/' . $post_type . '/');
          foreach($labels as $label){

          } */
    }

    public function to_boolean($string) {
        switch ($string) {
            case 'true':
                return true;
                break;
            case 'false':
                return false;
                break;
        }
    }

    public function to_value($value, $type='text') {
        switch ($type) {
            case 'text';
                $value = isset($value) ? $value : '';
        }
        return $value;
    }

}

$fcpt = new customPostType();

function get_custom_post_thumbnail($post_id) {
    $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
    return wp_get_attachment_url($thumbnail_id, 'thumbnail');
}

?>