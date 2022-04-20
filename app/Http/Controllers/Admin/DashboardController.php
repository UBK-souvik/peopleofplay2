<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Product;
use App\Models\Role;
use App\Models\Blog;
use App\Models\Poll;
use App\Models\News;
use App\Models\Event;

class DashboardController extends Controller
{
    public function getIndex()
    {
        userMenuList();
        $total_company = '';
        $people = User::where('role',2)->count();
        $company = User::where('role',3)->count();
        $products = Product::count();
        $roles = Role::count();
        $Blogs = Blog::count();
        $Poll = Poll::count();
        $News = News::count();
        $Events = Event::count();

        return view('admin.dashboard.index', compact('Events','people','company','products','roles','Blogs','Poll','News') );
    }
}
