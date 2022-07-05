<?php
namespace Modules\Points\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\Points\Models\ClubPoint;
use Modules\Points\Models\NewsCategory;
use Modules\Points\Models\NewsTranslation;
use Modules\Space\Models\Space;
use App;
class ClubPointController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('points.admin.index'));
        parent::__construct();
        $this->space = Space::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('news_view');
        $dataNews = ClubPoint::query()->orderBy('id', 'desc');


        // $this->filterLang($dataNews);

        $data = [
            'rows'        => $dataNews->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Club Points'),
                    'url'  => route('points.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            "languages"=>Language::getActive(false),
            "locale"=>App::getLocale(),
            'page_title'=>__("Club Points")
        ];
        return view('Points::admin.points.index', $data);
    }
    public function item_point(Request $request)
    {
        $this->checkPermission('space_view');
        $query = $this->space::query() ;
        $query->orderBy('id', 'desc');
        if (!empty($space_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $space_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($is_featured = $request->input('is_featured'))) {
            $query->where('is_featured', 1);
        }
        if (!empty($location_id = $request->query('location_id'))) {
            $query->where('location_id', $location_id);
        }
        if ($this->hasPermission('space_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with(['author'])->paginate(20),
            'space_manage_others' => $this->hasPermission('space_manage_others'),
            'breadcrumbs'        => [
                [
                    'name' => __('Spaces'),
                    'url'  => route('space.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Space Management")
        ];

        return view('Points::admin.points.item_point', $data);
    }

    public function set_items_point(Request $request)
    {
        $items = Space::whereBetween('price', [$request->min_price, $request->max_price])->get();
        foreach ($items as $item) {
            $item->earn_point = $request->point;
            $item->save();
        }
        return redirect()->route('points.admin.item_point')->with('success', __('Updated Successfully') );
    }

    public function set_all_items_point(Request $request)
    {
        $items = Space::all();
        foreach ($items as $item) {
            $item->earn_point = $request->point;
            $item->save();
        }
        return redirect()->route('points.admin.item_point')->with('success', __('Updated Successfully') );
    }


}
