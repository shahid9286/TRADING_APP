<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use App\Models\Event;

use Carbon\Carbon;
use App\Models\Branch;
class DashboardController extends Controller
{
    public function adminDashboard()
    {

        return view('admin.dashboard');
    }

    public function userDashboard()
    {
        return view("user.dashboard");
    }
}
