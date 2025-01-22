<?php

include_once "Common.php";

class Post extends Common{

    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function postChefs($body){
      $result = $this->postData("chefs_tbl", $body, $this->pdo);
      if($result['code'] == 200){
        $this->logger("testthunder5", "POST", "Created a new chef record");
        return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
      }
      $this->logger("testthunder5", "POST", $result['errmsg']);
      return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function postMenu($body){
       $result = $this->postData("menu_tbl", $body, $this->pdo);
       if($result['code'] == 200){
        $this->logger("testthunder5", "POST", "Created a new menu record");
        return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
      }
      return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }


  public function queue($body) {
    // Add the current timestamp to the body array
    $created_at = date('Y-m-d H:i:s');
    $body['created_at'] = $created_at;

    // Proceed with the postData function
    $result = $this->postData("queues", $body, $this->pdo);

    // Check the result and log accordingly
    if ($result['code'] == 200) {
        $this->logger("testthunder5", "POST", "Created a new queue record");
        return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
    }

    // Handle failure cases
    return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
}

}

?>