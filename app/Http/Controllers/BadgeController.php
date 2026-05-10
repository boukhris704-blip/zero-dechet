<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;

class BadgeController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('badges');
        $tousBadges = Badge::orderBy('points_requis')->get();
        $obtenus = $user->badges->pluck('id')->toArray();
        return view('badges.index', compact('tousBadges', 'obtenus', 'user'));
    }
}
