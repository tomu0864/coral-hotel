<?php

use App\Models\User;
use App\Models\BookArea;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\BookAreaController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\FacilityController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\PolicyTermController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RestaurantController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\RoomNumberController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\Frontend\RatingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

/*---------------------------------- Backend ----------------------------------------*/

// Admin Group Middleware
// Protect this route for admin: Check if the user is authenticated and role is admin
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
        Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('logout');
        Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('profile');
        Route::patch('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('profile.store');
        Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('change.password');
        Route::put('/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('password.update');
    });
});
// End Admin Group Middleware

// Route to login for admin
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Route for Admin
Route::middleware(['auth', 'roles:admin'])->group(function () {
    // Team
    Route::controller(TeamController::class)->group(function () {
        Route::group(['prefix' => 'team', 'as' => 'team.'], function () {
            Route::middleware('permission:team.menu')->group(function () {
                Route::get('/all', 'AllTeam')->name('all');
                Route::get('/add', 'AddTeam')->name('add');
                Route::post('/store', 'StoreTeam')->name('store');
                Route::get('/edit/{id}', 'EditTeam')->name('edit');
                Route::patch('/update', 'UpdateTeam')->name('update');
                Route::delete('/delete/{id}', 'DeleteTeam')->name('delete');
            });
        });
    });

    // Testimonial
    Route::controller(TestimonialController::class)->group(function () {
        Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {
            Route::middleware('permission:testimonial.menu')->group(function () {
                Route::get('/all', 'AllTestimonial')->name('all');
                Route::get('/add', 'AddTestimonial')->name('add');
                Route::post('/store', 'StoreTestimonial')->name('store');
                Route::get('/{id}/edit', 'EditTestimonial')->name('edit');
                Route::patch('/{id}/update', 'UpdateTestimonial')->name('update');
                Route::delete('/{id}/delete', 'DeleteTestimonial')->name('delete');
            });
        });
    });

    // Blog 
    Route::controller(BlogController::class)->group(function () {
        Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
            Route::middleware('permission:blog.menu')->group(function () {
                Route::get('/category', 'BLogCategory')->name('category');
                Route::get('/category/edit/{id}', 'EditBLogCategory');
                Route::post('/category/store', 'StoreBLogCategory')->name('category.store');
                Route::patch('/category/update', 'UpdateBLogCategory')->name('category.update');
                Route::delete('/{id}/category/delete', 'DeleteBLogCategory')->name('category.delete');
                Route::get('/post/all', 'AllBlogPost')->name('post.all');
                Route::get('/post/add', 'AddBlogPost')->name('post.add');
                Route::post('/post/store', 'StoreBlogPost')->name('post.store');
                Route::get('/{id}/post/edit', 'EditBlogPost')->name('post.edit');
                Route::patch('/{id}/post/update', 'UpdateBlogPost')->name('post.update');
                Route::delete('/{id}/post/delete', 'DeleteBlogPost')->name('post.delete');
            });
        });
    });


    // Book Area
    Route::controller(BookAreaController::class)->group(function () {
        Route::middleware('permission:book.area.menu')->group(function () {
            Route::get('/bookarea', 'BookArea')->name('book.area');
            Route::post('/bookarea/update', 'BookAreaUpdate')->name('book.area.update');
        });
    });

    // Room Type
    Route::controller(RoomTypeController::class)->group(function () {
        Route::group(['prefix' => 'room/type', 'as' => 'room.type.'], function () {
            Route::middleware('permission:roomtype.menu')->group(function () {
                Route::get('/list', 'RoomTypeList')->name('list');
                Route::get('/add', 'AddRoomType')->name('add');
                Route::post('/store', 'StoreRoomType')->name('store');
            });
        });
    });

    // Room Number
    Route::controller(RoomNumberController::class)->group(function () {
        Route::group(['prefix' => 'roomnumber', 'as' => 'roomnumber.'], function () {
            Route::middleware('permission:room.menu')->group(function () {
                Route::get('/show', 'Show')->name('show');
            });
        });
    });



    // Admin Bookings
    Route::controller(BookingController::class)->group(function () {
        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::middleware('permission:booking.menu')->group(function () {
                Route::get('/list', 'BookingList')->name('list');
                Route::get('/history', 'BookingHistory')->name('history');
                Route::get('/{id}/edit', 'BookingEdit')->name('edit');
                Route::get('/{id}/complete/details', 'CompletedBookingDetails')->name('completed.details');
                Route::patch('/{id}/complete/status/update', 'BookingCompleteStatusUpdate')->name('complete.status.update');
                Route::patch('/{id}/status/update', 'BookingStatusUpdate')->name('status.update');
                Route::patch('/{id}/update', 'BookingUpdate')->name('update');
                Route::delete('/{id}/delete', 'BookingDelete')->name('delete');

                // Assign Room Route
                Route::get('/{id}/assign/room', 'BookingAssignRoom')->name('assign.room');
                Route::post('/{booking_id}/{room_number_id}/assign/room/store', 'BookingAssignRoomStore')->name('assign.room.store');
                Route::delete('/{id}/assign/room/delete', 'BookingAssignRoomDelete')->name('assign.room.delete');
                Route::get('/{id}/download/invoice', 'DownloadInvoice')->name('download.invoice');
            });
        });
    });

    // Booking Report
    Route::controller(ReportController::class)->group(function () {
        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::middleware('permission:booking.menu')->group(function () {
                Route::get('/report', 'BookingReport')->name('report');
                Route::post('/report/search/by/date', 'SerachByDate')->name('report.search.by.date');
            });
        });
    });

    // Booking Room List
    Route::controller(RoomListController::class)->group(function () {
        Route::middleware('permission:booking.menu')->group(function () {
            Route::group(['prefix' => 'booking/room/list', 'as' => 'booking.room.list.'], function () {
                Route::get('/{id}', 'RoomListView')->name('view');
                // Route::get('/add', 'RoomListAdd')->name('add');
                Route::post('/store', 'RoomListStore')->name('store');
            });
        });
    });

    Route::get('/booking/add', [RoomListController::class, 'RoomListAdd'])->name('booking.room.list.add');

    // Rooms
    Route::controller(RoomController::class)->group(function () {
        Route::group(['prefix' => 'room', 'as' => 'room.'], function () {
            Route::middleware('permission:room.menu')->group(function () {
                Route::get('/{id}/edit', 'EditRoom')->name('edit');
                Route::patch('/{id}/update', 'UpdateRoom')->name('update');
                Route::delete('/{id}//delete', 'RoomDelete')->name('delete');
                Route::post('/{id}/image/main', 'mainImageStore')->name('image.main');
                Route::post('/{id}/image/sub', 'subImageStore')->name('image.sub');
                Route::get('/{id}/image/sub/delete', 'MultiImageDelete')->name('multi.image.delete');
                Route::post('/{id}/number/store', 'RoomNumberStore')->name('number.store');
                Route::patch('/{id}/number/update', 'RoomNumberUpdate')->name('number.update');
                Route::get('/{id}/number/edit', 'RoomNumberEdit')->name('number.edit');
                Route::delete('/{id}/number/delete', 'RoomNumberDelete')->name('number.delete');
            });
        });
    });

    //Facilities
    Route::controller(FacilityController::class)->group(function () {
        Route::group(['prefix' => 'facility', 'as' => 'facility.'], function () {
            Route::middleware('permission:facility.menu')->group(function () {
                Route::get('/', 'RoomFacility')->name('list');
                Route::get('/create', 'RoomFacilityCreate')->name('create');
                Route::post('/store', 'RoomFacilityStore')->name('store');
                Route::get('/{id}/edit', 'RoomFacilityEdit')->name('edit');
                Route::patch('/{id}/update', 'RoomFacilityUpdate')->name('update');
                Route::delete('/{id}/delete', 'RoomFacilityDelete')->name('delete');
            });
        });
    });

    // Setting
    Route::controller(SettingController::class)->group(function () {
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
            Route::middleware('permission:setting.menu')->group(function () {
                Route::get('/smtp', 'SettingSmtp')->name('smtp');
                Route::patch('/{id}/smtp/update', 'SettingSmtpUpdate')->name('smtp.update');
                Route::get('/site', 'SettingSite')->name('site');
                Route::patch('/{id}/site/update', 'SettingSiteUpdate')->name('site.update');
            });
        });
    });

    // Comment
    Route::controller(CommentController::class)->group(function () {
        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
            Route::middleware('permission:comment.menu')->group(function () {
                Route::get('/all', 'AllComment')->name('all');
                Route::post('/status/update', 'UpdateCommentStatus')->name('status.update');
            });
        });
    });

    // Gallery
    Route::controller(GalleryController::class)->group(function () {
        Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
            Route::middleware('permission:gallery.menu')->group(function () {
                Route::get('/all', 'AllGallery')->name('all');
                Route::get('/add', 'AddGallery')->name('add');
                Route::post('/store', 'StoreGallery')->name('store');
                Route::get('/{id}/edit', 'EditGallery')->name('edit');
                Route::patch('/{id}/update', 'UpdateGallery')->name('update');
                Route::delete('/delete', 'DeleteGalleryMultiple')->name('delete.multiple');
            });
        });
    });

    // Contact
    Route::controller(ContactController::class)->group(function () {
        Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
            Route::middleware('permission:support.menu')->group(function () {
                Route::get('/message', 'ContactMessage')->name('message');
                Route::post('/message/status/update', 'UpdateContactMessageStatus')->name('message.status.update');
            });
        });
    });

    // FAQ
    Route::controller(FaqController::class)->group(function () {
        Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
            Route::middleware('permission:faq.menu')->group(function () {
                Route::get('/all', 'All')->name('all');
                Route::get('/add', 'Add')->name('add');
                Route::post('/store', 'Store')->name('store');
                Route::get('/{id}/edit', 'Edit')->name('edit');
                Route::patch('/{id}/update', 'Update')->name('update');
                Route::delete('/{id}/delete', 'Delete')->name('delete');
            });
        });
    });

    // Restaurant
    Route::controller(RestaurantController::class)->group(function () {
        Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
            Route::middleware('permission:restaurant.menu')->group(function () {
                Route::get('/category/all', 'AllCategory')->name('category.all');
                Route::post('/category/store', 'CategoryStore')->name('category.store');
                Route::patch('/category/{id}/update', 'CategoryUpdate')->name('category.update');
                Route::delete('/category/{id}/delete', 'CategoryDelete')->name('category.delete');
                Route::get('/menu/all', 'AllMenu')->name('menu.all');
                Route::get('/menu/add', 'AddMenu')->name('menu.add');
                Route::post('/menu/store', 'StoreMenu')->name('menu.store');
                Route::get('/menu/{id}/edit', 'EditMenu')->name('menu.edit');
                Route::patch('/menu/{id}/update', 'UpdateMenu')->name('menu.update');
                Route::delete('/menu/delete/multiple', 'DeleteMenuMultiple')->name('menu.delete.multiple');
            });
        });
    });

    // Policy
    Route::controller(PolicyTermController::class)->group(function () {
        Route::middleware('permission:setting.menu')->group(function () {
            Route::group(['prefix' => 'policy', 'as' => 'policy.'], function () {
                Route::get('/edit', 'EditPolicy')->name('edit');
                Route::patch('/{id}/update', 'UpdatePolicy')->name('update');
            });
        });
    });

    // Terms Conditions
    Route::controller(PolicyTermController::class)->group(function () {
        Route::group(['prefix' => 'term', 'as' => 'term.'], function () {
            Route::middleware('permission:setting.menu')->group(function () {
                Route::get('/edit', 'EditTerm')->name('edit');
                Route::patch('/{id}/update', 'UpdateTerm')->name('update');
            });
        });
    });

    // Role & Permission
    Route::controller(RoleController::class)->group(function () {
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::middleware('permission:role.permission.menu')->group(function () {
                // Permissions
                Route::get('/permission', 'AllPermission')->name('permission');
                Route::get('/permission/add', 'AddPermission')->name('permission.add');
                Route::post('/permission/store', 'StorePermission')->name('permission.store');
                Route::get('/permission/{id}/edit', 'EditPermission')->name('permission.edit');
                Route::patch('/permission/{id}/update', 'UpdatePermission')->name('permission.update');
                Route::delete('/permission/{id}/delete', 'deletePermission')->name('permission.delete');
                Route::get('/permission/export', 'ExportPermission')->name('permission.export');
                Route::get('/permission/import', 'ImportPermission')->name('permission.import');
                Route::post('/permission/import/file', 'ImportFilePermission')->name('permission.import.file');

                // Roles
                Route::get('/all', 'AllRole')->name('all');
                Route::get('/add', 'AddRole')->name('add');
                Route::post('/store', 'StoreRole')->name('store');
                Route::get('/{id}/edit', 'EditRole')->name('edit');
                Route::patch('/{id}/update', 'UpdateRole')->name('update');
                Route::delete('/{id}/delete', 'DeleteRole')->name('delete');

                Route::get('/permission/assign', 'AssignRolePermission')->name('permission.assign');
                Route::post('/permission/assign/store', 'AssignRolePermissionStore')->name('permission.assign.store');
                Route::get('/permission/assign/all', 'AssignRolePermissionAll')->name('permission.assign.all');
                Route::get('/permission/{id}/assign/edit', 'AssignRolePermissionEdit')->name('permission.assign.edit');
                Route::patch('/permission/{id}/assign/update', 'AssignRolePermissionUpdate')->name('permission.assign.update');
                Route::delete('/permission/{id}/assign/delete', 'AssignRolePermissionDelete')->name('permission.assign.delete');
            });
        });
    });

    // Manage Admin User
    Route::controller(AdminController::class)->group(function () {
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::middleware('permission:role.permission.menu')->group(function () {
                Route::get('/all', 'AllAdmin')->name('all');
                Route::get('/add', 'AddAdmin')->name('add');
                Route::post('/store', 'StoreAdmin')->name('store');
                Route::get('/{id}/edit', 'EditAdmin')->name('edit');
                Route::patch('/{id}/update', 'UpdateAdmin')->name('update');
                Route::delete('/{id}/delete', 'DeleteAdmin')->name('delete');
            });
        });
    });
}); // End Admin Group Middleware

