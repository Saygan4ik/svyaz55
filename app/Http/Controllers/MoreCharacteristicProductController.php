<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoreCharacteristicProductRequest;
use App\Repositories\MoreCharacteristicProductRepository;
use Illuminate\Support\Facades\Session;

class MoreCharacteristicProductController extends Controller
{
    protected $moreCharacteristicProductRepository;

    public function __construct(MoreCharacteristicProductRepository $moreCharacteristicProductRepository) {
        $this->moreCharacteristicProductRepository = $moreCharacteristicProductRepository;
        $this->middleware('can:edit-products');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moreCharacteristicsProduct = $this->moreCharacteristicProductRepository->all();
        return view('admin/moreCharacteristicProduct/index', compact('moreCharacteristicsProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/moreCharacteristicProduct/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoreCharacteristicProductRequest $request)
    {
        if ($request->ajax()) {
            $char = $this->moreCharacteristicProductRepository->store($request->all());
            return response()->json(['id' => $char->id, 'text' => $char->text], 200);
        }
        $this->moreCharacteristicProductRepository->store($request->all());
        Session::flash('msg', 'Характеристика успешно создана!');
        return redirect('moreCharacteristicProduct');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $moreCharacteristicProduct = $this->moreCharacteristicProductRepository->getById($id);
        return view('admin/moreCharacteristicProduct/edit', compact('moreCharacteristicProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MoreCharacteristicProductRequest $request, $id)
    {
        $this->moreCharacteristicProductRepository->update($id, $request->all());
        Session::flash('msg', 'Характеристика успешно отредактирована!');
        return redirect('moreCharacteristicProduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->moreCharacteristicProductRepository->delete($id);
        Session::flash('msg', 'Характеристика успешно удалена!');
        return back();
    }
}
