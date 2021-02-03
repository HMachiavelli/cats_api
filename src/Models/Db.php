<?php

namespace App\Models;

use PDO;
use Symfony\Component\Yaml\Yaml;

class Db
{
  protected $pdo;
  protected $tableName;

  public function __construct(string $tableName, array $params = [])
  {
    $this->tableName = $tableName;

    $config = $this->getDbConfig();

    $dsn = $config['adapter'] . ':host=' . $config['host'] . ';dbname=' . $config['name'];
    $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    $this->pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  private function getDbConfig()
  {
    $config = Yaml::parseFile(__DIR__ . '/../../phinx.yml');
    $config = $config['environments']['development'] ?? [];

    if (empty($config)) {
      echo 'No DB config.';
      die();
    }

    return $config;
  }

  /**
   * Get the value of tableName
   */
  public function getTableName()
  {
    return $this->tableName;
  }
}
