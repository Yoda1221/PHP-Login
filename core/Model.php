<?php

namespace App\core;


abstract class Model {

    public const RULE_REQUIRED  = 'required';
    public const RULE_EMAIL     = 'email';
    public const RULE_MIN       = 'min';
    public const RULE_MAX       = 'max';
    public const RULE_MATCH     = 'match';
    public const RULE_UNIQUE    = 'unique';
    public array $errors        = [];

    abstract public function rules(): array;

    public function labels(): array {
        return [];
    }
    
    public function getLabels($attr) {
        return $this->labels()[$attr] ?? $attr;
    }

    public function loadData($data) {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }    
        }
    }

    public function validate() {
        foreach ($this->rules() as $att => $rules) {
            $value = $this->{$att};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($att, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($att, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule["min"]) {
                    $this->addError($att, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule["match"]}) {
                    $rule["match"] = $this->getLabels($rule["match"]);
                    $this->addError($att, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAtt = $rule['attributes'] ?? $att;
                    $tableName = $className::tablename();
                    $stmt = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAtt = :att" );
                    $stmt->bindValue(":att", $value);
                    $stmt->execute();
                    $record = $stmt->fetchObject();
                    if ($record) {
                        $this->addError($att, self::RULE_UNIQUE, ['field' => $this->getLabels($att)]);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function addError(string $att, string $rule, $params = []) {
        $messages = $this->errorMsg()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $messages = str_replace("{{$key}}", $value, $messages);
        }
        $this->errors[$att][] = $messages;
    }

    public function errorMsg() {
        return [
            self::RULE_REQUIRED => 'This field is required!',
            self::RULE_EMAIL    => 'Must be valid email address!',
            self::RULE_MIN      => 'Minimumm length must be {min} chars!',
            self::RULE_MAX      => 'Maximumm length must be {max}!',
            self::RULE_MATCH    => 'This filed must be same as {match}!',
            self::RULE_UNIQUE   => 'The record with this {field} alredy exists!'
        ];
    }

    public function hasError($attr) {
        return $this->errors[$attr] ?? false;
    }

    public function firstError($attr) {
        return $this->errors[$attr][0] ?? '';
    }

}
