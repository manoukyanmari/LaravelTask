<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(24);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->input("product_name");
        $product->quantity = $request->input("quantity");
        $product->price = $request->input("price");
        $product->save();

        $path = storage_path('product');
        if (!File::exists($path)) {
            mkdir($path);
        }
        
//        $fileTxt = fopen($path . "/Rabbit.json", "w");
        $response = json_encode($product);
//        fwrite($fileTxt, json_encode($response));

        file_put_contents($path. "/Rabbit.json" . "\r\n" . $response, FILE_APPEND);

//        fclose($fileTxt);

        return redirect()->route('products.index')->with('message', 'Item created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);


//        $path = storage_path('show');
//        if (!File::exists($path)) {
//            mkdir($path);
//        }
//        File::delete($path."/" . $product['name'] . ".txt");

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Item deleted successfully.');
    }

}
