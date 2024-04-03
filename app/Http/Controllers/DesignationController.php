<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Designation;
use App\Http\Resources\DesignationResource;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $designations = Designation::with('users')->latest();

        $designations = $designations->paginate($request->get('rows', 10));

        return DesignationResource::collection($designations);
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
        // return $request;
        $request->validate([
            'name' => 'required|string',
        ]);
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->description = $request->description;


        $designation->save();

        return message('Designation created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return DesignationResource::make($designation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {

        if (!$designation)
            return response()->json(['message' => 'Designation not found!'], 404);

        $request->validate([
            'name' => 'required|string',

        ]);

        $designation->update([
            'name' => $request->name,
            'description' => $request->description,

        ]);

        return message('Designation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if ($designation->delete())
            return message('Designation deleted successfully');

        return message('Something went wrong', 400);
    }
}
