<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Concession;


class Vendre extends Model
{
    use HasFactory;
    use Sluggable;

protected $table = 'vendres';

    protected $fillable = [
        'idVendre',
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
        'carburant',
        'transmission',
        'etatvehicule',
        'couleurint',
        'couleurext',
        'image_viste',
        'imagevehiculevente',
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

    public function getWhatsappLinkAttribute()
{
    $numeroWhatsapp = $this->concession->concession_phone;
    $messageWhatsapp = "Bonjour, je suis intéressé par l'achat de votre {$this->subcategory} {$this->modele} qui est de Prix: {$this->prix} FCFA";

    // Filtrage pour éviter les XSS
    $numeroEncrypted = preg_replace('/[^0-9]/', '', $numeroWhatsapp);
    $messageEncrypted = urlencode($messageWhatsapp);

    return "https://wa.me/$numeroEncrypted/?text=$messageEncrypted";
}

 public static function getVenteSevenPrices()
    {
        return self::query()
            ->select('prix')
            ->distinct()
            ->orderBy('prix', 'asc') // Trier par prix croissant
            ->limit(7)
            ->pluck('prix');
    }

}
