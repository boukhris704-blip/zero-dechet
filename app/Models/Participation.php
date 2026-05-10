<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = ['utilisateur_id','defi_id','complete'];
    protected $casts    = ['complete' => 'boolean'];

    public function utilisateur() { return $this->belongsTo(Client::class, 'utilisateur_id'); }
    public function defi()        { return $this->belongsTo(Defi::class); }
}
