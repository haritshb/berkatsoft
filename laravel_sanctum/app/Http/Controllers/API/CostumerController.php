<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ApiController;

class CostumerController extends ApiController
{
    public function index()
    {
        return $this->successResponse('Customer successfully fetched.', CustomerResource::collection(Customer::all()));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Error validation.', $validator->errors());       
        }

        return $this->successResponse('Customer successfully created.', new CustomerResource(
        	Customer::create($validator->validated())
        ));
    }

   
    public function show($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->errorResponse('Customer does not exist.');
        }
        return $this->successResponse('Customer successfully fetched.', new CustomerResource($customer));
    }
    

    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()){
            return $this->errorResponse('Error validation.', $validator->errors());       
        }

        $input = $validator->validated();

        $customer->name = $input['name'];
        $customer->address = $input['address'];
        $customer->phone = $input['phone'];
        $customer->save();
        
        return $this->successResponse('Customer successfully updated.', new CustomerResource($customer));
    }
   
    public function destroy($id)
    {
    	$customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->errorResponse('Customer does not exist.');
        }

        $customer->delete();

        return $this->successResponse('Customer successfully deleted.');
    }
}
