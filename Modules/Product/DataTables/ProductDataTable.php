<?php

namespace Modules\Product\DataTables;

use Modules\Product\Entities\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)->with('category')
            ->addColumn('product_card', function ($data) {
                $image = $data->getFirstMediaUrl('images', 'thumb') ?: 'https://via.placeholder.com/100';
                $category = $data->category->category_name ?? '-';
                $price = format_currency($data->product_price);
                $cost = format_currency($data->product_cost);
                $quantity = $data->product_quantity . ' ' . $data->product_unit;
                $actions = view('product::products.partials.actions', compact('data'))->render();
            
                return '
    <div class="p-3 border rounded shadow-sm" style="font-size: 16px; max-width: 300px;">
        <div class="text-center mb-3">
            <img src="'.$image.'" width="150" height="150" class="img-thumbnail" style="object-fit: cover;">
        </div>
        <div class="mb-3">
            <h5 class="fw-bold text-center">'.$data->product_name.'</h5>
            <div><strong>Kategori:</strong> '.$category.'</div>
            <div><strong>Kode:</strong> '.$data->product_code.'</div>
            <div><strong>Biaya:</strong> '.$cost.'</div>
            <div><strong>Harga:</strong> '.$price.'</div>
            <div><strong>Jumlah:</strong> '.$quantity.'</div>
        </div>
        <div class="text-center mt-3">
            '.$actions.'
        </div>
    </div>
';


            })
            
            ->rawColumns(['product_card']);
    }

    public function query(Product $model)
    {
        return $model->newQuery()->with('category');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>>" .
                  "<'row'<'col-sm-12'tr>>" .
                  "<'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(0)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('product_card')
                ->title('Produk')
                ->exportable(false)
                ->printable(false)
                ->className('align-top')
        ];
    }

    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
