<?php
namespace Modules\Chats;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Chats\Models\Chat;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('news.php'),
        ]);

        $sitemapHelper->add("chats",[app()->make(Chat::class),'getForSitemap']);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'chats'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'news'=>[
                "position"=>20,
                'url'        => route('chat.admin.all'),
                'title'      => __("User Chats"),
                'icon'       => 'ion-ios-chatbubbles',
                'permission' => 'news_view',
            ],
        ];
    }

    public static function getTemplateBlocks(){
        return [
            'list_news'=>"\\Modules\\News\\Blocks\\ListNews",
        ];
    }
}
