<?php include('header.php'); ?>
<link rel="stylesheet" href="validation/dist/css/bootstrapValidator.css" />

<script type="text/javascript" src="validation/dist/js/bootstrapValidator.js"></script>
<!-- =============================================== -->
<?php
include('form.php');
$frm = new formBuilder;
?>
</div>
<div class="content">
    <div class="wrap">
        <div class="content-top" style="min-height:300px;padding:50px">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Change Your Information</div>
                    <div class="panel-body">
                        <?php
                        $usr = mysqli_query($con, "SELECT * FROM tbl_users WHERE `user_id` = '" . $_SESSION['user'] . "'");
                        $user = mysqli_fetch_array($usr);
                        ?>
                        <form action="process_changeinfo.php" method="post" id="form1">
                            <div class="form-group has-feedback">
                                <input name="name" type="text" size="25" placeholder="Name" class="form-control" value="<?php echo $user['name']; ?>" />
                                <?php $frm->validate("name", array("required", "label" => "Name", "regexp" => "name")); // Validating form using form builder written in form.php 
                                ?>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="age" type="text" size="25" placeholder="Age" class="form-control" value="<?php echo $user['age']; ?>" />
                                <?php $frm->validate("age", array("required", "label" => "Age", "regexp" => "age")); // Validating form using form builder written in form.php 
                                ?>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <select name="gender" class="form-control">
                                    <option value>Select Gender</option>
                                    <option <?php if (strtoupper($user['gender']) == 'MALE') echo "selected" ?>>Male</option>
                                    <option <?php if (strtoupper($user['gender']) == 'FEMALE') echo "selected" ?>>Female</option>
                                </select>
                                <?php $frm->validate("gender", array("required", "label" => "Gender")); // Validating form using form builder written in form.php 
                                ?>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="phone" type="text" size="25" placeholder="Mobile Number" class="form-control" value="<?php echo $user['phone']; ?>" />
                                <?php $frm->validate("phone", array("required", "label" => "Mobile Number", "regexp" => "mobile")); // Validating form using form builder written in form.php 
                                ?>
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="email" type="text" size="25" placeholder="Email" class="form-control" value="<?php echo $user['email']; ?>" />
                                <?php $frm->validate("email", array("required", "label" => "Email", "email")); // Validating form using form builder written in form.php 
                                ?>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="clear"></div>

    </div>
    <?php include('footer.php'); ?>
</div>
<script>
    <?php $frm->applyvalidations("form1"); ?>
</script>