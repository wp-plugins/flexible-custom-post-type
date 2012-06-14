<?php
if (basename($_SERVER['PHP_SELF']) != 'admin.php')
    die();
?>
<div class="wrap">
    <h2><?php _e('Custom Taxonomy', 'fcpt') ?></h2>
    <br/>
    <div id="col-container">
        <form method="post" action="">

            <?php if (isset($id)): ?>
                <div id="col-right">
                    <div class="col-wrap">
                        <table class="widefat tag fixed">
                            <thead>
                                <tr>
                                    <th style="width:120px" class="manage-column column-name" scope="col"><?php _e('Name', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Title', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Description', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-posts num" scope="col"><?php _e('Type', 'fcpt'); ?></th>
                                    <?php if (function_exists('qtranslate_extension')): ?>
                                        <th style="" class="manage-column column-multilanguage check-column" scope="col"><span title="<?php _e('Is it a multilanguage field?', 'fcpt') ?>"></span></th>
                                    <?php endif; ?>
                                    <th style="" class="manage-column column-posts num" scope="col"></th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th style="" class="manage-column column-name" scope="col"><?php _e('Name', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Title', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-description" scope="col"><?php _e('Description', 'fcpt'); ?></th>
                                    <th style="" class="manage-column column-posts num" scope="col"><?php _e('Type', 'fcpt'); ?></th>
                                    <?php if (function_exists('qtranslate_extension')): ?>
                                        <th style="" class="manage-column column-multilanguage check-column" scope="col"><span title="<?php _e('Is it a multilanguage field?', 'fcpt') ?>"></span></th>
                                    <?php endif; ?>
                                    <th style="" class="manage-column column-posts num" scope="col"></th>
                                </tr>
                            </tfoot>

                            <tbody id="the-list">
                                <?php $i = 0; ?>
                                <?php if (is_array($custom_taxonomy['custom_fields'])): ?>
                                    <?php foreach ($custom_taxonomy['custom_fields'] as $custom_field): ?>
                                        <?php if ($custom_field['name'] != ''): ?>
                                            <tr>
                                                <td class="name column-name"><input style="width:100px" type="text" name="custom_fields[<?php echo $i; ?>][name]" value="<?php echo $custom_field['name'] ?>"/></td>
                                                <td class="description column-description"><input class="multilanguage-input" type="text" name="custom_fields[<?php echo $i; ?>][title]" value="<?php echo $custom_field['title'] ?>"/></td>
                                                <td class="description column-description"><input class="multilanguage-input" type="text" name="custom_fields[<?php echo $i; ?>][description]" value="<?php echo $custom_field['description'] ?>"/></td>
                                                <td class="posts column-posts num"><?php echo $this->custom_select('custom_fields[' . $i . '][type]', array('text' => 'text', 'textarea' => 'textarea', 'date' => 'date'), $custom_field['type'], false); ?></td>
                                                <?php if (function_exists('qtranslate_extension')): ?>
                                                    <td class="check-column"><input <?php echo ($custom_field['multilanguage'] == true) ? 'checked="checked"' : ''; ?> type="checkbox" name="custom_fields[<?php echo $i; ?>][multilanguage]" /></td>
                                                <?php endif; ?>
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
                                    <?php if (function_exists('qtranslate_extension')): ?>
                                        <td class="check-column"><input type="checkbox" name="custom_fields[<?php echo $i; ?>][multilanguage]"/></td>
                                    <?php endif; ?>
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
                        <h3><?php _e('Edit Custom Taxonomy', 'fcpt') ?></h3>                        
                        <div class="inside">
                            <?php
                            if (function_exists('wp_nonce_field')) {
                                wp_nonce_field('fcpt_add_custom_taxonomy');
                            }
                            ?>
                            <strong><?php _e('Basic options', 'fcpt'); ?></strong>
                            <input type="hidden" name="id" value="<?php echo isset($custom_taxonomy['id']) ? $custom_taxonomy['id'] : ''; ?>" />
                            <table class="form-table">
                                <tbody>
                                    <tr valign="top" <?php if (isset($custom_taxonomy['id'])): ?>style="display:none"<?php endif; ?>><th scope="row"><?php _e('Name', 'fcpt'); ?></th><td><input autocomplete="off" type="text" value="<?php echo $custom_taxonomy['name']; ?>" tabindex="1" name="name"> (e.g. actors)</td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Label', 'fcpt'); ?></th><td><input autocomplete="off" type="text" value="<?php echo $custom_taxonomy['label']; ?>" tabindex="2" name="label"> (e.g. Actors)</td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Singular label', 'fcpt'); ?></th><td><input autocomplete="off" type="text" value="<?php echo $custom_taxonomy['singular_label']; ?>" tabindex="3" name="singular_label"> (e.g. Actor)</td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Attach to Post Type', 'fcpt'); ?></th>
                                        <td>
                                            <div style="height:110px; overflow-y:scroll; border:1px solid #DFDFDF; padding-left:5px">
                                                <?php
                                                $post_types = array();
                                                foreach (get_post_types(array('public' => true), 'names') as $post_type) {
                                                    if ($post_type != 'attachment') {
                                                        $post_types[$post_type] = $post_type;
                                                    }
                                                }
                                                echo $this->custom_checkbox('post_types', $post_types, $custom_taxonomy['post_types']);
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <strong><?php _e('Advanced options', 'fcpt'); ?></strong>
                            <table class="form-table">
                                <tbody>
                                    <tr valign="top"><th scope="row"><?php _e('Hierarchical', 'fcpt') ?></th><td><?php echo $this->custom_select('hierarchical', array('false' => 'No', 'true' => 'Yes'), $custom_taxonomy['hierarchical'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Show UI', 'fcpt') ?></th><td><?php echo $this->custom_select('show_ui', array('true' => 'Yes', 'false' => 'No'), $custom_taxonomy['show_ui'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Query var', 'fcpt') ?></th><td><?php echo $this->custom_select('query_var', array('true' => 'Yes', 'false' => 'No'), $custom_taxonomy['query_var'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Rewrite', 'fcpt') ?></th><td><?php echo $this->custom_select('rewrite', array('true' => 'Yes', 'false' => 'No'), $custom_taxonomy['rewrite'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Custom rewrite slug', 'fcpt') ?></th><td><input type="text" name="rewrite_slug" tabindex="9" value="<?php echo isset($custom_taxonomy['rewrite_slug']) ? esc_attr($custom_taxonomy['rewrite_slug']) : ''; ?>" /></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Custom posts per page', 'fcpt') ?></th><td><input type="text" name="posts_per_page" tabindex="9" value="<?php echo isset($custom_taxonomy['posts_per_page']) ? esc_attr($custom_taxonomy['posts_per_page']) : ''; ?>" /></td></tr>
                                    <?php $orderby = array('none' => __('None', 'fcpt'), 'ID' => __('ID', 'fcpt'), 'author' => __('Autor', 'fcpt'), 'title' => __('Title', 'fcpt'), 'date' => __('Date', 'fcpt'), 'modified' => __('Modified', 'fcpt'), 'parent' => __('Parent', 'fcpt'), 'rand' => __('Random', 'fcpt'), 'comment_count' => __('Comment', 'fcpt'), 'menu_order' => __('Order', 'fcpt')); ?>
                                    <tr valign="top"><th scope="row"><?php _e('Order by', 'fcpt') ?></th><td><?php echo $this->custom_select('orderby', $orderby, $custom_taxonomy['orderby'] || 'menu_order', false); ?> <?php echo $this->custom_select('order', array('ASC' => __('Ascending', 'fcpt'), 'DESC' => __('Descending', 'fcpt')), $custom_taxonomy['order'] || 'ASC', false); ?></td></tr>
                                </tbody>
                            </table>

                            <br/>
                            <strong><?php _e('Labels', 'fcpt'); ?></strong>
                            <table class="form-table">
                                <?php foreach ($this->_labels['taxonomy'] as $key => $label): ?>
                                    <tr valign="top"><th scope="row"><?php echo $key; ?></th><td><input autocomplete="off" type="text" name="labels[<?php echo $key; ?>]" value="<?php echo $custom_taxonomy['labels'][$key] || ''; ?>" class="multilanguage-input" /> (e.g. "<?php printf($label[1], __($custom_taxonomy[$label[0]])); ?>")</td></tr>
                                <?php endforeach; ?>
                            </table>

                            <p class="submit"><input type="submit" class="button-primary" tabindex="21" value="<?php _e('Save changes', 'fcpt') ?>" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>