<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = auth()->user();
            if ($user->isAdmin()) {
                return $next($request);
            }
            throw new \Exception("Anda tidak memiliki hak akses");
        } catch (\Throwable $th) {
            return response()->json([
                "response_code" => '01',
                "response_message" => $th->getMessage(),
            ]);
        }
    }
}
