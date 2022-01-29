<?php

namespace GreatScottPlugins\GreatScottContentRecycler;

use GreatScottPlugins\WordPressPlugin\Plugin;

/**
 * Class ContentRecyclerPlugin
 *
 * @package GreatScottPlugins\GreatScottContentRecycler
 */
class ContentRecyclerPlugin extends Plugin
{
    /**
     * Init method.
     */
    public function init()
    {
        // Define revision count.
        if (false === defined('WP_POST_REVISIONS')) {
            // Store 10 revisions.
            define('WP_POST_REVISIONS', 10);
        }

        // Register post meta settings.
        register_post_meta(
            'post',
            'recycle_id',
            [
                'description'  => __('Recycle Post ID.', 'greatscott-content-recycler'),
                'show_in_rest' => true,
                'single'       => true,
                'type'         => 'string',
            ]
        );
    }

    /**
     * Register admin scripts.
     *
     * @action admin_init
     */
    public function registerAdminScripts()
    {
        $build_asset = require(self::dir('build/post-edit.asset.php'));

        wp_register_script(
            'content-recycler-post-edit',
            self::url('build/post-edit.js'),
            $build_asset['dependencies'],
            $build_asset['version']
        );
    }

    /**
     * Admin enqueue scripts.
     *
     * @action admin_enqueue_scripts
     */
    public function adminEnqueueScripts($hook)
    {
        switch ($hook) {
            case 'post.php':
                wp_enqueue_script('content-recycler-post-edit');
                break;
        }
    }
}
