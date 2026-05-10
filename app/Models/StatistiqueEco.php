<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StatistiqueEco extends Model
{
    protected $table    = 'statistiques_eco';
    protected $fillable = ['utilisateur_id','annee','mois','nb_scans','co2_economise','score_moyen'];

    public function utilisateur() { return $this->belongsTo(Client::class, 'utilisateur_id'); }
}
