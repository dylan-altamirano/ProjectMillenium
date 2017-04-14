<?php

  /**
   * This creates a collection class which is used as a replacement for arraylist in php
   */
  class Collection
  {
    private $items = array();

    /**
    *It adds a new item to the collection
    */
    public function add($obj, $key=null){

      if ($key == null) {
        $this->items[]=$obj;
      }else {
        if (isset($this->items[$key])) {
          throw new Exception("Key $key already in use");
        }else {
          $this->items[$key]=$obj;
        }
      }
    }

    public function delete($key){
      if (isset($this->items[$key])) {
        unset($this->items[$key]);
      }else {
        throw new Exception("Invalid key $key");
      }

    }

    public function getItem($key){
        if (isset($this->items[$key])) {
          return $this->items[$key];
        }else {
          throw new Exception("Invalid key $key");
        }
    }

    /**
    *It provides a list of keys
    */
    public function keys(){
      return array_keys($this->items);
    }

    /**
    *It provides a total of items inside of the collection
    */
    public function length(){
      return count($this->items);
    }

    /**
    *Determines whether a key exists or not
    */
    public function keyExists($key){
      return isset($this->items[$key]);
    }

  }


 ?>
