<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Need,NeedItem,Item};

class NeedController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $needs = Need::latest()->paginate(10);
        return view('needs.index', compact('needs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('needs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['file'=>'required|mimes:csv,txt']);
        $need = Need::create(['uploaded_by'=>auth()->id()]);
        $rows = array_map('str_getcsv', file($request->file('file')->getRealPath()));
        foreach(array_slice($rows,1)as $row){
            if(count($row)<3)continue;
            [$line,$name,$qty,$unit]=array_pad($row,4,null);
            $item = Item::firstOrCreate(['name'=>trim($name)],['unit'=>$unit?:'pcs']);
            NeedItem::create(['need_id'=>$need->id, 'item_id'=>$item->id, 'qty'=>$qty?:0]);

        }
        return redirect()->route('proc.compare.show', $need);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
