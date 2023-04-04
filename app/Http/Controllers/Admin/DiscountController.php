<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\DiscountRequest;
use App\Repositories\DiscountRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DiscountController extends MainController
{
    public $disc_rep;
    public $prod_rep;

    public function __construct(DiscountRepository $disc_rep, ProductRepository $prod_rep) {
        $this->template = 'admin.discount.index';
        $this->disc_rep = $disc_rep;
        $this->prod_rep = $prod_rep;
    }

    public function index()
    {

        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }

        $this->title = 'Скидки';

        $discounts = $this->getCategories();

        $this->content = view('admin.discount.content')->with('discounts', $discounts);

        return $this->renderOutput();
    }

    public function getProducts() {
        return $this->prod_rep->get(['id', 'title']);
    }

    public function getCategories() {
        return $this->disc_rep->get(['id', 'title'], false, true);
    }


    public function create()
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }
        $products = $this->getProducts();

        $this->title = 'Создание скидки';
        $this->content = view('admin.discount.create', compact('products'));
        return $this->renderOutput();
    }


    public function store(DiscountRequest $request)
    {

        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->disc_rep->createDiscount($request);

        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('discount.index')->with($result);

    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }
        $this->title = 'Редактирование скидки';

        $discount = $this->getDiscount($id);
        $products = $this->getProducts();
        $this->content = view('admin.discount.edit')->with(['discount' => $discount, 'products' => $products]);
        return $this->renderOutput();
    }



    public function getDiscount($id) {
        $discount = $this->disc_rep->one($id);

        if(!$discount) {
            return false;
        }
        return $discount;
    }

    public function update(DiscountRequest $request, $id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $discount = $this->getDiscount($id);

        $result = $this->disc_rep->updateDiscount($request, $discount);

        if (is_array($result) && !empty($result['errors'])){

            return redirect()->back()->with($result);
        }

        return redirect()->route('discount.index')->with($result);

    }

    public function destroy($id)
    {
        if(Gate::denies('DELETE_ITEMS')){
            return abort(404);
        }

        $discount = $this->getDiscount($id);
        $result = $this->disc_rep->deleteDiscount($discount);

        if (is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('discount.index')->with($result);
    }
}
