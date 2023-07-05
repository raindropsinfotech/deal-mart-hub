<?php

namespace App\Repositories\Interfaces\Backend;

interface MainCategoryRepositoryInterface
{
    /**
     * Interface for get all MainCategories
     *
     * @return void
     */
    public function all();

    /**
     * Interface for create new MainCategory
     *
     * @return void
     */
    public function store(array $data);

    /**
     * Interface for Find the form for editing the Main Category
     *
     * @return void
     */
    public function first(int $id);

    /**
     * Interface for Update the Main Category
     *
     * @return void
     */
    public function update(int $id, array $data);

    /**
     * Interface for Destroy the Main Category
     *
     * @return void
     */
    public function delete(int $id);

    /**
     * Interface for create slug of Main Category using AJAX
     *
     * @return void
     */
    public function createSlug(array $data);
}