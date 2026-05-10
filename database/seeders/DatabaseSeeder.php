<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Client, Produit, Alternative, Defi, Badge};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Badges
        $badges = [
            ['nom'=>'Premier Scan',      'icone'=>'🌱','description'=>'Votre premier scan !',       'points_requis'=>2],
            ['nom'=>'Éco-Curieux',       'icone'=>'🔍','description'=>'10 produits scannés.',        'points_requis'=>20],
            ['nom'=>'Champion Vert',     'icone'=>'🏆','description'=>'100 points accumulés.',       'points_requis'=>100],
            ['nom'=>'Sauveur Planète',   'icone'=>'🌍','description'=>'1 kg CO₂ économisé.',        'points_requis'=>50],
            ['nom'=>'Master Zéro Déchet','icone'=>'♻️','description'=>'500 points — niveau expert.','points_requis'=>500],
        ];
        foreach ($badges as $b) Badge::create($b);

        // Admin
        Client::create([
            'nom'=>'Admin','prenom'=>'Zéro Déchet',
            'email'=>'admin@zerodechet.tn',
            'password'=>Hash::make('admin123'),
            'is_admin'=>true,
        ]);

        // Utilisateurs test
        foreach ([
            ['nom'=>'Jridi',   'prenom'=>'Bayram',   'email'=>'bayram@test.tn'],
            ['nom'=>'Boukhris','prenom'=>'Mouhamed',  'email'=>'mouhamed@test.tn'],
            ['nom'=>'Mezghich','prenom'=>'Rayen',     'email'=>'rayen@test.tn'],
        ] as $u) {
            Client::create(array_merge($u,['password'=>Hash::make('password123')]));
        }

        // Produits
        $produits = [
            ['codeBarres'=>'3760020509350','nom'=>'Lait Bio Organic',     'marque'=>'Organic', 'categorie'=>'Alimentaire','score_eco'=>85,'co2_kg'=>0.34,'description'=>'Lait issu de l\'agriculture biologique.'],
            ['codeBarres'=>'3017620425035','nom'=>'Nutella',              'marque'=>'Ferrero', 'categorie'=>'Alimentaire','score_eco'=>22,'co2_kg'=>1.21,'description'=>'Pâte à tartiner chocolat-noisette.'],
            ['codeBarres'=>'5449000000996','nom'=>'Coca-Cola 50cl',       'marque'=>'Coca-Cola','categorie'=>'Boissons',  'score_eco'=>18,'co2_kg'=>0.35,'description'=>'Boisson gazeuse en plastique.'],
            ['codeBarres'=>'3329770043871','nom'=>'Eau Minérale Salima',  'marque'=>'Salima',  'categorie'=>'Boissons',  'score_eco'=>45,'co2_kg'=>0.12,'description'=>'Eau minérale naturelle.'],
            ['codeBarres'=>'3574661385891','nom'=>'Shampoing Solide Bio', 'marque'=>'Lush',    'categorie'=>'Cosmétiques','score_eco'=>92,'co2_kg'=>0.08,'description'=>'Shampoing solide sans plastique.'],
            ['codeBarres'=>'3600541916548','nom'=>'Shampoing Elsève',     'marque'=>"L'Oréal", 'categorie'=>'Cosmétiques','score_eco'=>35,'co2_kg'=>0.42,'description'=>'Shampoing en flacon plastique.'],
            ['codeBarres'=>'3574660221015','nom'=>'Dentifrice Naturel',   'marque'=>'Lamazuna','categorie'=>'Hygiène',   'score_eco'=>88,'co2_kg'=>0.05,'description'=>'Dentifrice en pastilles zéro déchet.'],
            ['codeBarres'=>'3614226731128','nom'=>'Déodorant Spray Axe',  'marque'=>'Axe',     'categorie'=>'Hygiène',   'score_eco'=>28,'co2_kg'=>0.55,'description'=>'Déodorant aérosol.'],
            ['codeBarres'=>'3411120009342','nom'=>'Lessive Eco Recharge', 'marque'=>'Ecover',  'categorie'=>'Ménager',   'score_eco'=>80,'co2_kg'=>0.18,'description'=>'Lessive végétale en recharge.'],
            ['codeBarres'=>'3011090005073','nom'=>'Lessive Ariel Liquide','marque'=>'Ariel',   'categorie'=>'Ménager',   'score_eco'=>30,'co2_kg'=>0.75,'description'=>'Lessive liquide en gros flacon.'],
        ];
        foreach ($produits as $p) Produit::create($p);

        // Alternatives
        $alts = [
            ['produit_id'=>'3017620425035','nom'=>'Purée d\'Amandes Bio', 'marque'=>'Jean Hervé','score_eco'=>75,'lien'=>null],
            ['produit_id'=>'3017620425035','nom'=>'Chocolat Noir 70%',    'marque'=>'Alter Eco', 'score_eco'=>68,'lien'=>null],
            ['produit_id'=>'5449000000996','nom'=>'Eau du Robinet filtrée','marque'=>null,        'score_eco'=>95,'lien'=>null],
            ['produit_id'=>'3600541916548','nom'=>'Shampoing Solide Lush', 'marque'=>'Lush',      'score_eco'=>92,'lien'=>null],
            ['produit_id'=>'3614226731128','nom'=>'Pierre d\'Alun',        'marque'=>'Lamazuna',  'score_eco'=>96,'lien'=>null],
            ['produit_id'=>'3011090005073','nom'=>'Lessive Poudre DIY',    'marque'=>'Fait maison','score_eco'=>90,'lien'=>null],
        ];
        foreach ($alts as $a) Alternative::create($a);

        // Défis
        $defis = [
            ['titre'=>'Semaine Sans Plastique',  'description'=>'Évitez tout emballage plastique pendant 7 jours.',    'points_recompense'=>50,'date_fin'=>now()->addDays(14)],
            ['titre'=>'Zéro Déchet au Marché',   'description'=>'Faites vos courses avec sac réutilisable et en vrac.','points_recompense'=>30,'date_fin'=>now()->addDays(7)],
            ['titre'=>'5 Produits Écologiques',  'description'=>'Scannez 5 produits avec score > 75 ce mois-ci.',      'points_recompense'=>40,'date_fin'=>now()->addDays(21)],
            ['titre'=>'Compostage Débutant',      'description'=>'Commencez le compostage pendant 2 semaines.',         'points_recompense'=>60,'date_fin'=>now()->addDays(30)],
            ['titre'=>'Sensibilisation Amis',     'description'=>'Invitez 3 amis à rejoindre Zéro Déchet.',             'points_recompense'=>25,'date_fin'=>now()->addDays(10)],
        ];
        foreach ($defis as $d) Defi::create($d);
    }
}
