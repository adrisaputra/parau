<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDetailController;
use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MenuAccessController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuAccessController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkerPaymentController;
use App\Http\Controllers\PurchaseTransactionController;
use App\Http\Controllers\SellingTransactionController;
use App\Http\Controllers\CashierController;

use App\Models\Product;   //nama model

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

Route::get('/buat_storage', function () {
    Artisan::call('storage:link');
    dd("Storage Berhasil Di Buat");
});

Route::get('/clear-cache-all', function () {
    Artisan::call('cache:clear');
    dd("Cache Clear All");
});

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [HomeController::class, 'index']);

Route::post('/login_w', [LoginController::class, 'authenticate']);
Route::post('/logout-sistem', [LoginController::class, 'logout']);

Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/detail_peta/{project}', [HomeController::class, 'detail_peta']);
Route::get('/profil/{user}', [UserController::class, 'edit_profil']);
Route::put('/profil/{user}', [UserController::class, 'update_profil']);

Route::middleware(['user_access'])->group(function () {

    ## Rekapitulasi
    Route::get('/rekapitulasi_jumlah_pegawai', [RekapitulasiController::class, 'rekapitulasi_jumlah_pegawai']);

    ## Produk
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/search', [ProductController::class, 'search']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product/edit/{product}', [ProductController::class, 'edit']);
    Route::put('/product/edit/{product}', [ProductController::class, 'update']);
    Route::get('/product/hapus/{product}', [ProductController::class, 'delete']);
    Route::post('/product/print', [ProductController::class, 'print_barcode']);
    Route::get('/product/get_data/{product}', function (Product $product) {
        return $product;
    });

    ## Category Produk
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/search', [CategoryController::class, 'search']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::put('/category/edit/{category}', [CategoryController::class, 'update']);
    Route::get('/category/hapus/{category}', [CategoryController::class, 'delete']);

    ## Supplier
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::get('/supplier/search', [SupplierController::class, 'search']);
    Route::get('/supplier/create', [SupplierController::class, 'create']);
    Route::post('/supplier', [SupplierController::class, 'store']);
    Route::get('/supplier/edit/{supplier}', [SupplierController::class, 'edit']);
    Route::put('/supplier/edit/{supplier}', [SupplierController::class, 'update']);
    Route::get('/supplier/hapus/{supplier}', [SupplierController::class, 'delete']);

    ## Outlet
    Route::get('/outlet', [OutletController::class, 'index']);
    Route::get('/outlet/search', [OutletController::class, 'search']);
    Route::get('/outlet/create', [OutletController::class, 'create']);
    Route::post('/outlet', [OutletController::class, 'store']);
    Route::get('/outlet/edit/{outlet}', [OutletController::class, 'edit']);
    Route::put('/outlet/edit/{outlet}', [OutletController::class, 'update']);
    Route::get('/outlet/hapus/{outlet}', [OutletController::class, 'delete']);

    ## Inventory
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::get('/inventory/search', [InventoryController::class, 'search']);

    //purchase transaction route
    Route::get('/purchase', [PurchaseTransactionController::class, 'index']);
    Route::get('/purchase/detail/{id}', [PurchaseTransactionController::class, 'detail']);
    Route::get('/purchase/search', [PurchaseTransactionController::class, 'search']);

    //selling transaction route
    Route::get('/selling', [SellingTransactionController::class, 'index']);
    Route::get('/selling/detail/{id}', [SellingTransactionController::class, 'detail']);
    Route::get('/selling/search', [SellingTransactionController::class, 'search']);

    //preorder route
    Route::get('/preorder', [PreorderController::class, 'index']);
    Route::get('/preorder/search', [PreorderController::class, 'search']);
    Route::get('/preorder/create', [PreorderController::class, 'create']);
    Route::get('/preorder_cashier', [PreorderController::class, 'preorder_cashier']);
    Route::get('/preorder/get_modal_data_po/', [PreorderController::class, 'get_modal_data_po']);
    Route::post('/preorder/add_to_cart_po/', [PreorderController::class, 'add_to_cart_po']);
    Route::post('/preorder/delete_item_po/', [PreorderController::class, 'delete_item_po']);
    Route::post('/preorder/order/', [PreorderController::class, 'order']);
    Route::get('/preorder/search_box_po', [PreorderController::class, 'search_box_po']);
    Route::get('/preorder/hapus/{purchase_transaction}', [PreorderController::class, 'delete']);
    Route::get('/preorder/confirm/{id}', [PreorderController::class, 'confirm']);
    Route::put('/preorder/confirm/{id}', [PreorderController::class, 'confirm_ship']);
    Route::get('/preorder/create/refresh', [PreorderController::class, 'refresh']);

    //preorder route
    Route::get('/cashier', function () {
        return redirect('/cashier/create');
    });
    Route::get('/cashier/search', [CashierController::class, 'search']);
    Route::get('/cashier/create/', [CashierController::class, 'create']);
    Route::get('/cashier/create_search/{selling_transaction_id}', [CashierController::class, 'create_search']);
    Route::get('/cashier_cashier', [CashierController::class, 'cashier_cashier']);
    Route::get('/cashier/get_modal_data/', [CashierController::class, 'get_modal_data']);
    Route::get('/cashier/get_modal_data_search/{selling_transaction_id}', [CashierController::class, 'get_modal_data_search']);
    Route::post('/cashier/add_to_cart/', [CashierController::class, 'add_to_cart']);
    Route::post('/cashier/add_to_cart_search/{selling_transaction_id}', [CashierController::class, 'add_to_cart_search']);
    Route::post('/cashier/add_to_cart_barcode/', [CashierController::class, 'add_to_cart_barcode']);
    Route::post('/cashier/delete_item/', [CashierController::class, 'delete_item']);
    Route::post('/cashier/order/', [CashierController::class, 'order']);
    Route::get('/cashier/hold/{selling_transaction}', [CashierController::class, 'hold']);
    Route::get('/cashier/print/', [CashierController::class, 'print']);
    Route::get('/cashier/print2/', [CashierController::class, 'print2']);
    Route::get('/cashier/print3/', [CashierController::class, 'print3']);
    Route::get('/cashier/search_box', [CashierController::class, 'search_box']);
    Route::get('/cashier/hapus/{selling_transaction}', [CashierController::class, 'delete']);
    Route::get('/cashier/confirm/{id}', [CashierController::class, 'confirm']);
    Route::put('/cashier/confirm/{id}', [CashierController::class, 'confirm_ship']);
    Route::get('/cashier/create/refresh', [CashierController::class, 'refresh']);
    Route::get('/cashier/create_search/refresh/{selling_transaction_id}', [CashierController::class, 'refresh_search']);

    ## Project
    Route::get('/project', [ProjectController::class, 'index']);
    Route::get('/project/search', [ProjectController::class, 'search']);
    Route::get('/project/create', [ProjectController::class, 'create']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::get('/project/edit/{project}', [ProjectController::class, 'edit']);
    Route::put('/project/edit/{project}', [ProjectController::class, 'update']);
    Route::get('/project/hapus/{project}', [ProjectController::class, 'delete']);
    Route::post('/project/invoice', [ProjectController::class, 'invoice']);

    ## Archives
    Route::get('/archives', [ArchivesController::class, 'index']);
    Route::get('/archives/search', [ArchivesController::class, 'search']);
    Route::get('/archives/restore_data/{project}', [ArchivesController::class, 'restore_data']);

    ## Progress
    Route::get('/progress', [ProgressController::class, 'index']);
    Route::get('/progress/search', [ProgressController::class, 'search']);
    Route::get('/progress/create', [ProgressController::class, 'create']);
    Route::post('/progress', [ProgressController::class, 'store']);
    Route::get('/progress/edit/{progress}', [ProgressController::class, 'edit']);
    Route::put('/progress/edit/{progress}', [ProgressController::class, 'update']);
    Route::get('/progress/hapus/{progress}', [ProgressController::class, 'delete']);

    ## Team
    Route::get('/team', [TeamController::class, 'index']);
    Route::get('/team/search', [TeamController::class, 'search']);
    Route::get('/team/create', [TeamController::class, 'create']);
    Route::post('/team', [TeamController::class, 'store']);
    Route::get('/team/edit/{team}', [TeamController::class, 'edit']);
    Route::put('/team/edit/{team}', [TeamController::class, 'update']);
    Route::get('/team/hapus/{team}', [TeamController::class, 'delete']);

    ## Group
    Route::get('/group', [GroupController::class, 'index']);
    Route::get('/group/search', [GroupController::class, 'search']);
    Route::get('/group/create', [GroupController::class, 'create']);
    Route::post('/group', [GroupController::class, 'store']);
    Route::get('/group/edit/{group}', [GroupController::class, 'edit']);
    Route::put('/group/edit/{group}', [GroupController::class, 'update']);
    Route::get('/group/hapus/{group}', [GroupController::class, 'delete']);

    ## Menu
    Route::get('/menu/', [MenuController::class, 'index']);
    Route::get('/menu/search', [MenuController::class, 'search']);
    Route::get('/menu/create', [MenuController::class, 'create']);
    Route::post('/menu', [MenuController::class, 'store']);
    Route::get('/menu/edit/{menu}', [MenuController::class, 'edit']);
    Route::put('/menu/edit/{menu}', [MenuController::class, 'update']);
    Route::get('/menu/hapus/{menu}', [MenuController::class, 'delete']);

    ## User
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/search', [UserController::class, 'search']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/user/edit/{user}', [UserController::class, 'edit']);
    Route::put('/user/edit/{user}', [UserController::class, 'update']);
    Route::get('/user/hapus/{user}', [UserController::class, 'delete']);

    ## Log Activity
    Route::get('/log', [LogController::class, 'index']);
    Route::get('/log/search', [LogController::class, 'search']);
});

