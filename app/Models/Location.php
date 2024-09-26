<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Concession;



class Location extends Model
{
    use HasFactory; 
    use Sluggable;

    protected $table = 'locations';

    protected $fillable = [
        'idLocation',
        'user_type',
        'user_id',
        'modele',
        'slug',
        'annee',
        'Kilometrage',
        'description',
        'equipements',
        'accesoires',
        'immatriculation',
        'annee_circulation',
        'date_assurance_debut',
        'date_assurance_fin',
        'image_assurance',
        'location_images',
        'category',
        'subcategory',
        'prix',
        'dernier_prix',
        'visibility',
    ];

   


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'modele'
            ]
        ];
    }

    public function concession()
    {
        return $this->belongsTo(Concession::class, 'user_id', 'user_id');
    }

// Modèle Location.php
public function getWhatsappLinkAttribute()
{
    $numeroWhatsapp = $this->concession->concession_phone;
    $messageWhatsapp = "Bonjour, je suis intéressé par la location de votre {$this->subcategory} {$this->modele} qui est de Prix: {$this->prix} FCFA";

    // Filtrage pour éviter les XSS
    $numeroEncrypted = preg_replace('/[^0-9]/', '', $numeroWhatsapp);
    $messageEncrypted = urlencode($messageWhatsapp);

    return "https://wa.me/$numeroEncrypted/?text=$messageEncrypted";
}

   public static function getLocationSevenPrices()
    {
        return self::query()
            ->select('prix')
            ->distinct()
            ->orderBy('prix', 'asc') // Trier par prix croissant
            ->limit(7)
            ->pluck('prix');
    }

    
}

