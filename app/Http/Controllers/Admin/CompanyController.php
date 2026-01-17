<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Company;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $data=Company::where('stir','<>',null)->paginate(10);
        //dd($data->total());
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req=$request->all();  
        //dd($req['surename']);
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->post('localhost:8000/base/hs/clients/client',[
            'clientName'=>$req['clientName'],
            'surename'=>$req['surename'],
            'phone'=>$req['phone'],
            'brand'=>$req['brand']
        ]);
       // dd($res);
        if($res->status()==200){
                $jsonData=$res->json();
                //dd($jsonData['data']);
                $dataArr=$jsonData["data"];
                foreach($dataArr as $data){
                    //if($data["mob"]!=""){
                        //dd($data);

                    //}
                    $cmpn=Company::create([
                        'id'=>$data['id'],
                        'code'=>$data['code'],
                        'name'=>$data['name'],
                        'fullName'=>$data['fullName'],
                        'address'=>$data['address'],
                        'mob'=>$data['mob']
                    ]);
                    //dd($cmpn);
                }
                //dd($companies);
        }else{
           
        }
        return to_route('admin.company.show',['company'=>$cmpn->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //dd($id);
        $company=Company::where('id',$id)->first();
        //dd($company);
        return view('company.show',compact('company'));
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

    public function refresh(){
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->get('localhost:8000/base/hs/crm/company');
        if($res->status()==200){
                $jsonData=$res->json();
                //dd($jsonData['count']);
                $data=$jsonData["data"];
                $companies=Company::upsert(
                    $data,
                    ['stir'],
                    ['code','name','fullName','address','mob']
                );
                //dd($companies);
        }else{
            //dd($res);
        }
        
        return to_route('admin.company.index');
        
        
        
        
        //dd($res);
    }

    public function newOrder(Company $company){
       //dd($company);
       $userId = auth()->id();
       $newOrder=$company->orders()->create([
            "user_id"=>$userId,
            "price_type_id"=>$company->price_type_id

       ]);
       $newOrder->status()->create([
        "user_id"=>$userId
        

       ]);
       $task=Task::create([
        'user_id'=>'9f8b646a-89c9-40c3-8099-465b65c279d5',
        'author'=>$userId,
        'title'=>$company->name." yetkazib berish",
        'task'=>'delivery',
        'type'=>'delivery',
        'doc_id'=>$newOrder->id,
        'expires_at'=>now()->addDays(3)
    ]);
    TaskStatus::create([
        'user_id'=>$userId,
        'task_id'=>$task->id
    ]);
       return to_route('admin.order.show',['order'=>$newOrder->id]);
       //dd($newOrder);
    }
}
