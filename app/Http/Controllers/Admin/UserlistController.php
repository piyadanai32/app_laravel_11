<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserlistController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10); // ดึงข้อมูลและแบ่งหน้า 
        return view('admin.users', compact('users')); // ส่งข้อมูลไปยัง View
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usertype' => 'required|in:admin,user'  // แก้ไขเฉพาะ usertype
        ]);

        $user = User::findOrFail($id);
        $user->usertype = $request->usertype;  // อัปเดตแค่ usertype
        $user->save();

        return redirect()->route('admin.users')->with('success', 'อัปเดตข้อมูลผู้ใช้เรียบร้อยแล้ว');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'ลบผู้ใช้เรียบร้อยแล้ว');
    }
}
