<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Demo WMS SQLinterface</title>
  </head>
  <body>
    <h1>This is the SQL Userinterface</h1>
    <br>

<!-- Select Table to use for SQL Query -->

    <?php
      // get all Tables
      include_once '../src/sqlqueries/sqlquery.php';
      include_once '../src/config/db.php';

      include_once 'include/sqlinsert.php';
      include_once 'include/sqlupdate.php';



      $object = new sqlquery;
      $tables = $object->allTables();
    ?>

    <form action="sqlinterface.php" method="get">
      <select name="table">
        <?php
          if(!isset($_GET['table'])){
            echo "<option selected disabled>Select Table</option>";
          }
        ?>
        <?php
          foreach ($tables as $table => $tablename) {
        ?>
          <option value="<?php echo htmlspecialchars($tablename); ?>"
            <?php
              if(isset($_GET['table'])){
                if($tablename == $_GET['table']){
                  echo ' selected="selected" ';
                }
              }
            ?> > <?php echo ($tablename); ?>
          </option>
        <?php
          }
        ?>
      </select>
      <button type="submit" name="submit">Select Table</button>
    </form>
    <br>

<!-- Select Table to use for SQL Query -->

<!-- Output of Selected Table -->
<?php
  if (!isset($_GET['table'])) {
    echo '<p>Please select a table first</p>';
  } else {
    $table = $_GET['table'];
?>
  <h2>Display all Content (SELECT *) of "<?php echo htmlspecialchars($table); ?>"</h2>

  <?php
      $content = $object->allRowsofTable($table);
      if (!$content == null){
  ?>
  <div style="overflow-x:auto; height: 350px; overflow: auto;">
  <table>
    <tr>
  <?php
        $columnnames = $object->allColumn($table);
        foreach ($columnnames as $columnname) {
            echo '<th>'.htmlspecialchars($columnname).'</th>';
        }

  ?>
    </tr>
    <tr>
  <?php
        foreach ($content as $row) {
          echo '<tr>';
          foreach ($row as $column => $value) {
            echo '<td>'.htmlspecialchars($value).'</td>';
          }
          echo '</tr>';
        }
  ?>
    </tr>
  </table>
</div>

  <?php
      } else {
        echo "<p> There is no Content in this Table! </p>";
      }
  ?>
<!-- Output of Selected Table -->

<!-- Insert new data into Table -->
  <h2>INSERT Content to "<?php echo htmlspecialchars($table); ?>"</h2>
  <form action="include/sqlinsert.php" method="POST">
      <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">
  <?php
      $columnnames = $object->allColumn($table);
      foreach($columnnames as $columnname){
        if($columnname != 'P_OID' && $columnname !='P_ZEITSTEMPEL' && $columnname != 'P_ANLAGE_DATUM' && $columnname != 'P_LETZTE_AENDERUNG' ){
          echo $columnname.":";
  ?>
      <input type="text" name="<?php echo htmlspecialchars($columnname); ?>" value="">
      <br>
  <?php
        }
      }
   ?>
      <br>
      <button type="submit" name="submit">INSERT into "<?php echo htmlspecialchars($table);?>"</button>
  </form>

  <?php
      if(isset($_GET['insertreturn'])){
        echo "<p>".$_GET['insertreturn']."</p>";
      }
   ?>
<!-- Insert new data into Table -->

<!-- Update data in Table -->
  <h2>UPDATE Row of "<?php echo htmlspecialchars($table); ?>"</h2>
  <?php
      if (!$content == null){
  ?>
  <form action="include/sqlupdate.php" method="POST">
    <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">
    P_OID:
    <select name="P_OID">
      <option selected disabled>P_OID</option>
      <?php
        foreach ($content as $row) {
      ?>
        <option value="<?php echo htmlspecialchars($row['P_OID']); ?>"> <?php echo ($row['P_OID']); ?></option>
      <?php
        }
      ?>
    </select>
    <br>
  <?php
      foreach($columnnames as $columnname){
        if($columnname != 'P_OID' && $columnname !='P_ZEITSTEMPEL' && $columnname != 'P_ANLAGE_DATUM' && $columnname != 'P_LETZTE_AENDERUNG' ){
          echo $columnname.":";
  ?>
      <input type="text" name="<?php echo htmlspecialchars($columnname); ?>" value="">
      <br>
  <?php
        }
      }
   ?>
      <br>
      <button type="submit" name="submit">Update Row in "<?php echo htmlspecialchars($table);?>"</button>
  </form>
  <?php
        if(isset($_GET['updatereturn'])){
          echo "<p>".$_GET['updatereturn']."</p>";
        }
      } else {
        echo "<p> There is no Content in this Table! </p>";
      }
   ?>

  <h2>DELETE a Row of "<?php echo htmlspecialchars($table); ?>"</h2>
  <?php
      if (!$content == null){
  ?>
  <form action="include/sqldelete.php" method="POST">
    <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">
    P_OID:
    <select name="P_OID">
      <option selected disabled>P_OID</option>
      <?php
        foreach ($content as $row) {
      ?>
        <option value="<?php echo htmlspecialchars($row['P_OID']); ?>"> <?php echo ($row['P_OID']); ?></option>
      <?php
        }
      ?>
    </select><br><br>
    <button type="submit" name="submit">Delete Row in "<?php echo htmlspecialchars($table);?>"</button>
</form>
<?php
      if(isset($_GET['deletereturn'])){
        echo "<p>".$_GET['deletereturn']."</p>";
      }
    } else {
      echo "<p> There is no Content in this Table! </p>";
    }
 ?>

<?php
  }

 ?>




  </body>
</html>
