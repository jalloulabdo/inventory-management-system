<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Client

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clients</li>
        </ol>
    </section>
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">


                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php elseif ($this->session->flashdata('error')): ?>
                        <div class="alert alert-error alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>



                    <form role="form" action="<?php base_url('Controller_Client/edit') ?>" method="post">
                        <div class="box-body">

                            <?php echo validation_errors(); ?>
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                            placeholder="First name" value="<?php echo $client_data['firstname'] ?>"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Username</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            placeholder="Last name" value="<?php echo $client_data['lastname'] ?>"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" value="<?php echo $client_data['email'] ?>"
                                            autocomplete="off">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Phone" value="<?php echo $client_data['phone'] ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Address" value="<?php echo $client_data['address'] ?>"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                            value="<?php echo $client_data['city'] ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>


                        </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?php echo base_url('Controller_Client/') ?>" class="btn btn-warning">Back</a>
                </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.row -->
</div>
<!-- /.box-body -->

</div>
<!-- /.box -->



</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("#groups").select2();

        $("#mainUserNav").addClass('active');
        $("#manageUserNav").addClass('active');
    });
</script>