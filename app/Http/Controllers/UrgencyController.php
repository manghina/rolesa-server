<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Urgency;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;

class UrgencyController extends Controller
{

    public function getAll(Request $request)
    {

        return response()->json([
            'data' => Urgency::all()
        ], 200);
    }


}
