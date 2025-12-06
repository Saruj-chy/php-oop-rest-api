<?php
class ProductOrder
{
    public $ID;
    public $NAME;
    public $AMOUNT;
    public $STATUS;
    public $CREATED_BY;
    public $CREATED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_DATE;
    private $conn;

    public function __construct($conn, $postData)
    {
        $postData            = array_change_key_case($postData, CASE_UPPER);
        $this->conn          = $conn;
        $this->ID          = $postData['ID'] ?? null;
        $this->NAME          = $postData['NAME'] ?? null;
        $this->AMOUNT        = $postData['AMOUNT'] ?? null;
        $this->STATUS        = $postData['STATUS'] ?? 0;
        $this->PRICE         = $postData['PRICE'] ?? null;
        $this->CREATED_BY    = $postData['CREATED_BY'] ?? null;
        $this->CREATED_DATE  = $postData['CREATED_DATE'] ?? null;
        $this->MODIFIED_BY   = $postData['MODIFIED_BY'] ?? null;
        $this->MODIFIED_DATE = $postData['MODIFIED_DATE'] ?? null;
    }

    public function InsertProductOrder()
    {
        $insert;
        $sql = "INSERT INTO CRM.PRODUCT_ORDER P (P.ID, P.NAME, P.AMOUNT, P.STATUS, P.CREATED_BY, P.CREATED_DATE)
        VALUES(CRM.PRODUCT_ORDER_SEQ.NEXTVAL, :NAME_STR, :AMOUNT, :STATUS_STR, :CREATED_BY, SYSDATE)";
        $stid = oci_parse($this->conn, $sql) or die("Connection Failed");
        oci_bind_by_name($stid, ":NAME_STR", $this->NAME);
        oci_bind_by_name($stid, ":AMOUNT", $this->AMOUNT);
        oci_bind_by_name($stid, ":STATUS_STR", $this->STATUS);
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

    public function LoadAllProductOrder()
    {
        $sql  = "SELECT * FROM CRM.PRODUCT_ORDER ";
        $stid = oci_parse($this->conn, $sql) or die("Connection Failed");
        oci_execute($stid);
        return $stid;
    }

    public function LoadProductOrder()
    {
        $sql  = "SELECT * FROM CRM.PRODUCT_ORDER WHERE ID = :ID ";
        $stid = oci_parse($this->conn, $sql) or die("Connection Failed");
        oci_bind_by_name($stid, ":ID", $this->ID);
        oci_execute($stid);
        return $stid;
    }

    function UpdateProductOrder()
{
    $update;
    $sql  = "UPDATE CRM.PRODUCT_ORDER P SET P.NAME = :NAME_STR, P.STATUS = :STATUS_STR, P.AMOUNT = :AMOUNT, P.MODIFIED_BY = :MODIFIED_BY, P.MODIFIED_DATE = SYSDATE WHERE P.ID = :ID ";

    $stmt = oci_parse($this->conn, $sql);
    oci_bind_by_name($stmt, ":ID", $this->ID);
    oci_bind_by_name($stmt, ":NAME_STR", $this->NAME);
    oci_bind_by_name($stmt, ":STATUS_STR", $this->STATUS);
    oci_bind_by_name($stmt, ":AMOUNT", $this->AMOUNT);
    oci_bind_by_name($stmt, ":MODIFIED_BY", $this->MODIFIED_BY);

    if (! oci_execute($stmt)) {
        $e      = oci_error($stmt);
        $update = false;
    } else {
        $update = true;
    }
    oci_commit($this->conn);
    oci_free_statement($stmt);
    return $update;
}
}
