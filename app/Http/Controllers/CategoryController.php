<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
	public function __construct(){
		$this -> middleware(['auth', 'verified']);
	}

	public function index(){
		$categories = Category::orderBy('id', 'DESC') -> get();
		return view('categories.index') -> withCategories($categories);
	}

	public function create(){
		return view('categories.create');
	}

	public function store(Request $request){
		$request -> validate(array(
			'name' => 'required|alpha_spaces|max:255',
		));

		$category = new Category;
		$category -> name = $request -> name;
		$category -> slug = str_slug($category -> name, '-');
		$category -> save();

		Session::flash('success', 'Category('.$category -> name.') created successfully!');
		return redirect() -> route('categories.index');
	}

	public function edit($id){
		$category = Category::findOrFail($id);
		return view('categories.edit') -> withCategory($category);
	}

	public function update(Request $request, $id){
		$request -> validate(array(
			'name' => 'required|alpha_spaces|max:255',
		));

		$category = Category::findOrFail($id);
		$category -> name = $request -> name;
		$category -> slug = str_slug($category -> name, '-');
		$category -> save();

		Session::flash('success', 'Category('.$category -> name.') updated successfully!');
		return redirect() -> route('categories.index');
	}

	public function destroy($id){
		$category = Category::findOrFail($id);

		if(count($category -> subCategories) > 0){
			Session::flash('error', 'This category cannot be deleted, it has sub categories.');
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
			$category = Category::findOrFail($id);
			$category -> delete();
		}

		return response()->json(['status'=>true,'message'=>"Category(ies) deleted successfully."]);
		// Session::flash('success', 'Categories deleted successfully');
  //       return redirect() -> back();
	}
}
