<?php

class HermesThemeForms
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_contact_form_script']);

        add_action('wp_ajax_submit_contact_form', [$this, 'handle_contact_form_submission']);
        add_action('wp_ajax_nopriv_submit_contact_form', [$this, 'handle_contact_form_submission']);
    }

    public function enqueue_contact_form_script()
    {
        if (is_page('contact')) {
            wp_enqueue_script('contact-form-script', HERMES_TEMPLATE_DIR_URI . '/assets/js/contact-form.js', ['jquery']);
            wp_localize_script('contact-form-script', 'contactForm', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('contact_form_nonce'),
            ]);
        }

        if (is_page('cere-oferta')) {
            wp_enqueue_script('offer-form-script', HERMES_TEMPLATE_DIR_URI . '/assets/js/offer-form.js', ['jquery']);
            wp_localize_script('offer-form-script', 'offerForm', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('offer_form_nonce'),
            ]);
        }
    }

    public function handle_contact_form_submission()
    {
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'contact_form_nonce')) {
            wp_send_json_error('Cererea nu este validă.');
        }

        // Verificăm dacă datele au fost trimise
        if (!isset($_POST['form_data'])) {
            wp_send_json_error('Datele formularului lipsesc.');
        }

        // Prelucrăm datele formularului
        $form_data = $_POST['form_data'];
        $nume = sanitize_text_field($form_data['nume']);
        $companie = sanitize_text_field($form_data['companie']);
        $email = sanitize_email($form_data['email']);
        $telefon = sanitize_text_field($form_data['telefon']);
        $subiect = sanitize_text_field($form_data['subiect']);
        $mesaj = sanitize_textarea_field($form_data['mesaj']);
        $tc = intval($form_data['tc']);

        // Salvăm datele în baza de date
        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form_submissions'; // Numele tabelei

        $result = $wpdb->insert(
            $table_name,
            [
                'nume' => $nume,
                'companie' => $companie,
                'email' => $email,
                'telefon' => $telefon,
                'subiect' => $subiect,
                'mesaj' => $mesaj,
                'tc' => $tc,
                'date_submitted' => current_time('mysql'),
            ],
            ['%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s']
        );

        // Verificăm dacă inserarea a avut succes
        if ($result) {
            wp_send_json_success('Mesajul a fost salvat cu succes.');
        } else {
            wp_send_json_error('A apărut o eroare la salvarea mesajului.');
        }
    }
}
