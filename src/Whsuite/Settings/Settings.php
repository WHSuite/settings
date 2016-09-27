<?php
namespace Whsuite\Settings;

/**
 * Settings Utility
 *
 * Loads the WHSuite Settings and adds them to the config handler.
 */
class Settings
{

    /**
     * Init
     */
    public static function init()
    {
        $settingsData = \Setting::with('SettingCategory')->get();
        $settings = array();

        foreach ($settingsData as $setting) {

            if (! empty($setting->slug) && ! empty($setting->SettingCategory->slug)) {

                $settings[$setting->SettingCategory->slug][$setting->slug] = $setting->value;

            } elseif(! empty($setting->slug) && empty($setting->SettingCategory->slug)) {

                $settings[$setting->slug] = $setting->value;
            }
        }

        \App::get('configs')->set('settings', $settings);
    }
}
