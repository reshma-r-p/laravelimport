<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row['name'],
            'price'        => $row['price'],
            'sku'          => $row['sku'],
            'description'  => $row['description'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required|max:255',
            '*.price' => 'required|regex:/^(\d+(,\d{1,2})?)?$/',
            '*.sku' => 'required|unique:products|max:255',
        ];
    }
}
