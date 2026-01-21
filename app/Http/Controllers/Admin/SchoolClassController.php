<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolClassRequest;
use App\Http\Services\SchoolClassService;
use App\Models\SchoolClass;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    use ResponseTrait;

    private $classService;

    public function __construct()
    {
        $this->classService = new SchoolClassService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->classService->getAllData();
        }

        $data['title'] = __('Class Settings');
        $data['showManageApplicationSetting'] = 'show';
        $data['activeClassesSetting'] = 'active-color-one';
        return view('admin.setting.classes.index', $data);
    }

    public function edit($id)
    {
        $data['class'] = SchoolClass::findOrFail($id);
        return view('admin.setting.classes.edit-form', $data);
    }

    public function store(SchoolClassRequest $request)
    {
        return $this->classService->store($request);
    }

    public function update(SchoolClassRequest $request, $id)
    {
        return $this->classService->update($request, $id);
    }

    public function delete($id)
    {
        return $this->classService->deleteById($id);
    }
}
