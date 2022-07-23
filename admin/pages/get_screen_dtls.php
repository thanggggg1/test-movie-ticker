<?php
include('../../config.php');
$sr = mysqli_query($con, "select r.room_id,r.room_name,t.* from tbl_rooms as r inner join tbl_roomtypes as t on r.type_id = t.type_id order by t.type_id ASC,r.room_name");
if (mysqli_num_rows($sr)) {
?>
  <table class="table table-bordered table-hover">
    <th class="col-md-1">Slno</th>
    <th class="col-md-2">Room Name</th>
    <th class="col-md-1">Type</th>
    <th class="text-right col-md-2"><button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Room</button></th>
    <?php
    $sl = 1;
    while ($screen = mysqli_fetch_array($sr)) {
    ?>
      <tr>
        <td><?php echo $sl; ?></td>
        <td><?php echo $screen['room_name']; ?></td>
        <td><?php echo $screen['type_name']; ?></td>
        <td>
          <center>
            <div class="tools">
              <button class="fa fa-trash-o" onclick="del(<?php echo $screen['room_id']; ?>)"></button>
            </div>
          </center>
        </td>
      </tr>
    <?php
      $sl++;
    }
    ?>
  </table>
<?php
} else {
?>
  <button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Room</button>

<?php
}
?>