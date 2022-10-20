<?php

namespace App\Models;

use PDO;
use App\Http\Config;
use App\Http\Request;

class DB
{
    private static $instance = null;
    private static $connstr = null;
    private static $query = null;
    private static $table = null;

    private function __construct(){}

    public static function table($table)
    {
        $options=array(PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8");
        self::$instance = new Self;
        self::$connstr = new PDO("mysql:hostname=".Config::HOSTNAME.";dbname=".Config::DBNAME,Config::USERNAME,Config::PASSWORD,$options);
        self::$table = $table;
        self::$query = "select * from " . self::$table;

        return self::$instance;
    }

    public function get()
    {
        $stmt=self::$connstr->prepare(self::$query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        return json_encode($result);
    }

    public function add(array $fields, array $values)
    {
        $field = implode(", ",$fields);
        $fieldBind=implode( ", :",$fields);
        $value=array_combine($fields,$values);
        self::$query = "insert into " . self::$table . " ({$field}) values (:$fieldBind)";
        $stmt=self::$connstr->prepare(self::$query);
        $stmt->execute($value);
        return true;

    }

    public function delete(array $ids)
    {
        $bind='';
        if(is_array($ids)) {
            foreach ($ids as  $id) {
                $bind.='?, ';
            }
        }
        $bind=trim($bind,', ');
        self::$query = "delete from " . self::$table . " where id IN ({$bind})";
        $stmt=self::$connstr->prepare(self::$query);
        $stmt->execute($ids);
        return true;
    }


    public function where($field,$opr,$value)
    {
        self::$query.=" where {$field} {$opr} '{$value}'";
        return $this;
    }

    public function innerJoin($relatedTable,$foreignKey,$ownerKey)
    {   
        $relationTable=self::$table;
        $relatedTableId="{$relatedTable}.id as {$relatedTable}_id";
        $relationTableId="{$relationTable}.id as {$relationTable}_id";
        self::$query="select * ,{$relatedTableId} ,{$relationTableId} from {$relationTable} INNER JOIN {$relatedTable} ON {$relationTable}.{$foreignKey} = {$relatedTable}.{$ownerKey}";

        return $this;
    }

    public function orderBy($field,$sortType="DESC")
    {
        self::$query.=" ORDER BY ".self::$table.".{$field} {$sortType}";
        return $this;
    }

    public function and($field,$opr,$value)
    {
        self::$query.=" and {$field} {$opr} '{$value}'";
        return $this;
    }

    public function first()
    {
        $stmt=self::$connstr->prepare(self::$query);
        $stmt->execute();
        $result=$stmt->fetch();
        return json_encode($result);
    }

    public function update($id,$fields,$values)
    {
        $result='';
        $value=array_merge($values,[$id]);
        foreach ($fields as  $field) {
            $result.="{$field}=? , ";
        }
        $result=trim($result,', ');
        self::$query="update ". self::$table ." set  {$result} , updated_at=NOW() where id=?";
        $stmt=self::$connstr->prepare(self::$query);
        $stmt->execute($value);
        return true;
    }
  

}