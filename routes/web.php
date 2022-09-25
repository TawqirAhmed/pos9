<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\InvoiceController;

use App\Http\Livewire\Dashboard\DashboardComponent;

use App\Http\Livewire\Inventory\Supplier\SupplierComponent;

use App\Http\Livewire\Inventory\Category\CategoryComponent;
use App\Http\Livewire\Inventory\Product\ProductComponent;
use App\Http\Livewire\Inventory\Product\ProductAddComponent;
use App\Http\Livewire\Inventory\Product\ProductEditComponent;
use App\Http\Livewire\Inventory\Product\NewStockComponent;
use App\Http\Livewire\Inventory\Purchase\PurchaseComponent;
use App\Http\Livewire\Inventory\Purchase\MakePurchaseComponent;
use App\Http\Livewire\Inventory\Purchase\EditPurchaseComponent;

use App\Http\Livewire\Sell\Customer\CustomerComponent;
use App\Http\Livewire\Sell\Quotation\MakeQuotationComponent;
use App\Http\Livewire\Sell\Refund\RefundComponent;
use App\Http\Livewire\Sell\Sell\MakeSellComponent;
use App\Http\Livewire\Sell\Sell\SellEditComponent;
use App\Http\Livewire\Sell\Sell\SellRecordComponent;

use App\Http\Livewire\Expences\Expences\ExpencesComponent;

use App\Http\Livewire\Report\Profit\ProfitComponent;
use App\Http\Livewire\Report\Report\ReportComponent;

use App\Http\Livewire\Configuration\Configuration\ConfigurationComponent;
use App\Http\Livewire\Configuration\User\UserComponent;
use App\Http\Livewire\Configuration\Payment\PaymentComponent;

use App\Http\Livewire\Account\Setting\SettingComponent;


use App\Http\Controllers\ChartController;
use App\Http\Controllers\ReportController;

use App\Http\Livewire\Inactive\InactiveComponent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/inactive', InactiveComponent::class)->name('inactive');
// Admin Routes---------------------------------------------------------------------------------------


    // code...

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'admin'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    // Route::get('/dashboard', DashboardComponent::class)->name('dashboard');
    
   
    Route::get('/dashboard', [ChartController::class, 'index'])->name('dashboard');
    Route::post('/customChart', [ChartController::class, 'index'])->name('customChart');

    // // inventory---------------------------------------------------------------------------------
    
    // Route::get('/category', CategoryComponent::class)->name('category');

    // Route::get('/products', ProductComponent::class)->name('products');
    // Route::get('/products_add', ProductAddComponent::class)->name('products_add');
    // Route::get('/products_edit/{id}', ProductEditComponent::class)->name('products_edit');
    // Route::get('/new_stock/{id}', NewStockComponent::class)->name('new_stock');
    // Route::get('barcode/{id}', [BarcodeController::class, 'index'])->name('barcode');

    // Route::get('/suppliers', SupplierComponent::class)->name('suppliers');
    // Route::get('/purchase', PurchaseComponent::class)->name('purchase');
    // Route::get('/make_purchase', MakePurchaseComponent::class)->name('make_purchase');
    // Route::get('/edit_purchase/{id}', EditPurchaseComponent::class)->name('edit_purchase');
    // // inventory---------------------------------------------------------------------------------

    // // sell--------------------------------------------------------------------------------------
    // Route::get('/customer', CustomerComponent::class)->name('customer');
    // Route::get('/make_quotation', MakeQuotationComponent::class)->name('make_quotation');
    // Route::get('/refund', RefundComponent::class)->name('refund');
    // Route::get('/make_sell', MakeSellComponent::class)->name('make_sell');
    // Route::get('/sell_edit/{id}', SellEditComponent::class)->name('sell_edit');
    // Route::get('/print_invoice/{id}', [InvoiceController::class, 'index'])->name('print_invoice');
    // Route::get('/sell_record', SellRecordComponent::class)->name('sell_record');
    // // sell--------------------------------------------------------------------------------------

    // // Expences--------------------------------------------------------------------------------------
    // Route::get('/expences', ExpencesComponent::class)->name('expences');
    // // Expences--------------------------------------------------------------------------------------

    // Configuration--------------------------------------------------------------------------------------
    Route::get('/configuration', ConfigurationComponent::class)->name('configuration');
    Route::get('/user', UserComponent::class)->name('user');
    Route::get('/payment', PaymentComponent::class)->name('payment');
    // Configuration--------------------------------------------------------------------------------------

    // Settings--------------------------------------------------------------------------------------
    Route::get('/account_settings', SettingComponent::class)->name('account_settings');
    // Settings--------------------------------------------------------------------------------------


    // Report--------------------------------------------------------------------------------------
    Route::get('/profit', ProfitComponent::class)->name('profit');
    Route::get('/report', ReportComponent::class)->name('report');


    Route::post('sells_report', [ReportController::class, 'SellsReport']);
    Route::post('due_sells_report', [ReportController::class, 'DueSellsReport']);
    Route::post('customers_purchase_report', [ReportController::class, 'CustomersPurchaseReport']);
    Route::post('purchase_report', [ReportController::class, 'PurchaseReport']);
    Route::post('expenses_report', [ReportController::class, 'ExpensesReport']);
    Route::post('refunds_report', [ReportController::class, 'RefundsReport']);
    Route::post('profits_report', [ReportController::class, 'ProfitsReport']);
    Route::get('customer_list', [ReportController::class, 'CustomersList'])->name('customer_list');
    Route::get('supplier_list', [ReportController::class, 'SuppliersList'])->name('supplier_list');
    // Report--------------------------------------------------------------------------------------
    
});
// Admin Routes---------------------------------------------------------------------------------------





