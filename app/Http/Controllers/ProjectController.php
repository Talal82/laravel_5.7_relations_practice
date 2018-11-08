<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\SubCategory;
use App\Category;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type, $id)
    {
        $parentType = $type;
        $parentCategory = '';
        if($type == 'sub_cat'){
            $parentCategory = SubCategory::findOrFail($id);
        }
        if($type == 'main_cat'){
            $parentCategory = Category::findOrFail($id);
        }
        $projects = Project::where('projectable_id', $id) -> where('projectable_type', $type) -> orderBy('id', 'DESC') -> get();
        return view('projects.index') -> withParentType($parentType) -> withParentCategory($parentCategory) -> withProjects($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $id)
    {
        $parentType = $type;
        $parentCategory = '';
        if($type == 'sub_cat'){
            $parentCategory = SubCategory::findOrFail($id);
        }
        if($type == 'main_cat'){
            $parentCategory = Category::findOrFail($id);
        }
        return view('projects.create') -> withParentType($parentType) -> withParentCategory($parentCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate(array(
            'name' => 'required|alpha_spaces|max:255',
            'detail' => 'required|max:1000',
        ));

        $parentType = $request -> parent_type;
        $parentId = $request -> parent_id;

        $parentCategory = '';
        if($parentType == 'sub_cat'){
            $parentCategory = SubCategory::findOrFail($parentId);
        }
        if($parentType == 'main_cat'){
            $parentCategory = Category::findOrFail($parentId);
        }

        $project = new Project;
        $project -> name = $request -> name;
        $project -> detail = $request -> detail;

        $project -> projectable() -> associate($parentCategory);
        $project -> save();

        Session::flash('success', 'Project('.$project -> name.') saved successfully!');
        return redirect() -> route('projects.index', [$parentType, $parentId] );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit') -> withProject($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate(array(
            'name' => 'required|alpha_spaces|max:255',
            'detail' => 'required|max:1000',
        ));

        $project = Project::findOrFail($id);
        $project -> name = $request -> name;
        $project -> detail = $request -> detail;

        $project -> save();

        Session::flash('success', 'Project('.$project -> name.') edited successfully!');
        return redirect() -> route('projects.index', [$project -> projectable_type, $project -> projectable_id] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $name = $project -> name;
        $projectableId = $project -> projectable_id;
        $projectableType = $project -> projectable_type;

        $project -> delete();

        Session::flash('success', 'Project('.$name.') deleted successfully!');
        return redirect() -> route('projects.index', [$projectableType, $projectableId]);
    }

    public function deleteMultiple(Request $request){
        $ids = $request->ids;
        $ids = explode(",", $ids);
        foreach($ids as $id){
            $project = Project::findOrFail($id);
            $project -> delete();
        }

        return response()->json(['status'=>true,'message'=>"Project(s) deleted successfully."]);
    }
}
