<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendre;
use App\Models\Concession;
use App\Rules\ValidatePrice;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Toastr;


class VendreController extends Controller
{
            public function addVehicule(Request $request)
            {
                $data = [
                    'pageTitle' => 'Vendre Vehicule',
                    'categories' => Category::orderBy('category_name', 'asc')->get()
                ];
                return view('back.pages.user.add-vehicule', $data);
            } 

            public function getVendreCategory(Request $request)
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


            public function createVendre(Request $request) 
            {
                    /**
                    * VALIDER LE FORMULAIRE
                    * ------------------
                    */

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
                        'carburant' => 'required',
                        'transmission' => 'required',
                        'etatvehicule' => 'required',
                        'couleurint' => 'required',
                        'couleurext' => 'required',
                        'image_viste' => 'required|mimes:png,jpg,jpeg|max:1024',
                        'imagevehiculevente' => 'required',
                        'imagevehiculevente.*' => 'required|mimes:png,jpg,jpeg|max:3024',
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
                        'carburant.required' => 'Veuillez saisir le type carburant du véhicule.',
                        'transmission.required' => 'Veuillez saisir la transmission du véhicule.',
                        'etatvehicule.required' => 'Veuillez saisir l\' etat du véhicule.',
                        'couleurint.required' => 'Veuillez saisir couleur interrieur du véhicule.',
                        'couleurext.required' => 'Veuillez saisir couleur exterrieur du véhicule.',
                        'image_viste.required' => 'Veuillez télécharger la carte de visite du véhicule.',
                        'imagevehiculevente.required' => 'Veuillez télécharger au moins 1 image.',
                        'imagevehiculevente.*.required' => 'le fichers est trop volumineux.',
                        'category.required' => 'Veuillez sélectionner la catégorie du véhicule.',
                        'subcategory.required' => 'Veuillez sélectionner la sous-catégorie du véhicule.',
                        'prix.required' => 'Veuillez saisir le prix du véhicule.',
                    ]);


                        $imageViste = null;
                        if ($request->hasFile('image_viste')) {
                            $path = 'images/Vendre/image_viste/';
                            $file = $request->file('image_viste');
                            $filename = uniqid('Visite') . '.' . $file->getClientOriginalExtension();

                            $upload = $file->move(public_path($path), $filename);

                            if ($upload) {
                                $imageViste = $filename;
                            }
                        }

                        $imageVehicule = [];
                        if ($request->hasFile('imagevehiculevente')) {
                        $files = $request->file('imagevehiculevente');

                        foreach ($files as $file) {
                                $extension = $file->getClientOriginalExtension();
                                $filename = uniqid('Vente_image_' . time()) . '.' . $extension;

                                $file->move(public_path('images/Vendre'), $filename);
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
                        $idVendre = strtolower($subcategoryName . '_' . $request->modele . '_' . $uniqueId);

                        $equipements = implode(', ', $request->input('equipements', []));
                        $accesoires = implode(', ', $request->input('accesoires', []));


                        // ENREGISTRER LES DÉTAILS DE LA VENTE
                        $vendre = new Vendre();
                        $vendre->idVendre = $idVendre;
                        $vendre->user_type = 'user';
                        $vendre->user_id = auth('user')->id();
                        $vendre->modele = $request->modele;
                        $vendre->annee = $request->annee;
                        $vendre->kilometrage = $request->kilometrage;
                        $vendre->description = $request->description;
                        $vendre->equipements = $equipements;
                        $vendre->accesoires = $accesoires;
                        $vendre->immatriculation = $request->immatriculation;
                        $vendre->carburant = $request->carburant;
                        $vendre->transmission = $request->transmission;
                        $vendre->etatvehicule = $request->etatvehicule;
                        $vendre->couleurint = $request->couleurint;
                        $vendre->couleurext = $request->couleurext;
                        $vendre->image_viste = $imageViste;
                        $vendre->imagevehiculevente = json_encode($imageFilenames);
                        $vendre->category = $request->category;
                        $vendre->subcategory = $request->subcategory;
                        $vendre->prix = $request->prix;
                        $vendre->dernier_prix = $request->dernier_prix;
                        $vendre->visibility = $request->visibility;

                        $saved = $vendre->save();

                        if ($saved) {
                            
                            return redirect()->route('user.vendre.all-vendres')
                               ->with('success','Le vehicule a été ajoute avec succès.');
                        
                            } else {
                                return response()->json(['status' => 0, 'msg' => 'Quelque chose s\'est mal passé lors de la création du produit.']);
                            }
            }


            public function allVentes(Request $request)
               {
                    $data = [
                        'pageTitle'=>'Mes Vehicule En vente'
                    ];
                    return view('back.pages.user.ventes',$data);
            } //End Method



            public function editVentes($idVendre)
              {
                $vendre = Vendre::where('idVendre', $idVendre)->firstOrFail();

                $categories = Category::orderBy('category_name','asc')->get();
                $subcategories = SubCategory::where('category_id',$vendre->category)
                                            ->where('is_child_of',0)
                                            ->orderBy('subcategory_name','asc')
                                            ->get();
                    $data = [
                        'pageTitle'=>'Modifier Vehicule',
                        'categories'=>$categories,
                        'subcategories'=>$subcategories,
                        'vendre'=>$vendre
                    ];
                    return view('back.pages.user.modifier-vente',$data);
            }

           public function updateVendre(Request $request)
             {
                 $vendre = Vendre::findOrFail(($request->id));
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
                        'carburant' => 'required',
                        'transmission' => 'required',
                        'etatvehicule' => 'required',
                        'couleurint' => 'required',
                        'couleurext' => 'required',
                        'image_viste' => 'nullable|mimes:png,jpg,jpeg|max:1024',
                        'imagevehiculevente' => 'nullable',
                        'imagevehiculevente.*' => 'nullable|mimes:png,jpg,jpeg|max:3024',
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
                        'carburant.required' => 'Veuillez saisir le type carburant du véhicule.',
                        'transmission.required' => 'Veuillez saisir la transmission du véhicule.',
                        'etatvehicule.required' => 'Veuillez saisir l\' etat du véhicule.',
                        'couleurint.required' => 'Veuillez saisir couleur interrieur du véhicule.',
                        'couleurext.required' => 'Veuillez saisir couleur exterrieur du véhicule.',
                        'image_viste.required' => 'Veuillez télécharger la carte de visite du véhicule.',
                        'imagevehiculevente.required' => 'Veuillez télécharger au moins 1 image.',
                        'imagevehiculevente.*.required' => 'le fichers est trop volumineux.',
                        'category.required' => 'Veuillez sélectionner la catégorie du véhicule.',
                        'subcategory.required' => 'Veuillez sélectionner la sous-catégorie du véhicule.',
                        'prix.required' => 'Veuillez saisir le prix du véhicule.',
                    ]);


                        
                        if ($request->hasFile('image_viste')) {
                            $path = 'images/Vendre/image_viste/';
                            $file = $request->file('image_viste');
                            $filename = uniqid('Visite') . '.' . $file->getClientOriginalExtension();
                            $old_image_viste = $vendre->image_viste;

                            $upload = $file->move(public_path($path), $filename);

                            if ($upload) {
                                 if( File::exists(public_path($path.$old_image_viste)) ){
                                    File::delete(public_path($path.$old_image_viste));
                                }
                                $imageViste = $filename;
                            }
                        } else {
                            $imageViste = $vendre->image_viste;
                        }

                        
                        $imageFilenames = [];
                        if ($request->hasFile('imagevehiculevente')) {
                        $path = 'images/Vendre';
                        $old_imagevehiculevente = $vendre->imagevehiculevente;

                        foreach ($request->file('imagevehiculevente') as $file) {
                                $extension = $file->getClientOriginalExtension();
                                $filename = uniqid('Vente_image_' . time()) . '.' . $extension;

                                $upload = $file->move(public_path($path), $filename);

                                if ($upload) {
                                 if( File::exists(public_path($path.$old_imagevehiculevente)) ){
                                    File::delete(public_path($path.$old_imagevehiculevente));
                                }
                                $imageFilenames[] = $filename;
                            }
                                
                        
                        }
                    }else {
                        $imageFilenames = json_decode($vendre->imagevehiculevente);
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
                        $idVendre = strtolower($subcategoryName . '_' . $request->modele . '_' . $uniqueId);

                        $equipements = implode(', ', $request->input('equipements', []));
                        $accesoires = implode(', ', $request->input('accesoires', []));


                        // ENREGISTRER LES DÉTAILS DE LA VENTE
                        // $vendre = new Vendre();
                        $vendre->idVendre = $idVendre;
                        $vendre->user_type = 'user';
                        $vendre->user_id = auth('user')->id();
                        $vendre->modele = $request->modele;
                        $vendre->slug = null;
                        $vendre->annee = $request->annee;
                        $vendre->kilometrage = $request->kilometrage;
                        $vendre->description = $request->description;
                        $vendre->equipements = $equipements;
                        $vendre->accesoires = $accesoires;
                        $vendre->immatriculation = $request->immatriculation;
                        $vendre->carburant = $request->carburant;
                        $vendre->transmission = $request->transmission;
                        $vendre->etatvehicule = $request->etatvehicule;
                        $vendre->couleurint = $request->couleurint;
                        $vendre->couleurext = $request->couleurext;
                        $vendre->image_viste = $imageViste;
                        $vendre->imagevehiculevente = json_encode($imageFilenames);
                        $vendre->category = $request->category;
                        $vendre->subcategory = $request->subcategory;
                        $vendre->prix = $request->prix;
                        $vendre->dernier_prix = $request->dernier_prix;
                        $vendre->visibility = $request->visibility;

                        $saved = $vendre->save();

                        if ($saved) {
                            return redirect()->route('user.vendre.all-vendres')
                               ->with('success','Le vehicule a été mis à jour avec succès.');
                        } else {
                            return redirect()->route('user.vendre.all-vendres',['idVendre'=>$vendre->idVendre])
                             ->with('fail','Une erreur est survenue lors de la mise à jour du produit.');
                        }
        }


          public function deleteVendre(Request $request)
            {
                $vendre = Vendre::findOrFail($request->id);

                // Supprimer l'image visite
                $pathVisite = 'images/Vendre/image_viste/';
                if ($vendre->image_viste && File::exists(public_path($pathVisite . $vendre->image_viste))) {
                    File::delete(public_path($pathVisite . $vendre->image_viste));
                }

                // Supprimer les images de véhicule à vendre
                $pathVente = 'images/Vendre/';
                if ($vendre->imagevehiculevente) {
                    $imageFilenames = json_decode($vendre->imagevehiculevente);
                    foreach ($imageFilenames as $filename) {
                        if (File::exists(public_path($pathVente . $filename))) {
                            File::delete(public_path($pathVente . $filename));
                        }
                    }
                }

                // Supprimer l'enregistrement Vendre
                $delete = $vendre->delete();

                if ($delete) {
                    return response()->json(['status' => 1, 'msg' => 'La vente et ses images associées ont été supprimées avec succès.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Une erreur est survenue lors de la suppression de la vente.']);
                }
         }

}
