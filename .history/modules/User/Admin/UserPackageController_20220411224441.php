<?php

namespace Modules\User\Admin;

use App\User;
use Illuminate\Http\Request;
use Modules\AdminController;
use App\Http\Controllers\PaymentController;
use Modules\User\Models\UserPackage;
use Auth;
use Modules\User\Models\Package;
use Modules\User\Models\PackagePayment;
use Session;
use Modules\Language\Models\Language;
use App;
use Modules\User\Models\PackageTranslation;

class UserPackageController extends AdminController
{
    
    public function index()
    {
        $packages = Package::orderBy('created_at', 'ASC')->paginate(10);

        $data = [
            'rows' => $packages,
        ];

        return view('User::admin.packages.index', $data);

    }

    public function create()
    {   
        $row = new Package();
        $row->fill([
            'status' => 'publish',
        ]);
        $data = [
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('User Package'),
                    'url'  => route('user_packages.index')
                ],
                [
                    'name'  => __('Add New Package'),
                    'class' => 'active'
                ],
            ],
            'translation'=>new PackageTranslation()
        ];
        return view('User::admin.packages.detail', $data);

    }    

    public function edit(Request $request, $id)
    {
        $row = Package::findOrFail($id);
        $translation = $row->translateOrOrigin($request->query('lang'));

        if (empty($row)) {
            return redirect(route('user_packages.index'));
        }

        $data = [
            'row'  => $row,
            'breadcrumbs' => [
                [
                    'name' => __('User Packages'),
                    'url'  => route('user_packages.index')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ],
            'translation'  => $translation,
            'enable_multi_lang'=>true
        ];
        
        return view('User::admin.packages.detail', $data);

    }
    
    public function store(Request $request, $id){
        if(is_demo_mode()){
            return redirect()->back('danger',__("DEMO MODE: Disable update"));
        }
        if($id>0){
            
            $row = Package::find($id);
            if (empty($row)) {
                return redirect(route('user_packages.index'));
            }
        }else{
            $row = new Package();
            $row->status = "publish";
        }

        $row->fill($request->input());
        
        $res = $row->saveOriginOrTranslation($request->query('lang'),true);

        if ($res) {
            
            if($id > 0 ){
                return redirect(route('user_packages.index'))->with('success', __('Package updated') );
            }else{
                return redirect(route('user_packages.index'))->with('success', __('Package created') );
            }
        }
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        if(Package::destroy($id)){
            return redirect()->back()->with('success', __('Package Info has been deleted successfully') );
        }
        return back();
    }

    //Show specific user packages
    public function select_package()
    {
        if (Auth::check()) {
            $packages = Package::where('active', '1')->get();
            return view('frontend.user.package_select', compact('packages'));
        }
        else {
            abort(404);
        }
    }

    public function get_package_purchase_modal(Request $request)
    {
        $package = Package::findOrFail($request->id);
        return view('frontend.partials.package_purchase_modal', compact('package'));
    }

    public function package_purchase_history()
    {
        $package_payments =  PackagePayment::latest()->paginate(20);
        return view('userpackage::admin.payment_history', compact('package_payments'));
    }

    public function package_purchase(Request $request){

        $user_package = Package::findOrFail($request->package_id);

        if ($user_package->item_upload_limit < Auth::user()->houses->count()){
            flash(translate('You have more uploaded items than this package limit. You need to remove excessive items to downgrade.'))->warning();
            return back();
        }

        if($user_package->amount == 0){
            return $this->purchase_payment_done($user_package->id, null, null);
        }else{

            $request->redirect_to = null;
            $request->amount = $user_package->amount;
            $request->payment_method = $request->payment_option;
            $request->payment_type = 'package_payment';
            $request->user_id = auth()->user()->id;
            $request->order_code = null;
            $request->seller_package_id = $request->seller_package_id;  

            return (new PaymentController())->payment_initialize($request,$request->payment_option);
        }
    }

    public function purchase_payment_done($package_id, $payment_method, $payment_data){
        $user = Auth::user();
        $user_package = Package::findOrFail($package_id);
        $shop->package_id = $user_package->id;
        $shop->item_upload_limit = $user_package->item_upload_limit;
        $shop->commission = $user_package->commission;
        $shop->published = 1;
        $shop->package_invalid_at = date('Y-m-d', strtotime($user_package->duration .'days'));
        $shop->save();

        if($payment_method != null){
            $user_package_payment = new PackagePayment;
            $user_package_payment->user_id = Auth::user()->id;
            $user_package_payment->package_id = $package_id;
            $user_package_payment->amount = $user_package->amount;
            $user_package_payment->payment_method = $payment_method;
            $user_package_payment->payment_details = $payment_data;
            $user_package_payment->save();
        }

        flash(translate('Package purchasing successful'))->success();
        return redirect()->route('seller.dashboard');
    }
    
}
