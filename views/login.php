<?php
  //**  @ var $model App\models\LoginForm
?>

<h1>Login</h1>
<?php

use App\core\form\Form;

 $form = Form::begin("", "post") ;
  echo $form->field($model, 'email') ;
  echo $form->field($model, 'password')->passField();  ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php echo Form::end() ?>