/*---------------------------------- End Backend ----------------------------------------*/



/*---------------------------------- Frontend ----------------------------------------*/

Route::middleware('auth')->group(function () {

    // Users Dashboard
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/profile', [UserController::class, 'UserProfile'])->name('profile');
        Route::patch('/profile/store', [UserController::class, 'UserProfileStore'])->name('profile.store');
        Route::get('/logout', [UserController::class, 'UserLogout'])->name('logout');
        Route::get('/change/password', [UserController::class, 'UserChangePassword'])->name('change.password');
        Route::get('/booking', [UserController::class, 'UserBooking'])->name('booking');
        Route::get('/{id}/booking/invoice', [UserController::class, 'UserBookingInvoice'])->name('booking.invoice');
        Route::put('/password/update', [UserController::class, 'UserPasswordUpdate'])->name('password.update');
    });

    // Bookings
    Route::controller(BookingController::class)->group(function () {
        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::get('/now', 'BookingNow')->name('now');
            Route::get('/checkout', 'Checkout')->name('checkout');
            Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
            Route::post('/store', 'BookingStore')->name('store');
            Route::delete('/{id}/cancel', 'BookingCancel')->name('cancel');
            Route::post('/mark-notification-as-read/{notification}', 'ReadNotification');
            Route::match(['get', 'post'], '/stripe_pay', 'stripe_pay')->name('stripe_pay');
        });
    });

    // BLog
    Route::controller(BlogController::class)->group(function () {
        Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
            Route::get('/details/{slug}', 'BlogDetails');
            Route::get('/category/{category_slug}', 'BlogByCategory');
            Route::get('/list', 'BlogList')->name('list');
        });
    });


    // Comment
    Route::controller(CommentController::class)->group(function () {
        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
            Route::post('/{id}/store', 'CommentStore')->name('store');
            Route::patch('/{id}/update', 'CommentUpdate')->name('update');
            Route::delete('/{id}/delete', 'CommentDelete')->name('delete');
        });
    });
}); // End Auth Middleware


