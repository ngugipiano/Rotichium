<?php

namespace Modules\User\Models;

use App\BaseModel;

class PackageTranslation extends BaseModel
{
    protected $fillable = ['name', 'package_id', 'amount', 'status','commission', 'item_upload_limit', 'duration', 'create_user', 'update_user'];

    public function user_package(){
      return $this->belongsTo(Package::class);
    }
}
