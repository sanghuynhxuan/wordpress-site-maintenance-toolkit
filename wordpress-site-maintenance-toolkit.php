<?php
/**
 * Plugin Name: WordPress Site Maintenance Toolkit
 * Description: A maintenance operations plugin that records controlled admin-side maintenance runs.
 * Version: 1.0.0
 * Author: Sang Huynh Xuan
 * License: GPL-2.0-or-later
 */

declare(strict_types=1);

if (! defined('ABSPATH')) { exit; }

require_once __DIR__ . '/includes/Support.php';
require_once __DIR__ . '/includes/Feature.php';

add_action('plugins_loaded', static function (): void {
    (new \SangPortfolio\WordpressSiteMaintenanceToolkit\Feature())->register();
});
