<?php
/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 15:20
 */

namespace Oz;

use \PDO;

class Database
{
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $pdo;

    public function __construct($dbhost, $dbname, $dbuser, $dbpass) {
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
    }

    public function getPDO() {
        if ($this->pdo === null) {
            $pdo = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";charset=utf8", $this->dbuser, $this->dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function queryOne($sql, $className, $attributes = null) {
        $stmt = $this->getReadStatement($sql, $className, $attributes);
        return $stmt->fetch();
    }

    public function queryList($sql, $className, $attributes = null) {
        $stmt = $this->getReadStatement($sql, $className, $attributes);
        return $stmt->fetchAll();
    }

    public function execute($sql, $attributes = null) {
        $ok = $this->getExecStatement($sql, $attributes);
        if ($ok) {
            $id = $this->getPDO()->lastInsertId();
            return $id;
        } else {
            return null;
        }
    }

    private function getReadStatement($sql, $className, $attributes) {
        $stmt = $this->getPDO()->prepare($sql);
        if ($attributes != null) {
            $stmt->execute($attributes);
        } else {
            $stmt->execute();
        }
        $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
        return $stmt;
    }

    private function getExecStatement($sql, $attributes) {
        $stmt = $this->getPDO()->prepare($sql);
        if ($attributes != null) {
            return $stmt->execute($attributes);
        } else {
            return $stmt->execute();
        }
    }
}