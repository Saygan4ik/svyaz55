<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\CharacteristicProductRepository;
use App\Repositories\MoreCharacteristicProductRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $characteristicProductRepository;
    protected $moreCharacteristicProductRepository;

    public function __construct(ProductRepository $productRepository,
                                CategoryRepository $categoryRepository,
                                CharacteristicProductRepository $characteristicProductRepository,
                                MoreCharacteristicProductRepository $moreCharacteristicProductRepository) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->characteristicProductRepository = $characteristicProductRepository;
        $this->moreCharacteristicProductRepository = $moreCharacteristicProductRepository;
        $this->middleware('can:edit-products')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all(['slug', 'name', 'visible']);
        $characteristics = $this->characteristicProductRepository->all();
        $moreCharacteristics =$this->moreCharacteristicProductRepository->all();
        return view('admin/product/create', compact('categories', 'characteristics', 'moreCharacteristics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->store($request->all());
        Session::flash('msg', 'Товар успешно создан!');
        return redirect('product/'.$product->slug.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = $this->productRepository->getBySlug($slug);
        $images = $this->productRepository->getProductImages($product->id);
        $categories = $this->categoryRepository->all(['slug', 'name', 'visible']);
        $characteristics = $this->characteristicProductRepository->all();
        $moreCharacteristics =$this->moreCharacteristicProductRepository->all();
        return view('admin/product/edit', compact('product', 'categories', 'images', 'characteristics', 'moreCharacteristics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $slug)
    {
        $product = $this->productRepository->update($slug, $request->all());
        Session::flash('msg', 'Товар успешно создан!');
        return redirect('product/'.$product->slug.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveImage(Request $request, $id) {
        if (Auth::user()) {
            if ($this->productRepository->saveImage($request, $id)) {
                Session::flash('msg', 'Изображение добавлено!');
                return response()->json([], 200);
            }
            else {
                Session::flash('msg', 'Ошибка при сохранение');
                return response()->json([], 200);
            }
        }
        else {
            return abort(401);
        }
    }

    public function deleteImage($id) {
        if (Auth::user()) {
            $this->productRepository->deleteImage($id);
            Session::flash('msg', 'Изображение успешно удалено');
            return back();
        }
        else {
            return abort(401);
        }
    }

    public function setMainImage(Request $request) {
        $imageId = $this->productRepository->setMainImage($request->all());
        return response(['image_id' => $imageId], 200);
    }
}
