<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function dashboard_data()
    {
        $total_companies = Company::count();
        $total_employees = Employee::count();
        $total_users = User::count();
        return response()->json(
            [
                'totalCompanies'=>$total_companies,
                'totalEmployees'=>$total_employees,
                'totalUsers'=>$total_users
                ]
            );


    }
 
}
