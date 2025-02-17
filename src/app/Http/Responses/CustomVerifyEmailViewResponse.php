<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\VerifyEmailViewResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CustomVerifyEmailViewResponse implements VerifyEmailViewResponse
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => 'Verify email'], 200)
            : view('auth.verify-email');
    }
}