<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
   // Afficher la liste des notifications
   public function index()
   {

       $notifications = Auth::user()->notifications;

       return view('notifications.index', compact('notifications'));
   }
}
