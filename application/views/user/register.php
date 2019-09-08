<div class="row">
    <div class="col-md-4 offset-md-4 form-div mt-5">
        <form class="form-signin" action="<?php echo base_url('/register'); ?>" method="post">
            <h3 class="text-center">Register</h3>

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="password">Department</label>
                <select class="form-control" name="department">
                    <option selected disabled hidden>Select Department</option>
                    <?php
                    foreach ($departments as $dep) : ?>
                    <option value="<?= $dep['department_id']; ?>"><?= $dep['department_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <select class="form-control" name="level">
                    <option selected disabled hidden>Select Position</option>
                    <option value="1">Employee</option>
                    <option value="2">Manager</option>
                    <option value="3">Director</option>
                </select>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" value="" class="form-control form-control-lg">
            </div>

            <div class="form-group">
                <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Sign Up</button>
            </div>
            <p class="text-center">Already a user? <a href="<?php echo base_url('/'); ?>">Sign In</a></p>

        </form>
    </div>
</div>