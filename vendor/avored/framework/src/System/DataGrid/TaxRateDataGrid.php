<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class TaxRateDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_tax_rate_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name', ['label' => 'Tên'])
            ->linkColumn(
                'edit',
                [],
                function ($model) {
                    return "<a href='" . 
                        route('admin.tax-rate.edit', $model->id) . 
                        "' >Chỉnh</a>";
                }
            )->linkColumn(
                'show', 
                [], 
                function ($model) {
                    return "<a href='" . 
                        route('admin.tax-rate.show', $model->id) . 
                        "' >Hiện</a>";
                }
            );

        $this->dataGrid = $dataGrid;
    }
}
