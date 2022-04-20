<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    public $start, $end;

    public function handle(Request $request, Closure $next)
    {
        $this->start = microtime(true);
        /* if ($request->server('HTTP_X_FORWARDED_PROTO') == 'https')
        {
            return $next($request);
        } else {
            return redirect()->secure($request->getRequestUri());
        } */

        try {
            $authorization = $request->header('Authorization');
            if($authorization != null)
            {
                $authorizationArr = explode('Bearer', $authorization);
                if(isset($authorizationArr[1]))
                {
                    $jwt_token = "Bearer " . \Crypt::decryptString(trim($authorizationArr[1]));
                    $request->headers->set('Authorization', $jwt_token);
                }
            }
        } catch (\Exception $e){
            $validator = \Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('token', transLang('invalid_token'));
            throw new \Illuminate\Validation\ValidationException($validator);
        }


        return $next($request);
    }

    public function terminate($request, $response)
    {   
        $this->end = microtime(true);
        $duration = number_format(($this->end - $this->start), 3);

        $url      = $request->fullUrl();
        $method   = $request->getMethod();
        $ip       = $request->getClientIp();
        $status   = $response->getStatusCode();
        $log      = "{$ip}: [{$status}] [{$method}] @ {$url} - {$duration}ms";
        \Log::info('==============================================================');
        // \Log::info($log, ['request' => $request->all(), 'response' => $response]);
        \Log::info($log, ['request' => $request->all()]);
    }
}
