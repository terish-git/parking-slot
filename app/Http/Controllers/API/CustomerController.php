<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Customer as CustomerResource;
use Validator;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $i = 'A';
do {
  echo $i . '<br />';
} while ( $i++ != 'ZZZ' );


        // $customers = Customer::all();
        // return $this->sendResponse(CustomerResource::collection($customers), 'Customers Retrieved Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required|min:3|max:15|unique:customers',
        ]);

        if ($validator->fails()) return $this->sendError('Validation Error.', $validator->errors(), 422);

        try {
            $customer = Customer::create([
                'name'     => $request->name,
                'phone_number'    => $request->phone_number,
            ]);

            $success['customer']    = $customer;
            $message                = 'Success! New customer has been successfully registered.';

        } catch (Exception $e) {
            $success['token'] = [];
            $message          = 'Error! Unable to create a new customer.';
        }

        return $this->sendResponse($success, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
