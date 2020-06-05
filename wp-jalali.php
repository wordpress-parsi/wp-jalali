<?php
/**
 * Plugin Name: wp-jalali
 * Version: 5.1
 * Plugin URI: http://wp-persian.com/wp-jalali
 * Description: Full Jalali calendar support for Wordpress and localization improvements for Persian/Afghan/Tajik users.
 * Author: WP Persian Team
 * Author URI: http://wp-persian.com
 * Text Domain: wp-parsidate
 * Domain Path: parsi-languages
 * License: GPL3
 *
 * Copyright 2005-2020  Wordpress Persian Project  (email : info@wp-persian.com)
 * wp-jalali is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * wp-jalali is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WP-Parsidate.
 *
 *
 * WordPress Parsi Package, Adds Persian language & Jalali date support to your blog
 *
 * Developers:
 *              Mani Monajjemi
 *              Gonahkar
 *              Reza Moallemi
 *              Zakrot Web Solutions
 *              WP Parsi team
 */


if (!defined('ABSPATH')) exit; //No direct access allowed

final class WP_Parsidate
{
    /**
     * @var WP_Parsidate Class instance
     */
    public static $instance = null;

    private function __construct()
    {
        $this->define_const();
        $this->setup_vars();
        $this->include_files();
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'parsi_settings_link'));
        add_action('widgets_init', array($this, 'register_widget'));
    }

    /**
     * Sets up constants for plugin
     *
     * @return          void
     * @since           2.0
     */
    private function define_const()
    {
        if (!defined('WP_PARSI_ROOT')) {
            define('WP_PARSI_ROOT', __FILE__);
        }

        if (!defined('WP_PARSI_DIR')) {
            define('WP_PARSI_DIR', plugin_dir_path(WP_PARSI_ROOT));
        }

        if (!defined('WP_PARSI_URL')) {
            define('WP_PARSI_URL', plugin_dir_url(WP_PARSI_ROOT));
        }

        if (!defined('WP_PARSI_VER')) {
            define('WP_PARSI_VER', '2.2');
        }
    }

    /**
     * Sets up global variables
     *
     * @return          void
     * @since           2.0
     */
    private function setup_vars()
    {
        global $persian_month_names;
        $persian_month_names = array(
            '',
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند'
        );
    }

    /**
     * Includes files for plugin
     *
     * @return         void
     * @since          2.0
     */
    public function include_files()
    {
        require_once(WP_PARSI_DIR . 'includes/settings.php');
        global $wpp_settings;
        $wpp_settings = wp_parsi_get_settings();

        $files = array(
            'parsidate',
            'jalali',
            'general',
            'fixes-archive',
            'fixes-permalinks',
            'fixes-dates',
            'fixes-misc',
            'admin/styles-fix',
            //'admin/datepicker-rtl',
            'admin/gutenberg-jalali-calendar',
            'admin/lists-fix',
            'admin/widgets',
            'fixes-calendar',
            'fixes-archives',
            'plugins/woocommerce',
            //'plugins/fixes-woo',
            'plugins/edd',
            'plugins/disable',
            'widget/widget_archive',
            'widget/widget_calendar'
        );

        foreach ($files as $file) {
            require_once(WP_PARSI_DIR . 'includes/' . $file . '.php');
        }

        if (get_locale() == 'fa_IR') {
            load_textdomain('wp-parsidate', WP_PARSI_DIR . 'languages/fa_IR.mo');
        }
    }

    /**
     * Returns an instance of WP_Parsidate class, makes instance if not exists
     *
     * @return          WP_Parsidate Instance of WP_Parsidate
     * @since           2.0
     */
    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new WP_Parsidate();
        }

        return self::$instance;
    }

    /**
     * Add Setting Link To Install Plugin
     *
     * @param array $links
     *
     * @return          array
     */
    public static function parsi_settings_link($links)
    {
        $settings_link = array('<a href="' . menu_page_url('wp-parsi-settings', false) . '">' . __('settings', 'wp-parsidate') . '</a>');

        return array_merge($links, $settings_link);
    }

    /**
     * Register Plugin Widgets
     *
     * @return          boolean
     * @since           2.0
     */
    public function register_widget()
    {
        register_widget('parsidate_archive');
        register_widget('parsidate_calendar');

        return true;
    }
}

return WP_Parsidate::get_instance();
