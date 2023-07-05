<?php

namespace App\Http\Controllers\backend\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\MainCategory;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Requests\Backend\Categories\SubCategoryRequest;
use App\Repositories\Interfaces\Backend\SubCategoryRepositoryInterface;

class SubCategoryController extends Controller
{
    private $subCategory;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SubCategoryRepositoryInterface $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getResults = $this->subCategory->all();

        $getSubCategories = $getResults['getSubCategories'];
        $getMainCategories = $getResults['getMainCategories'];
        $superAdmin = $getResults['superAdmin'];

        return view('backend.super-admin.sub-category.index', compact('getSubCategories', 'getMainCategories', 'superAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $getResults = $this->subCategory->create();

        $getSubCategories = $getResults['getSubCategories'];
        $getMainCategories = $getResults['getMainCategories'];

        return view('backend.super-admin.sub-category.create', compact('getMainCategories', 'getSubCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        //
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'maincat_id' => $request->main_categories,
            'parent_id' => $request->parent_id,
            'author' => auth()->id()
        ];

        // $createSubCategory = SubCategory::create($data);
        $createSubCategory = $this->subCategory->store($data);

        if( $createSubCategory ) {
            return redirect()->route('backend_all_sub_categories')->with('success','Sub Category created successfully!');
        } else {
            return redirect()->route('backend_all_sub_categories')->with('error',"Oops! Couldn't create sub category!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $edit_id)
    {
        //
        $getResults = $this->subCategory->first($edit_id);

        $editSubCategories = $getResults['editSubCategories'];
        $getSubCategories = $getResults['getSubCategories'];
        $getMainCategories = $getResults['getMainCategories'];

        return view('backend.super-admin.sub-category.edit', compact('editSubCategories', 'getMainCategories', 'getSubCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, string $id)
    {
        //
        $getSubCategory = SubCategory::where('id',$id)->firstOrFail();

        $updatedata = [
            'name' => $request->name,
            'slug' => $request->slug,
            'maincat_id' => $request->main_categories,
            'parent_id' => $request->parent_id,
        ];

        $updateSubCategory = $this->subCategory->update($id, $updatedata);

        if( $updateSubCategory ) {
            return redirect()->route('backend_all_sub_categories')->with('success','Sub Category updated successfully!');
        } else {
            return redirect()->route('backend_all_sub_categories')->with('error',"Oops! Couldn't update sub category!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // SubCategory::where('id',$id)->delete();
        $deleteSubCategory = $this->subCategory->delete($id);

        if( $deleteSubCategory ) {
            return redirect()->route('backend_all_sub_categories')->with('success','Sub Category deleted successfully.');
        } else {
            return redirect()->route('backend_all_sub_categories')->with('error','Oops! Sub Category not deleted.');
        }

    }

    /**
     * Create slug by category name
     */
    public function createCatSlug(Request $request)
    {
        // $slug = SlugService::createSlug(MainCategory::class, 'slug', $request->name);
        $slug = $this->subCategory->createSlug($request->all());

        if( $slug ) {
            return response()->json(
                [
                    'status' => 'success',
                    'slug' => $slug
                ],200
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'slug' => ''
                ],403
            );
        }
    }
}
