<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Коммерческое предложение</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin:20px 300px 0 300px;
            font-size: 14px;
            color: #000;
        }
        @media screen and (max-width: 1024px) {
            body {
                margin: 10px; /* маленькие отступы на мобилке */
                font-size: 12px;
            }
        }


        /* A4 формат */
        @page {
            size: A4;
            margin: 20mm;
        }

        @media print {
            body {
                margin: 0;
            }
        }

        /* Шапка */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 80px;
        }
        .company-info {
            text-align: right;
        }
        .company-info h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .company-info p {
            margin: 2px 0;
            font-size: 13px;
        }

        /* Заголовок */
        .title {
            text-align: center;
            font-size: 18px;
            margin: 20px 0 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .intro {
            margin: 15px 0 20px;
        }

        /* Таблица */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }
        th, td{
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-size: 13px;
            word-wrap: break-word;

        }
        .cell-left {
           
            text-align: left;
            
        }
        .cell-right {
            
            text-align: right;
            
        }

        th {
            background: #f2f2f2;
        }
        /* Ячейка для фото */
td.photo-cell, th.photo-cell {
    width: 100px;     /* можно регулировать */
    height: 100px;    /* высота строки под фото */
    text-align: center;
    vertical-align: middle;
}

/* Картинка */
td.photo-cell img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* вписывается без обрезки */
    display: block;
    margin: 0 auto;
}

        /* Итог */
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Условия */
        .footer {
            margin-top: 30px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <!-- Шапка -->
    <div class="header">
        <div class="logo">
            <img src="\images\logo.jpg" alt="Логотип">
        </div>
        <div class="company-info">
            <h2>ООО «BDB COMMERCE AND SERVICE»</h2>
            <p>г. Ташкент, М.Улугбекский р-н, ул. Навнихол-3, д-7</p>
            <p>Р/с 20208000505552329001, ИНН: 309738079</p>
            <p>АО “ANOR BANK”, МФО: 01183</p>
            <p>Тел: +998 95 141 20 40</p>
        </div>
    </div>
    <div style="font-size: 1rem;"> {{$offer->created_at->format('d.m.Y')}}</div>
    <!-- Заголовок -->
    <div class="title">Коммерческое предложение № {{$offer->number}}</div>

    <!-- Вступительный текст -->
    <div class="intro">
        <p>  Компания ООО «BDB COMMERCE AND SERVICE» рада предложить Вам сотрудничество в области поставок POS оборудования. Мы уверены, что наш опыт и продукция смогут помочь Вам значительно снизить затраты и повысить эффективность работы Вашего бизнеса. </p>
    </div>

    <!-- Таблица -->
    <table>
        <thead>
            <tr>
                <th class="" style="width: 40px;">№</th>
                <th style="width: 80px;">Фото</th>
                <th class="cell-left">Наименование</th>
                <th style="width: 60px;">Кол-во</th>
                <th style="width: 80px;">Цена, сум</th>
                <th style="width: 100px;">Сумма, сум</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total=0;
            @endphp
            @foreach($offer->items as $idx=>$item)
            
            <tr>
                <td>{{$idx+1}}</td>
                <td class="photo-cell">
                    @if($item->item->category_id==5)
                        <x-label-size w="100" h="50" />
                    @else
                        <img src="\images\items\{{$item->item->code}}.jpg" alt="">
                    @endif

                </td>
                <td class="cell-left" style="vertical-align:top;">
                    <p>{{$item->item->short_name=='' ? $item->item->acc_name : $item->item->short_name}}</p>
                    <p>{{$item->item->description!='' ? 'Характеристика:'.$item->item->description : ''}}</p>
                    
                </td>
                <td class="cell-right">{{number_format($item->qty,0,' ',' ')}}</td>
                <td class="cell-right">{{number_format($item->price,0,' ',' ')}}</td>
                <td class="cell-right">{{number_format($item->price*$item->qty,0,' ',' ')}}</td>
            </tr>
                @php
                    $total=$total+($item->price*$item->qty);
                @endphp
            @endforeach
            
        </tbody>
    </table>
   
    <!-- Итог -->
    <div class="total">
        Итого: <strong>{{number_format($total,0,' ',' ')}} сум</strong>
    </div>

    <!-- Условия -->
    <div class="footer">
        <p>Также по запросу мы готовы предоставить расширенный ассортимент
самоклеящихся стикеров, термобумаги и других расходных материалов.
</p>
        <p><strong>С уважением,</strong></p>
        <p><strong>Команда OOO "BDB COMMERCE AND SERVICE"</strong></p>
    </div>

</body>
</html>
