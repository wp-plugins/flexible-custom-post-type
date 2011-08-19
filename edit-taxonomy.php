<div class="wrap">
    <h2>Custom Taxonomy</h2>
    <br/>
    <div id="col-container">
        <form method="post" action="">
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
                            <strong><?php _e('Basic Options', 'fcpt'); ?></strong>
                            <input type="hidden" name="id" value="<?php echo isset($custom_taxonomy['id']) ? $custom_taxonomy['id'] : ''; ?>" />
                            <table class="form-table">
                                <tbody>
                                    <tr valign="top" <?php if (isset($custom_taxonomy['id'])): ?>style="display:none"<?php endif; ?>><th scope="row"><?php _e('Name', 'fcpt'); ?></th><td><input autocomplete="off" type="text" value="<?php echo $custom_taxonomy['name']; ?>" tabindex="1" name="name"> (e.g. actors)</td></tr>
                                        <tr valign="top"><th scope="row"><?php _e('Label', 'fcpt'); ?></th><td><input autocomplete="off" type="text" value="<?php echo $custom_taxonomy['label']; ?>" tabindex="2" name="label"> (e.g. Actors)</td></tr>
                                        <tr valign="top"><th scope="row"><?php _e('Singular Label', 'fcpt'); ?></th><td><input autocomplete="off" type="text" value="<?php echo $custom_taxonomy['singular_label']; ?>" tabindex="3" name="singular_label"> (e.g. Actor)</td></tr>
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
                            <strong><?php _e('Advanced Options', 'fcpt'); ?></strong>
                            <table class="form-table">
                                <tbody>
                                    <tr valign="top"><th scope="row"><?php _e('Hierarchical', 'fcpt') ?></th><td><?php echo $this->custom_select('hierarchical', array('false' => 'No', 'true' => 'Yes'), $custom_taxonomy['hierarchical'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Show UI', 'fcpt') ?></th><td><?php echo $this->custom_select('show_ui', array('true' => 'Yes', 'false' => 'No'), $custom_taxonomy['show_ui'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Query Var', 'fcpt') ?></th><td><?php echo $this->custom_select('query_var', array('true' => 'Yes', 'false' => 'No'), $custom_taxonomy['query_var'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Rewrite', 'fcpt') ?></th><td><?php echo $this->custom_select('rewrite', array('true' => 'Yes', 'false' => 'No'), $custom_taxonomy['rewrite'], false); ?></td></tr>
                                    <tr valign="top"><th scope="row"><?php _e('Custom Rewrite Slug', 'fcpt') ?></th><td><input type="text" name="rewrite_slug" tabindex="9" value="<?php echo isset($custom_taxonomy['rewrite_slug']) ? esc_attr($custom_taxonomy['rewrite_slug']) : ''; ?>" /></td></tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" tabindex="21" value="<?php _e('Save changes', 'fcpt') ?>" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>