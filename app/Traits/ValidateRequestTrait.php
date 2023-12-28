<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait ValidateRequestTrait
{
    /**
     * Validate the given request with the provided rules.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateEmployeeRequest(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'password' => 'required|string|min:6|max:12',
            'designation_id' => 'required'
        ];

        return Validator::make($request->all(), $rules);
    }

    public function validateEmployeeUpdateRequest(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:12',
            'designation_id' => 'required'
        ];

        return Validator::make($request->all(), $rules);
    }
}
