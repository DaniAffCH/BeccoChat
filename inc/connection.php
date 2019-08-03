<?php
class DB
{
     protected $pdo = null,
     $stmt = null,
     $dsn = 'mysql:dbname=Sql1295720_3;host=89.46.111.80',
     $usersql = 'Sql1295720',
     $passwordsql = '2p4745j152';

     function __construct()
     {
          try {
               $this->pdo = new PDO(
               $this->dsn,
               $this->usersql,
               $this->passwordsql,
               [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
               PDO::ATTR_EMULATE_PREPARES => false,
               ]
               );
          } catch (Exception $ex) {
               die($ex->getMessage());
          }
     }

     function __destruct()
     {
          if ($this->stmt !== null) {
               $this->stmt = null;
          }
          if ($this->pdo !== null) {
               $this->pdo = null;
          }
     }

     public function select($sql, $cond = null)
     {
          $result = false;
          try {
               $this->stmt = $this->pdo->prepare($sql);
               $this->stmt->execute($cond);
               $result = $this->stmt->fetchAll();
          } catch (Exception $ex) {
               die($ex->getMessage());
          }
          $this->stmt = null;
          return $result;
     }
}
?>
