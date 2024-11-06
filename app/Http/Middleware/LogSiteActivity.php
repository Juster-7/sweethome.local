<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Log;

class LogSiteActivity
{
	//private $startTime;
	
	public function __construct(
		protected Log $log
	) {}

	//private $startTime;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
		//$this->startTime = microtime(true);
        return $next($request);
    }
	
	public function terminate(Request $request, $response) {
		//$endTime = microtime(true);
		//$this->log->duration = $endTime.' - '.$this->startTime;
		$this->log->saveLog($request);
	}
}
