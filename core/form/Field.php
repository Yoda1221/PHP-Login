<?php

namespace App\core\form;

use App\core\Model;

class Field {

    public const TYPE_TEXT  = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUM   = 'number';
    public const TYPE_PASS  = 'password';

    public Model $model;
    public string $attr;
    public string $type;
    
    public function __construct(Model $model, string $attr) {
        $this->type     = self::TYPE_TEXT;
        $this->attr     = $attr;
        $this->model    = $model;
    }
    
    public function __toString() {
        
        return sprintf('
            <div class="mb-3">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s" />
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->attr,
            $this->type,
            $this->attr,
            $this->model->{$this->attr},
            $this->model->hasError($this->attr) ? ' is-invalid' : '' ,
            $this->model->firstError($this->attr)
        );

    }

    public function passField() {
        $this->type = self::TYPE_PASS;
        return $this;
    }

}