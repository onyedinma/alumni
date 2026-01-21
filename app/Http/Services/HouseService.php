<?php

namespace App\Http\Services;

use App\Models\House;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class HouseService
{
    use ResponseTrait;

    public function getAllData()
    {
        $houses = House::query()->orderBy('name');

        return datatables($houses)
            ->addIndexColumn()
            ->addColumn('color_preview', function ($house) {
                if ($house->color_code) {
                    return '<span class="color-preview-badge" style="display:inline-flex;align-items:center;gap:8px;padding:6px 12px;border-radius:8px;background:' . $house->color_code . '20;border:1px solid ' . $house->color_code . '40;"><span style="width:18px;height:18px;border-radius:4px;background:' . $house->color_code . ';"></span><span style="color:' . $house->color_code . ';font-weight:500;">' . $house->color_code . '</span></span>';
                }
                return '<span style="color:#666;">No color</span>';
            })
            ->addColumn('status', function ($house) {
                if ($house->is_active) {
                    return '<span class="status-badge status-active"><i class="fa-solid fa-circle"></i> Active</span>';
                } else {
                    return '<span class="status-badge status-inactive"><i class="fa-solid fa-circle"></i> Inactive</span>';
                }
            })
            ->addColumn('action', function ($house) {
                $html = '<div class="action-btns">';
                $html .= '<button type="button" class="action-btn action-btn-edit edit" data-id="' . $house->id . '" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>';
                $html .= '<button type="button" onclick="deleteItem(\'' . route('admin.setting.houses.delete', $house->id) . '\',\'houseDataTable\')" class="action-btn action-btn-delete" title="Delete"><i class="fa-solid fa-trash"></i></button>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['color_preview', 'status', 'action'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $house = new House();
            $house->name = $request->name;
            $house->color_code = $request->color_code;
            $house->description = $request->description;
            $house->is_active = $request->is_active ?? true;
            $house->save();

            DB::commit();
            return $this->success([], __('House created successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], __('Failed to create house: ') . $e->getMessage());
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $house = House::findOrFail($id);
            $house->name = $request->name;
            $house->color_code = $request->color_code ?? $house->color_code;
            $house->description = $request->description ?? $house->description;
            $house->is_active = $request->has('is_active') ? $request->is_active : $house->is_active;
            $house->save();

            DB::commit();
            return $this->success([], __('House updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], __('Failed to update house: ') . $e->getMessage());
        }
    }

    public function deleteById($id)
    {
        try {
            $house = House::findOrFail($id);

            // Check if house is in use
            if ($house->firstHouseAlumni()->count() > 0 || $house->finalHouseAlumni()->count() > 0) {
                return $this->error([], __('Cannot delete house: It is assigned to alumni'));
            }

            $house->delete();
            return $this->success([], __('House deleted successfully'));
        } catch (Exception $e) {
            return $this->error([], __('Failed to delete house: ') . $e->getMessage());
        }
    }
}
