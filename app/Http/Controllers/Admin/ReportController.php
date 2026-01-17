<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Company;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    public function company($stir)
    {
        $company = Company::where('stir', $stir)->first();
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->post('localhost:8000/base/hs/reports/client/' . $stir);
        if ($res->status() == 200) {
            //dd($res);
            $jsonData = $res->json();
            //dd($jsonData);
            if ($jsonData["records"] == 0) {
                return view('reports.company', ['close' => $jsonData["records"], 'data' => [], 'company' => $company->name]);
            }
            $dataArr = $jsonData["data"];
            //dd($dataArr);
          
              //  dd($labels);
                $dataChart= collect($dataArr)
                ->flatMap(fn($doc) => $doc['items']) // собрать все товары в один массив
                ->groupBy('item') // группировать по ID товара
                ->map(function ($items) {
                    return [
                        'item' => $items->first()['item'],
                        'qty' => $items->sum('qty'),
                        'value' => $items->sum('value'),
                        'total' => $items->sum('total'),
                        'profit' => $items->sum('profit')
                    ];
                });


            //dd($dataChart);
            return view('reports.company', ['data' => $dataArr, 'close' => $jsonData["records"], 'company' => $company->name,'dataChart'=>$dataChart]);
        } else {
            return view('reports.company', ['close' => 0, 'data' => [], 'company' => $company->name]);
        }
    }
}
