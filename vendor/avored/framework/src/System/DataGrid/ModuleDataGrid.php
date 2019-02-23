<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class ModuleDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_theme_controller');

        $dataGrid->model($model)
                ->column('name', ['label' => 'Tên'])
                ->column('identifier', ['label' => 'Định danh'])
                ->column('status', ['label' => 'Tình trạng']);

        $this->dataGrid = $dataGrid;
    }
}
