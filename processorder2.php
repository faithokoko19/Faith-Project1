<?php
  require_once("file_exceptions.php");

  // create short variable names
  $throwpillowqty = (int) $_POST['throwpillowqty'];                                           
  $mirrorqty = (int) $_POST['mirrorqty'];                                             
  $blanketqty = (int) $_POST['blanketqty'];                                         
  $address = preg_replace('/\t|\R/',' ',$_POST['address']);                     
  $document_root = $_SERVER['DOCUMENT_ROOT'];                                   
  $date = date('H:i, jS F Y'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Cozy Home Interiors - Order Results</title>
  </head>
  <body>
    <h1>Cozy Home Interiors</h1>
    <h2>Order Results</h2> 
    <?php
      echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";
      echo "<p>Your order is as follows: </p>";

      $totalqty = 0;
      $totalamount = 0.00;

      define('THROWPILLOWPRICE', 18);
      define('MIRRORPRICE', 50);
      define('BLANKETPRICE', 30);

      $totalqty = $throwpillowqty + $mirrorqty + $blanketqty;
      echo "<p>Items ordered: ".$totalqty."<br />";

      if ($totalqty == 0) {
        echo "You did not order anything on the previous page!<br />";
      } else {
        if ($throwpillowqty > 0) {
          echo htmlspecialchars($throwpillowqty).' pillows<br />';
        }
        if ($mirrorqty > 0) {
          echo htmlspecialchars($mirrorqty).' mirrors<br />';
        }
        if ($blanketqty > 0) {
          echo htmlspecialchars($blanketqty).' blankets<br />';
        }
      }


      $totalamount = $throwpillowqty * THROWPILLOWPRICE
                   + $mirrorqty * MIRRORPRICE
                   + $blanketqty * BLANKETPRICE;

      echo "Subtotal: $".number_format($totalamount,2)."<br />";

      $taxrate = 0.10;  // local sales tax is 10%
      $totalamount = $totalamount * (1 + $taxrate);
      echo "Total including tax: $".number_format($totalamount,2)."</p>";

      echo "<p>Address to ship to is ".htmlspecialchars($address)."</p>";

      $outputstring = $date."\t".$throwpillowqty." tires \t".$mirrorqty." oil\t"
                      .$blanketqty." spark plugs\t\$".$totalamount
                      ."\t". $address."\n";

      // open file for appending
      try
      {
        if (!($fp = @fopen("$document_root/../orders/orders.txt", 'ab'))) {
            throw new fileOpenException();
        }
      
        if (!flock($fp, LOCK_EX)) {
           throw new fileLockException();
        }
      
        if (!fwrite($fp, $outputstring, strlen($outputstring))) {
           throw new fileWriteException();
        }

        flock($fp, LOCK_UN);
        fclose($fp);
        echo "<p>Order written.</p>";
      }
      catch (fileOpenException $foe)
      {
         echo "<p><strong>Orders file could not be opened.<br/>
               Please contact our webmaster for help.</strong></p>";
      }
      catch (Exception $e)
      {
         echo "<p><strong>Your order could not be processed at this time.<br/>
               Please try again later.</strong></p>";
      }
    ?>
  </body>
</html>