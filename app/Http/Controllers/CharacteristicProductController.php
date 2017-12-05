<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacteristicProductRequest;
use App\Repositories\CharacteristicProductRepository;
use Illuminate\Support\Facades\Session;

class CharacteristicProductController extends Controller
{
    protected $characteristicProductRepository;

    public function __construct(CharacteristicProductRepository $characteristicProductRepository) {
        $this->characteristicProductRepository = $characteristicProductRepository;
        $this->middleware('can:edit-products');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characteristicsProduct = $this->characteristicProductRepository->all();
        return view('admin/characteristicProduct/index', compact('characteristicsProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/characteristicProduct/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacteristicProductRequest $request)
    {
        if ($request->ajax()) {
            $char = $this->characteristicProductRepository->store($request->all());
            return response()->json(['id' => $char->id, 'name' => $char->name, 'slug' => $char->slug, 'unit' => $char->unit], 200);
        }
        $this->characteristicProductRepository->store($request->all());
        Session::flash('msg', 'Характеристика успешно создана!');
        return redirect('characteristicProduct');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $characteristicProduct = $this->characteristicProductRepository->getBySlug($slug);
        return view('admin/characteristicProduct/edit', compact('characteristicProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CharacteristicProductRequest $request, $slug)
    {
        $this->characteristicProductRepository->update($slug, $request->all());
        Session::flash('msg', 'Характеристика успешно отредактирована!');
        return redirect('characteristicProduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->characteristicProductRepository->delete($id);
        Session::flash('msg', 'Характеристика успешно удалена!');
        return back();
    }
}
