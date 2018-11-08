<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use Session;

class SubCategoryController extends Controller
{
    public function __construct(){
    	$this -> middleware(['auth', 'verified']);
    }

    public function index($slug, $id){
		$categories = SubCategory::orderBy('id', 'DESC') -> where('category_id', $id) -> get();
		$parentCategory = Category::findOrFail($id);
		// dd(gettype($categories));
		return view('sub_categories.index') -> withCategories($categories) -> withParentCategory($parentCategory);
	}

	public function create($id){
		$parentCategory = Category::findOrFail($id);
		return view('sub_categories.create') -> withParentCategory($parentCategory);
	}

	public function store(Request $request, $id){
		$request -> validate(array(
			'name' => 'required|alpha_spaces|max:255',
		));

		$category = new SubCategory;
		$category -> name = $request -> name;
		$category -> slug = str_slug($category -> name, '-');
		$category -> category_id = $id;
		$category -> save();

		Session::flash('success', 'Sub Category('.$category -> name.') created successfully!');
		return redirect() -> route('sub_categories.index', [$category -> category -> slug, $category -> category -> id]);
	}

	public function edit($id){
		$category = SubCategory::findOrFail($id);
		return view('sub_categories.edit') -> withCategory($category);
	}

	public function update(Request $request, $id){
		$request -> validate(array(
			'name' => 'required|alpha_spaces|max:255',
		));

		$category = SubCategory::findOrFail($id);
		$category -> name = $request -> name;
		$category -> slug = str_slug($category -> name, '-');
		$category -> save();

		Session::flash('success', 'Category('.$category -> name.') updated successfully!');
		return redirect() -> route('sub_categories.index', [$category -> category -> slug, $category -> category -> id]);
	}

	public function destroy($id){
		$category = SubCategory::findOrFail($id);

		if(count($category -> projects) > 0){
			Session::flash('error', 'This Sub category cannot be deleted, it has Projects.');
			return redirect() -> back();
		}
		else{
			$name = $category -> name;
			$category -> delete();

			Session::flash('success', 'Category('.$name.') deleted successfully!');
			return redirect() -> back();
		}
		
	}

	public function deleteMultiple(Request $request){
		$ids = $request->ids;
		$ids = explode(",", $ids);
		foreach($ids as $id){
			$category = SubCategory::findOrFail($id);
			if(count($category -> projects) > 0){
				return response()->json(['status'=>false ,'message'=>"These Sub categories cannot be deleted, because some of them has projects. Some of them maybe get deleted."]);
			}
			else{
				$category -> delete();
				return response()->json(['status'=>true,'message'=>"Sub Category(ies) deleted successfully."]);
			}
			$category -> delete();
		}
	}
}
