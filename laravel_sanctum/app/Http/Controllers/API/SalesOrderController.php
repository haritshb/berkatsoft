<?php

namespace App\Http\Controllers\API;

use App\Models\SalesOrder;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\SalesOrderResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ApiController;

class SalesOrderController extends ApiController
{
    public function index()
    {
        //$sales_order = Product::find(1);
        //$products = Product::find(1);
        $products = Product::find(1);
        $customers = Customer::orderBy('name', 'asc')->get();
        $sales_order = SalesOrder::with(['product', 'customer'])->get();
        return $this->successResponse('Sales Order successfully fetched.', 
        //SalesOrderResource::collection(SalesOrder::all())
        //compact('products', 'customers')
        compact('sales_order')
        );
        //SalesOrderResource::collection($product->title));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'product_id' => 'required'            
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Error validation.', $validator->errors());       
        }

        return $this->successResponse('Sales Order successfully created.', new SalesOrderResource(
        	SalesOrder::create($validator->validated())
        ));
    }

   
    public function show($id)
    {
        $sales_order = SalesOrder::find($id);

        if (is_null($sales_order)) {
            return $this->errorResponse('Sales Order does not exist.');
        }
        return $this->successResponse('Sales Order successfully fetched.', new SalesOrderResource($sales_order));
    }
    

    public function update(Request $request, SalesOrder $sales_order)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'product_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->errorResponse('Error validation.', $validator->errors());       
        }

        $input = $validator->validated();

        $sales_order->customer_id = $input['customer_id'];
        $sales_order->product_id = $input['product_id'];        
        $sales_order->save();
        
        return $this->successResponse('Sales Order successfully updated.', new SalesOrderResource($sales_order));
    }
   
    public function destroy($id)
    {
    	$sales_order = SalesOrder::find($id);

        if (is_null($sales_order)) {
            return $this->errorResponse('Sales Order does not exist.');
        }

        $sales_order->delete();

        return $this->successResponse('Sales Order successfully deleted.');
    }
}
