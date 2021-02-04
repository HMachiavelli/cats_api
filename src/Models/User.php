<?php

namespace App\Models;

class User extends Db
{
  protected $id;
  protected $username;
  protected $password;
  protected $createdAt;

  public function __construct(array $params = [])
  {
    parent::__construct('users');
    $this->fill($params);
  }

  private function fill(array $params = []): void
  {
    $this->setId($params['id']               ?? null);
    $this->setUsername($params['username']   ?? null);
    $this->setPassword($params['password']   ?? null);
    $this->setCreatedAt($params['createdAt'] ?? null);
  }

  public function getByUsername(string $username)
  {
    if (!$this->pdo) {
      return false;
    }

    $st = $this->pdo->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE username = :username');
    $st->execute([':username' => $username]);

    return $st->fetch(\PDO::FETCH_ASSOC);
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
   * Get the value of username
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set the value of username
   *
   * @return  self
   */
  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  /**
   * Get the value of password
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */
  public function setPassword($password)
  {
    $this->password = $password;

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
