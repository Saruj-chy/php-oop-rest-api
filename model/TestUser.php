<?php
class TestUser {
    public $NAME;
    public $EMAIL;
    public $PHONE_NUMBER;
    public $PASSWORD;
    public $RECEIVE_DATE;
    public $CREATED_BY;
    public $CREATED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_DATE;
    

    public function __construct($data) {
        $this->NAME    = $data['NAME'] ?? null;
        $this->EMAIL  = $data['EMAIL'] ?? null;
        $this->PHONE_NUMBER = $data['PHONE_NUMBER'] ?? 0;
        $this->PASSWORD = $data['PASSWORD'] ?? null;
        $this->RECEIVE_DATE = $data['RECEIVE_DATE'] ?? null;
        $this->CREATED_BY = $data['CREATED_BY'] ?? null;
        $this->CREATED_DATE = $data['CREATED_DATE'] ?? null;
        $this->MODIFIED_BY = $data['MODIFIED_BY'] ?? null;
        $this->MODIFIED_DATE = $data['MODIFIED_DATE'] ?? null;
    }
}