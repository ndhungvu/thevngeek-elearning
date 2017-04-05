<?php

use Illuminate\Http\Request;

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

/* /========================ROUTE FOR CLIENT========================/ */

Route::group(['namespace' => 'Client'], function() {
    require __DIR__ . '/client.php';
});

/* /========================ROUTE FOR ADMIN========================/ */

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    require __DIR__ . '/admin.php';
});

Route::get('download', ['as' => 'download', function (Request $request, $path = 'document', $uploadDisk = 'uploads') {
    $param = $request->all();

    if (isset($param['file']) && $param['file']) {

        $destinationTarget = public_path() . '/' . $uploadDisk . '/' . $path . '/' . $param['file'];

        if (File::exists($destinationTarget)) {
            return response()->download($destinationTarget);
        }
    }

    return redirect()->back()->with('flashError', trans('message.danger.download'));
}]);

/*Ajax*/
Route::post('deleteMultiple', ['as' => 'deleteMultiple', 'uses' => 'AjaxController@deleteMultiple']);