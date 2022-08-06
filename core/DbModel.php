<?php

namespace App\core;

use App\core\Model;

class DbModel extends Model {
    
    public function tableName(): string {
        return '';
    }
    public function attributes(): array {
        return [];
    }

    /**
     ** SAVE NEW USER TO DATABASE
     *
     * @return void
     */
    public function save() {
        $tableName  = $this->tableName();
        $attributes = $this->attributes();
        $params     = array_map(fn($attr) => ":$attr", $attributes);
        $stmt = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ")
            VALUES(" . implode(',', $params) . ")
        ");

        foreach ($attributes as $attribute) {
            $stmt->bindValue(":$attribute", $this->{$attribute});
        }

        $stmt->execute();
        return true;
    }

    /**
     ** SEARCH FOR A USER IN THE DATABASE E.G. BY EMAIL ADDRESS
     *
     * @param array $where
     * @return void
     */
    public function findUser(array $where) {
        $tableName  = static::tableName();
        $attr       = array_keys($where);
        $whereStr   = implode("AND", array_map(fn($att) => "$att = :$att", $attr));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $whereStr");
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

}
