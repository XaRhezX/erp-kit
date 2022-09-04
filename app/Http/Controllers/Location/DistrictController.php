<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationDistrict;
use Illuminate\Http\Request;
use App\Http\Requests\Location\District\StoreRequest;
use App\Http\Requests\Location\District\UpdateRequest;
use App\Actions\Location\District\Store;
use App\Actions\Location\District\Update;
use App\Actions\Location\District\Delete;


class DistrictController extends Controller
{
    protected $is_public = true;
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
        $store = Store::run($request->validated());
        return $this->success($store);
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
        $update = Update::run($locationDistrict,$request->validated());
        return $this->success($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationDistrict $locationDistrict)
    {
        $delete = Delete::run($locationDistrict);
        return $this->success($delete);
    }
}
