<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Contracts\CategoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryInterface
{
    /**
     * Find an Category by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Category
     */
    public function find($id)
    {
        return Category::find($id);
    }

    /**
     * Find an Category by given key which returns Category Model
     *
     * @param string $key
     * @return \AvoRed\Framework\Models\Database\Category
     */
    public function findByKey($key)
    {
        return Category::whereSlug($key)->first();
    }

    /**
     * Find an Category by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * Paginate Category
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Category::paginate($noOfItem);
    }

    /**
     * Find an Category Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Category::query();
    }

    /**
     * Find an Category Query
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function create($data)
    {
        return Category::create($data);
    }

    /*
    * Return Products of Category with Filters
    *
    *
    * @param integer $categoryId
    * @param array   $filters
    * @return \Illuminate\Support\Collection $collect
    */
    public function getCategoryProductWithFilter($categoryId, $filters = [])
    {
        $prefix = env('DB_TABLE_PREFIX', 'avored_');

        $propetryInnerJoinFlag = false;
        $attributeInnerJoinFlag = false;

        $sql = "Select p.id
                FROM {$prefix}products as p 
                INNER JOIN {$prefix}category_product as cp on p.id = cp.product_id ";

        foreach ($filters as $type => $filterArray) {
            if ('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();

                    if ('INTEGER' == $property->data_type) {
                        if (false === $propetryInnerJoinFlag) {
                            $propetryInnerJoinFlag = true;
                            $sql .= "INNER JOIN {$prefix}product_property_integer_values as ppiv ON p.id = ppiv.product_id ";
                        }
                    }
                }
            }

            if ('attribute' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $attribute = Attribute::whereIdentifier($identifier)->first();
                    if (false === $attributeInnerJoinFlag) {
                        $attributeInnerJoinFlag = true;
                        $sql .= "INNER JOIN {$prefix}product_attribute_integer_values as paiv ON p.id = paiv.product_id ";
                    }
                }
            }
        }

        $sql .= "WHERE p.type != 'VARIABLE_PRODUCT' AND  cp.category_id = ? ";

        foreach ($filters as $type => $filterArray) {
            if ('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();

                    if ('INTEGER' == $property->data_type) {
                        $sql .= "AND ppiv.property_id = {$property->id} AND ppiv.value={$value} ";
                    }
                }
            }
        }

        foreach ($filters as $type => $filterArray) {
            if ('attribute' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $attribute = Attribute::whereIdentifier($identifier)->first();
                    $sql .= "AND paiv.attribute_id = {$attribute->id} AND paiv.value={$value} ";
                }
            }
        }

        $products = DB::select($sql, [$categoryId]);
        $collect = Collection::make([]);

        foreach ($products as $productArray) {
            $product = Product::find($productArray->id);

            if ($product->type == 'VARIABLE_PRODUCT') {
                $collect->push(($product->getVariableMainProduct()));
            } else {
                $collect->push(Product::find($productArray->id));
            }
        }

        return $collect;
    }

    /*
    * Paginate Category Page Product
    *
    *
    * @param \Illuminate\Support\Collection $products
    * @param integer $perPage
    * @return \Illuminate\Pagination\LengthAwarePaginator
    */

    public function paginateProducts($products, $perPage = 10)
    {
        $request = request();
        $page = request('page');
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $products->slice($offset, $perPage), // Only grab the items we need
            $products->count(), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );
    }

    /**
     * Get an Category Options for Vue Components
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function options($empty = true)
    {
        if (true === $empty) {
            $empty = new Category();
            $empty->name = 'Please Select';
            return Category::all()->prepend($empty);
        }
        return Category::all();
    }
}
