<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SubCategory extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'maincat_id',
        'name',
        'slug',
        'parent_id',
        'author',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'id']
            ]
        ];
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany(SubCategory::class,'parent_id','id') ;
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function getMainCategories()
    {
        return $this->hasOne(MainCategory::class, 'id', 'maincat_id');
    }

    public function getParentCategories()
    {
        return $this->hasOne(SubCategory::class, 'id', 'parent_id');
    }
}
