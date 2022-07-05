<?php
namespace Modules\Newsletter\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;

class NewsletterController extends AdminController
{
    public function index(Request $request)
    {
        $users = User::all();
        $subscribers = Subscriber::all();

        $data = [
            'rows'        => $users,
            'breadcrumbs' => [
                [
                    'name' => __('Newsletter'),
                    'url'  => route('newsletter.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'subscribers' => $subscribers,
            "languages"=>Language::getActive(false),
            "locale"=>\App::getLocale(),
            'page_title'=>__("News Management")
        ];


        return view('Newsletter::admin.index', $data);
    }

}
