<?php

namespace AvoRed\Framework\AdminConfiguration;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminConfiguration\Facade as AdminConfigurationFacade;
use AvoRed\Framework\Models\Repository\SiteCurrencyRepository;
use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Models\Database\Country;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
        
    /**
     * Boot the Provider
     *
     * @return void
     */
    public function boot()
    {
        $this->registerAdminConfiguration();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton(
            'adminconfiguration', 
            \AvoRed\Framework\AdminConfiguration\Manager::class
        );
    }

    /**
     * Register the permission Manager Instance.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(
            'adminconfiguration', 
            function () {
                new Manager();
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
        return ['adminconfiguration', 'AvoRed\Framework\AdminConfiguration\Manager'];
    }

    /**
     * Register the Admin Configuration.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        $configurationGroup = AdminConfigurationFacade::add('general')
            ->label('Thông tin chung');

        $configurationGroup->addConfiguration('general_site_title')
            ->label('Tên trang')
            ->type('text')
            ->name('general_site_title');

        $configurationGroup->addConfiguration('general_site_description')
            ->label('Mô tả trang')
            ->type('text')
            ->name('general_site_description');

        $siteCurrencyRepository = new SiteCurrencyRepository;
        $configurationGroup->addConfiguration('general_site_currency')
            ->label('Đơn vị tiền tệ')
            ->type('select')
            ->name('general_site_currency')
            ->options($siteCurrencyRepository);

        $configurationGroup->addConfiguration('general_administrator_email')
            ->label('Email quản trị viên')
            ->type('text')
            ->name('general_administrator_email');

        $configurationGroup->addConfiguration('general_term_condition_page')
            ->label('Điều khoản & điều kiện')
            ->type('select')
            ->name('general_term_condition_page')
            ->options(
                function () {
                    $options = Page::all()->pluck('name', 'id');
                    return $options;
                }
            );

        $configurationGroup->addConfiguration('general_home_page')
            ->label('Trang chủ')
            ->type('select')
            ->name('general_home_page')
            ->options(
                function () {
                    return Page::all()->pluck('name', 'id');
                }
            );

        $userGroup = AdminConfigurationFacade::add('users')
            ->label('Người dùng');

        $userGroup->addConfiguration('user_default_country')
            ->label('Quốc gia mặc định')
            ->type('select')
            ->name('user_default_country')
            ->options(
                function () {
                    return Country::all()->pluck('name', 'id');
                }
            );

        $userGroup->addConfiguration('user_activation_required')
            ->label('Yêu cầu xác thực người dùng')
            ->type('select')
            ->name('user_activation_required')
            ->options(
                function () {
                    return [0 => 'No', 1 => 'Yes'];
                }
            );

        $shippingGroup = AdminConfigurationFacade::add('shipping')
            ->label('Giao hàng');

        $shippingGroup->addConfiguration('shipping_free_shipping_enabled')
            ->label('Miễn phí vận chuyển?')
            ->type('select')
            ->name('shipping_free_shipping_enabled')
            ->options(
                function () {
                    return [1 => 'Yes', 0 => 'No'];
                }
            );

        $paymentGroup = AdminConfigurationFacade::add('payment')
            ->label('Thanh toán');

        $paymentGroup->addConfiguration('payment_stripe_enabled')
            ->label('Thanh toán Stripe')
            ->type('select')
            ->name('payment_stripe_enabled')
            ->options(
                function () {
                    return [0 => 'No', 1 => 'Yes'];
                }
            );

        $paymentGroup->addConfiguration('payment_stripe_publishable_key')
            ->label('Khóa Stripe công khai')
            ->type('text')
            ->name('payment_stripe_publishable_key');

        $paymentGroup->addConfiguration('avored_stripe_secret_key')
            ->label('Khóa Stripe bảo mật')
            ->type('text')
            ->name('avored_stripe_secret_key');

        $taxGroup = AdminConfigurationFacade::add('tax')
            ->label('Thuế');

        $taxGroup->addConfiguration('tax_enabled')
            ->label('Áp dụng thuế?')
            ->type('select')
            ->name('tax_enabled')
            ->options(
                function () {
                    return [1 => 'Yes', 0 => 'No'];
                }
            );

        $taxGroup->addConfiguration('tax_percentage')
            ->label('Phần trăm thuế')
            ->type('text')
            ->name('tax_percentage');

        $taxGroup->addConfiguration('tax_default_country')
            ->label('Thuế theo quốc gia')
            ->type('select')
            ->name('tax_default_country')
            ->options(
                function () {
                    return $options = Country::all()->pluck('name', 'id');
                }
            );
    }
}
