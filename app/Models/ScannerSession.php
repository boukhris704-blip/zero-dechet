<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ScannerSession extends Model
{
    protected $table    = 'scanner_sessions';
    protected $fillable = ['utilisateur_id','token','code_barre','consomme','expires_at'];
    protected $casts    = ['consomme' => 'boolean', 'expires_at' => 'datetime'];

    public function utilisateur() { return $this->belongsTo(Client::class, 'utilisateur_id'); }

    public function estValide(): bool
    {
        return !$this->consomme && $this->expires_at->isFuture();
    }
}
