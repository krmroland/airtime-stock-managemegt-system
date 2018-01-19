<?php

namespace App\Traits;

use Illuminate\Validation\Rule;

trait CommonValidationRules
{
    /**
     * the name of the table on which validation should be done
     */
    protected $table;

    /**
     * Determines if updating.
     *
     * @return     boolean  True if updating, False otherwise.
     */
    public function isUpdating()
    {
        return !!($this->method()=="PATCH" || $this->method()=="PUT");
    }
    /**
     * Determines if creating.
     *
     * @return     boolean  True if creating, False otherwise.
     */
    public function isCreating()
    {
        return !!($this->method()=="POST");
    }
    /**
     * Determines if deleting.
     *
     * @return     boolean  True if deleting, False otherwise.
     */
    public function isDeleting()
    {
        return !!($this->method()=="DELETE");
    }
    /**
     * we will prepare the rules, we will cycle through the request and
     *
     * trigger a rule if the method exists
     *
     * @param      string  $table
     *
     * @return     array the compiled rules
     */
    public function prepareRules($table)
    {
        $this->table=$table;
        // remember this trait is user in form request so this=== $request
        $rules=[];
        foreach (array_keys($this->except("_token")) as $method) {
            if (method_exists($this, $method)) {
                $rules[$method]= $this->{$method}();
            }
        }

        return $this->mergedRules($rules);
    }
    /**
     * merge the generated rules and the custom rules on the base class
     *
     * @param      array  $generatedRules
     *
     * @return    array
     */
    protected function mergedRules($generatedRules)
    {
        return array_merge($this->otherRules(), $generatedRules);
    }
    /**
     * this is the ugandan way of validating a phone Number
     *
     * @return     array
     */
    protected function phoneNumber()
    {
        return [
        "required",
        "digits:10",
        "regex:/07\d{8}/",
        $this->unique("phoneNumber")
        ];
    }

    /**
     * name validation
     *
     * @return     array
     */
    protected function name()
    {
        return ["required","min:3","max:40","string"];
    }
    /**
     * email validation, sometimes we need to add uniqueness
     *
     * and its diffrent depending on if we are creating or updating
     *
     * @return     array
     */
    protected function email()
    {
        return ["required","email",$this->unique("email")];
    }
    /**
     * gender validation
     *
     * @return     array
     */
    protected function gender()
    {
        return ["required",Rule::in(["female","male"])];
    }
    /**
     * the location rules
     *
     * @return     array
     */
    public function location()
    {
        return $this->address();
    }
    /**
     * the address rules
     *
     * @return     array
     */
    public function address()
    {
        return ["required","min:10","max:150"];
    }
    /**
     * maakes the unique rule
     *
     * @param      string $field
     *
     * @return     mixed
     */
    protected function unique($field)
    {
        if ($this->isCreating()) {
            return "unique:$this->table";
        }

        if ($this->isUpdating()) {
            return (Rule::unique($this->table)->ignore($this->fieldValue($field), $field));
        }

        return;
    }
    /**
     * fetch me the field value in times of updating
     *
     * using the route, catacy of route model binding
     *
     * @param      string  $field  The field
     *
     * @return     mixed
     */
    protected function fieldValue($field)
    {
        $model=$this->route(str_singular($this->table));

        if ($model) {
            return @$model->{$field};
        }

        return null;
    }

    public function otherRules()
    {
        return [];
    }
}
