<?php

namespace AvoRed\Framework\User\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class UserDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('first_name', ['label' => 'Họ'])
                ->column('last_name', ['label' => 'Tên'])
                ->column('email', ['label' => 'Email'])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.user.edit', $model->id) . "' >Chỉnh</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.user.show', $model->id) . "' >Hiện</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
