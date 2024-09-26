<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Location;
use App\Rules\ValidatePrice;
use App\Models\Concession;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Toastr;

class LocationController extends Controller
{
    public function addLocation(Request $request)
    {
        $data = [
            'pageTitle' => 'Location Vehicule',
            'categories' => Category::orderBy('category_name', 'asc')->get()
        ];
        return view('back.pages.user.add-location', $data);
    } 

     public function getLocationCategory(Request $request)
        {
            
            $category_name = $request->category_name;
            $category = Category::where('category_name', $category_name)->firstOrFail();

            $subcategories = SubCategory::where('category_id', $category->id)
                ->where('is_child_of', 0)
                ->orderBy('subcategory_name', 'asc')
                ->get();

            $html = '';
            foreach ($subcategories as $item) {
                $html .= '<option value="' . $item->subcategory_name . '">' . $item->subcategory_name . '</option>';
                if (count($item->children) > 0) {
                    foreach ($item->children as $child) {
                        $html .= '<option value="' . $child->id . '">-- ' . $child->subcategory_name . '</option>';
                    }
                }
            }

            return response()->json(['status' => 1, 'data' => $html]);
        }


     public function createLocation(Request $request) 
        { 
            /**
            * VALIDER LE FORMULAIRE
            * ------------------
            */
             try {
                 // Vérifier si l'utilisateur a une concession
                $userId = auth('user')->id();
                $concession = Concession::where('user_id', $userId)->first();
                if (!$concession) {
                    // Retourner une réponse JSON avec une indication pour rediriger
                    return redirect()->route('user.concession-settings')
                              ->with('success','Merci! Veuillez créer un compte concessionaire avant.');
                }

            $request->validate([
                'modele' => 'required',
                'annee' => 'required',
                'kilometrage' => 'required',
                'description' => 'required|min:50',
                'equipements' => 'required',
                'accesoires' => 'required',
                'immatriculation' => 'required',
                'annee_circulation' => 'required',
                'date_assurance_debut' => 'required',
                'date_assurance_fin' => 'required',
                'image_assurance' => 'required|mimes:png,jpg,jpeg|max:1024',
                'location_images' => 'required',
                'location_images.*' => 'required|mimes:png,jpg,jpeg|max:3024',
                'category' => 'required',
                'subcategory' => 'required',
                'prix' => ['required', new ValidatePrice],
                'dernier_prix' => ['nullable', new ValidatePrice],
            ], [
                'modele.required' => 'Veuillez saisir un modèle de véhicule.',
                'annee.required' => 'Veuillez saisir l\'année du véhicule.',
                'kilometrage.required' => 'Veuillez saisir le kilométrage du véhicule.',
                'description.required' => 'Veuillez saisir une description du véhicule.',
                'description.min' => 'Veuillez saisir une description du véhicule de plus de 50 caractere.',
                'equipements.required' => 'Veuillez sélectionner les équipements du véhicule.',
                'accesoires.required' => 'Veuillez sélectionner les accessoires du véhicule.',
                'immatriculation.required' => 'Veuillez saisir le numéro d\'immatriculation du véhicule.',
                'annee_circulation.required' => 'Veuillez saisir l\'année de mise en circulation du véhicule.',
                'date_assurance_debut.required' => 'Veuillez saisir la date de début d\'assurance du véhicule.',
                'date_assurance_fin.required' => 'Veuillez saisir la date de fin d\'assurance du véhicule.',
                'image_assurance.required' => 'Veuillez télécharger la carte d\'assurance du véhicule.',
                'location_images.required' => 'Veuillez télécharger au moins 1 image.',
                'location_images.*.required' => 'Le fichier est trop volumineux.',
                'category.required' => 'Veuillez sélectionner la catégorie du véhicule.',
                'subcategory.required' => 'Veuillez sélectionner la sous-catégorie du véhicule.',
                'prix.required' => 'Veuillez saisir le prix de location du véhicule.',
            ]);

            // Traiter l'image d'assurance
            $imageAssurance = null;
            if ($request->hasFile('image_assurance')) {
                $path = 'images/Locations/carte_assurance/';
                $file = $request->file('image_assurance');
                $filename = uniqid('assurance_') . '.' . $file->getClientOriginalExtension();

                $upload = $file->move(public_path($path), $filename);

                if ($upload) {
                    $imageAssurance = $filename;
                }
            }

            // Traiter les images de la location avec Dropzone
            $imageFilenames = [];
            if ($request->hasFile('location_images')) {
                

                $files = $request->file('location_images');

                foreach ($files as $file) {
                    
                        $extension = $file->getClientOriginalExtension();
                        $filename = uniqid('location_image_' . time()) . '.' . $extension;
                        $file->move(public_path('images/locations/'), $filename);
                        $imageFilenames[] = $filename;
                    
                }
            }


           $subcategory = $request->subcategory;

            // Vérifiez si $subcategory est un objet
            if (is_object($subcategory)) {
                $subcategoryName = $subcategory->subcategory_name;
            } else {
                // Si $subcategory est une chaîne de caractères, utilisez-la directement
                $subcategoryName = $subcategory;
            }
            

            // Générer l'identifiant unique
            $uniqueId = uniqid();
            $idLocation = strtolower($subcategoryName . '_' . $request->modele . '_' . $uniqueId);

            $equipements = implode(', ', $request->input('equipements', []));
            $accesoires = implode(', ', $request->input('accesoires', []));
            

            // Enregistrer les détails de la location
            $location = new Location();
            $location->idLocation = $idLocation;
            $location->user_type = 'user';
            $location->user_id = auth('user')->id();
            $location->modele = $request->modele;
            $location->annee = $request->annee;
            $location->kilometrage = $request->kilometrage;
            $location->description = $request->description;
            $location->equipements = $equipements;  
            $location->accesoires = $accesoires; 
            $location->immatriculation = $request->immatriculation;
            $location->annee_circulation = $request->annee_circulation;
            $location->date_assurance_debut = $request->date_assurance_debut;
            $location->date_assurance_fin = $request->date_assurance_fin;
            $location->image_assurance = $imageAssurance;
            $location->location_images = json_encode($imageFilenames);
            $location->category = $request->category;
            $location->subcategory = $request->subcategory;
            $location->prix = $request->prix;
            $location->dernier_prix = $request->dernier_prix;
            $location->visibility = $request->visibility;


            $saved = $location->save();

            if ($saved) {
               return redirect()->route('user.location.all-locations')
                              ->with('success','Le vehicule a été  ajoute avec succès.');
            } else {
               return response()->json(['status' => 0, 'msg' => 'Quelque chose s\'est mal passé lors de la création de la location reessayer.']);
            }
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors(), 400);
        }
    }



    public function allLocations(Request $request)
    {
                    $data = [
                        'pageTitle'=>'Mes Vehicule En Location'
                    ];
                    return view('back.pages.user.locations',$data);
    }

     public function editLocation($idLocation)
              {
                $location = Location::where('idLocation', $idLocation)->firstOrFail();

                $categories = Category::orderBy('category_name','asc')->get();
                $subcategories = SubCategory::where('category_id',$location->category)
                                            ->where('is_child_of',0)
                                            ->orderBy('subcategory_name','asc')
                                            ->get();
                    $data = [
                        'pageTitle'=>'Modifier Vehicule',
                        'categories'=>$categories,
                        'subcategories'=>$subcategories,
                        'location'=>$location
                    ];
                    return view('back.pages.user.modifier-location',$data);
            }

            public function updateLocation(Request $request)
             {
                 $location = Location::findOrFail(($request->id));
                    /**
                    * VALIDER LE FORMULAIRE
                    * ------------------
                    */
                    $request->validate([
                        'modele' => 'required',
                        'annee' => 'required',
                        'kilometrage' => 'required',
                        'description' => 'required|min:50',
                        'equipements' => 'required',
                        'accesoires' => 'required',
                        'immatriculation' => 'required',
                        'annee_circulation' => 'required',
                        'date_assurance_debut' => 'required',
                        'date_assurance_fin' => 'required',
                        'image_assurance' => 'nullable|mimes:png,jpg,jpeg|max:1024',
                        'location_images' => 'nullable',
                        'location_images.*' => 'nullable|mimes:png,jpg,jpeg|max:3024',
                        'category' => 'required',
                        'subcategory' => 'required',
                        'prix' => ['required', new ValidatePrice],
                        'dernier_prix' => ['nullable', new ValidatePrice],
                    ], [
                        'modele.required' => 'Veuillez saisir un modèle de véhicule.',
                        'annee.required' => 'Veuillez saisir l\'année du véhicule.',
                        'kilometrage.required' => 'Veuillez saisir le kilométrage du véhicule.',
                        'description.required' => 'Veuillez saisir une description du véhicule.',
                        'equipements.required' => 'Veuillez sélectionner les équipements du véhicule.',
                        'accesoires.required' => 'Veuillez sélectionner les accessoires du véhicule.',
                        'immatriculation.required' => 'Veuillez saisir le numéro d\'immatriculation du véhicule.',
                        'annee_circulation.required' => 'Veuillez saisir l\'année de mise en circulation du véhicule.',
                        'date_assurance_debut.required' => 'Veuillez saisir la date de début d\'assurance du véhicule.',
                        'date_assurance_fin.required' => 'Veuillez saisir la date de fin d\'assurance du véhicule.',
                        'image_assurance.required' => 'Veuillez télécharger la carte d\'assurance du véhicule.',
                        'location_images.required' => 'Veuillez télécharger au moins 1 image.',
                        'location_images.*.required' => 'Le fichier est trop volumineux.',
                        'category.required' => 'Veuillez sélectionner la catégorie du véhicule.',
                        'subcategory.required' => 'Veuillez sélectionner la sous-catégorie du véhicule.',
                        'prix.required' => 'Veuillez saisir le prix de location du véhicule.',
                    ]);


                        
                        if ($request->hasFile('image_assurance')) {
                            $path = 'images/Locations/carte_assurance/';
                            $file = $request->file('image_assurance');
                            $filename = date('assurance_') . '.' . $file->getClientOriginalExtension();
                            $old_image_assurance = $location->image_assurance;

                            $upload = $file->move(public_path($path), $filename);

                            if ($upload) {
                                 if( File::exists(public_path($path.$old_image_assurance)) ){
                                    File::delete(public_path($path.$old_image_assurance));
                                }
                                $imageAssurance = $filename;
                            }
                        } else {
                            $imageAssurance = $location->image_assurance;
                        }

                        
                        $imageFilenames = [];
                        if ($request->hasFile('location_images')) {
                        $path = 'images/locations/';
                        $old_location_images = $location->location_images;

                        foreach ($request->file('location_images') as $file) {
                                $extension = $file->getClientOriginalExtension();
                                $filename = uniqid('Vente_image_' . time()) . '.' . $extension;

                                $upload = $file->move(public_path($path), $filename);

                                if ($upload) {
                                 if( File::exists(public_path($path.$old_location_images)) ){
                                    File::delete(public_path($path.$old_location_images));
                                }
                                $imageFilenames[] = $filename;
                            }
                                
                        
                        }
                    }else {
                        $imageFilenames = json_decode($location->location_images);
                    }


                        // recupere la marque du vehicule

                        $subcategory = $request->subcategory;

                        // Vérifiez si $subcategory est un objet
                        if (is_object($subcategory)) {
                            $subcategoryName = $subcategory->subcategory_name;
                        } else {
                            // Si $subcategory est une chaîne de caractères, utilisez-la directement
                            $subcategoryName = $subcategory;
                        }
                

                        // Générer l'identifiant unique
                        $uniqueId = uniqid();
                        $idLocation = strtolower($subcategoryName . '_' . $request->modele . '_' . $uniqueId);

                        $equipements = implode(', ', $request->input('equipements', []));
                        $accesoires = implode(', ', $request->input('accesoires', []));


                        // ENREGISTRER LES DÉTAILS DE LA VENTE
                        $location->idLocation = $idLocation;
                        $location->user_type = 'user';
                        $location->user_id = auth('user')->id();
                        $location->modele = $request->modele;
                        $location->annee = $request->annee;
                        $location->kilometrage = $request->kilometrage;
                        $location->description = $request->description;
                        $location->equipements = $equipements;  
                        $location->accesoires = $accesoires; 
                        $location->immatriculation = $request->immatriculation;
                        $location->annee_circulation = $request->annee_circulation;
                        $location->date_assurance_debut = $request->date_assurance_debut;
                        $location->date_assurance_fin = $request->date_assurance_fin;
                        $location->image_assurance = $imageAssurance;
                        $location->location_images = json_encode($imageFilenames);
                        $location->category = $request->category;
                        $location->subcategory = $request->subcategory;
                        $location->prix = $request->prix;
                        $location->dernier_prix = $request->dernier_prix;
                        $location->visibility = $request->visibility;


                        $saved = $location->save();

                        if ($saved) {
                           return redirect()->route('user.location.all-locations',['idLocation'=>$location->idLocation])
                              ->with('success','Le vehicule a été mis à jour avec succès.');
                        } else {
                            return response()->json(['status' => 0, 'msg' => 'Une erreur est survenue lors de la mise à jour de la location.']);
                        }
        }

           public function deleteLocation(Request $request)
            {
                $location = Location::findOrFail($request->id);

                // Supprimer l'image visite
                $pathVisite = 'images/Locations/carte_assurance/';
                if ($location->image_assurance && File::exists(public_path($pathVisite . $location->image_assurance))) {
                    File::delete(public_path($pathVisite . $location->image_assurance));
                }

                // Supprimer les images de véhicule à location
                $pathLocation = 'images/locations/';
                if ($location->location_images) {
                    $imageFilenames = json_decode($location->location_images);
                    foreach ($imageFilenames as $filename) {
                        if (File::exists(public_path($pathLocation . $filename))) {
                            File::delete(public_path($pathLocation . $filename));
                        }
                    }
                }

                // Supprimer l'enregistrement location
                $delete = $location->delete();

                if ($delete) {
                    return response()->json(['status' => 1, 'msg' => 'La location et ses images associées ont été supprimées avec succès.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Une erreur est survenue lors de la suppression de la vente.']);
                }
         }
}


       
