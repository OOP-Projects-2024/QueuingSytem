<?php
class Patch{

    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    //Updating Queue Status
    public function patchStatus($body, $id){
        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE queues SET customer_name=?, status=?, created_at=?, isdeleted=? WHERE id = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute($values);

            $code = 200;
            $data = null;

            return array("data"=>$data, "code"=>$code);
        }
        catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 400;
        }

        
        return array("errmsg"=>$errmsg, "code"=>$code);

    }

    //Archive queues
    public function archiveQueues($id){
        
        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "UPDATE queues SET isdeleted=1 WHERE id = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$id]);

            $code = 200;
            $data = null;

            return array("data"=>$data, "code"=>$code);
        }
        catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 400;
        }

        
        return array("errmsg"=>$errmsg, "code"=>$code);

    }


}

?>