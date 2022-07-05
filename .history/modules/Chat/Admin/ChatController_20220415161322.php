<?php
namespace Modules\Chat\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\News;
use Modules\News\Models\NewsTranslation;

class NewsController extends AdminController
{
