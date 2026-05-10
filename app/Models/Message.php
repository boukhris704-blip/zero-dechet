<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['expediteur_id','destinataire_id','contenu','lu'];
    protected $casts    = ['lu' => 'boolean'];

    public function expediteur()   { return $this->belongsTo(Client::class, 'expediteur_id'); }
    public function destinataire() { return $this->belongsTo(Client::class, 'destinataire_id'); }
}
