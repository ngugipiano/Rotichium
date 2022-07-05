<?php
namespace  Modules\Points;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'points',
                'title' => __("Club Points Settings"),
                'position'=>30,
                'view'=>"News::admin.settings.news",
                "keys"=>[
                    'news_page_list_title',
                    'news_page_list_banner',
                    'news_sidebar',
                    'news_page_list_seo_title',
                    'news_page_list_seo_desc',
                    'news_page_list_seo_image',
                    'news_page_list_seo_share',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
