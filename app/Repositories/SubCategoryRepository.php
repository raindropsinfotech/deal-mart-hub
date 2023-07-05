<?php

namespace App\Repositories;

use App\Repositories\Interfaces\Backend\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\MainCategory;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Requests\Backend\Categories\SubCategoryStoreRequest;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{

    /**
     * Get all Sub Categories with other datas from Database
     *
     * @return array: of Sub Categoris
     */
    public function all()
    {
        $getSubCategories = SubCategory::with(['getAuthor', 'getMainCategories', 'getParentCategories'])->orderBy('id','desc')->get();
        $getMainCategories = MainCategory::orderBy('id','asc')->get();
        $superAdmin = User::with('roles')->whereHas("roles", function($q){ $q->where("id", 1); })->withTrashed()->orderBy('id', 'desc')->get();
        $results = [
            'getSubCategories' => $getSubCategories,
            'getMainCategories' => $getMainCategories,
            'superAdmin' => $superAdmin
        ];
        return $results;
    }

     /**
     * Create new Sub Category
     *
     * @return void
     */
    public function create()
    {

        $getMainCategories = MainCategory::orderBy('id','asc')->get();
        $getSubCategories = SubCategory::orderBy('id','desc')->get();

        $results = [
            'getSubCategories' => $getSubCategories,
            'getMainCategories' => $getMainCategories,
        ];

        return $results;
    }

    /**
     * Store new Sub Category
     *
     * @return void
     */
    public function store(array $data)
    {

        $storeSubCategory = SubCategory::create($data);

        return $storeSubCategory;
    }

    /**
     * Find Sub Category
     *
     * @return void
     */
    public function first(int $id)
    {
        // $editMainCategory = MainCategory::where('id',$id)->firstOrFail();
        $editSubCategories = SubCategory::where('id',$id)->firstOrFail();
        $getMainCategories = MainCategory::orderBy('id','asc')->get();
        $getSubCategories = SubCategory::orderBy('id','desc')->get();

        $results = [
            'editSubCategories' => $editSubCategories,
            'getSubCategories' => $getSubCategories,
            'getMainCategories' => $getMainCategories,
        ];

        return $results;
    }

    /**
     * Update the Sub Category
     *
     * @return void
     */
    public function update(int $id, array $data)
    {

        $updateSubCategory = SubCategory::where('id',$id)->firstOrFail();


        $updateSubCategory->name = $data['name'];
        $updateSubCategory->slug = $data['slug'];
        $updateSubCategory->maincat_id = $data['maincat_id'];
        $updateSubCategory->parent_id = $data['parent_id'];

        $updateSubCategory->save();

        return $updateSubCategory;
    }

    /**
     * Destroy/Delete Sub Category by Id
     *
     * @return void
     */
    public function delete(int $id)
    {
        $deleteSubCategory = SubCategory::where('id',$id)->delete();;

        return $deleteSubCategory;
    }

    /**
     * Generate Slug for Sub Category
     *
     * @return void
     */
    public function createSlug(array $data)
    {
        $name = $data['name'];
        $slug = SlugService::createSlug(SubCategory::class, 'slug', $name);
        // if( isset($request->id) && !empty($request->id) ) {
        //     $getMainCategory = MainCategory::where('id',$request->id)->firstOrFail();
        //     if( $getMainCategory->name == $request->name ) {
        //         $slug = SlugService::createSlug(MainCategory::class, 'slug', $request->name, ['unique' => false]);
        //     } else {
        //         $slug = SlugService::createSlug(MainCategory::class, 'slug', $request->name);
        //     }
        // } else {
        //     $slug = SlugService::createSlug(MainCategory::class, 'slug', $request->name);
        // }

        return $slug;
    }
}