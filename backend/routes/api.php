<?php

use App\Http\Controllers\AccessibilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/analyze', [AccessibilityController::class, 'analyze']);
