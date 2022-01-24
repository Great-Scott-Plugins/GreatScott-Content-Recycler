<?php

namespace GreatScottPlugins\GreatScottContentRecycler;

use GreatScottPlugins\WordPressPlugin\Plugin;

/**
 * Class Post
 *
 * @package GreatScottPlugins\GreatScottContentRecycler
 */
class Post extends Plugin
{
    /**
     * Get public ID for post.
     *
     * @param int|null $post_id
     *
     * @return int Public ID for post.
     */
    public static function getPublicId(int $post_id = null): int
    {
        $recycle_id = intval(get_post_meta($post_id, 'recycle_id', true));

        if (true === empty($recycle_id)) {
            update_post_meta($post_id, 'recycle_id', $post_id);

            return $post_id;
        }

        return $recycle_id;
    }
}
