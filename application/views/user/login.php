<div class="row">
    <div class="col-md-4 offset-md-4 form-div login">
        
        <?php if ($this->session->flashdata('register_info') != '') : ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('register_info'); ?>
        </div>
        <?php endif; ?>

        <form class="form-signin" action="<?php echo base_url('/'); ?>" method="post">
            <h3 class="text-center">Login</h3>

            <?php if ($this->session->flashdata('login_info') != '') : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('login_info'); ?>
            </div>
            <?php endif; ?>
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="" class="form-control form-control-lg">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control form-control-lg">
            </div>

            <div class="form-group">
                <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Login</button>
            </div>
            <p class="text-center">Register new user <a href="<?php echo base_url('/register'); ?>">Register</a></p>

        </form>
    </div>
</div>