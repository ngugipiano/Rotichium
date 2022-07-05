<?php
namespace Modules\Points;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Points\Models\ClubPoint;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('points.php'),
        ]);

        $sitemapHelper->add("points",[app()->make(ClubPoint::class),'getForSitemap']);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'points'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'points'=>[
                "position"=>15,
                'url'        => route('points.admin.index'),
                'title'      => __("Club Points"),
                'icon'       => 'icon ion-ios-contacts',
                'permission' => 'news_view',
                'childrens'  => [
                    'news_view'=>[
                        'url'        => route('points.admin.index'),
                        'title'      => __("User Points"),
                        'permission' => 'news_view',
                    ],
                    'news_create'=>[
                        'url'        => route('points.admin.item_point'),
                        'title'      => __("Set Item Point"),
                        'permission' => 'news_view',
                    ],
                ]
            ],
        ];
    }

    public static function getTemplateBlocks(){
        return [
            'list_news'=>"\\Modules\\Points\\Blocks\\ListNews",
        ];
    }
}
