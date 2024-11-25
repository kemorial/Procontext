<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class UserStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!is_null(User::where('email', '=', $request['email'])->first())) {
            return response()->json(['error' => "email is engaged"], 400);
        }
        if (!(new EmailValidator())->isValid($request['email'], new RFCValidation)) {
            return response()->json(['error' => "email is invalid"], 400);
        }
        if (!isset($request['name']) || !isset($request['email']) || !isset($request['age'])) {
            return response()->json(['error' => "enter all parameters"], 400);
        }
        if ($request['age'] < 0) {
            return response()->json(['error' => "age must be natural number"], 400);
        }
        return $next($request);
    }
}
