<div class="wrap">
    <div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e('Custom Elements', 'fcpt'); ?></h2>
    <h3><?php _e('Custom Post Type', 'fcpt'); ?></h3>
    <div class="tablenav top">
        <div class="alignleft actions">
            <a class="button add-new-h2" href="?page=fcpt-edit-post"><?php _e('Add New Post Type', 'fcpt'); ?></a>
        </div>
    </div>
    <table cellspacing="0" id="all-plugins-table" class="widefat">
        <thead>
            <tr>
                <th class="manage-column" scope="col"><?php _e('Post type', 'fcpt'); ?></th>
                <th class="manage-column" scope="col"><?php _e('Description', 'fcpt'); ?></th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th class="manage-column" scope="col"><?php _e('Post type', 'fcpt'); ?></th>
                <th class="manage-column" scope="col"><?php _e('Description', 'fcpt'); ?></th>
            </tr>
        </tfoot>

        <tbody class="plugins">
            <?php if (count($custom_post_types) > 0): ?>
            <?php foreach ($custom_post_types as $custom_post_type): ?>
                    <tr class="<?php echo $custom_post_type['status']; ?>">
                        <td class="plugin-title"><strong><?php echo $custom_post_type['label']; ?> (<?php echo $custom_post_type['name']; ?>)</strong><a title="" href="?page=fcpt-edit-post&id=<?php echo $custom_post_type['id']; ?>"><?php _e('Edit', 'fcpt'); ?></a> | <a title="" class="delete" href="?page=fcpt&element=post&id=<?php echo $custom_post_type['id']; ?>"><?php _e('Delete', 'fcpt'); ?></a></td>
                        <td class="desc">
                            <p><?php echo $custom_post_type['description']; ?></p>
                        </td>
                    </tr>
            <?php endforeach; ?>
            <?php else: ?>
                        <tr><td colspan="2"><?php _e('There are no custom post types', 'fcpt'); ?></td></tr>
            <?php endif; ?>
                    </tbody>
                </table>
                <br/><br/>



                <h3><?php _e('Custom Taxonomies', 'fcpt'); ?></h3>
                <div class="tablenav top">
                    <div class="alignleft actions">
                        <a class="button add-new-h2" href="?page=fcpt-edit-taxonomy"><?php _e('Add New Taxonomy', 'fcpt'); ?></a>
                    </div>
                </div>
                <table cellspacing="0" id="all-plugins-table" class="widefat">
                    <thead>
                        <tr>
                            <th class="manage-column" scope="col"><?php _e('Taxonomy', 'fcpt'); ?></th>
                            <th class="manage-column" scope="col"><?php _e('Description', 'fcpt'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="manage-column" scope="col"><?php _e('Taxonomy', 'fcpt'); ?></th>
                            <th class="manage-column" scope="col"><?php _e('Description', 'fcpt'); ?></th>
                        </tr>
                    </tfoot>
                    <tbody class="plugins">
            <?php if (count($custom_taxonomies) > 0): ?>
            <?php foreach ($custom_taxonomies as $custom_taxonomy): ?>
                                <tr class="<?php echo $custom_taxonomy['status']; ?>">
                                    <td class="plugin-title"><strong><?php echo $custom_taxonomy['name']; ?></strong><a title="" href="?page=fcpt-edit-taxonomy&id=<?php echo $custom_taxonomy['id']; ?>"><?php _e('Edit', 'fcpt'); ?></a> | <a title="" href="?page=fcpt&element=taxonomy&id=<?php echo $custom_taxonomy['id']; ?>"><?php _e('Delete', 'fcpt'); ?></a></td>
                                    <td class="desc">
                    <?php echo $custom_taxonomy['description']; ?>
                            </td>
                        </tr>
            <?php endforeach; ?>
            <?php else: ?>
                                    <tr><td colspan="2"><?php _e('There are no custom taxonomies', 'fcpt'); ?></td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>