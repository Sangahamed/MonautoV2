<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\SubCategory;
// use \Cviebrock\EloquentSluggable\Services\SlugService;
use Toastr;

class CategoriesController extends Controller
{
    public function catSubcatList(Request $request)
    {
        $data = [
            'pageTitle' => 'Type & Marque management',
        ];
        return view('back.pages.admin.cats-subcats-list', $data);
    }

    public function addCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'Ajouter Type',
        ];
        return view('back.pages.admin.add-category', $data);
    }

    public function storeCategory(Request $request)
    {
         $request->validate([
            'category_name' => 'required|min:3|unique:categories,category_name',
        ], [
            'category_name.required' => ':Le type est obligatoire',
            'category_name.min' => ':Entrez minimun 3 caractere',
            'category_name.unique' => 'Le Type exist deja',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        if ($category->wasRecentlyCreated) {
            return redirect()->route('admin.manage-categories.add-category')
                ->with('success', '<b>' . ucfirst($request->category_name) . '</b> Type ajouter avec succes.');
        } else {
            return redirect()->route('admin.manage-categories.add-category')
                ->with('fail', 'Quelque chose a causer une erreur reessayer .');
        }
    }

    public function editCategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $data = [
            'pageTitle' => 'Modifier Type',
            'category' => $category,
        ];
        return view('back.pages.admin.edit-category', $data);
    }

    public function updateCategory(Request $request)
    {
        
        $category = Category::findOrFail($request->category_id);
        
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $request->category_id,
            'category_name.unique' => 'This :attribute already exists',
         ],[
            'category_name'=>'Entrez le Type de Voiture',
            'category_name.unique'=>'Ce nom exist deja',
            
         ]);

        //UPDATE TYPE DE VOITURE
           $category->category_name = $request->category_name;
           $category->category_slug = null;
        //    dd($category);
                 $saved = $category->save();      

        if ($saved) {
            return redirect()->route('admin.manage-categories.edit-category', ['id' => $request->category_id])
                ->with('success', '<b>' . ucfirst($request->category_name) . '</b> Type modifier.');
        } else {
            return redirect()->route('admin.manage-categories.edit-category', ['id' => $request->category_id])
                ->with('fail', 'Quelque chose a causer une erreur reessayer.');
        }
    }

    public function addSubCategory(Request $request)
    {
        $independent_subcategories = SubCategory::where('is_child_of', 0)->get();
        $categories = Category::all();
        $data = [
            'pageTitle' => 'Ajouter Marque',
            'categories' => $categories,
            'subcategories' => $independent_subcategories,
        ];

        return view('back.pages.admin.add-subcategory', $data);
    }

  public function storeSubCategory(Request $request)
{
    $request->validate([
        'parent_category' => 'required|exists:categories,id',
        'subcategory_name' => 'required|min:3|',
        'subcategory_image' => 'nullable|image|mimes:png,jpg,jpeg,svg',
    ], [
        'parent_category.required' => ':vous devez entre le type',
        'parent_category.exists' => ':le type existe pas reessayer',
        'subcategory_name.required' => ':Rentre la marque',
        'subcategory_name.min' => ':3 Carractere minimum',
        'subcategory_name.unique' => 'La marque existe deja',
        'subcategory_image.required' => ':veuillez entre un logo',
        'subcategory_image.image' => ':Entrer une image',
        'subcategory_image.mimes' => ':Entrer un format JPG, JPEG, PNG, or SVG format',
    ]);

    if ($request->hasFile('subcategory_image')) {
        $path = 'images/categories/';
        $file = $request->file('subcategory_image');
        $filename = time() . '_' . $file->getClientOriginalName();

        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path));
        }

        $upload = $file->move(public_path($path), $filename);

        if ($upload) {
            $subcategory = new SubCategory();
            $subcategory->category_id = $request->parent_category;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->subcategory_image = $filename;
            $subcategory->is_child_of = $request->is_child_of;
            $saved = $subcategory->save();

             if( $saved ){
                    return redirect()->route('admin.manage-categories.add-subcategory')
                    ->with('success','<b>'.ucfirst($request->subcategory_name).'</b> La marque a ete ajouter avec succes.');
                }else{
                    return redirect()->route('admin.manage-categories.add-subcategory')->with('fail','Quelque chose a causer une erreur reessayer.');
                }
            }else{
                return redirect()->route('admin.manage-categories.add-subcategory')->with('fail','Quelque chose a causer une erreur avec Marque image reessayer.');
            }
        }
    }

 public function editSubCategory(Request $request){
        $subcategory_id = $request->id;
        $subcategory = SubCategory::findOrFail($subcategory_id);
        $independent_subcategories = SubCategory::where('is_child_of',0)->get();
        $data = [
            'pageTitle'=>'Modifier Marque',
            'categories'=>Category::all(),
            'subcategory'=>$subcategory,
            'subcategories'=>(!empty($independent_subcategories)) ? $independent_subcategories : []
        ];
        return view('back.pages.admin.edit-subcategory',$data);
    }



  public function updateSubCategory(Request $request){
        $subcategory_id = $request->subcategory_id;
        $subcategory = SubCategory::findOrFail($subcategory_id);

    $request->validate([
        'parent_category' => 'required|exists:categories,id',
        'subcategory_name' => 'required|min:3|unique:sub_categories,subcategory_name,' . $subcategory_id,
        'subcategory_image' => 'nullable|image|mimes:png,jpg,jpeg,svg',
    ], [
        'parent_category.required' => ':vous devez entre le type',
        'parent_category.exists' => ':le type existe pas reessayer',
        'subcategory_name.required' => ':Rentre la marque',
        'subcategory_name.min' => ':3 Carractere minimum',
        'subcategory_name.unique' => 'La marque existe deja',
        'subcategory_image.required' => ':veuillez entre un logo',
        'subcategory_image.image' => ':Entrer une image',
        'subcategory_image.mimes' => ':Entrer un format JPG, JPEG, PNG, or SVG format',
    ]);

    // CHECK IF THIS SUB CATEGORY HAS CHILDREN
    if( $subcategory->children->count() && $request->is_child_of != 0 ){
            return redirect()->route('admin.manage-categories.edit-subcategory',['id'=>$subcategory_id])->with('fail','La Marque ('.$subcategory->children->count().') a pas d\' attribut.');
        }
        else{

        if( $request->hasFile('subsubcategory_image') ){
            $path = 'images/categories/';
            $file = $request->file('subcategory_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $old_subcategory_image = $subcategory->subcategory_image;

            //Upload new subcategory image
            $upload = $file->move(public_path($path),$filename);

            if( $upload ){
                 //Delete old subcategory image
                 if( File::exists(public_path($path.$old_subcategory_image)) ){
                    File::delete(public_path($path.$old_subcategory_image));
                 }
                 //Update subcategory info

                $subcategory->category_id = $request->parent_category;
                $subcategory->subcategory_name = $request->subcategory_name;
                $subcategory->subcategory_image = $filename;
                $subcategory->subcategory_slug = null;
                $subcategory->is_child_of = $request->is_child_of;
                $saved = $subcategory->save();

                 if($saved ){
                    return redirect()->route('admin.manage-categories.edit-subcategory',['id'=>$request->subcategory_id])->with('success','<b>'.ucfirst($request->subcategory_name).'</b> Marque modifier.');
                 }else{
                    return redirect()->route('admin.manage-categories.edit-subcategory',['id'=>$request->subcategory_id])->with('fail','Erreur veuillez reessayer.');
                 }
            }else{
                return redirect()->route('admin.manage-categories.edit-subcategory',['id'=>$request->subcategory_id])->with('fail','Vous avez une erreur avec votre image.');
            }

        }else{

            $subcategory->category_id = $request->parent_category;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->subcategory_slug = null;
            $subcategory->is_child_of = $request->is_child_of;
            $saved = $subcategory->save();

            if( $saved ){
                return redirect()->route('admin.manage-categories.edit-subcategory',['id'=>$request->subcategory_id])->with('success','<b>'.ucfirst($request->subcategory_name).'</b> La marque a ete modifier.');
            }else{
                return redirect()->route('admin.manage-categories.edit-subcategory',['id'=>$request->subcategory_id])->with('fail','Quelque chose a causer une erreur reessayer.');
            }
        }
        }
  }

}
