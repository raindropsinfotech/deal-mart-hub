<?php

namespace App\Repositories;

use App\Repositories\Interfaces\Backend\MainCategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Http\Requests\Backend\Categories\MainCategoryStoreRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class MainCategoryRepository implements MainCategoryRepositoryInterface
{

    /**
     * Get all MainCategories from Database
     *
     * @return array: of Main Categoris
     */
    public function all()
    {
        $getMainCategories = MainCategory::with('getAuthor')->orderBy('id','desc')->get();
        return $getMainCategories;
    }

    /**
     * Create new Main Category
     *
     * @return void
     */
    public function store(array $data)
    {

        $storeMainCategory = MainCategory::create($data);

        return $storeMainCategory;
    }

    /**
     * Find Main Category
     *
     * @return void
     */
    public function first(int $id)
    {
        $editMainCategory = MainCategory::where('id',$id)->firstOrFail();
        return $editMainCategory;
    }

    /**
     * Update the Main Category
     *
     * @return void
     */
    public function update(int $id, array $data)
    {

        $updateMainCategory = MainCategory::where('id',$id)->firstOrFail();

        $updateMainCategory->name = $data['name'];
        $updateMainCategory->slug = $data['slug'];

        $updateMainCategory->save();

        return $updateMainCategory;
    }

    /**
     * Destroy/Delete Main Category by Id
     *
     * @return void
     */
    public function delete(int $id)
    {
        $deleteMainCategory = MainCategory::where('id',$id)->delete();;

        return $deleteMainCategory;
    }

    /**
     * Generate Slug for Main Category
     *
     * @return void
     */
    public function createSlug(array $data)
    {
        $name = $data['name'];
        $slug = SlugService::createSlug(MainCategory::class, 'slug', $name);
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