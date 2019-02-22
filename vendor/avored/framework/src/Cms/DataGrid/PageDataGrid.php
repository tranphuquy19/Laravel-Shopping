<?php

namespace AvoRed\Framework\Cms\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class PageDataGrid
{
    /**
     * Page Model Builder
     *
     * @var \Illuminate\Database\Eloquent\Builder $dataGrid
     */
    public $dataGrid;

    /**
     * Construct to build a page datagrid
     *
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @return void
     */
    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_page_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name', ['sortable' => true])
            ->column('slug')
            ->column('meta_title', ['label' => 'Meta Title'])
            ->linkColumn(
                'edit',
                [],
                function ($model) {
                    return "<a href='" . route('admin.page.edit', $model->id) . "' >Chỉnh sửa</a>";
                }
            )->linkColumn(
                'show',
                [], 
                function ($model) {
                    return "<a href='" . route('admin.page.show', $model->id) . "' >Hiện</a>";
                }
            );

        $this->dataGrid = $dataGrid;
    }
}
