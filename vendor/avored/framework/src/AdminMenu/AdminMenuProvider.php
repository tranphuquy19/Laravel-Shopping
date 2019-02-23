<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;

class AdminMenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerAdminMenu();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('adminmenu', 'AvoRed\Framework\AdminMenu\Builder');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(
            'adminmenu',
            function () {
                return new Builder();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['adminmenu', 'AvoRed\Framework\AdminMenu\Builder'];
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        AdminMenuFacade::add(
            'shop',
            function (AdminMenu $shopMenu) {
                $shopMenu->label('Catalog')->route('#')->icon('ti-shopping-cart');
            }
        );

        $shopMenu = AdminMenuFacade::get('shop');
        $shopMenu->subMenu(
            'category',
            function (AdminMenu $menu) {
                $menu->key('category')
                    ->label('Danh mục')
                    ->route('admin.category.index');
            }
        );

        $shopMenu->subMenu(
            'product',
            function (AdminMenu $menu) {
                $menu->key('category')
                    ->label('Sản phẩm')
                    ->route('admin.product.index');
            }
        );

        $shopMenu->subMenu(
            'attribute',
            function (AdminMenu $menu) {
                $menu->key('attribute')
                    ->label('Thuộc tính sản phẩm')
                    ->route('admin.attribute.index');
            }
        );

        $shopMenu->subMenu(
            'property',
            function (AdminMenu $menu) {
                $menu->key('property')
                    ->label('Đặc tính')
                    ->route('admin.property.index');
            }
        );

        AdminMenuFacade::add(
            'content', 
            function (AdminMenu $menu) {
                $menu->label('Nội dung')->route('#')->icon('ti-files');
            }
        );

        $contentMenu = AdminMenuFacade::get('content');
        $contentMenu->subMenu(
            'page',
            function (AdminMenu $menu) {
                $menu->key('page')->label('Trang')->route('admin.page.index');
            }
        );

        $contentMenu->subMenu(
            'menu', 
            function (AdminMenu $menu) {
                $menu->key('menu')->label('Menu')->route('admin.menu.index');
            }
        );

        AdminMenuFacade::add(
            'user',
            function (AdminMenu $menu) {
                $menu->label('Khách hàng')->route('#')->icon('ti-user');
            }
        );

        $userMenu = AdminMenuFacade::get('user');

        $userMenu->subMenu(
            'user',
            function (AdminMenu $menu) {
                $menu->key('user')->label('Tổng quan')->route('admin.user.index');
            }
        );
        $userMenu->subMenu(
            'user_group', 
            function (AdminMenu $menu) {
                $menu->key('user_group')
                    ->label('Nhóm khách hàng')
                    ->route('admin.user-group.index');
            }
        );

        AdminMenuFacade::add(
            'orders',
            function (AdminMenu $menu) {
                $menu->label('Đặt hàng')->route('#')->icon('ti-truck');
            }
        );

        $orderMenu = AdminMenuFacade::get('orders');
        $orderMenu->subMenu(
            'order',
            function (AdminMenu $menu) {
                $menu->key('order')->label('Tỗng quan')->route('admin.order.index');
            }
        );
        $orderMenu->subMenu(
            'order_return_request',
            function (AdminMenu $menu) {
                $menu->key('order_return_request')
                    ->label('Yêu cầu trả hàng')
                    ->route('admin.order-return-request.index');
            }
        );

        $orderMenu->subMenu(
            'order_status', function (AdminMenu $menu) {
                $menu->key('order')
                    ->label('Tình trạng đơn hàng')
                    ->route('admin.order-status.index');
            }
        );

        AdminMenuFacade::add(
            'system',
            function (AdminMenu $systemMenu) {
                $systemMenu->label('Cài đặt')->route('#')->icon('ti-settings');
            }
        );

        $systemMenu = AdminMenuFacade::get('system');

        $systemMenu->subMenu(
            'configuration',
            function (AdminMenu $menu) {
                $menu->key('configuration')
                    ->label('Cấu hình')
                    ->route('admin.configuration')
                    ->icon('ti-settings');
            }
        );

        $systemMenu->subMenu(
            'site_currency_setup',
            function (AdminMenu $menu) {
                $menu->key('site_currency_setup')
                    ->label('Đơn vị tiền tệ')
                    ->route('admin.site-currency.index');
            }
        );

        $systemMenu->subMenu(
            'country',
            function (AdminMenu $menu) {
                $menu->key('country')
                    ->label('Quốc gia')
                    ->route('admin.country.index');
            }
        );

        $systemMenu->subMenu(
            'state',
            function (AdminMenu $menu) {
                $menu->key('state')->label('State')->route('admin.state.index');
            }
        );
        $systemMenu->subMenu(
            'tax_group',
            function (AdminMenu $menu) {
                $menu->key('tax_group')
                    ->label('Nhóm thuế')
                    ->route('admin.tax-group.index');
            }
        );
        $systemMenu->subMenu(
            'tax_rate',
            function (AdminMenu $menu) {
                $menu->key('tax_rate')
                    ->label('Thuế suất')
                    ->route('admin.tax-rate.index');
            }
        );

        $systemMenu->subMenu(
            'module',
            function (AdminMenu $menu) {
                $menu->key('module')->label('Mô đun')->route('admin.module.index');
            }
        );

        $systemMenu->subMenu(
            'admin-user',
            function (AdminMenu $menu) {
                $menu->key('admin-user')
                    ->label('Nhân viên')
                    ->route('admin.admin-user.index');
            }
        );

        $systemMenu->subMenu(
            'role',
            function (AdminMenu $menu) {
                $menu->key('role')
                    ->label('Vai trò/Quyền hạn')
                    ->route('admin.role.index');
            }
        );

        $systemMenu->subMenu(
            'themes', 
            function (AdminMenu $menu) {
                $menu->key('themes')->label('Giao diện')->route('admin.theme.index');
            }
        );
    }
}
