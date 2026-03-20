<?php 

namespace app\classes;

use app\interfaces\ValidateInterface;

class Validate
{

    public array $data = [];
    public array $errors = [];
    public bool $error = false;

    public function handle(Array $validations)
    {
        
        foreach($validations as $field => $validation){

           $this->validationInstance($field, $validation);

        }
        
        $this->error = in_array(true, $this->errors);

    }
    
    private function validationInstance(string $field, array $validations)
    {
        $namespace = "app\\classes\\";

        foreach($validations as $classValidate)
        {

            $class = $namespace.$classValidate;

            [$class, $param] = $this->classWithColon($class);

            if(class_exists($class)){
                [$this->errors[$classValidate], $this->data[$field]] = $this->executeClass(new $class, $field, $param);
            }

        }

    }

    private function classWithColon($class)
    {

        $param = null;

        if(str_contains($class, ":")){
            [$class, $param] = explode(":", $class);
        }

        return [$class, $param];

    }

    private function executeClass(ValidateInterface $validateInterface, $field, $param)
    {

       return $validateInterface->handle($field, $param);

    }

}
?>