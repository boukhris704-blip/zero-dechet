<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $fillable = ['produit_id','nom','marque','score_eco','lien'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id', 'codeBarres');
    }
}
