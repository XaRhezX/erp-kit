<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationProvince;
use Illuminate\Http\Request;
use App\Http\Requests\Location\Province\StoreRequest;
use App\Http\Requests\Location\Province\UpdateRequest;
use App\Actions\Location\Province\Store;
use App\Actions\Location\Province\Update;
use App\Actions\Location\Province\Delete;


class ProvinceController extends Controller
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
        $model = LocationProvince::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\Province\StoreRequest  $request
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
     * @param  \App\Models\LocationProvince  $locationProvince
     * @return \Illuminate\Http\Response
     */
    public function show(LocationProvince $locationProvince)
    {
        //$locationProvince->load();
        return $this->success($locationProvince);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\Province\UpdateRequest  $request
     * @param  \App\Models\LocationProvince  $locationProvince
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, LocationProvince $locationProvince)
    {
        $update = Update::run($locationProvince,$request->validated());
        return $this->success($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationProvince  $locationProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationProvince $locationProvince)
    {
        $delete = Delete::run($locationProvince);
        return $this->success($delete);
    }
}
