<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationDistrict;
use Illuminate\Http\Request;
use App\Http\Requests\Location\District\StoreRequest;
use App\Http\Requests\Location\District\UpdateRequest;

class DistrictController extends Controller
{
    protected $is_public = false;
    protected $need_permission = true;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = LocationDistrict::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\District\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $created = LocationDistrict::create($request->validated());
        return $this->success($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(LocationDistrict $locationDistrict)
    {
        //$locationDistrict->load();
        return $this->success($locationDistrict);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\District\UpdateRequest  $request
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, LocationDistrict $locationDistrict)
    {
        $locationDistrict->update($request->validated());
        return $this->success($locationDistrict);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationDistrict $locationDistrict)
    {
        $locationDistrict->delete();
        return $this->success($locationDistrict);
    }
}
