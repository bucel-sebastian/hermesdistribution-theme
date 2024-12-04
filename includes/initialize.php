<?php

class HermesTheme
{

    public HermesThemeTemplateHandler $template_handler;
    public HermesThemeHead $theme_head;
    private HermesThemeSetup $theme_setup;

    public function __construct()
    {
        $this->load_dependencies();

        error_log("dependencies loaded");

        $this->theme_head = new HermesThemeHead();
        $this->template_handler = new HermesThemeTemplateHandler();
        $this->theme_setup = new HermesThemeSetup();
    }

    private function load_dependencies(): void
    {
        require_once HERMES_FILE_PATH . '/includes/classes/theme-update.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-setup.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-db.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-template-handler.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-admin.class.php';
        require_once HERMES_FILE_PATH . '/includes/classes/theme-head.class.php';
    }
}
