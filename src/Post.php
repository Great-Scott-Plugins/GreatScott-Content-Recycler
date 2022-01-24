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
        if (true === is_null($post_id)) {
            $post_id = get_the_ID();
        }

        $post_revisions = wp_get_post_revisions($post_id);

        $latest_revision = array_shift($post_revisions);

        if (true === empty($latest_revision) || false === $latest_revision instanceof \WP_Post) {
            return $post_id;
        }

        return $latest_revision->ID;
    }
}
