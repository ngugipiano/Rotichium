<?php
namespace Modules\Newsletter;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Newsletter\Models\Newsletter;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('news.php'),
        ]);

        $sitemapHelper->add("newsletter",[app()->make(Newsletter::class),'getForSitemap']);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'newsletter'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'news'=>[
                "position"=>20,
                'url'        => route('newsletter.admin.index'),
                'title'      => __("Newsletter"),
                'icon'       => 'ion-md-bookmarks',
                'permission' => 'news_view',
                'children'   => [
                    'news_view'=>[
                        'url'        => route('newsletter.admin.index'),
                        'title'      => __("Newsletter"),
                        'permission' => 'news_view',
                    ],
                    'news_create'=>[
                        'url'        => route('news.admin.create'),
                        'title'      => __("Subscribers"),
                        'permission' => 'news_create',
                    ],

                ]
            ],
        ];
    }

    public static function getTemplateBlocks(){
        return [
            'list_news'=>"\\Modules\\News\\Blocks\\ListNews",
        ];
    }
}
