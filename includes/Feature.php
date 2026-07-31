<?php
declare(strict_types=1);
namespace SangPortfolio\WordpressSiteMaintenanceToolkit;
if (! defined('ABSPATH')) { exit; }
final class Feature {
    private const OPTION = 'wordpress_site_maintenance_toolkit_enabled';
    private const SLUG = 'wordpress-site-maintenance-toolkit';
    private const TITLE = 'WordPress Site Maintenance Toolkit';
    public function register(): void {
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_menu', [$this, 'registerPage']);
        if (Support::enabled(self::OPTION)) { $this->registerFeature(); }
    }
    public function registerSettings(): void { register_setting(self::SLUG, self::OPTION, ['sanitize_callback' => static fn($value): string => empty($value) ? '0' : '1']); }
    public function registerPage(): void { add_options_page(self::TITLE, self::TITLE, 'manage_options', self::SLUG, [$this, 'renderPage']); }
    public function renderPage(): void { if (! current_user_can('manage_options')) { return; } echo '<div class="wrap"><h1>' . esc_html(self::TITLE) . '</h1><form method="post" action="options.php">'; settings_fields(self::SLUG); echo '<label><input type="checkbox" name="' . esc_attr(self::OPTION) . '" value="1" ' . checked(Support::enabled(self::OPTION), true, false) . '> ' . esc_html__('Enable feature', 'sang-portfolio') . '</label>'; submit_button(); echo '</form></div>'; }
    private function registerFeature(): void { add_action('admin_init', [$this, 'recordMaintenanceRun']); }
    public function recordMaintenanceRun(): void { if (! current_user_can('manage_options') || empty($_GET['sang_maintenance'])) { return; } check_admin_referer('sang_maintenance_run'); wp_clean_plugins_cache(); update_option('sang_portfolio_maintenance_last_run', time(), false); wp_safe_redirect(Support::pageUrl(self::SLUG)); exit; }
}
