<?php
/** TO DO
 *
 * 1. Add support for CSS classes to all rendered elements.
 * 2. --Create config.php file and setter/getter config helper files.--
 * 3. Finalize passable attributes to @param array $param (field ID, required, placeholder, ...)
 * 4. Set up @var array $fieldAttributes as a set of acceptable field attributes.
 * 5. Incorporate common UX/UI JS options?Fo
 * 6. Submit options
 * 7. Views for HTML
**/

namespace jbcappell\Formable;



trait Formable
{

  /**
   Attributes
  **/

  /**
   * Multidimensional array containing acceptable input types and their parameters. @var array
   */
  protected $availableInputs = [];

  /** Form method. @var string **/
  protected $method = '';

  /** Form action @var string **/
  protected $action = '';

  /** array of rendered input, manipulated in renderForm(). @var array **/
  protected $inputs = [];

  /** CSS class for input elements @var string **/
  protected $inputClass = '';

  /** Assumed Configurations for field names from config.php @var array **/
  protected $assumptions = [];


  /**
    Validators
  **/

  /** Validates @param array $fields against @var array $editable. Throws Exception **/
  public function canEditFields(array $fields){

    foreach(array_keys($fields) as $field){
      if(in_array($field, array_keys($this->editable))===false)
        throw new \Exception("$field is not editable.", 1);
    }

    return true;

  }

  /** validates @param string $input against @var array $availableInputs. Throws Exception **/
  public function inputAvailable(string $input){

    if(empty($this->availableInputs))
      $this->initForm();

    if(in_array($input, array_keys($this->availableInputs))===false)
      throw new \Exception("$input is not available.", 1);

      return $this->availableInputs[$input];
  }

  /**
    Renderers
  **/

  /** builds html element for @param string $field with @param string $params **/
  public function buildInput(string $field, array $params){

    $toView  = [];

    $type = (array_key_exists('type', $params) ? $params['type'] : null);
    $defaultValue =  (array_key_exists('defaultValue', $params) ? $params['defaultValue'] : null);
    $label = (array_key_exists('label', $params) ? $params['label'] : ucwords($field));

    $toView = [
        'type'=>$type,
        'field'=>$field,
        'defaultValue'=>$defaultValue,
        'label'=>$label,
        'inputClass'=>$this->inputClass
    ];

    $input = $this->inputAvailable($type);


    if($input['scaffold'] == 'select'){

        if(array_key_exists('options', $params)){

            $toView['options'] = $params['options'];

            $return = view('Formable::select', $toView)->render();

        }
        else
          throw new \Exception("select scaffold expects array \$options.", 1);

    }
    else{
      $return = view('Formable::'.$input['scaffold'], $toView)->render();
    }

    return view('Formable::frame', ['label'=>$label, 'input'=>$return])->render();

  }

  /** builds html from with @var array $editable or, if passed, @param array $fields **/
  public function renderForm(array $fields = null){

    $fields = ($fields ? $fields : $this->initEditable());

    $this->canEditFields($fields);

    foreach($fields as $field=>$params){

      $this->inputs[] = $this->buildInput($field, $params);

    }

    return "<form>".implode("", $this->inputs)."</form>";

  }

  /**
    Setters
  **/

  public function initForm(){
    $config = include('config.php');

    foreach($config as $attr=>$conf){
      if(isset($this->{$attr})) {
        $this->{"set".ucwords($attr)}($conf);
      }

    }

    return $this;

  }

  public function pushConfig(array $config){

    foreach($config as $attr=>$conf){
      if(isset($this->{$attr})) {
        $this->{"set".ucwords($attr)}($conf);
      }

    }

  }

  public function initEditable(){

    foreach($this->editable as $k=>$v){

        $this->editable[$k]['defaultValue']=$this->{$k};

    }

    return $this->editable;

  }

  public function setEditable(array $fields){
      $this->editable = $fields;

  }

  public function pushEditable(array $fields){

    $this->editable = array_merge($this->editable,$fields);

  }

  /** builds html element for @param string $field with @param string $params **/
  public function assume(array $fields){

    if(empty($this->assumptions))
      $this->initForm();

    foreach($fields as $field){

      $params = $this->assumptions[$field];

      $this->inputs[] = $this->buildInput($field, $params);

    }

  }

  public function setMethod(string $method){

    $this->method = $method;

  }

  public function setAction(string $action){

    $this->method = $action;

  }

  public function setInputClass(string $inputClass){
    $this->inputClass = $inputClass;
  }

  public function setAvailableInputs(array $inputs){

    $this->availableInputs = $inputs;

  }

  public function setAssumptions(array $inputs){

    $this->assumptions = $inputs;

  }

}
