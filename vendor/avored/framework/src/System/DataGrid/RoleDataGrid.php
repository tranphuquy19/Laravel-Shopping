<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class RoleDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_role_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('name')
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.role.edit', $model->id) . "' >Chỉnh</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.role.show', $model->id) . "' >Hiện</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
