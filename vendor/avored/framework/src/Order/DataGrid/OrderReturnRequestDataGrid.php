<?php

namespace AvoRed\Framework\Order\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class OrderReturnRequestDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_order_return_request_controller');

        $dataGrid->model($model)
                    ->column('order_id', ['label' => 'Thứ tự yêu cầu trả hàng', 'sortable' => true])
                    ->column('customer_name', ['label' => 'Tên khách hàng', 'sortable' => true])
                    ->column('customer_phone', ['label' => 'Sdt khách hàng', 'sortable' => true])
                    ->column('comment', ['label' => 'Bình luận'])
                    ->column('status', ['label' => 'Tình trạng'])
                    ->linkColumn('view', [], function ($model) {
                        return "<a href='" . route('admin.order-return-request.view', $model->id) . "' >Hiện</a>";
                    });

        $this->dataGrid = $dataGrid;
    }
}
