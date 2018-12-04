 <?php
      require 'ClotheLinedatabase.php';
      $sql = "SELECT item_name, item_price, item_topbid, item_id, item_tag FROM item";
      $result=mysqli_query($mysqli,$sql);

      $data= array();
      while($enr = mysqli_fetch_assoc($result)){
        $a = array($enr['item_name'], $enr['item_price'], $enr['item_topbid'], $enr['item_id'], $enr['item_tag']);
        array_push($data, $a);
      }

      echo json_encode($data); 
?>