<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Resources\Supplier\SupplierCollection;
use App\Http\Resources\Supplier\SupplierResource;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
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

        $data = DB::table('suppliers')
            ->select('suppliers.id', 'suppliers.name_supplier', DB::raw('count(*) AS total_products'))
            ->join('products', 'suppliers.id', '=', 'products.supplier_id')
            ->groupBy('products.supplier_id')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('suppliers.id')
            ->get();
        return new SupplierCollection($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = new Supplier;
        $supplier->name_supplier = $request->name_supplier;
        if ($supplier->save()) {
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
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {   
        $dataOnRequestTotalProducts = DB::table('suppliers')
                ->select(DB::raw('count(*) AS total_products'))
                ->join('products', 'suppliers.id', '=', 'products.supplier_id')
                ->where('suppliers.id', '=', $supplier['id'])
                ->groupBy('products.supplier_id')
                ->get();
        $supplier['total_products'] = $dataOnRequestTotalProducts[0]->total_products;
        return new SupplierResource($supplier);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        if ($supplier->update($request->all())) {
            return response('', $this->responceWithoutBody);
        } else {
            return response('', $this->responceToBadRequest);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->delete()) {
            return response('', $this->responceWithoutBody);
        } else {
            return response('', $this->responceToBadRequest);
        }
    }

}
