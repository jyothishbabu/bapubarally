<?php

/**
 * Fired during plugin activation
 *
 * @link       http://registration_magic.com
 * @since      3.0.0
 *
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      3.0.0
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/includes
 * @author     CMSHelplive
 */
class RM_Activator
{

    /**
     * Runs all the actions for plugin activation
     *
     * @since    3.0.0
     */
    public static function activate($network_wide)
    {
        RM_Table_Tech::create_tables($network_wide);
        RM_Utilities::create_submission_page();
        error_log(self::migrate($network_wide));
    }

    public static function migrate($network_wide)
    {
        global $wpdb;
        
        $existing_rm_db_version = get_site_option('rm_option_db_version', false);
        $existing_crf_db_version = get_option('crf_db_version', false);

        if(!$existing_rm_db_version && !$existing_crf_db_version)
        {
           // update_site_option('rm_option_db_version', RM_DB_VERSION);
            return 'fresh_installation';        //No need for migration.
        }
        
        if($existing_rm_db_version && floatval($existing_rm_db_version) >= RM_DB_VERSION)
            return 'already_on_equal_or_better';
        
        self::migrate_crf_to_rm_4_0($network_wide, $existing_rm_db_version, $existing_crf_db_version);
        self::migrate_rm_4_0_to_rm_4_1($network_wide, $existing_rm_db_version);
        self::migrate_rm_4_1_to_rm_4_2($network_wide, $existing_rm_db_version);
        
        update_site_option('rm_option_db_version', RM_DB_VERSION);
    }

    private static function migrate_rm_4_0_to_rm_4_1($network_wide, $existing_rm_db_version)
    {
        if (floatval($existing_rm_db_version) < 4.1)
        {
            global $wpdb;

            if (is_multisite() && $network_wide)
            {

                $current_blog = $wpdb->blogid;

                $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
                foreach ($blog_ids as $blog_id)
                {
                    switch_to_blog($blog_id);
                    self::migrate_per_site_rm_4_0_to_rm_4_1();
                    restore_current_blog();
                }
                switch_to_blog($current_blog);
            } else
            {
                self::migrate_per_site_rm_4_0_to_rm_4_1();
            }
        }
    }
    
    private static function migrate_rm_4_1_to_rm_4_2($network_wide, $existing_rm_db_version)
    {
        if (floatval($existing_rm_db_version) < 4.2)
        {
            global $wpdb;
            if (is_multisite() && $network_wide)
            {
                $current_blog = $wpdb->blogid;
                $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
                foreach ($blog_ids as $blog_id)
                {
                    switch_to_blog($blog_id);
                    self::migrate_per_site_rm_4_1_to_rm_4_2();
                    restore_current_blog();
                }
                switch_to_blog($current_blog);
            } else
            {
                self::migrate_per_site_rm_4_1_to_rm_4_2();
            }
        }
    }

    private static function migrate_crf_to_rm_4_0($network_wide, $existing_rm_db_version, $existing_crf_db_version)
    {

        //$existing_rm_db_version = get_site_option('rm_option_db_version', false);
        //$existing_crf_db_version = get_option('crf_db_version', false);

        if (!$existing_crf_db_version)
        {
            if ($existing_rm_db_version)
            return 'already_on_rm';
            
            update_site_option('rm_option_db_version', RM_DB_VERSION);
            return 'no_crf_data';
        }

        if ($existing_rm_db_version)
            return 'already_on_rm';

        if ($existing_crf_db_version && !$existing_rm_db_version)
        {
            global $wpdb;

            error_log("Migrating old crf...");
            $mig = new RM_Migrator;
            $mig->migration_old_crf();

            if (is_multisite() && $network_wide)
            {

                $current_blog = $wpdb->blogid;

                $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
                foreach ($blog_ids as $blog_id)
                {
                    switch_to_blog($blog_id);
                    error_log('curr wpdb prefix: ' . $wpdb->prefix);
                    self::migrate_per_site_crf_to_rm_4_0();
                    restore_current_blog();
                }
                switch_to_blog($current_blog);
            } else
            {
                self::migrate_per_site_crf_to_rm_4_0();
            }

            $mig->migrate_user_meta();
        }
    }
    
    private static function migrate_per_site_rm_4_0_to_rm_4_1()
    {
        global $wpdb;
        $field_table_name = $wpdb->prefix."rm_fields";
        $wpdb->query("ALTER TABLE `$field_table_name` ADD `page_no` INT(6) NOT NULL DEFAULT '1' AFTER `form_id`");
    }
    
