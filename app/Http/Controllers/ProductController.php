<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * Restriction on pagination
     * @var int
     */
    public const LIMIT_PAGINATION = 100;

    /**
     * Server response code for invalid request
     * @var int
     */
    protected $responceToBadRequest = Response::HTTP_BAD_REQUEST;

    /**
     * Server response code with empty response body
     * @var int
     */
    protected $responceWithoutBody = Response::HTTP_NO_CONTENT;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $limit = self::LIMIT_PAGINATION, int $offset = 0)
    {

        if ($limit > self::LIMIT_PAGINATION) {
            $limit = self::LIMIT_PAGINATION;
        } 
        
        $data = DB::table('products')
            ->select('products.id', 'products.name_product', 'products.description_product', 'products.cost_product', 'suppliers.name_supplier')
            ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('products.id')
            ->get();

        return new ProductCollection($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name_product = $request->name_product;
        $product->description_product = $request->description_product;
        $product->supplier_id = $request->supplier_id;
        $product->cost_product = $request->cost_product;
        if ($product->save()) {
            return response([
                'status' => 'created',
                'code' => Response::HTTP_CREATED
            ], Response::HTTP_CREATED);
        } else {
            return response('', $this->responceToBadRequest);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $nameSupplier = DB::table('products')
        //         ->where('products.id', '=', $product['id'])
        //         ->select(DB::raw('suppliers.name_supplier'))
        //         ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
        //         ->get();
        // $product['nameSupplier'] = $nameSupplier[0]->name_supplier;
        // return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($product->update($request->all())) {
            return response('', $this->responceWithoutBody);
        } else {
            return response('', $this->responceToBadRequest);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return response('', $this->responceWithoutBody);
        } else {
            return response('', $this->responceToBadRequest);
        }
    }

    
    /**
     *  Sort Result Query Asc
     * @return
     */
    public function sort(string $nameSupplier, string $sortingType)
    {
        $data = DB::table('products')
                ->select(DB::raw('products.id, products.name_product, products.description_product, products.cost_product, suppliers.name_supplier'))
                ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
                ->where('suppliers.name_supplier', '=', $nameSupplier)
                ->orderBy('products.cost_product', $sortingType)
                ->get();
        /**SELECT products.id, products.name_product, products.description_product, products.cost_product, suppliers.name_supplier
        FROM `products`
        INNER JOIN `suppliers`  ON suppliers.id = products.supplier_id
        WHERE suppliers.name_supplier = $nameSupplier
        GROUP BY products.supplier_id 
        ORDER BY products.cost_product $sortingType
        */

        return new ProductCollection($data);
    }

    
}
