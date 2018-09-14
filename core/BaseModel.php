<?php

namespace Core;

use DebugBar\DataCollector\PDO\TraceablePDO;
// use PDO;

class BaseModel
{
    protected $pdo;

    public function __construct(TraceablePDO $db) {
        $this->db = $db;
    }
}
