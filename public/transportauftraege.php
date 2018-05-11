<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Demo WMS Transportauftraege</title>
  </head>
  <body>
    <h1>Here you can see all Transportauftäge</h1>
    <br>

    <?php
      // get all Tables
      include_once '../src/sqlqueries/sqlquery.php';
      include_once '../src/config/db.php';

      include_once 'include/finish_transportauftrag.php';

      $object = new sqlquery;
      $table = 'TRANSPORTAUFTRAG';
    ?>

  <?php
      $content = $object->allRowsofTable($table);
      if (!$content == null){
  ?>
  <form action="include/finish_transportauftrag.php" method="post">
  <table>
    <tr>
      <th></th>

  <?php
        $columnnames = $object->allColumn($table);
        foreach ($columnnames as $columnname) {
            echo '<th>'.htmlspecialchars($columnname).'</th>';
        }
  ?>
    </tr>
  <?php
        foreach ($content as $row) {
          echo '<tr>';
          if ($row['P_STATUS'] == 'FINISHED' || $row['P_STATUS'] == 'finished'){
            echo '<td></td>';
          }else{
          ?>
                  <td>
                    <button type="submit" name="P_OID" value="<?php echo htmlspecialchars($row['P_OID'])  ?>">Finish</button>
                  </td>
          <?php
          }
          foreach ($row as $column => $value) {
            echo '<td>'.htmlspecialchars($value).'</td>';
          }

        echo '</tr>';
        }
  ?>
  </table>
    </form>

  <?php
      } else {
        echo "<p> There is no Content in this Table! </p>";
      }
  ?>

  </body>
</html>
