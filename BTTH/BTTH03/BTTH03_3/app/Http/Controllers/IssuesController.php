<?php

namespace App\Http\Controllers;

use App\Models\issues;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    // Hiển thị danh sách sự cố
    public function index()
    {
        $issues = issues::with('computer')->get(); // Kèm thông tin máy tính liên quan
        return response()->json($issues);
    }

    // Hiển thị chi tiết một sự cố
    public function show($id)
    {
        $issue = issues::with('computer')->find($id);
        if (!$issue) {
            return response()->json(['message' => 'Issue not found'], 404);
        }
        return response()->json($issue);
    }

    // Tạo mới một sự cố
    public function store(Request $request)
    {
        $validated = $request->validate([
            'computer_id' => 'required|exists:computers,id', // Đảm bảo máy tính tồn tại
            'reported_by' => 'nullable|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        $issue = issues::create($validated);
        return response()->json($issue, 201);
    }

    // Cập nhật thông tin sự cố
    public function update(Request $request, $id)
    {
        $issue = issues::find($id);
        if (!$issue) {
            return response()->json(['message' => 'Issue not found'], 404);
        }

        $validated = $request->validate([
            'computer_id' => 'exists:computers,id',
            'reported_by' => 'string|max:50',
            'reported_date' => 'date',
            'description' => 'string',
            'urgency' => 'in:Low,Medium,High',
            'status' => 'in:Open,In Progress,Resolved',
        ]);

        $issue->update($validated);
        return response()->json($issue);
    }

    // Xóa sự cố
    public function destroy($id)
    {
        $issue = issues::find($id);
        if (!$issue) {
            return response()->json(['message' => 'Issue not found'], 404);
        }

        $issue->delete();
        return response()->json(['message' => 'Issue deleted successfully']);
    }
}
