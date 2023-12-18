<?php

namespace App\Imports;

use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Stock([
            'productId' => $row['urun'],
            'content' => $row['icerik'],
            'delivery' => $row['durum'],
            'noStock' => $row['stoklu'],
        ]);
    }
}