// OPEN ROUTE

// About
Route::controller(AboutController::class)->group(function () {
    Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
        Route::get('/', 'show')->name('show');
    });
});

// Bookings
Route::controller(BookingController::class)->group(function () {
    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::get('/now', 'BookingNow')->name('now');
    });
});


// Rooms
Route::controller(FrontendRoomController::class)->group(function () {
    Route::group(['prefix' => 'rooms', 'as' => 'room.'], function () {
        Route::get('/', 'RoomList')->name('all');
        Route::get('/{id}/details', 'RoomDetails')->name('details');
        Route::get('/bookings', 'BookingSearch')->name('booking.search');
        Route::get('/bookings/search/details/{id}', 'BookingSearchDetails')->name('booking.search.details');
        Route::get('/availablity', 'CheckAvailability')->name('availability');
    });
});

// Team
Route::controller(TeamController::class)->group(function () {
    Route::group(['prefix' => 'team', 'as' => 'team.'], function () {
        Route::get('/list', 'TeamList')->name('list');
    });
});

// Testimonial
Route::controller(TestimonialController::class)->group(function () {
    Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {
        Route::get('/list', 'TestimonialList')->name('list');
    });
});

// BLog
Route::controller(BlogController::class)->group(function () {
    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get('/list', 'BlogList')->name('list');
    });
});

