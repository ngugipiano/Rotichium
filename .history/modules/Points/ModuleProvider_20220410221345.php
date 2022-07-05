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
                "position"=>10,
                'url'        => route('points.admin.index'),
                'title'      => __("Club Points"),
                'icon'       => 'icon ion-ios-contacts',
                'permission' => 'news_view',
                'children'   => [
                    'news_view'=>[
                        'url'        => route('points.admin.index'),
                        'title'      => __("All News"),
                        'permission' => 'news_view',
                    ],
                    'news_create'=>[
                        'url'        => route('points.admin.create'),
                        'title'      => __("Add News"),
                        'permission' => 'news_create',
                    ],
                    'news_categoty'=>[
                        'url'        => route('points.admin.category.index'),
                        'title'      => __("Categories"),
                        'permission' => 'news_create',
                    ],
                    'news_tag'=>[
                        'url'        => route('points.admin.tag.index'),
                        'title'      => __("Tags"),
                        'permission' => 'news_create',
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
