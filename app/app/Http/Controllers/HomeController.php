<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

class HomeController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $items = Item::with(['category', 'images'])->where('approval_state', 'approved')->get();
        $categories = Category::all();

        return view('home', ['categories' => $categories, 'items' => $items]);
    }

    public function statistics() {
        $category_counts = Item::selectRaw("count('category_id') as count, categories.name")
          ->join('categories', 'items.category_id', '=', 'categories.id')
          ->groupBy('category_id')
          ->get();

        $item_dates = Item::selectRaw("count(date_reported) as count, date_reported")
          ->groupBy('date_reported')
          ->get();
        return view('stats', ['category_counts' => $category_counts, 'item_dates' => $item_dates]);
    }

    public function welcome() {
        return view('welcome');
    }
}
