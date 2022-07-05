<?php
namespace  Modules\Newsletter;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'newsletter',
                'title' => __("Newsletter settings"),
                'position'=>30,
                'view'=>"Newsletter::admin.settings.index",
                "keys"=>[
                    'news_page_list_title',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
