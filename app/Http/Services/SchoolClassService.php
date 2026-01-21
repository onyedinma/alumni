<?php

namespace App\Http\Services;

use App\Models\SchoolClass;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class SchoolClassService
{
    use ResponseTrait;

    public function getAllData()
    {
        $classes = SchoolClass::query()->ordered();

        return datatables($classes)
            ->addIndexColumn()
            ->addColumn('status', function ($class) {
                if ($class->is_active) {
                    return '<span class="status-badge status-active"><i class="fa-solid fa-circle"></i> Active</span>';
                } else {
                    return '<span class="status-badge status-inactive"><i class="fa-solid fa-circle"></i> Inactive</span>';
                }
            })
            ->addColumn('action', function ($class) {
                $html = '<div class="action-btns">';
                $html .= '<button type="button" class="action-btn action-btn-edit edit" data-id="' . $class->id . '" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>';
                $html .= '<button type="button" onclick="deleteItem(\'' . route('admin.setting.classes.delete', $class->id) . '\',\'classDataTable\')" class="action-btn action-btn-delete" title="Delete"><i class="fa-solid fa-trash"></i></button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $class = new SchoolClass();
            $class->name = $request->name;
            $class->level = $request->level;
            $class->year_number = $request->year_number;
            $class->arm = $request->arm;
            $class->sort_order = $request->sort_order ?? 0;
            $class->is_active = $request->is_active ?? true;
            $class->save();

            DB::commit();
            return $this->success([], __('Class created successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], __('Failed to create class: ') . $e->getMessage());
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $class = SchoolClass::findOrFail($id);
            $class->name = $request->name;
            $class->level = $request->level ?? $class->level;
            $class->year_number = $request->year_number ?? $class->year_number;
            $class->arm = $request->arm ?? $class->arm;
            $class->sort_order = $request->sort_order ?? $class->sort_order;
            $class->is_active = $request->has('is_active') ? $request->is_active : $class->is_active;
            $class->save();

            DB::commit();
            return $this->success([], __('Class updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], __('Failed to update class: ') . $e->getMessage());
        }
    }

    public function deleteById($id)
    {
        try {
            $class = SchoolClass::findOrFail($id);

            // Check if class is in use
            if ($class->firstYearAlumni()->count() > 0 || $class->finalYearAlumni()->count() > 0) {
                return $this->error([], __('Cannot delete class: It is assigned to alumni'));
            }

            $class->delete();
            return $this->success([], __('Class deleted successfully'));
        } catch (Exception $e) {
            return $this->error([], __('Failed to delete class: ') . $e->getMessage());
        }
    }
}
