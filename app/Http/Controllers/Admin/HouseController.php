<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HouseRequest;
use App\Http\Services\HouseService;
use App\Models\House;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    use ResponseTrait;

    private $houseService;

    public function __construct()
    {
        $this->houseService = new HouseService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->houseService->getAllData();
        }

        $data['title'] = __('House Settings');
        $data['showManageApplicationSetting'] = 'show';
        $data['activeHousesSetting'] = 'active-color-one';
        return view('admin.setting.houses.index', $data);
    }

    public function edit($id)
    {
        $data['house'] = House::findOrFail($id);
        return view('admin.setting.houses.edit-form', $data);
    }

    public function store(HouseRequest $request)
    {
        return $this->houseService->store($request);
    }

    public function update(HouseRequest $request, $id)
    {
        return $this->houseService->update($request, $id);
    }

    public function delete($id)
    {
        return $this->houseService->deleteById($id);
    }
}
