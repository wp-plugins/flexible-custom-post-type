<form method="post" action="">
    <?php
    if (function_exists('wp_nonce_field')) {
        wp_nonce_field('fcpt_add_custom_post_type');
    }
    ?>
    <input type="hidden" name="action" value="edit" />
    <input type="hidden" name="type" value="post" />
    <input type="hidden" name="id" value="<?php echo isset($custom_post_type['id']) ? $custom_post_type['id'] : 0; ?>" />
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e('Post Type Name', 'fcpt') ?></th>
            <td><input type="text" name="name" tabindex="1" value="<?php echo isset($custom_post_type['name']) ? esc_attr($custom_post_type['name']) : ''; ?>" />  (e.g. movies)</td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Label', 'fcpt') ?></th>
            <td><input type="text" name="label" tabindex="2" value="<?php echo isset($custom_post_type['label']) ? esc_attr($custom_post_type['label']) : ''; ?>" /> (e.g. Movies)</td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Singular Label', 'fcpt') ?></th>
            <td><input type="text" name="singular_label" tabindex="3" value="<?php echo isset($custom_post_type['singular_label']) ? esc_attr($custom_post_type['singular_label']) : ''; ?>" /> (e.g. Movie)</td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Description', 'fcpt') ?></th>
            <td><textarea name="description" tabindex="4" rows="4" cols="35"><?php echo isset($custom_post_type['description']) ? esc_attr($custom_post_type['description']) : ''; ?></textarea></td>
        </tr>
    </table>
    <ul>
        <li>
            <a href="#" class="comment_button"><?php _e('View Advanced Label Options', 'fcpt'); ?></a>
            <div style="display:none;">
                <p><?php _e('Below are the advanced label options for custom post types.  If you are unfamiliar with these labels the plugin will automatically create labels based off of your custom post type name', 'fcpt'); ?></p>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php _e('Add New', 'fcpt') ?></th>
                        <td><input type="text" name="labels[add_new]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["add_new"]) ? esc_attr($custom_post_type['labels']["add_new"]) : ''; ?>" /> (e.g. Add New)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Add New Item', 'fcpt') ?></th>
                        <td><input type="text" name="labels[add_new_item]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["add_new_item"]) ? esc_attr($custom_post_type['labels']["add_new_item"]) : ''; ?>" /> (e.g. Add New Movie)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Edit', 'fcpt') ?></th>
                        <td><input type="text" name="labels[edit]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["edit"]) ? esc_attr($custom_post_type['labels']["edit"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. Edit)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Edit Item', 'fcpt') ?></th>
                        <td><input type="text" name="labels[edit_item]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["edit_item"]) ? esc_attr($custom_post_type['labels']["edit_item"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. Edit Movie)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('New Item', 'fcpt') ?></th>
                        <td><input type="text" name="labels[new_item]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["new_item"]) ? esc_attr($custom_post_type['labels']["new_item"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. New Movie)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('View', 'fcpt') ?></th>
                        <td><input type="text" name="labels[view]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["view"]) ? esc_attr($custom_post_type['labels']["view"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. View Movie)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('View Item', 'fcpt') ?></th>
                        <td><input type="text" name="labels[view_item]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["view_item"]) ? esc_attr($custom_post_type['labels']["view_item"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. View Movie)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Search Items', 'fcpt') ?></th>
                        <td><input type="text" name="labels[search_items]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["search_items"]) ? esc_attr($custom_post_type['labels']["search_items"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. Search Movies)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Not Found', 'fcpt') ?></th>
                        <td><input type="text" name="labels[not_found]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["not_found"]) ? esc_attr($custom_post_type['labels']["not_found"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. No Movies Found)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Not Found in Trash', 'fcpt') ?></th>
                        <td><input type="text" name="labels[not_found_in_trash]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["not_found_in_trash"]) ? esc_attr($custom_post_type['labels']["not_found_in_trash"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. No Movies found in Trash)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Parent', 'fcpt') ?></th>
                        <td><input type="text" name="labels[parent]" tabindex="2" value="<?php echo isset($custom_post_type['labels']["parent"]) ? esc_attr($custom_post_type['labels']["parent"]) : ''; ?>" /> <a href="#" title="Post type label.  Used in the admin menu for displaying post types." style="cursor: help;">?</a> (e.g. Parent Movie)</td>
                    </tr>
                </table>
            </div>
        </li>

        <li><a href="#" class="comment_button" id="2"><?php _e('View Advanced Options', 'fcpt'); ?></a>
            <div style="display:none;" id="slidepanel2">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php _e('Public', 'fcpt') ?></th>
                        <td><?php echo $this->custom_select('public', array('true' => 'true', 'false' => 'false'), $custom_post_type['public']); ?></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Show UI', 'fcpt') ?></th>
                        <td><?php echo $this->custom_select('show_ui', array('true' => 'true', 'false' => 'false'), $custom_post_type['show_ui']); ?></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Capability Type', 'fcpt') ?></th>
                        <td><input type="text" name="capability_type" tabindex="6" value="post" value="<?php echo esc_attr($custom_post_type['capability']); ?>" /> <a href="#" title="The post type to use for checking read, edit, and delete capabilities" style="cursor: help;">?</a></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Hierarchical', 'fcpt') ?></th>
                        <td>
                            <?php echo $this->custom_select('hierarchical', array('false' => 'false', 'true' => 'true'), $custom_post_type['hierarchical']); ?>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Rewrite', 'fcpt') ?></th>
                        <td>
                            <?php echo $this->custom_select('rewrite', array('false' => 'false', 'true' => 'true'), $custom_post_type['rewrite']); ?>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Custom Rewrite Slug', 'fcpt') ?></th>
                        <td><input type="text" name="rewrite_slug" tabindex="9" value="<?php echo isset($custom_post_type['rewrite_slug']) ? esc_attr($custom_post_type['rewrite_slug']) : ''; ?>" /></td>
                    </tr>ptd_custom_post_type[
                    <tr valign="top">
                        <th scope="row"><?php _e('Query Var', 'fcpt') ?></th>
                        <td><?php echo $this->custom_select('query_var', array('true' => 'true', 'false' => 'false'), $custom_post_type['query_var']); ?></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Menu Position', 'fcpt') ?></th>
                        <td><input type="text" name="menu_position" tabindex="11" size="5" value="<?php echo (isset($fcpt_menu_position)) ? esc_attr($fcpt_menu_position) : ''; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Supports', 'fcpt') ?></th>
                        <td>
                            <input type="checkbox" name="supports[]" tabindex="11" value="title" <?php
                                   if (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('title', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Title <a href="#" title="Adds the title meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="12" value="editor" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('editor', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Editor <a href="#" title="Adds the content editor meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="13" value="excerpt" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('excerpt', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Excerpt <a href="#" title="Adds the excerpt meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="14" value="trackbacks" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('trackbacks', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   } ?> />&nbsp;Trackbacks <a href="#" title="Adds the trackbacks meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="15" value="custom-fields" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('custom-fields', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Custom Fields <a href="#" title="Adds the custom fields meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="16" value="comments" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('comments', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   } ?> />&nbsp;Comments <a href="#" title="Adds the comments meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="17" value="revisions" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('revisions', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Revisions <a href="#" title="Adds the revisions meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="18" value="thumbnail" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('thumbnail', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Featured Image <a href="#" title="Adds the featured image meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="19" value="author" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('author', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   } ?> />&nbsp;Author <a href="#" title="Adds the author meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                                   <input type="checkbox" name="supports[]" tabindex="20" value="page-attributes" <?php
                                   If (isset($fcpt_supports) && is_array($fcpt_supports)) {
                                       If (in_array('page-attributes', $fcpt_supports)) {
                                           echo 'checked="checked"';
                                       }
                                   } Elseif (!isset($_GET['edittype'])) {
                                       echo 'checked="checked"';
                                   }
                            ?> />&nbsp;Page Attributes <a href="#" title="Adds the page attribute meta box when creating content for this custom post type" style="cursor: help;">?</a> <br/ >
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php _e('Built-in Taxonomies', 'fcpt') ?></th>
                        <td>
                            <?php
                                   //load built-in WP Taxonomies
                                   $args = array('public' => true);
                                   $output = 'objects';
                                   $add_taxes = get_taxonomies($args, $output);
                                   foreach ($add_taxes as $add_tax) {
                                       if ($add_tax->name != 'nav_menu') {
                            ?>
                                           <input type="checkbox" name="addon_taxes[]" tabindex="20" value="<?php echo $add_tax->name; ?>" <?php if (isset($fcpt_taxes) && is_array($fcpt_taxes)) {
                                               echo (in_array($add_tax->name, $fcpt_taxes)) ? 'checked="checked"' : '';
                                           } ?> /><?php echo $add_tax->label; ?><br />
                            <?php
                                       }
                                   }
                            ?>
                               </td>
                           </tr>

                       </table>
                   </div>

               </li>
           </ul>
           <p class="submit"><input type="submit" class="button-primary" tabindex="21" value="<?php _e('Save changes', 'fcpt') ?>" /></p>

</form>