    private static function migrate_per_site_rm_4_1_to_rm_4_2()
    {
        global $wpdb;
        $sub_table_name = $wpdb->prefix."rm_submissions";
        $field_table_name = $wpdb->prefix."rm_fields";
        $stat_table_name = $wpdb->prefix."rm_stats";

        ob_start();
        $wpdb->query("ALTER TABLE `$sub_table_name` ADD `child_id` INT(6) NOT NULL DEFAULT '0' AFTER `user_email`;");
        $wpdb->query("ALTER TABLE `$sub_table_name` ADD `is_read` TINYINT(1) NOT NULL DEFAULT '1' AFTER `child_id`");
        $wpdb->query("ALTER TABLE `$sub_table_name` ADD `last_child` INT(6) NOT NULL DEFAULT '0' AFTER `child_id`");
        $wpdb->query("ALTER TABLE `$field_table_name` ADD `field_is_editable` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_field_primary`;");
        $wpdb->query("ALTER TABLE `$stat_table_name` ADD `submission_id` INT(6)");
        ob_get_clean();
    }
    

    private static function migrate_per_site_crf_to_rm_4_0()
    {
        //Start migration.
        global $wpdb;
        $step = 1200;

        error_log("IN THE PI: Migration progress log:");
        error_log("Initiating migration...");
        //require_once 'class_rm_migrator.php';
        $mig = new RM_Migrator;
        error_log("Class loaded.");
        /* error_log("Migrating old crf...");
          $mig->migration_old_crf(); */
        error_log("Migrating Global settings...");
        $mig->migrate_options();
        error_log("Migrating PayPal fields...");
        $mig->migrate_paypal_fields();



        error_log("Migrating PayPal logs...");

        $table_name = $wpdb->prefix . 'crf_paypal_log';
        $total_subs = $wpdb->get_var("SELECT COUNT(`id`) FROM $table_name WHERE 1");
        $total_loop_count = ceil((double) $total_subs / $step);
        for ($i = 0; $i <= $total_loop_count; $i++)
            $mig->migrate_paypal_logs($i * $step, $step);




        error_log("Migrating Stats...");

        $table_name = $wpdb->prefix . 'crf_stats';
        $total_subs = $wpdb->get_var("SELECT COUNT(`id`) FROM $table_name WHERE 1");
        $total_loop_count = ceil((double) $total_subs / $step);
        for ($i = 0; $i <= $total_loop_count; $i++)
            $mig->migrate_stats($i * $step, $step);


        error_log("Migrating Forms...");
        $mig->migrate_forms();
        error_log("Migrating Fields...");
        $mig->migrate_fields();
        error_log("Migrating Notes...");
        $mig->migrate_notes();

        error_log("Migrating Front users...");

        $table_name = $wpdb->prefix . 'crf_users';
        $total_subs = $wpdb->get_var("SELECT COUNT(`id`) FROM $table_name WHERE 1");
        $total_loop_count = ceil((double) $total_subs / $step);
        for ($i = 0; $i <= $total_loop_count; $i++)
            $mig->migrate_front_users($i * $step, $step);


        error_log("Migrating Submissions...");

        //ob_start();

        $table_name = $wpdb->prefix . 'crf_submissions';

        //$total_subs = $wpdb->get_var("SELECT COUNT(`id`) FROM $table_name WHERE 1");
        $count_array = $wpdb->get_results("SELECT `submission_id`, COUNT(*) AS `count` FROM `$table_name` WHERE 1 GROUP BY `submission_id`");

        $i = 0;
        $j = 0;
        $k = array();
        foreach ($count_array as $count_per_sub)
        {
            if ($j > 1200)
            {
                $k[] = $j;
                $j = 0;
            }

            $j += (int) $count_per_sub->count;
        }
        if ($j <= 1200)
            $k[] = $j;   //add any leftover submissions from the loop.

            
//ob_start();
        //var_dump($k);
        //error_log("K: ".ob_get_clean());

        foreach ($k as $kcount)
        {
            $mig->migrate_submissions($i, (int) $kcount);
            $i += (int) $kcount;
        }


        error_log("Inserting primary emails...");
        $mig->insert_primary_emails();
        error_log("Migration finished.");


        //update_option('rm_option_rm_version', RM_PLUGIN_VERSION);
        return 'migrate_success';
    }

}
