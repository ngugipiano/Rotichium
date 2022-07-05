<?php
namespace Modules\Chat\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class ChatThread extends BaseModel
{

    use SoftDeletes;
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }

    public function blocked_by()
    {
        return $this->belongsTo(User::class, 'blocked_by_user');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


}
