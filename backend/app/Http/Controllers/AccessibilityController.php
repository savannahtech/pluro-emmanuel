<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyzeHtmlRequest;
use App\Services\AccessibilityService;
use Illuminate\Http\Request;

class AccessibilityController extends Controller
{
    protected AccessibilityService $accessibilityService;

    public function __construct(AccessibilityService $accessibilityService)
    {
        $this->accessibilityService = $accessibilityService;
    }

    public function analyze(AnalyzeHtmlRequest $request): \Illuminate\Http\JsonResponse
    {
       try{
           $file = $request->file('file');
           $content = file_get_contents($file->getRealPath());
           $result = $this->accessibilityService->analyze($content);
           return response()->json(['data'=>$result]);
       }catch (\Exception $e){
           return response()->json(['error' => $e->getMessage()], 500);
         }
    }
}
