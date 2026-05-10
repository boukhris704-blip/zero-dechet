<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'nom', 'prenom', 'email', 'password',
        'points', 'co2_economise', 'photo', 'is_admin',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'is_admin'      => 'boolean',
        'co2_economise' => 'decimal:2',
    ];

    public function scans()
    {
        return $this->hasMany(Scan::class, 'utilisateur_id');
    }

    public function participations()
    {
        return $this->hasMany(Participation::class, 'utilisateur_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges', 'utilisateur_id', 'badge_id')
                    ->withTimestamps();
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function statistiques()
    {
        return $this->hasMany(StatistiqueEco::class, 'utilisateur_id');
    }

    public function scannerSessions()
    {
        return $this->hasMany(ScannerSession::class, 'utilisateur_id');
    }

    public function ajouterPoints(int $pts): void
    {
        $this->increment('points', $pts);
        $this->verifierBadges();
    }

    public function verifierBadges(): void
    {
        $this->refresh();
        $badges = Badge::where('points_requis', '<=', $this->points)->get();
        foreach ($badges as $badge) {
            $this->badges()->syncWithoutDetaching([$badge->id]);
        }
    }
}
