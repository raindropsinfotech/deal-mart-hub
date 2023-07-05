<?php

namespace App\Http\Controllers\backend\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Http\Requests\Backend\Categories\MainCategoryRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Repositories\Interfaces\Backend\MainCategoryRepositoryInterface;

class MainCategoryController extends Controller
{
    private $mainCategory;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainCategoryRepositoryInterface $mainCategory)
    {
        $this->mainCategory = $mainCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $getMainCategories = $this->mainCategory->all();
        return view('backend.super-admin.main-category.index', compact('getMainCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.super-admin.main-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainCategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'author' => auth()->id()
        ];

        $createMainCategory = $this->mainCategory->store($data);

        if( $createMainCategory ) {
            return redirect()->route('backend_all_main_categories')->with('success','Main Category created successfully!');
        } else {
            return redirect()->route('backend_all_main_categories')->with('error',"Oops! Couldn't create main category!");
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
    public function edit(string $edit_id, Request $request)
    {
        $editMainCategories = $this->mainCategory->first($edit_id);
        return view('backend.super-admin.main-category.edit', compact('editMainCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainCategoryRequest $request, string $id)
    {
        $updatedata = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];

        $updateMainCategory = $this->mainCategory->update($id, $updatedata);

        if( $updateMainCategory ) {
            return redirect()->route('backend_all_main_categories')->with('success','Main Category updated successfully!');
        } else {
            return redirect()->route('backend_all_main_categories')->with('error',"Oops! Couldn't update main category!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleteMainCategory = $this->mainCategory->delete($id);
        if( $deleteMainCategory ) {
            return redirect()->route('backend_all_main_categories')->with('success','Main Category deleted successfully.');
        } else {
            return redirect()->route('backend_all_main_categories')->with('error','Oops! Main Category not deleted.');
        }
    }

     /**
     * Create slug by category name
     */
    public function createCatSlug(Request $request)
    {
        $slug = $this->mainCategory->createSlug($request->all());
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
