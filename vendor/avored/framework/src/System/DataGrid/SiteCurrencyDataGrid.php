<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class SiteCurrencyDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('site_currency_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('code', ['label' => 'Mã'])
                ->column('name', ['label' => 'Tên'])
                ->column('conversion_rate', ['label' => 'Tỉ lệ hoán đổi'])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.site-currency.edit', $model->id) . "' >Chỉnh</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.site-currency.show', $model->id) . "' >Hiện</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
