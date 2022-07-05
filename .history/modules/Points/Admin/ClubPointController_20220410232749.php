<?php
namespace Modules\Points\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\Points\Models\ClubPoint;
use Modules\Points\Models\NewsCategory;
use Modules\Points\Models\NewsTranslation;

class ClubPointController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('points.admin.index'));
        parent::__construct();
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
            "locale"=>\App::getLocale(),
            'page_title'=>__("Club Points")
        ];
        return view('Points::admin.points.index', $data);
    }
    public function configure_index()
    {
        return view('Points::admin.points.config', $data);
    }

    public function store(Request $request, $id){
        if(is_demo_mode()){
            return redirect()->back('danger',__("DEMO MODE: Disable update"));
        }
        if($id>0){
            $this->checkPermission('news_update');
            $row = News::find($id);
            if (empty($row)) {
                return redirect(route('news.admin.index'));
            }
        }else{
            $this->checkPermission('news_create');
            $row = new News();
            $row->status = "publish";
        }

        $row->fill($request->input());
        if($request->input('slug')){
            $row->slug = $request->input('slug');
        }
        $res = $row->saveOriginOrTranslation($request->query('lang'),true);

        if ($res) {
            if(is_default_lang($request->query('lang'))){
                $row->saveTag($request->input('tag_name'), $request->input('tag_ids'));
            }
            if($id > 0 ){
                return back()->with('success',  __('News updated') );
            }else{
                return redirect(route('news.admin.edit',$row->id))->with('success', __('News created') );
            }
        }
    }

    public function bulkEdit(Request $request)
    {
        if(is_demo_mode()){
            return redirect()->back('danger',__("DEMO MODE: Disable update"));
        }
        $this->checkPermission('news_update');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = News::where("id", $id);
                if (!$this->hasPermission('news_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('news_delete');
                }
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = News::where("id", $id);
                if (!$this->hasPermission('news_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('news_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function trans($id,$locale){
        $row = News::find($id);

        if(empty($row)){
            return redirect()->back()->with("danger",__("News does not exists"));
        }

        $translated = News::query()->where('origin_id',$id)->where('lang',$locale)->first();
        if(!empty($translated)){
            redirect($translated->getEditUrl());
        }

        $language = Language::where('locale',$locale)->first();
        if(empty($language)){
            return redirect()->back()->with("danger",__("Language does not exists"));
        }

        $new = $row->replicate();

        if(!$row->origin_id){
            $new->origin_id = $row->id;
        }

        $new->lang = $locale;

        $new->save();


        return redirect($new->getEditUrl());
    }
}
