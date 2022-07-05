<?php
namespace Modules\Newsletter\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Mail;
use Modules\Email\Emails\Newsletter;
use Modules\Email\Emails\TestEmail;

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
                    'name'  => __('Create'),
                    'class' => 'active'
                ],
            ],
            'subscribers' => $subscribers,
            "languages"=>Language::getActive(false),
            "locale"=>\App::getLocale(),
            'page_title'=>__("Newsletter Management")
        ];


        return view('Newsletter::admin.index', $data);
    }
    public function send(Request $request)
    {
        if (env('MAIL_USERNAME') == null) {
            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'Email::emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = setting_item('email_from_address');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new Newsletter($array));

                    } catch (\Exception $e) {

                    }
            	}
            }

            //sends newsletter to subscribers
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'Email::emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = setting_item('email_from_address');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new Newsletter($array));

                    } catch (\Exception $e) {

                    }
            	}
            }
        }
        else {
            return redirect()->back()->with('error', __('Please configure SMTP first!'));
        }
    	return redirect()->back()->with('success', __('Newsletter has been send!'));
    }

    public function testEmail(Request $request){

        if(is_demo_mode()){
            return response()->json(['error' => __("DEMO MODE: Disable update")], 200);
        }
        $to = $request->to;
        try {
            Mail::to($to)->send(new TestEmail());
            return response()->json(['error' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'messages' => $e->getMessage()], 200);
        }
    }

}
