<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $fillable = ['utilisateur_id','produit_id'];

    public function utilisateur()
    {
        return $this->belongsTo(Client::class, 'utilisateur_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id', 'codeBarres');
    }
}
