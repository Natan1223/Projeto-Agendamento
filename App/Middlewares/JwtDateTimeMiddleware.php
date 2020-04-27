<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Request;
use Psr\Http\Message\ServerRequestInterface as Response;


final class JwtDateTimeMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        $token = $request->getAttribute("jwt");
        $expireDate = date_format(new \DateTime($token['data_expira']), 'Y-m-d H:i:s');

        $now = new \DateTime();
        $now = date_format($now, 'Y-m-d H:i:s');
        if($expireDate < $now)
            return $response->withStatus(401);
        $response = $next($request, $response);
        return $response;
    }
}