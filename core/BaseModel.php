<?php

namespace Core;

// use DebugBar\DataCollector\PDO\TraceablePDO;
// use PDO;
use \ParagonIE\EasyDB\EasyDB;

class BaseModel
{
    protected $db;
    protected $fillable = [];
    protected $guarded = [];

    public function __construct(EasyDB $db) {
        $this->db = $db;
    }

    protected function guard($array)
    {
        foreach ($this->guarded as $guard) {
            unset($array[$guard]);
        }
        return $array;
    }
}
