<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Permission\Facade as PermissionFacade;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class PermissionProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerPermissions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('permission', 'AvoRed\Framework\Permission\Manager');
    }

    /**
     * Register the permission Manager Instance.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('permission', function () { new Manager(); });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['permission', 'AvoRed\Framework\Permission\Manager'];
    }

    /**
     * Register the permissions.
     *
     * @return void
     */
    protected function registerPermissions()
    {
        $group = PermissionFacade::add('page', function (PermissionGroup $group) {
            $group->label('Quyền hạn trang');
        });
        $group->addPermission('admin-page-list', function (Permission $permission) {
            $permission->label('Danh sách trang')
                    ->routes('admin.page.index');
        });
        $group->addPermission('admin-page-create', function (Permission $permission) {
            $permission->label('Tạo trang')
                    ->routes('admin.page.create,admin.page.store');
        });
        $group->addPermission('admin-page-update', function (Permission $permission) {
            $permission->label('Cập nhật trang')
                    ->routes('admin.page.edit,admin.page.update');
        });
        $group->addPermission('admin-page-destroy', function (Permission $permission) {
            $permission->label('Xóa trang')
                    ->routes('admin.page.destroy');
        });
        $group->addPermission('admin-page-show', function (Permission $permission) {
            $permission->label('Hiển thị tranng')
                    ->routes('admin.page.show');
        });

        $group = PermissionFacade::add('menu', function (PermissionGroup $group) {
            $group->label('Danh sách quyền hạn');
        });

        $group->addPermission('admin-menu-list', function (Permission $permission) {
            $permission->label('Thứ tự menu trước')
                    ->routes('admin.menu.index');
        });

        $group->addPermission('admin-menu-store', function (Permission $permission) {
            $permission->label('Lưu menu trước')
                    ->routes('admin.menu.store');
        });

        $group = PermissionFacade::add('category', function (PermissionGroup $group) {
            $group->label('Quyền danh mục');
        });
        $group->addPermission('admin-category-list', function (Permission $permission) {
            $permission->label('Ds danh mục')
                    ->routes('admin.category.index');
        });
        $group->addPermission('admin-category-create', function (Permission $permission) {
            $permission->label('Tạo danh mục')
                    ->routes('admin.category.create,admin.category.store');
        });
        $group->addPermission('admin-category-update', function (Permission $permission) {
            $permission->label('Cập nhật danh mục')
                    ->routes('admin.category.edit,admin.category.update');
        });
        $group->addPermission('admin-category-destroy', function (Permission $permission) {
            $permission->label('Xóa danh mục')
                    ->routes('admin.category.destroy');
        });
        $group->addPermission('admin-category-show', function (Permission $permission) {
            $permission->label('Hiển thị danh mục')
                    ->routes('admin.category.show');
        });

        $group = PermissionFacade::add('product', function (PermissionGroup $group) {
            $group->label('Quyền sản phẩm');
        });

        $group->addPermission('admin-product-list', function (Permission $permission) {
            $permission->label('Danh sách sản phẩm')
                    ->routes('admin.product.index');
        });
        $group->addPermission('admin-product-create', function (Permission $permission) {
            $permission->label('Tạo sản phẩm')
                    ->routes('admin.product.create,admin.product.store');
        });
        $group->addPermission('admin-product-update', function (Permission $permission) {
            $permission->label('Cập nhật sản phẩm')
                    ->routes('admin.product.edit,admin.product.update');
        });
        $group->addPermission('admin-product-destroy', function (Permission $permission) {
            $permission->label('Xóa sản phẩm')
                    ->routes('admin.product.destroy');
        });
        $group->addPermission('admin-product-show', function (Permission $permission) {
            $permission->label('Hiển thị sản phẩm')
                    ->routes('admin.product.show');
        });

        $group = PermissionFacade::add('order', function (PermissionGroup $group) {
            $group->label('Quyền đặt hàng');
        });

        $group->addPermission('admin-order-list', function (Permission $permission) {
            $permission->label('Danh sách đơn hàng')
                    ->routes('admin.order.index');
        });

        $group->addPermission('admin-order-view', function (Permission $permission) {
            $permission->label('Hiển thị đơn hàng')
                    ->routes('admin.order.view');
        });
        $group->addPermission('admin-order-send-invoice-email', function (Permission $permission) {
            $permission->label('Gửi Email hóa đơn')
                    ->routes('admin.order.send-email-invoice');
        });
        $group->addPermission('admin-order-change-status', function (Permission $permission) {
            $permission->label('Tình trạng thay đổi đơn hàng')
                    ->routes('admin.order.change-status,admin.order.update-status');
        });

        $group = PermissionFacade::add('order-status', function (PermissionGroup $group) {
            $group->label('Quyền đặt hàng');
        });
        $group->addPermission('admin-order-status-list', function (Permission $permission) {
            $permission->label('Danh sách tình trạng đơn hàng')
                    ->routes('admin.order-status.index');
        });
        $group->addPermission('admin-order-status-create', function (Permission $permission) {
            $permission->label('Tạo tình trạng đơn hàng')
                    ->routes('admin.order-status.create,admin.order-status.store');
        });
        $group->addPermission('admin-order-status-update', function (Permission $permission) {
            $permission->label('Cập nhật tình trạng đơn hàng')
                    ->routes('admin.order-status.edit,admin.order-status.update');
        });
        $group->addPermission('admin-order-status-destroy', function (Permission $permission) {
            $permission->label('Hủy tình trạng đơn hàng')
                    ->routes('admin.order-status.destroy');
        });
        $group->addPermission('admin-order-status-show', function (Permission $permission) {
            $permission->label('Hiển thị tình trạng đơn hàng')
                    ->routes('admin.order-status.show');
        });

        $group = PermissionFacade::add('attribute', function (PermissionGroup $group) {
            $group->label('Quyền thuộc tính');
        });
        $group->addPermission('admin-attribute-list', function (Permission $permission) {
            $permission->label('Danh sách thuộc tính')
                    ->routes('admin.attribute.index');
        });
        $group->addPermission('admin-attribute-create', function (Permission $permission) {
            $permission->label('Tạo thuộc tính')
                    ->routes('admin.attribute.create,admin.attribute.store');
        });
        $group->addPermission('admin-attribute-update', function (Permission $permission) {
            $permission->label('Chỉnh sửa thuộc tính')
                    ->routes('admin.attribute.edit,admin.attribute.update');
        });
        $group->addPermission('admin-attribute-destroy', function (Permission $permission) {
            $permission->label('Xóa thuộc tính')
                    ->routes('admin.attribute.destroy');
        });
        $group->addPermission('admin-attribute-show', function (Permission $permission) {
            $permission->label('Hiển thị thuộc tính')
                    ->routes('admin.attribute.show');
        });

        $group = PermissionFacade::add('property', function (PermissionGroup $group) {
            $group->label('Quyền đặc tính');
        });

        $group->addPermission('admin-property-list', function (Permission $permission) {
            $permission->label('Danh sách đặc tính')
                    ->routes('admin.property.index');
        });
        $group->addPermission('admin-property-create', function (Permission $permission) {
            $permission->label('Tạo đặc tính')
                    ->routes('admin.property.create,admin.property.store');
        });
        $group->addPermission('admin-attribute-update', function (Permission $permission) {
            $permission->label('Cập nhật đặc tính')
                    ->routes('admin.property.edit,admin.property.update');
        });
        $group->addPermission('admin-property-destroy', function (Permission $permission) {
            $permission->label('Hủy đặc tính')
                    ->routes('admin.property.destroy');
        });
        $group->addPermission('admin-property-show', function (Permission $permission) {
            $permission->label('Hiển thị đặc tính')
                    ->routes('admin.property.show');
        });

        $group = PermissionFacade::add('user', function (PermissionGroup $group) {
            $group->label('Quyền người dùng');
        });

        $group->addPermission('admin-user-list', function (Permission $permission) {
            $permission->label('Danh sách người dùng')
                    ->routes('admin.user.index');
        });
        $group->addPermission('admin-user-create', function (Permission $permission) {
            $permission->label('Tạo người dùng')
                    ->routes('admin.user.create,admin.user.store');
        });
        $group->addPermission('admin-user-update', function (Permission $permission) {
            $permission->label('Cập nhật người dùng')
                    ->routes('admin.user.edit,admin.user.update');
        });
        $group->addPermission('admin-user-destroy', function (Permission $permission) {
            $permission->label('Xóa người dùng')
                    ->routes('admin.user.destroy');
        });
        $group->addPermission('admin-user-show', function (Permission $permission) {
            $permission->label('Hiển thị người dùng')
                    ->routes('admin.user.show');
        });

        $group = PermissionFacade::add('user-group', function (PermissionGroup $group) {
            $group->label('Quyền nhóm người dùng');
        });

        $group->addPermission('admin-user-group-list', function (Permission $permission) {
            $permission->label('Danh sách nhóm người dùng')
                    ->routes('admin.user-group.index');
        });
        $group->addPermission('admin-user-group-create', function (Permission $permission) {
            $permission->label('Tạo nhóm người dùng')
                    ->routes('admin.user-group.create,admin.user-group.store');
        });
        $group->addPermission('admin-user-group.update', function (Permission $permission) {
            $permission->label('Cập nhật nhóm người dùng')
                    ->routes('admin.user-group.edit,admin.user-group.update');
        });
        $group->addPermission('admin-user-group-destroy', function (Permission $permission) {
            $permission->label('Xóa nhóm người dùng')
                    ->routes('admin.user-group.destroy');
        });
        $group->addPermission('admin-user-group-show', function (Permission $permission) {
            $permission->label('Hiển thị nhóm người dùng')
                    ->routes('admin.user-group.show');
        });

        $group = PermissionFacade::add('admin-user', function (PermissionGroup $group) {
            $group->label('Quyền quản trị viên');
        });

        $group->addPermission('admin-admin-user-list', function (Permission $permission) {
            $permission->label('Danh sách quản trị viên')
                    ->routes('admin.admin-user.index');
        });
        $group->addPermission('admin-admin-user-create', function (Permission $permission) {
            $permission->label('Thêm quản trị viên')
                    ->routes('admin.admin-user.create,admin.admin-user.store');
        });
        $group->addPermission('admin-admin-user-update', function (Permission $permission) {
            $permission->label('Cập nhật quản trị viên')
                    ->routes('admin.admin-user.edit,admin.admin-user.update');
        });
        $group->addPermission('admin-admin-user-destroy', function (Permission $permission) {
            $permission->label('Xóa quản trị viên')
                    ->routes('admin.admin-user.destroy');
        });
        $group->addPermission('admin-admin-user-show', function (Permission $permission) {
            $permission->label('Hiển thị quản trị viên')
                    ->routes('admin.admin-user.show');
        });

        $group = PermissionFacade::add('role', function (PermissionGroup $group) {
            $group->label('Quyền vai trò');
        });

        $group->addPermission('admin-role-list', function (Permission $permission) {
            $permission->label('Danh sách vai trò')
                    ->routes('admin.role.index');
        });
        $group->addPermission('admin-role-create', function (Permission $permission) {
            $permission->label('Tạo vai trò')
                    ->routes('admin.role.create,admin.role.store');
        });
        $group->addPermission('admin-role-update', function (Permission $permission) {
            $permission->label('Cập nhật vai trò')
                    ->routes('admin.role.edit,admin.role.update');
        });
        $group->addPermission('admin-role-destroy', function (Permission $permission) {
            $permission->label('Xóa vai trò')
                    ->routes('admin.role.destroy');
        });
        $group->addPermission('admin-role-show', function (Permission $permission) {
            $permission->label('Hiển thị vai trò')
                    ->routes('admin.role.show');
        });

        $group = PermissionFacade::add('configuration', function (PermissionGroup $group) {
            $group->label('Quyền cấu hình');
        });

        $group->addPermission('admin-configuration', function (Permission $permission) {
            $permission->label('Cấu hình')
                    ->routes('admin.configuration');
        });
        $group->addPermission('admin-configuration-store', function (Permission $permission) {
            $permission->label('Lưu cấu hình')
                    ->routes('admin.configuration.store');
        });

        $group = PermissionFacade::add('site-currency', function (PermissionGroup $group) {
            $group->label('Quyền đơn vị tiền tệ');
        });

        $group->addPermission('admin-site-currency-list', function (Permission $permission) {
            $permission->label('Danh sách đơn vị tiền tệ')
                    ->routes('admin.site-currency.index');
        });
        $group->addPermission('admin-site-currency-create', function (Permission $permission) {
            $permission->label('Thêm đơn vị tiền tệ')
                    ->routes('admin.site-currency.create,admin.site-currency.store');
        });
        $group->addPermission('admin-site-currency-update', function (Permission $permission) {
            $permission->label('Cập nhật đơn vị tiền tệ')
                    ->routes('admin.site-currency.edit,admin.site-currency.update');
        });
        $group->addPermission('admin-site-currency-destroy', function (Permission $permission) {
            $permission->label('Xóa đơn vị tiền tệ')
                    ->routes('admin.site-currency.destroy');
        });
        $group->addPermission('admin-site-currency-show', function (Permission $permission) {
            $permission->label('Hiển thị đơn vị tiền tệ')
                    ->routes('admin.site-currency.show');
        });

        $group = PermissionFacade::add('country', function (PermissionGroup $group) {
            $group->label('Quyền quốc gia');
        });

        $group->addPermission('admin-country-list', function (Permission $permission) {
            $permission->label('Danh sách quốc gia')
                    ->routes('admin.country.index');
        });
        $group->addPermission('admin-country-create', function (Permission $permission) {
            $permission->label('Thêm quốc gia')
                    ->routes('admin.country.create,admin.country.store');
        });
        $group->addPermission('admin-country-update', function (Permission $permission) {
            $permission->label('Cập nhật quốc gia')
                    ->routes('admin.country.edit,admin.country.update');
        });
        $group->addPermission('admin-country-destroy', function (Permission $permission) {
            $permission->label('Xóa quốc gia')
                    ->routes('admin.country.destroy');
        });
        $group->addPermission('admin-country-show', function (Permission $permission) {
            $permission->label('Hiển thị quốc gia')
                    ->routes('admin.country.show');
        });

        $group = PermissionFacade::add('state', function (PermissionGroup $group) {
            $group->label('Quyền tỉnh');
        });

        $group->addPermission('admin-state-list', function (Permission $permission) {
            $permission->label('Danh sách vùng')
                    ->routes('admin.state.index');
        });
        $group->addPermission('admin-state-create', function (Permission $permission) {
            $permission->label('Thêm vùng')
                    ->routes('admin.state.create,admin.state.store');
        });
        $group->addPermission('admin-state-update', function (Permission $permission) {
            $permission->label('Cập nhật vùng')
                    ->routes('admin.state.edit,admin.state.update');
        });
        $group->addPermission('admin-site-currency-destroy', function (Permission $permission) {
            $permission->label('Xóa vùng')
                    ->routes('admin.state.destroy');
        });
        $group->addPermission('admin-site-currency-show', function (Permission $permission) {
            $permission->label('Hiển thị vùng')
                    ->routes('admin.state.show');
        });

        $group = PermissionFacade::add('theme', function (PermissionGroup $group) {
            $group->label('Quyền giao diện');
        });

        $group->addPermission('admin-theme-list', function (Permission $permission) {
            $permission->label('Danh sách giao diện')
                    ->routes('admin.theme.index');
        });
        $group->addPermission('admin-theme-create', function (Permission $permission) {
            $permission->label('Theme Upload/Create')
                    ->routes('admin.create.index', 'admin.theme.store');
        });
        $group->addPermission('admin-theme-activated', function (Permission $permission) {
            $permission->label('Kích hoạt giao diện')
                    ->routes('admin.activated.index');
        });
        $group->addPermission('admin-theme-deactivated', function (Permission $permission) {
            $permission->label('Hủy kích hoạt')
                    ->routes('admin.deactivated.index');
        });
        //$group->addPermission('admin-theme-destroy', function(Permission $permission) {
        //    $permission->label('Theme Destroy')
        //            ->routes('admin.destroy.index');
        //});

        $group = PermissionFacade::add('module', function (PermissionGroup $group) {
            $group->label('Quyền module');
        });

        $group->addPermission('admin-module-list', function (Permission $permission) {
            $permission->label('Danh sách Module')
                    ->routes('admin.module.index');
        });
        $group->addPermission('admin-module-create', function (Permission $permission) {
            $permission->label('Tải lên Module')
                    ->routes('admin.create.index', 'admin.module.store');
        });

        Blade::if('hasPermission', function ($routeName) {
            $condition = false;
            $user = Auth::guard('admin')->user();

            if (!$user) {
                $condition = $user->hasPermission($routeName) ?: false;
            }

            $converted_res = ($condition) ? 'true' : 'false';

            return "<?php if ($converted_res): ?>";
        });
    }
}
