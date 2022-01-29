<?php

/**
 * Plugin Name: GreatScott Content Recycler
 * Plugin URI: https://greatscottplugins.com
 * Description:
 * Author: GreatScottPlugins
 * Author URI: https://greatscottplugins.com
 * Version: 1.0.0
 * Text Domain: greatscott-content-recycler
 * Domain Path: /languages/
 * Min WP Version: 5.0
 * Requires PHP: 5.9
 *
 * Copyright (c) 2022 Great Scott Plugins
 *
 * GNU General Public License, Free Software Foundation <https://www.gnu.org/licenses/gpl-3.0.html>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     GreatScottPlugins\GreatScottContentRecycler
 * @author      GreatScottPlugins
 * @copyright   Copyright (C) 2022 GreatScottPlugins. All rights reserved.
 *
 **/

use GreatScottPlugins\GreatScottContentRecycler\ContentRecyclerPlugin;

require_once __DIR__ . '/vendor/autoload.php';

ContentRecyclerPlugin::load();
