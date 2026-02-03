<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    //
    public function index()
    {
        $templates = \App\Models\TemplateSurat::where('is_active', true)->get();
        return response()->json($templates);
    }
}
