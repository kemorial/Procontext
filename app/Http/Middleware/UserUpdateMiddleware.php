<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isset($request['age'])) {
            if ($request['age'] < 0) {
                return response()->json(['error' => "age must be natural number"], 400);
            }
        }
        if (isset($request['email'])) {
            if (!is_null(User::where('email', '=', $request['email'])->first())) {
                return response()->json(['error' => "email is already used"], 400);
            }
            if (!(new EmailValidator())->isValid($request['email'], new RFCValidation)) {
                return response()->json(['error' => "email is invalid"], 400);
            }
        }
        return $next($request);
    }
}