// Gallery
Route::controller(GalleryController::class)->group(function () {
    Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
        Route::get('/show', 'showGallery')->name('show');
    });
});

// Contact
Route::controller(ContactController::class)->group(function () {
    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
        Route::get('/us', 'ContactUs')->name('us');
        Route::post('/store', 'Store')->name('store');
    });
});

// FAQ
Route::controller(FaqController::class)->group(function () {
    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
        Route::get('/show', 'Show')->name('show');
    });
});

// Restaurant
Route::controller(RestaurantController::class)->group(function () {
    Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
        Route::get('/show', 'Show')->name('show');
    });
});

// Like
Route::controller(LikeController::class)->group(function () {
    Route::group(['prefix' => 'like', 'as' => 'like.'], function () {
        Route::post('/{blog_id}/store', 'Store')->name('store');
        Route::delete('/{blog_id}/delete', 'Delete')->name('delete');
    });
});

// Rating
Route::controller(RatingController::class)->group(function () {
    Route::group(['prefix' => 'rating', 'as' => 'rating.'], function () {
        Route::post('/{room_id}/store', 'Store')->name('store');
        Route::patch('/{rating_id}/update', 'Update')->name('update');
        Route::delete('/{rating_id}/delete', 'Delete')->name('delete');
    });
});

// Private Policy
Route::get('/private/policy', [PolicyTermController::class, 'PolicyShow'])->name('private.policy.show');

// Terms And Condition 
Route::get('/terms/condition', [PolicyTermController::class, 'TermsShow'])->name('terms.show');


/*---------------------------------- End Frontend ----------------------------------------*/
