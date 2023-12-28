<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use App\Traits\ValidateRequestTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits;

class EmployeeController extends Controller
{
    use ValidateRequestTrait;
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $employees = Employee::with('designation')->paginate(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $designations = Designation::select('id','title')->get();
        return view('employees.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateEmployeeRequest($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $employee = $request->except('_token');
        Employee::create($employee);
        return back()->withSuccess('Employee created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function show(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return Application|Factory|View
     */
    public function edit(employee $employee, $id)
    {
        $employee = Employee::findOrFail($id);
        $designations = Designation::select('id','title')->get();
        return view('employees.edit',compact('employee','designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateEmployeeUpdateRequest($request);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        $employee = $request->except('_token');
        Employee::where('id', $id)->update($employee);
        return back()->withSuccess('Employee updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *getMessages
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return back()->withSuccess('Employee deleted Successfully');
    }


    public function search(Request $request)
    {
        $employees = Employee::getBySearch($request['search'])->paginate(5);
        return view('partials.employeesList', compact('employees'));
    }
}