Route::middleware(['cek_status'])->group(function () {

    ## Project Detail
    Route::get('/project-detail/{id}', [ProjectDetailController::class, 'index']);
    Route::get('/project-detail/search/{id}', [ProjectDetailController::class, 'search']);
    Route::get('/project-detail/create/{id}', [ProjectDetailController::class, 'create']);
    Route::post('/project-detail/{id}', [ProjectDetailController::class, 'store']);
    Route::get('/project-detail/edit/{id}/{project_detail}', [ProjectDetailController::class, 'edit']);
    Route::put('/project-detail/edit/{id}/{project_detail}', [ProjectDetailController::class, 'update']);
    Route::put('/project-detail/edit_status/{id}/{project_detail}', [ProjectDetailController::class, 'update_status']);
    Route::get('/project-detail/hapus/{id}/{project_detail}', [ProjectDetailController::class, 'delete']);

    ## Material
    Route::get('/material/{project}', [MaterialController::class, 'index']);
    Route::get('/material/search/{project}', [MaterialController::class, 'search']);
    Route::get('/material/create/{project}', [MaterialController::class, 'create']);
    Route::post('/material/{project}', [MaterialController::class, 'store']);
    Route::get('/material/edit/{project}/{material}', [MaterialController::class, 'edit']);
    Route::put('/material/edit/{project}/{material}', [MaterialController::class, 'update']);
    Route::put('/material/discount/{project}/{selling_transaction}', [MaterialController::class, 'discount']);
    Route::get('/material/hapus/{project}/{material}', [MaterialController::class, 'delete']);
    Route::get('/material/search_box/{project}', [MaterialController::class, 'search_box']);
    Route::get('/material/get_modal_data/{project}', [MaterialController::class, 'get_modal_data']);
    Route::post('/material/add_to_cart/{project}', [MaterialController::class, 'add_to_cart']);
    Route::post('/material/add_to_cart_barcode/{project}', [MaterialController::class, 'add_to_cart_barcode']);
    Route::get('/material/create/refresh/{project}', [MaterialController::class, 'refresh']);
    Route::post('/material/delete_item/{project}', [MaterialController::class, 'delete_item']);

    ## Payment
    Route::get('/payment/{project}', [PaymentController::class, 'index']);
    Route::get('/payment2/{project}', [PaymentController::class, 'index2']);
    Route::get('/payment2/create/{project}', [PaymentController::class, 'create']);
    Route::post('/payment2/{project}', [PaymentController::class, 'store']);
    Route::get('/payment2/edit/{project}/{payment}', [PaymentController::class, 'edit']);
    Route::put('/payment2/edit/{project}/{payment}', [PaymentController::class, 'update']);
    Route::put('/payment/discount/{project}', [PaymentController::class, 'discount']);
    Route::get('/payment2/hapus/{project}/{payment}', [PaymentController::class, 'delete']);

    ## Worker
    Route::get('/worker/{team}', [WorkerController::class, 'index']);
    Route::get('/worker/search/{team}', [WorkerController::class, 'search']);
    Route::get('/worker/create/{team}', [WorkerController::class, 'create']);
    Route::post('/worker/{team}', [WorkerController::class, 'store']);
    Route::get('/worker/edit/{team}/{worker}', [WorkerController::class, 'edit']);
    Route::put('/worker/edit/{team}/{worker}', [WorkerController::class, 'update']);
    Route::get('/worker/hapus/{team}/{worker}', [WorkerController::class, 'delete']);

    ## Payment
    Route::get('/worker_payment/{team}/{worker}', [WorkerPaymentController::class, 'index']);
    Route::get('/worker_payment/{team}/{worker}/search', [WorkerPaymentController::class, 'search']);
    Route::get('/worker_payment/create/{team}/{worker}', [WorkerPaymentController::class, 'create']);
    Route::post('/worker_payment/{team}/{worker}', [WorkerPaymentController::class, 'store']);
    Route::get('/worker_payment/edit/{team}/{worker}/{worker_payment}', [WorkerPaymentController::class, 'edit']);
    Route::put('/worker_payment/edit/{team}/{worker}/{worker_payment}', [WorkerPaymentController::class, 'update']);
    Route::get('/worker_payment/hapus/{team}/{worker}/{worker_payment}', [WorkerPaymentController::class, 'delete']);

    ## Sub Menu
    Route::get('/sub_menu/{id}', [SubMenuController::class, 'index']);
    Route::get('/sub_menu/search/{id}', [SubMenuController::class, 'search']);
    Route::get('/sub_menu/create/{id}', [SubMenuController::class, 'create']);
    Route::post('/sub_menu/{id}', [SubMenuController::class, 'store']);
    Route::get('/sub_menu/edit/{id}/{sub_menu}', [SubMenuController::class, 'edit']);
    Route::put('/sub_menu/edit/{id}/{sub_menu}', [SubMenuController::class, 'update']);
    Route::get('/sub_menu/hapus/{id}/{sub_menu}', [SubMenuController::class, 'delete']);

    ## Menu Akses
    Route::get('/menu_akses/{group}', [MenuAccessController::class, 'index']);
    Route::get('/menu_akses/search/{group}', [MenuAccessController::class, 'search']);
    Route::get('/menu_akses/create/{group}', [MenuAccessController::class, 'create']);
    Route::post('/menu_akses/{group}', [MenuAccessController::class, 'store']);
    Route::get('/menu_akses/edit/{group}/{menu_access}', [MenuAccessController::class, 'edit']);
    Route::put('/menu_akses/edit/{group}/{menu_access}', [MenuAccessController::class, 'update']);
    Route::get('/menu_akses/hapus/{group}/{menu_access}', [MenuAccessController::class, 'delete']);

    ## Sub Menu Akses
    Route::get('/sub_menu_akses/{group}/{menu}', [SubMenuAccessController::class, 'index']);
    Route::get('/sub_menu_akses/search/{group}/{menu}', [SubMenuAccessController::class, 'search']);
    Route::get('/sub_menu_akses/create/{group}/{menu}', [SubMenuAccessController::class, 'create']);
    Route::post('/sub_menu_akses/{group}/{menu}', [SubMenuAccessController::class, 'store']);
    Route::get('/sub_menu_akses/edit/{group}/{menu}/{sub_menu_access}', [SubMenuAccessController::class, 'edit']);
    Route::put('/sub_menu_akses/edit/{group}/{menu}/{sub_menu_access}', [SubMenuAccessController::class, 'update']);
    Route::get('/sub_menu_akses/hapus/{group}/{menu}/{sub_menu_access}', [SubMenuAccessController::class, 'delete']);

    ## Setting
    Route::get('/setting', [SettingController::class, 'index']);
    Route::put('/setting/edit/{setting}', [SettingController::class, 'update']);
});
