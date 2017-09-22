<?php

return [

  'availableInputs' => [

      'text'=>['scaffold'=>'input'],
      'email'=>['scaffold'=>'input'],
      'password'=>['scaffold'=>'input'],
      'button'=>['scaffold'=>'input'],
      'checkbox'=>['scaffold'=>'input'],
      'color'=>['scaffold'=>'input'],
      'date'=>['scaffold'=>'input'],
      'file'=>['scaffold'=>'input'],
      'email'=>['scaffold'=>'input'],
      'hidden'=>['scaffold'=>'input'],
      'number'=>['scaffold'=>'input'],
      'radio'=>['scaffold'=>'input'],
      'submit'=>['scaffold'=>'input'],
      'tel'=>['scaffold'=>'input'],
      'url'=>['scaffold'=>'input'],
      'select'=>['scaffold'=>'select', 'children'=>'options', 'childrenType'=>'array'],
      'textarea'=>['scaffold'=>'textarea']
  ],

  'assumptions' => [
    'name'=>['type'=>'text', 'name'=>'Name', 'required'=>true],
    'email'=>['type'=>'email', 'name'=>'Email Address', 'required'=>true],
    'password'=>['type'=>'password', 'name'=>'Password', 'required'=>true],
    'enabled'=>['type'=>'checkbox', 'name'=>'Enabled'],
  ],

  'inputClass'=>'form-control',

  'method'=>'POST'

];

 ?>
