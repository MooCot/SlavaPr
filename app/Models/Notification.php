<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function create(string $title, string $text, int $user_id) {
        $notification = new Notification();
        $notification->title = $title;
        $notification->text = $text;
        $notification->user_id = $user_id;
        $notification->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $notification->updated_at = date('Y-m-d H:i:s', strtotime(now()));
        $notification->save(); 
    }
}
