<?php
/**
 * Plugin Name: WordPress Site Maintenance Toolkit
 * Description: Operational toolkit for maintaining, monitoring, and updating WordPress client sites.
 * Version: 0.1.0
 * Author: Sang Huynh Xuan
 * License: GPL-2.0-or-later
 */

declare(strict_types=1);

namespace SangPortfolio;

if (! defined('ABSPATH')) {
    exit;
}

final class WordpressSiteMaintenanceToolkitPlugin {
    public const VERSION = '0.1.0';

    public function __construct() {
        add_action('init', [$this, 'bootstrap']);
    }

    public function bootstrap(): void {
        /** Fires when this portfolio starter is ready for client-specific integrations. */
        do_action('sang_portfolio_wordpress_site_maintenance_toolkit_ready');
    }
}

new WordpressSiteMaintenanceToolkitPlugin();
