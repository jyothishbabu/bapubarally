<?php


abstract class  RM_Filter{
    public $filters=array();
    public $request;
    public $searched=false;
    public $service;
    public $pagination;
    public $limit=9999999;
    protected $params= array();
    protected $default_param_values= array();
    protected $records = null;
    
    
    
    
    public function __constuct($request,$service,$params,$default_param_values){
        $this->request = $request;
        $this->service= $service;
        $this->add_params($params,$default_param_values);
        $this->set_filters();
       
    }
    
    abstract protected function set_pagination();
    
    abstract public function get_records();
    
    protected function set_filters() {
        foreach ($this->params as $key => $val) {
            if (isset($this->request->req[$key])) {
                $this->filters[$key] = $this->request->req[$val];
            } else {
                if (array_key_exists($key, $this->default_param_values)) {
                    $this->filters[$key] = empty($this->default_param_values[$key]) ? null : $this->default_param_values[$key];
                }
            }
        }
        
    }
    
    protected function add_params($params=array(),$default_value= array()){
        
        if(!empty($params) && is_array($params)){
            foreach($params as $key=>$val){
                $this->params[$key]= $val;
            }
        }
        
        if(!empty($default_value) && is_array($default_value)){
            foreach($default_value as $key=>$val){
                $this->default_param_values[$key]= $val;
            }
        }
    }
    
    public function render_pagination(){
       return $this->pagination->render();
    }
    
}