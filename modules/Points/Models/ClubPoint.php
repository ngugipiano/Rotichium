<?php
namespace Modules\Points\Models;

use App\BaseModel;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Booking\Models\Booking;
use Modules\User\Models\User;

class ClubPoint extends BaseModel
{
    // use SoftDeletes;
    // protected $table = 'core_news';
    // protected $fillable = [
    //     'title',
    //     'content',
    //     'status',
    //     'cat_id',
    //     'image_id'
    // ];

    public function user(){
    	return $this->belongsTo(user::class);
    }

    public function order(){
    	return $this->belongsTo(Booking::class);
    }

}
