<?php

namespace App;

class Category extends AbstractModel
{
    protected $fillable = [
        'name', 'description', 'parent', 'image'
    ];

    /**
     * hasMany Question
     */
    public function parentCategories()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function getImageUrl($image, $uploadDisk = 'uploads')
    {
        if ($image) {
            return asset('/' . $uploadDisk . '/' . strtolower(class_basename($this)) . '/' . $image);
        }
    }

    public function getParentCategory($categoryAll, $categoryLists = '')
    {
        $data = ($categoryLists) ?: $categoryAll;

        $parents = $data->filter(function ($category) {
            return $category->parent;
        })->flatMap(function ($category) use ($categoryAll) {
            return [
                $category->id => [
                    'id' => $category->parent,
                    'name' => $categoryAll->where('id', $category->parent)->first()->name,
                    'description' => $categoryAll->where('id', $category->parent)->first()->description,
                ]
            ];
        });

        return $parents;
    }

    public static function getCategoriesByParent($parent = null) {
        return app(Category::class)->where(['parent'=>$parent])->orderBy('created_at', 'DSC')->with('parentCategories')->get();
    }

    public static function getTreesByParent($parent = null) {
        $trees = [];
        $categories = self::getCategoriesByParent($parent);
        if(!empty($categories)) {
            foreach ($categories as $key => $category) {
                $trees_1 = [];
                $categories_1 = self::getCategoriesByParent($category->id);
                if(!empty($categories_1)) {
                    foreach ($categories_1 as $key_1 => $category_1) {
                        $trees_2 = [];
                        $categories_2 = self::getCategoriesByParent($category_1->id);
                        if(!empty($categories_1)) {
                            foreach ($categories_2 as $key_2 => $category_2) {
                                $trees_2[] = ['id' => $category_2->id, 'name' => $category_2->name];
                            }
                        }
                        $trees_1[] = ['id' => $category_1->id, 'name' => $category_1->name, 'parents' => $trees_2];
                    }
                }
                $trees[] = ['id' => $category->id, 'name' => $category->name, 'parents' => $trees_1];

            }
        }
        return $trees;
    }
}
