<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::get();
        $totalUser = $user->count();
        $totalActiveUser = $user->where('is_active',1)->count();
        $totalDectiveUser = $user->where('is_active',0)->count();
        $department = Department::count();
        return response()->json([
            'totalUser'=>$totalUser,
            'totalActiveUser'=>$totalActiveUser,
            'totalInactiveUser'=>$totalDectiveUser,
            'department'=>$department,
        ]);
    }
}
