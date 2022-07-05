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
                'view'=>"Points::admin.settings.points",
                "keys"=>[
                    'club_point_convert_rate',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
