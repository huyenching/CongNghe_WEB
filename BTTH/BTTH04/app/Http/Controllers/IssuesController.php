<?php

namespace App\Http\Controllers;

use App\Models\Computers;
use App\Models\Issues;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    public function index(){
        $data = Issues::with('computer')->paginate(5);
        return view("issues.index",compact("data"));
    }
    public function create(){ 
        $computer = Computers::all();
        return view("issues.create",compact("computer"));
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'computer_name' => 'required',
            'reported_by' => 'required',
            'reported_date' => 'required|after_or_equal:today',
            'description' => 'required',
            'urgency'=> 'required',
            'status'=> 'required',
            ], [
            'computer_name.required' => 'Vui lòng chọn tên.',
            'reported_by.required' => 'Vui lòng nhập người báo cáo.',
            'reported_date.required' => 'Vui lòng chọn ngày.',
            'date.after_or_equal' => 'Ngày phải từ hôm nay trở đi.',
            'description.required'=> 'Vui lòng nhập mô tả chi tiết',
            'urgency.required' => 'Vui lòng chọn mức độ sự cố.',
            'status.required'=> 'Vui lòng chọn trạng thái của sự cố',
            ]);
            $computer_name = Computers::where('computer_name',
            $request->computer_name)->first();
            if ($computer_name) {
            Issues::create([
            'computer_id' => $computer_name->id,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'description' => $request->description,
            'urgency' => $request->urgency,
            'status'=> $request->status,
            ]);
            session()->flash('success', 'Thêm thành công!');
            }
           return redirect()->route('issues.index')->with('success','Thêm thành công');
    }
    public function edit($id){

        $isues = Issues::with('computer')->findOrFail($id);
        $computer_name = Computers::all();
        return view('issues.edit', compact('isues' , 'computer_name'));
    }

    public function update(Request $request,$id){
        // dd($request);
        $validatedData = $request->validate([
            'computer_name' => 'required',
            'reported_by' => 'required',
            'reported_date' => 'required|after_or_equal:today',
            'description' => 'required',
            'urgency'=> 'required',
            'status'=> 'required',
            ], [
            'computer_name.required' => 'Vui lòng chọn tên.',
            'reported_by.required' => 'Vui lòng nhập người báo cáo.',
            'reported_date.required' => 'Vui lòng chọn ngày.',
            'date.after_or_equal' => 'Ngày phải từ hôm nay trở đi.',
            'description.required'=> 'Vui lòng nhập mô tả chi tiết',
            'urgency.required' => 'Vui lòng chọn mức độ sự cố.',
            'status.required'=> 'Vui lòng chọn trạng thái của sự cố',
            ]);
            $isues = Issues::find($id);
            $computer_name = Computers::where('computer_name',$request->computer_name)->first();
            $isues->update([
                'computer_id' => $computer_name->id,
                'reported_by' => $request->reported_by,
                'reported_date' => $request->reported_date,
                'description' => $request->description,
                'urgency' => $request->urgency,
                'status'=> $request->status,
           ] );
           return redirect()->route('issues.index')->with('success', 'Cập nhật thành công.');
    }
    public function destroy($id){
        $issues = Issues::find($id);
        $issues->delete();
        return redirect()->route('issues.index')->with('success','Xóa thành công');
    }


}
