# Formable
An HTML form generator Trait for Laravel models.

## Installation
Add Service provider to config/app.php

```PHP
'providers' => [
  // ...
  jbcappell\Formable\FormableServiceProvider::class
]
```

## Quick Start

1. Add the trait to your model:

```PHP
use jbcappell\Formable;

class User extends Model
{

	use Formable\Formable;

  //...

}
```

2. Set Up the public `$editable` attribute in your model

```PHP

use jbcappell\Formable;

class User extends Model
{

	use Formable\Formable;

  public $editable = [

    'name' => ['type'=>'text', 'name'=>'First Name'],
    'email' => ['type'=>'email', 'name'=>'Email'],
    'password' => ['type'=>'password', 'name'=>'Password'],
    'role' => ['type'=>'select', 'name'=>'User Role', 'options'=>[0=>'Select', 1=>'Admin', 2=>'User']]

  ];

  //...

}
```

3. Render the form with your model.
```PHP

$user = new User;

$form = $user->renderForm();

```
