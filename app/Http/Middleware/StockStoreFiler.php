<?php

namespace App\Http\Middleware;

use Closure;

use App\StockStore;

class StockStoreFiler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (StockStore::isEmpty()) {
          flash("You havent set up the stock store yet! Please do to continue ","info");
          return redirect("/purchases/create");
        }
        return $next($request);
    }
}
