<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Traits\JsonResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, JsonResponse;
    public $per_page = 10;
    public $sort_by = 'created_at';
    public $sort_key = 'desc';
    public $search_type = 'name';
    public $permission = null;

    public function __construct(Request $request)
    {
        $this->setPermission();
        if ($request->input('search_type')) $this->search_type = $request->search_type;
        if ($request->input('per_page')) $this->per_page = $request->per_page;
        if ($request->input('sort_by')) $this->sort_by = $request->sort_by;
        if ($request->input('sort_key')) $this->sort_key = ($request->sort_key == 'asc') ? 'asc' : 'desc';
    }

    public function setPermission()
    {

        $this->permission = str_replace('-', '.', Str::kebab(str_replace('Controller', '', class_basename($this))));
        if (!$this->is_public) {
            $this->middleware('permission:' . $this->permission . '-list', ['only' => ['index']]);
            $this->middleware('permission:' . $this->permission . '-view', ['only' => ['show']]);
        }
        if ($this->need_permission) {
            $this->middleware('permission:' . $this->permission . '-create', ['only' => ['store']]);
            $this->middleware('permission:' . $this->permission . '-edit', ['only' => ['update']]);
            $this->middleware('permission:' . $this->permission . '-delete', ['only' => ['destroy']]);
        }
    }

    public function search(Builder $data, Request $request)
    {
        if ($request->input('search')) {
            $search = Str::lower(str_replace(' ', '%', $request->input('search')));
            if (Str::contains($this->search_type, '.')) {
                $key = explode('.', $this->search_type);
                $searchKey = end($key);
                array_pop($key);
                $relation = implode('.', $key);
                $data->whereHas($relation, function ($q) use ($search, $searchKey) {
                    $q->where($searchKey, 'like', '%' . $search . '%');
                });
            } else {
                $data->whereRaw("LOWER($this->search_type) like '%" . $search . "%'");
            }
        }
        $filter = Arr::except($request->input(), ['search', 'search_type', 'per_page', 'sort_by', 'sort_key']);
        $availableColumn = $this->getAvailableColumns($data);
        $filter = Arr::only($filter, $availableColumn);
        if (count($filter) > 0) $data->where($filter);
        if (Str::contains($this->sort_by, '.')) {
        } else {
        }
        return $data->orderBy($this->sort_by, $this->sort_key)
            ->paginate($this->per_page)
            ->withQueryString()
            ->onEachSide(1);
    }

    public function getAvailableColumns(Builder $data)
    {
        $table = $data->getModel()->getTable();
        $hash = md5("DBColumnName_" . $table);
        $columns = Cache::get($hash);
        if (empty($columns)) {
            $columns = Schema::getColumnListing($table);
            Cache::put($hash, $columns, 3600);
        }
        return $columns;
    }
}