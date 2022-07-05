<?php

namespace Modules\User\Models;

use App\BaseModel;

class PackageTranslation extends BaseModel
{
    protected $fillable = ['name', 'lang', 'package_id'];

    public function user_package(){
      return $this->belongsTo(Package::class);
    }
}
