<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.list.index', compact('users'));
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'Delete Success...']);
    }
    public function searchList(Request $request)
    {
        $users = User::orWhere('name', 'LIKE', '%' . $request->searchKey . '%')->
            orWhere('email', 'LIKE', '%' . $request->searchKey . '%')->
            orWhere('phone', 'LIKE', '%' . $request->searchKey . '%')->
            orWhere('address', 'LIKE', '%' . $request->searchKey . '%')->
            orWhere('gender', 'LIKE', '%' . $request->searchKey . '%')
            ->get();
        return view('admin.list.index', compact('users'));
    }
}
