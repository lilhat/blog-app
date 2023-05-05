<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $posts = BlogPost::count();
        $users = User::where('role_as','0')->count();
        $admins = User::where('role_as','1')->count();

        return view('admin.dashboard', compact('categories','posts','users','admins'));
    }
}
