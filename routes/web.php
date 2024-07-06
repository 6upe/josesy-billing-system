<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    try {
            // Attempt a simple query
            DB::select('SELECT 1');
            $message = "Successfully connected to the database.";
        } catch (\Exception $e) {
            $message = "Could not connect to the database. Please check your configuration. Error: " . $e->getMessage();
        }
    return view('index', compact('message'));
});


Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('auth.register');
    Route::post('/register', 'RegisterController@register')->name('auth.register');
    Route::post('/logout', 'LoginController@logout')->name('auth.logout');
});

// routes/web.php

Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home');
    Route::get('/products', 'ProductController@index')->name('dashboard.products');
    Route::get('/clients', 'ClientController@index')->name('dashboard.clients');
    Route::get('/quotations', 'QuotationController@index')->name('dashboard.quotations');
    Route::get('/invoices', 'InvoiceController@index')->name('dashboard.invoices');
    Route::get('/statements', 'StatementController@index')->name('dashboard.statements');
    Route::get('/receipts', 'ReceiptController@index')->name('dashboard.receipts');
    Route::get('/payments', 'PaymentController@index')->name('dashboard.payments');
    Route::get('/reports', 'ReportController@index')->name('dashboard.reports');
});

Route::group(['prefix' => 'dashboard/products', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/add-product', 'ProductController@addProduct')->name('dashboard.products.addProduct');
    Route::post('/add-product', 'ProductController@saveProduct')->name('dashboard.products.saveProduct');
    Route::get('/edit-product/{id}', 'ProductController@editProduct')->name('dashboard.products.editProduct');
    Route::post('/edit-product/{id}', 'ProductController@updateProduct')->name('dashboard.products.updateProduct');
    Route::delete('/delete-product/{id}', 'ProductController@deleteProduct')->name('dashboard.products.deleteProduct');

});

Route::group(['prefix' => 'dashboard/clients', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/add-client', 'ClientController@addClient')->name('dashboard.clients.addClient');
    Route::post('/add-client', 'ClientController@saveClient')->name('dashboard.clients.saveClient');
    Route::get('/edit-client/{id}', 'ClientController@editClient')->name('dashboard.clients.editClient');
    Route::post('/edit-client/{id}', 'ClientController@updateClient')->name('dashboard.clients.updateClient');
    Route::delete('/delete-client/{id}', 'ClientController@deleteClient')->name('dashboard.clients.deleteClient');

});

Route::group(['prefix' => 'dashboard/quotations', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/add-quotation', 'QuotationController@createQuotation')->name('dashboard.quotations.createQuotation');
    Route::post('/add-quotation', 'QuotationController@saveQuotation')->name('dashboard.quotations.saveQuotation');
    Route::get('/edit-quotation/{quotation}', 'QuotationController@editQuotation')->name('dashboard.quotations.editQuotation');
    Route::get('/show-quotation/{quotation}', 'QuotationController@showQuotation')->name('dashboard.quotations.showQuotation');
    Route::put('/edit-quotation/{quotation}', 'QuotationController@updateQuotation')->name('dashboard.quotations.updateQuotation');
    Route::delete('/delete-quotation/{quotation}', 'QuotationController@deleteQuotation')->name('dashboard.quotations.deleteQuotation');
});

Route::group(['prefix' => 'dashboard/invoices', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/add-invoice', 'InvoiceController@createInvoice')->name('dashboard.invoices.createInvoice');
    Route::post('/add-invoice', 'InvoiceController@saveInvoice')->name('dashboard.invoices.saveInvoice');
    Route::get('/edit-invoice/{invoice}', 'InvoiceController@editInvoice')->name('dashboard.invoices.editInvoice');
    Route::get('/show-invoice/{invoice}', 'InvoiceController@showInvoice')->name('dashboard.invoices.showInvoice');
    Route::put('/edit-invoice/{invoice}', 'InvoiceController@updateInvoice')->name('dashboard.invoices.updateInvoice');
    Route::delete('/delete-invoice/{invoice}', 'InvoiceController@deleteInvoice')->name('dashboard.invoices.deleteInvoice');
});

Route::group(['prefix' => 'dashboard/payments', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/register-payment', 'PaymentController@registerPayment')->name('dashboard.payments.registerPayment');
    Route::post('/register-payment', 'PaymentController@savePayment')->name('dashboard.payments.savePayment');
    Route::get('/edit-payment/{payment}', 'PaymentController@editPayment')->name('dashboard.payments.editPayment');
    Route::put('/edit-payment/{payment}', 'PaymentController@updatePayment')->name('dashboard.payments.updatePayment');
});

Route::group(['prefix' => 'dashboard/receipts', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/request-receipt/{receipt}', 'ReceiptController@requestReceipt')->name('dashboard.receipts.requestReceipt');
});

Route::group(['prefix' => 'dashboard/statements', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth'], function () {
    Route::get('/request-statement/{statement}', 'StatementController@requestStatement')->name('dashboard.statements.requestStatement');
});


