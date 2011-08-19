<div class="wrap">
    <h2><?php _e('Custom Post Type','fcpt'); ?></h2>
    <?php echo $this->message(); ?>
    <br/>
    <div id="col-container">
        <form method="post" action="">
            <?php if (isset($id)): ?>
                <div id="col-right">
                    <div class="col-wrap">
                        <table cellspacing="0" class="widefat tag fixed">
                            <thead>
                                <tr>
                                    <th style="width:120px" class="manage-column column-name" scope="col"><?php _e('Name', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Title', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Description', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-posts num" scope="col"><?php _e('Type', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-posts num" scope="col"></th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th style="" class="manage-column column-name" scope="col"><?php _e('Name', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Title', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Description', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-posts num" scope="col"><?php _e('Type', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-posts num" scope="col"></th>
                                </tr>
                            </tfoot>

                            <tbody id="the-list">
                            <?php $i = 0; ?>
                            <?php if (is_array($custom_post_type['custom_fields'])): ?>
                            <?php foreach ($custom_post_type['custom_fields'] as $custom_field): ?>
                            <?php if ($custom_field['name'] != ''): ?>
                                        <tr>
                                            <td class="name column-name"><input style="width:100px" type="text" name="custom_fields[<?php echo $i; ?>][name]" value="<?php echo $custom_field['name'] ?>"/></td>
                                            <td class="description column-description"><input class="multilanguage-input" type="text" name="custom_fields[<?php echo $i; ?>][title]" value="<?php echo $custom_field['title'] ?>"/></td>
                                            <td class="description column-description"><input class="multilanguage-input" type="text" name="custom_fields[<?php echo $i; ?>][description]" value="<?php echo $custom_field['description'] ?>"/></td>
                                            <td class="posts column-posts num"><?php echo $this->custom_select('custom_fields[' . $i . '][type]', array('text' => 'text', 'textarea' => 'textarea', 'date' => 'date'), $custom_field['type'], false); ?></td>
                                            <td class="posts column-posts num"><a href="#" onclick="jQuery(this).parent().parent().remove(); return false;"><?php _e('Delete', 'fcpt'); ?></a></td>
                                        </tr>
                            <?php $i++; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                                        <tr>
                                            <td class="name column-name"><input style="width:100px" type="text" name="custom_fields[<?php echo $i; ?>][name]"/></td>
                                            <td class="description column-description"><input class="multilanguage-input" type="text" name="custom_fields[<?php echo $i; ?>][title]"/></td>
                                            <td class="description column-description"><input class="multilanguage-input" type="text" name="custom_fields[<?php echo $i; ?>][description]"/></td>

                                            <td class="posts column-posts num"><?php echo $this->custom_select('custom_fields[' . $i . '][type]', array('text' => 'text', 'textarea' => 'textarea', 'date' => 'date'), $custom_field['type'], false); ?></td>
                                            <td class="posts column-posts num"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            <?php endif; ?>
                                        <div id="col-left">
                                            <div id="poststuff">
                                                <div class="postbox">
                                                    <h3><?php _e('Edit Custom Post Type', 'fcpt') ?></h3>
                                                    <div class="inside">

                            <?php
                                        if (function_exists('wp_nonce_field')) {
                                            wp_nonce_field('fcpt_add_custom_post_type');
                                        }
                            ?>
                                        <br/>
                                        <strong><?php _e('Basic options','fcpt'); ?></strong>
                                        <input type="hidden" name="id" value="<?php echo isset($custom_post_type['id']) ? $custom_post_type['id'] : ''; ?>" />
                                        <p>The name of the post-type cannot be changed. The name may show up in your URLs, e.g. ?movie=star-wars. This will also make a new theme file available, starting with prefix named "single-", e.g. single-movie.php.</p>
                                        <table class="form-table">
                                            <tr <?php if (isset($custom_post_type['id'])): ?>style="display:none;"<?php endif; ?> valign="top"><th scope="row"><?php _e('Name', 'fcpt') ?></th><td><input autocomplete="off" type="text" name="name" tabindex="1" value="<?php echo isset($custom_post_type['name']) ? esc_attr($custom_post_type['name']) : ''; ?>" />  (e.g. movie)</td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Label', 'fcpt') ?></th><td><input autocomplete="off" type="text" name="label" tabindex="2" value="<?php echo isset($custom_post_type['label']) ? esc_attr($custom_post_type['label']) : ''; ?>" /> (e.g. Movies)</td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Singular Label', 'fcpt') ?></th><td><input autocomplete="off" type="text" name="singular_label" tabindex="3" value="<?php echo isset($custom_post_type['singular_label']) ? esc_attr($custom_post_type['singular_label']) : ''; ?>" /> (e.g. Movie)</td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Description', 'fcpt') ?></th><td><textarea name="description" tabindex="4" rows="2" cols="35"><?php echo isset($custom_post_type['description']) ? esc_attr($custom_post_type['description']) : ''; ?></textarea></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Icon', 'fcpt') ?></th><td><?php echo $this->custom_select('menu_icon', $this->get_icons(), $custom_post_type['menu_icon'], false); ?> <img alt="<?php _e('menu_icon','fcpt');?>" path="<?php echo WP_PLUGIN_URL . '/' . $this->_plugin_basename . '/icons'; ?>" style="vertical-align:middle" src="<?php echo WP_PLUGIN_URL . '/' . $this->_plugin_basename . '/icons/' . (isset($custom_post_type['menu_icon']) ? $custom_post_type['menu_icon'] : 'default.png'); ?>"/></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Status', 'fcpt') ?></th><td><?php echo $this->custom_select('status', array('active' => 'Active', 'inactive' => 'Inactive'), $custom_post_type['status'], false); ?></td></tr>
                                        </table>
                                        <br/>
                                        <strong><?php _e('Advanced options','fcpt'); ?></strong>
                                        <table class="form-table">
                                            <tr valign="top"><th scope="row"><?php _e('Public', 'fcpt') ?></th><td><?php echo $this->custom_select('public', array('true' => 'Yes', 'false' => 'No'), $custom_post_type['public'], false); ?></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Show UI', 'fcpt') ?></th><td><?php echo $this->custom_select('show_ui', array('true' => 'Yes', 'false' => 'No'), $custom_post_type['show_ui'], false); ?></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Capability Type', 'fcpt') ?></th><td><input type="text" name="capability_type" tabindex="6" value="post" value="<?php echo esc_attr($custom_post_type['capability']); ?>" /></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Hierarchical', 'fcpt') ?></th><td><?php echo $this->custom_select('hierarchical', array('false' => 'No', 'true' => 'Yes'), $custom_post_type['hierarchical'], false); ?></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Rewrite', 'fcpt') ?></th><td><?php echo $this->custom_select('rewrite', array('true' => 'Yes', 'false' => 'No'), $custom_post_type['rewrite'], false); ?></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Custom Rewrite Slug', 'fcpt') ?></th><td><input type="text" name="rewrite_slug" tabindex="9" value="<?php echo isset($custom_post_type['rewrite_slug']) ? esc_attr($custom_post_type['rewrite_slug']) : ''; ?>" /></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Query Var', 'fcpt') ?></th><td><?php echo $this->custom_select('query_var', array('true' => 'Yes', 'false' => 'No'), $custom_post_type['query_var'], false); ?></td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Menu Position', 'fcpt') ?></th>
                                            <td>
                                            <?php echo $this->custom_select('menu_position', array(
                                                '5' => 'Bellow Posts',
                                                '10' => 'Below Media',
                                                '20' => 'Below Pages',
                                                '60' => 'Below first separator',
                                                '100' => 'Below second separator'
                                                    ), $custom_post_type['menu_position'], false);
                                            ?>
                                            </td>
                                            </tr>
                                            <tr valign="top"><th scope="row"><?php _e('Supports', 'fcpt') ?></th><td>
                                            <div style="height:110px; overflow-y:scroll; border:1px solid #DFDFDF; padding-left:5px">
                                            <?php
                                            echo $this->custom_checkbox('supports', array(
                                                'title' => 'title',
                                                'editor' => 'editor',
                                                'excerpt' => 'excerpt',
                                                'trackbacks' => 'trackbacks',
                                                'custom-fields' => 'custom-fields',
                                                'comments' => 'comments',
                                                'revisions' => 'revisions',
                                                'thumbnail' => 'thumbnail',
                                                'author' => 'author',
                                                'page-attributes' => 'page-attributes'
                                                ), $custom_post_type['supports'], array(
                                                'title' => 'title',
                                                'editor' => 'editor',                                                
                                                'thumbnail' => 'thumbnail',
                                                'author' => 'author',
                                                ));
                                            ?>
                                            </div>
                                            </td></tr>
                                            <tr valign="top"><th scope="row"><?php _e('Built-in Taxonomies', 'fcpt') ?></th><td>
                                            <div style="height:110px; overflow-y:scroll; border:1px solid #DFDFDF; padding-left:5px">
                                            <?php
                                            $taxonomies = array();
                                            foreach (get_taxonomies(array('public' => true), 'names') as $taxonomy) {
                                                if ($taxonomy != 'nav_menu') {
                                                    $taxonomies[$taxonomy] = $taxonomy;
                                                }
                                            }
                                            echo $this->custom_checkbox('taxonomies', $taxonomies, $custom_post_type['taxonomies']);
                                            ?>
                                            </div>
                                            </td></tr>
                                        </table>
                            <p class="submit"><input type="submit" class="button-primary" tabindex="21" value="<?php _e('Save changes', 'fcpt') ?>" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>