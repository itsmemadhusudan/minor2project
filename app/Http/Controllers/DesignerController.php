<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload;
use App\Models\Product;
class DesignerController extends Controller
{
    public function aboutUs()
    {
        return view('aboutus');
    }
    public function culturalProduct(){
        $products = Product::where('category','Cultural')->get();
        return view('cultural', compact('products'));
    }
    public function westernProduct(){
        $products = Product::where('category','Western')->get();
        return view('western', compact('products'));
    }
    public function showDesignerPage(Request $request)
    {
        $sortBy = $request->query('sort', 'name');
        $direction = $request->query('direction', 'asc');
        $priceRange = $request->query('price_range', 'all');
        $category = $request->query('category', 'all');
        $products = Product::query();
        switch ($priceRange) {
            case 'under1000':
                $products->where('price', '<=', 1000);
                break;
            case 'under2000':
                $products->where('price', '<=', 2000)
                        ->where('price', '>', 1000);
                break;
            case 'above2000':
                $products->where('price', '>', 2000);
                break;
        }
        if ($category !== 'all' && in_array($category, ['Western', 'Traditional'])) {
            $products->where('category', $category);
        }
//get products using bubble shorts
        $products = $products->get()->toArray();
        $n = count($products);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                $shouldSwap = false;
                switch ($sortBy) {
                    case 'price':
                        $shouldSwap = $direction === 'asc' ?
                            $products[$j]['price'] > $products[$j + 1]['price'] :
                            $products[$j]['price'] < $products[$j + 1]['price'];
                        break;

                    case 'category':
                        $shouldSwap = $direction === 'asc' ?
                            strcasecmp($products[$j]['category'], $products[$j + 1]['category']) > 0 :
                            strcasecmp($products[$j]['category'], $products[$j + 1]['category']) < 0;
                        break;
                    default:
                        $shouldSwap = $direction === 'asc' ?
                            strcasecmp($products[$j]['name'], $products[$j + 1]['name']) > 0 :
                            strcasecmp($products[$j]['name'], $products[$j + 1]['name']) < 0;
                        break;
                }
                if ($shouldSwap) {
                    $temp = $products[$j];
                    $products[$j] = $products[$j + 1];
                    $products[$j + 1] = $temp;
                }
            }
        }
        $products = collect($products);
        return view('designer', [
            'products' => $products,
            'currentSort' => $sortBy,
            'currentDirection' => $direction,
            'currentPriceRange' => $priceRange,
            'currentCategory' => $category
        ]);
    }
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        return redirect()->route('profile')->with('status', 'Profile updated!');
    }

    public function index()
    {
        $uploads = Upload::all();
        return view('designer', compact('uploads'));
    }
}
