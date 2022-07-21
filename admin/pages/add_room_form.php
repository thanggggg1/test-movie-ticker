<div class="form-group">
    <input type="text" name="name" id="name" placeholder="Room Name" class="form-control" />
</div>
<div class="form-group">
    <select name="tid" id="tid" class="form-control">
        <option value>Select Room Type</option>
        <?php
        include('../../config.php');
        $rm = mysqli_query($con, "select * from tbl_roomtypes");
        while ($room = mysqli_fetch_array($rm)) {
        ?>
            <option value="<?php echo $room['type_id']; ?>"><?php echo $room['type_name']; ?></option>
        <?php
        }
        ?>
    </select>
</div>
<div class="form-group">
    <button type="button" class="btn btn-success" id="savescreen">Save</button>
</div>