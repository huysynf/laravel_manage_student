<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function errorNotFound()
    {
        return view('backends.errors.error_notfound');
    }

    public function errorForbidden()
    {
        return view('backends.errors.error_forbidden');
    }

}
