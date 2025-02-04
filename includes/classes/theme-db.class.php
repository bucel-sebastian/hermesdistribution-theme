<?php

class HermesThemeDatabase
{
    private $db_theme_tables;

    public function __construct()
    {
        global $wpdb;

        $this->db_theme_tables = [
            [
                'name' => "{$wpdb->prefix}contact_form",
                'sql' => "CREATE TABLE `{$wpdb->prefix}contact_form` (
                    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
                    `name` varchar(255) NOT NULL,
                    `company_name` varchar(255),
                    `email` varchar(255) NOT NULL,
                    `phone` varchar(255),
                    `subject` varchar(255) NOT NULL,
                    `message` TEXT NOT NULL,
                    `tc` INT(2) NOT NULL DEFAULT 0,
                    `status` INT(2) NOT NULL DEFAULT 0
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
            ],
            [
                'name' => "{$wpdb->prefix}offers_request",
                'sql' => "CREATE TABLE `{$wpdb->prefix}offers_request` (
                    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
                    `name` varchar(255) NOT NULL,
                    `company_name` varchar(255),
                    `email` varchar(255) NOT NULL,
                    `phone` varchar(255),
                    `subject` varchar(255) NOT NULL,
                    `message` TEXT NOT NULL,
                    `tc` INT(2) NOT NULL DEFAULT 0,
                    `status` INT(2) NOT NULL DEFAULT 0
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
            ]
        ];
    }

    public function create_tables()
    {
        foreach ($this->db_theme_tables as $db_theme_table) {
            maybe_create_table($db_theme_table['name'], $db_theme_table['sql']);
        }
    }
}
