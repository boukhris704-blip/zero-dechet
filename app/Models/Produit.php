<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table      = 'produits';
    protected $primaryKey = 'codeBarres';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'codeBarres','nom','marque','categorie',
        'score_eco','co2_kg','description','image',
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'produit_id', 'codeBarres');
    }

    public function scans()
    {
        return $this->hasMany(Scan::class, 'produit_id', 'codeBarres');
    }

    public function getNiveauAttribute(): string
    {
        return match(true) {
            $this->score_eco >= 80 => 'Excellent',
            $this->score_eco >= 60 => 'Bon',
            $this->score_eco >= 40 => 'Moyen',
            default                => 'Mauvais',
        };
    }

    public function getCouleurAttribute(): string
    {
        return match(true) {
            $this->score_eco >= 80 => 'success',
            $this->score_eco >= 60 => 'info',
            $this->score_eco >= 40 => 'warning',
            default                => 'danger',
        };
    }
}
