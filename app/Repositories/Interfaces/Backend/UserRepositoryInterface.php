<?php

namespace App\Repositories\Interfaces\Backend;

interface UserRepositoryInterface
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
     * Interface for Update the User account
     *
     * @return void
     */
    public function updateAccount(int $id, array $data);

    /**
     * Interface for Update the User Security
     *
     * @return void
     */
    public function updateSecurity(int $id, array $data);

    /**
     * Interface for Update the User Preference
     *
     * @return void
     */
    public function updatePrafrence(int $id, array $data);

    /**
     * Interface for Suspend/Deactive User
     *
     * @return void
     */
    public function suspendUser(int $id);

     /**
     * Interface for Rise/Active User
     *
     * @return void
     */
    public function riseUser(int $id);

    /**
     * Interface for Destroy the User
     *
     * @return void
     */
    public function delete(int $id);
}