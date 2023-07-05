<?php

namespace App\Repositories\Interfaces\Backend;

interface SubCategoryRepositoryInterface
{
    /**
     * Interface for get all Sub Categories
     *
     * @return void
     */
    public function all();

    /**
     * Interface for create new Sub Category
     *
     * @return void
     */
    public function create();

    /**
     * Interface for store new Sub Category
     *
     * @return void
     */
    public function store(array $data);

    /**
     * Interface for Find the form for editing the Sub Category
     *
     * @return void
     */
    public function first(int $id);

    /**
     * Interface for Update the Sub Category
     *
     * @return void
     */
    public function update(int $id, array $data);

    /**
     * Interface for Destroy the Sub Category
     *
     * @return void
     */
    public function delete(int $id);

    /**
     * Interface for create slug of Sub Category using AJAX
     *
     * @return void
     */
    public function createSlug(array $data);
}