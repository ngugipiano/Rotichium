<?php
namespace Modules\Chat;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Chat\Models\Chat;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('chat.php'),
        ]);

        $sitemapHelper->add("news",[app()->make(Chat::class),'getForSitemap']);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'chat'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'chat'=>[
                "position"=>20,
                'url'        => route('chat.admin.all'),
                'title'      => __("User Chats"),
                'icon'       => 'ion-md-bookmarks',
                'permission' => 'news_view',
                'children'   => [
                    'news_view'=>[
                        'url'        => route('chat.admin.all'),
                        'title'      => __("All Chats"),
                        'permission' => 'news_view',
                    ],
                    'news_create'=>[
                        'url'        => route('news.admin.create'),
                        'title'      => __("Add News"),
                        'permission' => 'news_create',
                    ],
                    'news_categoty'=>[
                        'url'        => route('news.admin.category.index'),
                        'title'      => __("Categories"),
                        'permission' => 'news_create',
                    ],
                    'news_tag'=>[
                        'url'        => route('news.admin.tag.index'),
                        'title'      => __("Tags"),
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
