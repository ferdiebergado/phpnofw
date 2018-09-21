<?php
namespace Core;

// use DebugBar\DataCollector\PDO\TraceablePDO;
// use PDO;
use \Core\ModelInterface;
use \ParagonIE\EasyDB\EasyDB;

class BaseModel implements ModelInterface
{
    protected $db;
    protected $table;
    protected $fillable;
    protected $guarded;
    
    public function __construct(EasyDB $db) {
        $this->db = $db;
        if (empty($this->table)) {
            $this->table = \get_class($this) . 's';
        }
    }

    public function find($id) {
        return $this->guard($this->db->row("SELECT * FROM $this->table WHERE id = ?", $id));
    }

    public function update($id, array $fields)
    {
        return $this->db->update($this->table, $fields, ['id' => $id]);
    }

    public function guard($array)
    {
        foreach ($this->guarded as $guard) {
            unset($array[$guard]);
        }
        return $array;
    }
}
