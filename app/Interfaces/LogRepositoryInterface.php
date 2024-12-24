<?php

namespace App\Interfaces;

use App\Models\Log;

interface LogRepositoryInterface {
	public function save(Log $log, $request);
}
