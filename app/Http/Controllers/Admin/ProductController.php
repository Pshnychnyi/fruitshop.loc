<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends MainController
{

    private $prod_rep;
    private $cat_rep;

    public function __construct(ProductRepository $prod_rep, CategoryRepository $cat_rep)
    {
        $this->template = 'admin.product.index';
        $this->prod_rep = $prod_rep;
        $this->cat_rep = $cat_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }

        $this->title = 'Продукты';
        $products = $this->getProducts(true);

        $this->content = view('admin.product.content')->with('products', $products);

        return $this->renderOutput();
    }

    public function getProducts($paginate = false)
    {
        return $this->prod_rep->get(['id', 'title'], false, $paginate);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $this->title = 'Создание продукта';

        $per = ['1кг', '500г', '100г'];

        $categories = $this->getCategories();
        $products = $this->getProducts();


        $this->content = view('admin.product.create', compact('categories', 'products', 'per'));

        return $this->renderOutput();
    }

    public function getCategories() {
        return $this->cat_rep->get(['id', 'title']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->prod_rep->createProduct($request);

        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('product.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $this->title = 'Редактирование продукта';

        $per = ['1кг', '500г', '100г'];

        $product = $this->getProduct($id);
        $products = $this->getProducts()->except($product->id);
        $categories = $this->getCategories();

        $this->content = view('admin.product.edit', compact('product', 'categories', 'products', 'per'));

        return $this->renderOutput();
    }

    public function getProduct($id) {

        return $this->prod_rep->one($id) ?: false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $product = $this->getProduct($id);

        $result = $this->prod_rep->updateProduct($request, $product);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('product.index')->with($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('DELETE_ITEMS')){
            return abort(404);
        }

        $product = $this->getProduct($id);

        $result = $this->prod_rep->deleteProduct($product);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('product.index')->with($result);
    }
}
