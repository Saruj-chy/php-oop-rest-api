<?php
class Product
{
    public $NAME;
    public $CATEGORY;
    public $MODEL;
    public $PRICE;
    public $CREATED_BY;
    public $CREATED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_DATE;
    private $conn;

    public function __construct($data, $conn)
    {
        $this->conn          = $conn;
        $this->NAME          = $data['NAME'] ?? null;
        $this->CATEGORY      = $data['CATEGORY'] ?? null;
        $this->MODEL         = $data['MODEL'] ?? 0;
        $this->PRICE         = $data['PRICE'] ?? null;
        $this->CREATED_BY    = $data['CREATED_BY'] ?? null;
        $this->CREATED_DATE  = $data['CREATED_DATE'] ?? null;
        $this->MODIFIED_BY   = $data['MODIFIED_BY'] ?? null;
        $this->MODIFIED_DATE = $data['MODIFIED_DATE'] ?? null;
    }

    public function InsertProduct()
    {
        $insert;
        $sql  = "INSERT INTO CRM.PRODUCT T (T.ID, T.NAME, T.CATEGORY, T.MODEL, T.PRICE, T.CREATED_BY, T.CREATED_DATE) 
        VALUES(CRM.PRODUCT_SEQ.NEXTVAL, :NAME_STR, :CATEGORY, :MODEL, :PRICE, :CREATED_BY, SYSDATE)";
        $stid = oci_parse($this->conn, $sql) or die("Connection Failed");
        oci_bind_by_name($stid, ":NAME_STR", $this->NAME);
        oci_bind_by_name($stid, ":CATEGORY", $this->CATEGORY);
        oci_bind_by_name($stid, ":MODEL", $this->MODEL);
        oci_bind_by_name($stid, ":PRICE", $this->PRICE);
        oci_bind_by_name($stid, ":CREATED_BY", $this->CREATED_BY);
        if (! oci_execute($stid)) {
            $e      = oci_error($stid);
            $insert = false;
        } else {
            $insert = true;
        }
        oci_commit($this->conn);
        return $insert;
    }
}
