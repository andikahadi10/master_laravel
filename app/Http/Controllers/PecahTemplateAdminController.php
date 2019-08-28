<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;



class PecahTemplateAdminController extends Controller
{
  public function index()
  {

    return view('admin.index');

  }
}
