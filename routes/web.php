<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Route};
use App\Models\Link;
use App\Http\Controllers\Frontend\{ContactController, HomeController as FrontendHomeController, LoginController, RegisterController};
use App\Http\Controllers\{DashboardController, PaypalController, UserDashboardController};
use App\Http\Controllers\Admin\{BlogController, CategoryController, ContactMessageController, LinkController, RoleController, UserRoleController};

Route::get('/', [FrontendHomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('category/{slug}/posts', [FrontendHomeController::class, 'categoryPosts'])->name('category.posts');
Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('frontend.contact.submit');
Route::get('/contact/captcha', [ContactController::class, 'generateCaptcha'])->name('frontend.contact.captcha');
Route::get('/register', [FrontendHomeController::class, 'register'])->name('frontend.register');
Route::post('/register', [RegisterController::class, 'register'])->name('frontend.register.authenticate');

Route::get( '/submit_link', [FrontendHomeController::class, 'submit_link'])->name('frontend.submit_link');
Route::get('/submit_link/captcha', [FrontendHomeController::class, 'generateCaptcha'])->name('frontend.submit_link.captcha');
Route::post('/submit_link/submit', [FrontendHomeController::class, 'submitLink'])->name('frontend.submit_link.submit');


Route::get('/login', [FrontendHomeController::class, 'login'])->name('frontend.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('frontend.login.authenticate');
Route::post('/logout', function (Request $request) {
    Auth::logout();
 
    $request->session()->invalidate();
    $request->session()->regenerateToken();
 
    return redirect('/');
})->name('logout');

// Route::middleware('auth')->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::middleware(['auth', 'admin'])->get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages');
Route::middleware(['auth', 'admin'])->delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->names('admin.categories');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('links/pending', [LinkController::class, 'pending'])->name('admin.links.pending');
    Route::get('/links/processed', [LinkController::class, 'processed'])->name('admin.links.processed');
    Route::patch('links/{link}/status', [LinkController::class, 'updateStatus'])->name('admin.links.status');
    Route::get('/links/{link}/edit', [LinkController::class, 'edit'])->name('admin.links.edit');
    Route::put('/links/{link}', [LinkController::class, 'update'])->name('admin.links.update');

    Route::resource('blogs', BlogController::class)->names('admin.blogs');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::post('/submit-link', [UserDashboardController::class, 'submitLink'])->name('submit.link');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('roles', RoleController::class)->names('admin.roles');
    Route::get('user-roles', [UserRoleController::class, 'index'])->name('admin.user-roles.index');
    Route::post('user-roles/{user}/update', [UserRoleController::class, 'updateUserRoles'])->name('admin.user-roles.update');
    Route::post('roles/{role}/add-users', [UserRoleController::class, 'addUsersToRole'])->name('admin.roles.add-users');
    Route::delete('roles/{role}/users/{user}', [UserRoleController::class, 'removeUserFromRole'])->name('admin.roles.remove-user');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
    Route::post('/links/store', [LinkController::class, 'store'])->name('links.store');
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
});

Route::post('/paypal/create', [PaypalController::class, 'createOrder'])->name('paypal.create');
Route::post('/paypal/capture', [PaypalController::class, 'captureOrder'])->name('paypal.capture');

Route::get('/pricing', function() {return view('pricing');})->middleware('auth')->name('pricing');