<?php 
 
class Formbuilder {
 
    /**
     * @var array the formbuilder schema we are working with
     */
    protected $schema;
 
    /**
     * @var int Cached nextFieldId
     */
    private $nextFieldId;
 
    /**
     * Set the schema to work off
     *
     * @param array $builderSchema
     * @return FormbuilderParser
     */
 
    public function setFormbuilderSchema($builderSchema)
    {
        // reset nextFieldId's value
        $this->nextFieldId = null;
 
        $this->schema = $builderSchema;
        $this->parse();
        return $this;
    }
 
    /**
     * Get the next field id
     *
     * Loops through the fields in our schema and extracts the id from the field'd id, finds the max and returns max + 1
     *
     * @returns int
     */
    public function getNextFieldId()
    {
        if(!$this->nextFieldId)
        {
            $this->nextFieldId = array_reduce($this->schema['fields'], function($carry, $field){
                if(isset($field['id']))
                {
                    $id = $field['id'];
                    $matches = [];
                    if(preg_match('/^[a-zA-Z]([0-9]+)$/', $id, $matches))
                    {
                        return max(intval($matches[1]), $carry);
                    }
                }
                return $carry;
            }, 1);
        }
        return ++$this->nextFieldId;
    }
 
    /**
     * Parse the schema with the aim of attaching field ids where they don't exist
     */
    protected function parse()
    {
        $this->schema['fields'] = array_map(function($field) {
            if(!isset($field['id']))
            {
                $field['id'] = 'f' . ($this->getNextFieldId());
            }
            return $field;
        }, $this->schema['fields']);
    }
 
    /**
     * Return the parsed schema - useful to return to formbuilder's save XHR call to have id's properly set
     * @return array
     */
    public function getParsedSchema()
    {
        return $this->schema;
    }
 
    /**
     * Runs through the options array and builds a new array with the labels
     *
     * @param $options
     * @return array
     */
    public static function enumFromOptions($options)
    {
        return array_map(function ($option) {
            return $option['label'];
        }, $options);
    }
 
    /**
     * Runs through the options array and builds a new array of options where checked is set to true
     *
     * @param $options
     * @return mixed
     */
    public static function selectedOptionsFromOptions($options)
    {
        return array_reduce($options, function($carry, $option){
            if($option['checked'])
                $carry[] = $option['label'];
            return $carry;
        }, array());
    }
 
    /**
     * Determines if the type is an integer or a general number and sets the type on the schema
     *
     * @param array $field The number field we are processing
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function numberHandler($field, $schema, $form)
    {
        $schema['type'] = isset($field['field_options']['integer_only']) && $field['field_options']['integer_only']?'integer':'number';
        //$schema['minimum'] = 18;
        return array($schema, $form);
    }
 
    /**
     * Sets the type to string for the text type
     *
     * @param array $field The text field we are processing
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function textHandler($field, $schema, $form)
    {
        $schema['type'] = 'string';
        return array($schema, $form);
    }
 
    /**
     * Sets the form type to textarea and uses the text handler to set the schema type
     *
     * @param array $field The number field we are processing
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function paragraphHandler($field, $schema, $form)
    {
        list($schema, $form) = static::textHandler($field, $schema, $form);
        $form['type'] = 'textarea';
        return array($schema, $form);
    }
 
    /**
     *
     */
    public static function dropdownHandler($field, $schema, $form)
    {
        $schema['type'] = 'string';
        $checked_options = static::selectedOptionsFromOptions($field['field_options']['options']);
        $schema['default'] = empty($checked_options)?'':$checked_options[0];
        $enum = array();
        if(isset($field['field_options']['include_blank_option']) && $field['field_options']['include_blank_option'])
            $enum = array('');
        $schema['enum'] = array_merge($enum, static::enumFromOptions($field['field_options']['options']));
        return array($schema, $form);
    }
 
    /**
     * Handles adding options and setting checked values on a checkbox group
     *
     * @param array $field The number field we are processing
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function checkboxesHandler($field, $schema, $form)
    {
        $schema['type'] = 'array';
        $schema['items'] = array(
            'type' => 'string',
            'title' => $field['title'],
            'enum' => static::enumFromOptions($field['field_options']['options'])
        );
        // check for a dn set any default values
        $schema['default'] = static::selectedOptionsFromOptions($field['field_options']['options']);
        $form['type'] = 'checkboxes';
        return array($schema, $form);
    }
 
    /**
     *
     * @param array $field The number field we are processing
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function radioHandler($field, $schema, $form)
    {
        $schema['type'] = 'string';
        $checked_options = static::selectedOptionsFromOptions($field['field_options']['options']);
        $schema['default'] = empty($checked_options)?'':$checked_options[0];
        $schema['enum'] = static::enumFromOptions($field['field_options']['options']);
        $form['type'] = 'radios';
        return array($schema, $form);
    }
 
    /**
     * @param array $field
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function dateHandler($field, $schema, $form)
    {
        $schema['type'] = 'string';
        $form['htmlClass'] = $form['htmlClass'] . ' date-picker';
        return array($schema, $form);
    }
 
    /**
     * @param array $field
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function timeHandler($field, $schema, $form)
    {
        $schema['type'] = 'string';
        $form['htmlClass'] = $form['htmlClass'] . ' time-picker';
        return array($schema, $form);
    }
 
    /**
     * @param array $field
     * @param array $schema the jsonform schema
     * @param array $form the field's form data where we can specify jsonform display options
     * @returns array
     */
    public static function fileHandler($field, $schema, $form)
    {
        $schema['type'] = 'string';
        $form['type'] = 'file';
        return array($schema, $form);
    }
 
    /**
     * Generate a JSON schema from the form-builder schema
     */
    public function toJsonFormFromSchema()
    {
        $fields = $this->schema != null?$this->schema['fields']:[];
        $class = get_class($this);
        return array_reduce($fields, function($carry, $field) use($class) {
            //if id already exists in $accumulator, raise an exception
            if(array_key_exists($field['id'], $carry['schema']))
                throw new \Exception($field['id'] . " already exists");
 
            // initialize the values we can handle
            $schema = array(
                'title' => $field['title'],
                'required' => $field['required']
            );
            $form = array(
                'key' => $field['id'],
                'htmlClass' => 'form-group'
            );
 
            // create the expected handler name
            $method_name = $field['type'] . 'Handler';
            if(method_exists($class, $method_name))
            {
                list($schema, $form) = call_user_func(array($class, $method_name), $field, $schema, $form);
            }
            else
            {
                print_r("Method " . $method_name . " doesnt exist.");
                $schema['type'] = 'string';
            }
 
            $carry['schema'][$field['id']] = $schema;
            $carry['form'][] = $form;
            return $carry;
        }, array( 'schema' => array(), 'form' => array() ));
    }
}