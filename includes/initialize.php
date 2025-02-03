<?php

class HermesTheme
{

    public HermesThemeTemplateHandler $template_handler;
    public HermesThemeHead $theme_head;
    private HermesThemeSetup $theme_setup;
    public HermesThemeWcHandlers $theme_wc_handlers;
    public HermesThemeWcProducts $theme_wc_products;
    public HermesThemeWcShop $theme_wc_shop;
    public HermesThemeForms $theme_forms;

    public function __construct()
    {
        $this->load_dependencies();

        error_log("dependencies loaded");

        $this->theme_head = new HermesThemeHead();
        $this->template_handler = new HermesThemeTemplateHandler();
        $this->theme_setup = new HermesThemeSetup();
        $this->theme_wc_handlers = new HermesThemeWcHandlers();
        $this->theme_wc_products = new HermesThemeWcProducts();
        $this->theme_wc_shop = new HermesThemeWcShop();
        $this->theme_forms = new HermesThemeForms();
    }

    private function load_dependencies(): void
    {
        require_once HERMES_FILE_PATH . '/includes/classes/theme-update.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-setup.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-db.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-template-handler.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-admin.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-head.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-wc-handlers.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-wc-products.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-wc-shop.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-forms.class.php';
    }
}
