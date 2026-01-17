<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use App\Models\Category;
use App\Models\OrderItem;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Item::paginate(20);
        //dd($data);
        return view('item.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        //dd($categories);
        return view('item.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Item::find($id)->first();
        $categories=Category::all();
        //dd($categories);
        return view('item.edit',compact('item','categories'));
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

    public function refresh(){
        
            $res = Http::withHeaders([
                'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
                'Accept' => 'application/json'
            ])->get('localhost:8000/base/hs/crm/item');
            if($res->status()==200){
                    $jsonData=$res->json();
                    //dd($jsonData['count']);
                    $data=$jsonData["data"];
                    $items=Item::upsert(
                        $data,
                        ['code'],
                        ['name','mxik','package_code','unit','acc_code','acc_name','barcode']
                    );
                    //dd($items);
            }else{
                dd($res);
            }
            return to_route('admin.item.index');
            //dd($res);
    }

    public function report($item){
        $report=OrderItem::where('item_id',$item)->with(['order.company'])->get();
        //dd($report);
        return view('item.report',compact('report'));

    }
    
}
