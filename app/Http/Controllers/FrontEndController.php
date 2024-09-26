<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Category;
use App\Models\Vendre;


class FrontEndController extends Controller
{
    public function homePage(Request $request){
        $data = [
            'pageTitle'=>'MONAUTO | VENTE & ACHAT DE VEHICULE',
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'prices' => Vendre::getVenteSevenPrices(),
            'prix' => Location::getLocationSevenPrices(),
            'vehicles' => Vendre::orderBy('created_at', 'desc')->limit(9)->get()

        ];
        
        return view('front.pages.home',$data);
    }

     public function ListLocationPage(Request $request){
        $data = [
            'pageTitle'=>'Location'
        ];
        
        return view('front.pages.location-vehicule',$data);
    }
    
    public function PolitiqueConfidentialite(Request $request){
        $data = [
            'pageTitle'=>'Politique De Confidentialite'
        ];
        
        return view('front.pages.politique-confidentialite',$data);
    }
    
    public function ConditionsGenerales(Request $request){
        $data = [
            'pageTitle'=>'Conditions Generales'
        ];
        
        return view('front.pages.conditions-generales',$data);
    }

    public function ListVentePage(Request $request){
        $data = [
            'pageTitle'=>'vente'
        ];
        
        return view('front.pages.vente-vehicule',$data);
    }

    public function DetailVente($idVendre)
    {
         $vendre = Vendre::where('idVendre', $idVendre)->firstOrFail();
         $data = [
            'pageTitle'=>'Detail Vehicule',
             'vendre'=>$vendre
        ];
        
        return view('front.pages.detail-vehicule',$data);
    }

     public function DetailLocation($idLocation)
        {
            $location = Location::where('idLocation', $idLocation)->firstOrFail();
            $data = [
                'pageTitle' => 'Détail Véhicule',
                'location' => $location
            ];

            return view('front.pages.detail-location', $data);
        }


    
}
