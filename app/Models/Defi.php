<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Defi extends Model
{
    protected $fillable = ['titre','description','points_recompense','date_fin','image'];
    protected $casts    = ['date_fin' => 'date'];

    public function participations()
    {
        return $this->hasMany(Participation::class, 'defi_id');
    }

    public function estActif(): bool
    {
        return $this->date_fin->isFuture();
    }
}