// Manager Routes-------------------------------------------------------------------------------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'manager'
])->group(function () {

    // inventory---------------------------------------------------------------------------------
    
    Route::get('/category', CategoryComponent::class)->name('category');

    Route::get('/products', ProductComponent::class)->name('products');
    Route::get('/products_add', ProductAddComponent::class)->name('products_add');
    Route::get('/products_edit/{id}', ProductEditComponent::class)->name('products_edit');
    Route::get('/new_stock/{id}', NewStockComponent::class)->name('new_stock');
    Route::get('barcode/{id}', [BarcodeController::class, 'index'])->name('barcode');

    Route::get('/suppliers', SupplierComponent::class)->name('suppliers');
    
    Route::get('/purchase', PurchaseComponent::class)->name('purchase');
    Route::get('/make_purchase', MakePurchaseComponent::class)->name('make_purchase');
    Route::get('/edit_purchase/{id}', EditPurchaseComponent::class)->name('edit_purchase');
    // inventory---------------------------------------------------------------------------------

    // Expences--------------------------------------------------------------------------------------
    Route::get('/expences', ExpencesComponent::class)->name('expences');
    // Expences--------------------------------------------------------------------------------------

});
// Manager Routes-------------------------------------------------------------------------------------





// Cashier Routes-------------------------------------------------------------------------------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'cashier'
])->prefix('cashier')->group(function () {
    

    // sell--------------------------------------------------------------------------------------
    Route::get('/customer', CustomerComponent::class)->name('customer');
    Route::get('/make_quotation', MakeQuotationComponent::class)->name('make_quotation');
    Route::get('/refund', RefundComponent::class)->name('refund');
    Route::get('/make_sell', MakeSellComponent::class)->name('make_sell');
    Route::get('/sell_edit/{id}', SellEditComponent::class)->name('sell_edit');
    Route::get('/print_invoice/{id}', [InvoiceController::class, 'index'])->name('print_invoice');
    Route::get('/sell_record', SellRecordComponent::class)->name('sell_record');
    // sell--------------------------------------------------------------------------------------

    
});
// Cashier Routes-------------------------------------------------------------------------------------
