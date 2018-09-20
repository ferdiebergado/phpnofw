<?php declare(strict_types = 1);

$container = new Dice\Dice;

$db = require(CONFIG_PATH . 'database.php');
$dsn = "mysql:host=". $db['host'] . ";port=" . $db['port'] . ";dbname=" . $db['dbname'] . ";charset=" . $db['charset'];

$pdorule = [
         //Mark the class as shared so the same instance is returned each time
   'shared' => true,

         //The constructor arguments that will be supplied when the instance is created
   'constructParams' => [$dsn, $db['username'], $db['password'], $db['options']]
];

//Apply the rule to the PDO class
$container->addRule('PDO', $pdorule);

//Now any time PDO is requested from Dice, the same instance will be returned
//And will havebeen constructed with the arugments supplied in 'constructParams'

$container->create('PDO');

if (config('debug_mode')) {
    $container->create('DebugBar\\StandardDebugBar');
    $container->create('DebugBar\\DataCollector\\PDO\\TraceablePDO');
    $container->create('DebugBar\\DataCollector\\PDO\\PDOCollector');
    $container->create('Core\\DebugbarRenderer');
}

$container->create('Core\\BaseModel');
$container->create('App\\Models\\User');
$container->create('ParagonIE\\EasyDB\\EasyDB');

return $container;
