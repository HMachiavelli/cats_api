<?php

namespace App\Models;

class Request extends Db
{
  protected $id;
  protected $name;
  protected $response;
  protected $createdAt;

  public function __construct(array $params = [])
  {
    parent::__construct('requests');
    $this->fill($params);
  }

  private function fill(array $params = []): void
  {
    $this->setId($params['id']               ?? null);
    $this->setName($params['name']           ?? null);
    $this->setResponse($params['response']   ?? null);
    $this->setCreatedAt($params['createdAt'] ?? null);
  }

  public function getByName(string $name)
  {
    if (!$this->pdo) {
      return false;
    }

    $st = $this->pdo->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE name = :name');
    $st->execute([':name' => $name]);

    return $st->fetch(\PDO::FETCH_ASSOC);
  }

  public function insert()
  {
    if (!$this->pdo) {
      return false;
    }

    $st = $this->pdo->prepare(
      'INSERT INTO ' . $this->getTableName() . ' (name, response) VALUES (:name, :response)'
    );

    $st->execute([
      ':name' => $this->getName(),
      ':response' => $this->getResponse()
    ]);

    return (int)$this->pdo->lastInsertId();
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of response
   */
  public function getResponse()
  {
    return $this->response;
  }

  /**
   * Set the value of response
   *
   * @return  self
   */
  public function setResponse($response)
  {
    $this->response = $response;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }
}
