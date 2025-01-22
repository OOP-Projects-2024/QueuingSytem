<?php
include_once "Common.php";

class Get extends Common{

    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }
    
    public function getLogs($date){
        $filename = "./logs/" . $date . ".log";
        
        $file = file_get_contents("./logs/$filename");
        $logs = explode(PHP_EOL, $file);

        
        $logs = array();
        try{
            $file = new SplFileObject($filename);
            while(!$file->eof()){
                array_push($logs, $file->fgets());
            }
            $remarks = "success";
            $message = "Successfully retrieved logs.";
        }
        catch(Exception $e){
            $remarks = "failed";
            $message = $e->getMessage();
        }
        

        return $this->generateResponse(array("logs"=>$logs), $remarks, $message, 200);
    }

    //Fetching All Queue Records
    public function queue(){
        $sqlString = "SELECT * FROM queues";
    
        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute();
            
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if ($data) {
                // Return data in a structured response
                return array("code" => 200, "data" => $data);
            } else {
                // Handle case where no records are found
                return array("code" => 404, "errmsg" => "No records found");
            }
        } catch (\PDOException $e) {
            // Catch and handle any database errors
            return array("code" => 500, "errmsg" => "Error: " . $e->getMessage());
        }
    }

    //Fetching queue records through id
    public function number($id){
        $condition = "isdeleted = 0";
        if($id != null){
            $condition .= " AND id=" . $id; 
        }

        $result = $this->getDataByTable('queues', $condition, $this->pdo);

        if($result['code'] == 200){
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

     //Fetching Queue Records by status
     public function status($status){
        $condition = "status=" . $status; 

        $result = $this->getDataByTable('queues', $condition, $this->pdo);
        if($result['code'] == 200){
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }
}
?>