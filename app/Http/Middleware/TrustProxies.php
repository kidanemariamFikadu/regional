<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies
{
     protected $proxies = '*'; // Trust all proxies (or use ['127.0.0.1'] for localhost)

    protected $headers = Request::HEADER_X_FORWARDED_FOR;
}
