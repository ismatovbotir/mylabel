<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BDB commerce and service">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>{{$order->company->name}}</title>
    <!-- StyleSheets  -->
    <style>
        .agrement{
           border:none;
           border-bottom: 1px solid grey;

        }
    </style>
    <link rel="stylesheet" href="http://crm.mylabel.uz/assets/css/dashlite.css?ver=2.4.0">
    <link id="skin-default" rel="stylesheet" href="http://crm.mylabel.uz/assets/css/theme.css?ver=2.4.0'">
    <style>
       * {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>

<body class="bg-white" >
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    @php
                    $dateName=[
                        '01'=>'января',
                        '02'=>'февраля',
                        '03'=>'марта',
                        '04'=>'апреля',
                        '05'=>'майа',
                        '06'=>'июня',
                        '07'=>'июля',
                        '08'=>'августа',
                        '09'=>'сентября',
                        '10'=>'октября',
                        '11'=>'ноября',
                        '12'=>'декабря'

                    ]
                @endphp
                    
                    
                    <h5>Спецификация № {{$order->bill}} от {{$order->updated_at->format('d')}} {{$dateName[$order->updated_at->format('m')]}} {{$order->updated_at->format('Y')}}г.</h5>
                   
                    <h5>К договору поставки товара №
                        @if($order->agreement_number!="") 
                         {{$order->agreement_number}} от {{substr($order->agreement_date,8,2)}} {{$dateName[substr($order->agreement_date,5,2)]}} {{substr($order->agreement_date,0,4)}} г.
                    @else    
                        <input class="agrement" type="text" style="width:80px;"> от <input type="text" class="agrement" style="width:150px;">
                    @endif
                    </h5>
                </div>
                <div class="invoice-head mt-2">
                    <div class="invoice-contact">
                        
                        <div class="invoice-contact-info">
                            <h6 class="title">OOO "BDB COMMERCE AND SERVICE"</h6>
                            
                            <h5 class="title text-center">ИНН:	309738079</h5>
                        </div>
                    </div>
                    <div class="invoice-contact">
                        <h6 class="title text-wrap"  >{{$order->company->fullName}} </h6>
                            
                        <h5 class="title text-center">ИНН:	{{$order->company->stir}}</h5>
                        
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th >№</th>
                                    <th class="text-center">ИКПУ</th>
                                    <th class="text-center">Наименование товара</th>
                                    <th class="text-center">К-во</th>
                                    <th class="text-center">Ед.</th>
                                    <th class="text-center">Цена за ед. сум</th>
                                    <th class="text-center">Сумма, сум</th>
                                    <th class="text-center">Сумма НДС</th>
                                    <th class="text-center">Стоимость поставки с учетом НДС</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                               
                                @endphp
                                @foreach($order->orderItems as $idx=>$item)
                                <tr>
                                    <td>{{$idx+1}}</td>
                                    <td>{{$item->item->mxik}}</td>
                                    <td>{{$item->item->acc_name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>шт</td>
                                    <td class="text-nowrap">{{number_format($item->price/1.12,2,'.',' ')}}</td>
                                    <td class="text-nowrap">{{number_format($item->price/1.12*$item->qty,2,'.',' ')}}</td>
                                    <td class="text-nowrap">{{number_format($item->qty*$item->price*12/112,2,'.',' ')}}</td>
                                    <td class="text-nowrap">{{number_format($item->qty*$item->price,2,'.',' ')}}</td>
                                </tr>
                                    @php
                                        $total+=$item->qty*$item->price;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td >Итого:</td>
                                    <td colspan="2">{{number_format($total,2,'.',' ')}}</td>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->
    
</body>

</html>