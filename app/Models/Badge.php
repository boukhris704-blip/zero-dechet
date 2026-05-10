<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['nom','description','icone','points_requis'];

    public function utilisateurs()
    {
        return $this->belongsToMany(Client::class, 'user_badges', 'badge_id', 'utilisateur_id')
                    ->withTimestamps();
    }
}
