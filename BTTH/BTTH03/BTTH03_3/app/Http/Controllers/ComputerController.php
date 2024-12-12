<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    // Hiển thị danh sách máy tính
    public function index()
    {
        $computers = Computer::all();
        return response()->json($computers);
    }

    // Hiển thị thông tin chi tiết của một máy tính
    public function show($id)
    {
        $computer = Computer::find($id);
        if (!$computer) {
            return response()->json(['message' => 'Computer not found'], 404);
        }
        return response()->json($computer);
    }

    // Tạo mới một máy tính
    public function store(Request $request)
    {
        $validated = $request->validate([
            'computer_name' => 'required|string|max:50',
            'model' => 'required|string|max:100',
            'operating_system' => 'required|string|max:50',
            'processor' => 'required|string|max:50',
            'memory' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        $computer = Computer::create($validated);
        return response()->json($computer, 201);
    }

    // Cập nhật thông tin máy tính
    public function update(Request $request, $id)
    {
        $computer = Computer::find($id);
        if (!$computer) {
            return response()->json(['message' => 'Computer not found'], 404);
        }

        $validated = $request->validate([
            'computer_name' => 'string|max:50',
            'model' => 'string|max:100',
            'operating_system' => 'string|max:50',
            'processor' => 'string|max:50',
            'memory' => 'integer',
            'available' => 'boolean',
        ]);

        $computer->update($validated);
        return response()->json($computer);
    }

    // Xóa máy tính
    public function destroy($id)
    {
        $computer = Computer::find($id);
        if (!$computer) {
            return response()->json(['message' => 'Computer not found'], 404);
        }

        $computer->delete();
        return response()->json(['message' => 'Computer deleted successfully']);
    }
}
