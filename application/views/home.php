<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a href="<?=base_url('trip/home')?>" class="navbar-brand">
                Trip
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add Trip
                </button>
        </div>
    </nav>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="table_data">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Plat No</th>
                            <th>Date</th>
                            <th width="5%">Point Start</th>
                            <th width="5%">Point End</th>
                            <th>Distance (KM)</th>
                            <th>Standard Time (Menit)</th>
                            <th>Price Per KM</th>
                            <th width="10%">Actual Time (Menit)</th>
                            <th>Total Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($data as $d) {
                        ?>
                        <tr>
                            <td><?php echo $d['nama_driver']; ?></td>
                            <td><?php echo $d['no_plat']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($d['date_trip'])); ?></td>
                            <td><?php echo $d['point_start']; ?></td>
                            <td><?php echo $d['point_end']; ?></td>
                            <td style="text-align:right"><?php echo $d['distance']; ?></td>
                            <td style="text-align:right"><?php echo $d['standard_time']; ?></td>
                            <td style="text-align:right"><?php echo $d['price_per_km']; ?></td>
                            <td style="text-align:right"><?php echo $d['actual_time']; ?></td>
                            <td style="text-align:right"><?php echo $d['total_cost']; ?></td>
                            <td>
                                <a href="#" id="edit" class="btn btn-warning" data-id="<?=$d['id_trip']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="<?=base_url('home/deleteTrip/'.$d['id_trip'])?>" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
    </div>

    <!-- Modal Add Data -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Trip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=base_url('home/addTrip')?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="driver">Nama Driver</label>
                            <select class="form-select" aria-label="Default select example" id="driver" name="driver">
                                <option value="" selected disabled>-- Pilih --</option> 
                                <?php
                                    foreach ($driver as $dr) {
                                ?>
                                    <option value="<?php echo $dr['id_driver']; ?>"><?php echo $dr['nama_driver']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="date_trip">Tanggal Trip</label>
                            <input type="date" class="form-control" id="date_trip" name="date_trip">
                        </div>
                        <div class="form-group mb-2">
                            <label for="point_start">Point Start</label>
                            <select class="form-select" aria-label="Default select example" id="point_start" name="point_start" onchange="getPointEnd()">
                                <option value="" selected disabled>-- Pilih --</option> 
                                <?php
                                    foreach ($point_start as $ps) {
                                ?>
                                    <option value="<?php echo $ps['point_start']; ?>"><?php echo $ps['point_start']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="point_end">Point End</label>
                            <div id="point_end_section">
                                <select class="form-select" aria-label="Default select example" id="point_end" name="point_end" onchange="getDataCost()">
                                    <option value="" selected disabled>-- Pilih --</option> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="distance">Distance</label>
                            <input type="number" class="form-control" id="distance" name="distance" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label for="standard_time">Standard Time</label>
                            <input type="number" class="form-control" id="standard_time" name="standard_time" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price_per_km">Price Per KM</label>
                            <input type="number" class="form-control" id="price_per_km" name="price_per_km" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actual_time">Actual Time</label>
                            <input type="number" class="form-control" id="actual_time" name="actual_time">
                        </div>
                        <div class="form-group mb-2">
                            <label for="total_cost">Total Cost</label>
                            <input type="number" class="form-control" id="total_cost" name="total_cost" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="id_cost" id="id_cost">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Of Add Modal -->

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Trip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=base_url('home/addTrip')?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="driver_edit">Nama Driver</label>
                            <select class="form-select" aria-label="Default select example" id="driver_edit" name="driver_edit">
                                <option value="" selected disabled>-- Pilih --</option> 
                                <?php
                                    foreach ($driver as $dr) {
                                ?>
                                    <option value="<?php echo $dr['id_driver']; ?>"><?php echo $dr['nama_driver']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="date_trip_edit">Tanggal Trip</label>
                            <input type="date" class="form-control" id="date_trip_edit" name="date_trip_edit">
                        </div>
                        <div class="form-group mb-2">
                            <label for="point_start_edit">Point Start</label>
                            <select class="form-select" aria-label="Default select example" id="point_start_edit" name="point_start_edit" onchange="getPointEndEdit()">
                                <option value="" selected disabled>-- Pilih --</option> 
                                <?php
                                    foreach ($point_start as $ps) {
                                ?>
                                    <option value="<?php echo $ps['point_start']; ?>"><?php echo $ps['point_start']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="point_end_edit">Point End</label>
                            <div id="point_end_section_edit">
                                <select class="form-select" aria-label="Default select example" id="point_end_edit" name="point_end_edit" onchange="getDataCostEdit()">
                                    <option value="" selected disabled>-- Pilih --</option> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="distance_edit">Distance</label>
                            <input type="number" class="form-control" id="distance_edit" name="distance_edit" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label for="standard_time_edit">Standard Time</label>
                            <input type="number" class="form-control" id="standard_time_edit" name="standard_time_edit" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price_per_km_edit">Price Per KM</label>
                            <input type="number" class="form-control" id="price_per_km_edit" name="price_per_km_edit" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label for="actual_time_edit">Actual Time</label>
                            <input type="number" class="form-control" id="actual_time_edit" name="actual_time_edit">
                        </div>
                        <div class="form-group mb-2">
                            <label for="total_cost_edit">Total Cost</label>
                            <input type="number" class="form-control" id="total_cost_edit" name="total_cost_edit" readonly>
                        </div>
                    </div>
                    <input type="text" name="id_trip_edit" id="id_trip_edit">
                    <input type="text" name="id_cost_edit" id="id_cost_edit">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Of Edit Modal -->

    <script>
        $(document).ready(function() {
            $('#table_data').DataTable( {
                "order": []
            } );
        });

        $(document).on('click', '#edit', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?=base_url('home/getTripById/')?>'+id,
                dataType: 'json',
                success: function(data) {
                    var point_end_edit = data[0].point_end;
                    $('#id_trip_edit').val(id);
                    $('#driver_edit').val(data[0].id_driver);
                    $('#date_trip_edit').val(data[0].date_trip);
                    $('#point_start_edit').val(data[0].point_start);
                    $.ajax({
                        url: '<?=base_url('home/getPointEndEdit/')?>'+data[0].point_start,
                        success: function(data) {
                            $('#point_end_section_edit').html(data);
                            $('#point_end_edit').val(point_end_edit);
                        }
                    });
                    
                    $('#distance_edit').val(data[0].distance);
                    $('#standard_time_edit').val(data[0].standard_time);
                    $('#price_per_km_edit').val(data[0].price_per_km);
                    $('#actual_time_edit').val(data[0].actual_time);
                    $('#total_cost_edit').val(data[0].total_cost);
                    $('#id_cost_edit').val(data[0].id_cost);
                    $('#editModal').modal('show');
                }
            });
        });

        function getPointEnd() {
            var point_start = $('#point_start').val();
            $.ajax({
                url: '<?=base_url('home/getPointEnd/')?>'+point_start,
                success: function(data) {
                    $('#point_end_section').html(data);
                    $('#distance').val('');
                    $('#standard_time').val('');
                    $('#price_per_km').val('');
                    $('#total_cost').val('');
                    $('#id_cost').val('');
                }
            });
        }

        function getDataCost() {
            var point_start = $('#point_start').val();
            var point_end = $('#point_end').val();
            $.ajax({
                url: '<?=base_url('home/getCost/')?>'+point_start+'/'+point_end,
                dataType: 'json',
                success: function(data) {
                    $('#distance').val(data[0].distance);
                    $('#standard_time').val(data[0].standard_time);
                    $('#price_per_km').val(data[0].price_per_km);
                    var total_cost = data[0].distance * data[0].price_per_km;
                    $('#total_cost').val(total_cost);
                    $('#id_cost').val(data[0].id_cost);
                }
            });
        }

        function getPointEndEdit() {
            var point_start = $('#point_start_edit').val();
            $.ajax({
                url: '<?=base_url('home/getPointEndEdit/')?>'+point_start,
                success: function(data) {
                    $('#point_end_section_edit').html(data);
                    $('#distance_edit').val('');
                    $('#standard_time_edit').val('');
                    $('#price_per_km_edit').val('');
                    $('#total_cost_edit').val('');
                    $('#id_cost_edit').val('');
                }
            });
        }

        function getDataCostEdit() {
            var point_start = $('#point_start_edit').val();
            var point_end = $('#point_end_edit').val();
            $.ajax({
                url: '<?=base_url('home/getCost/')?>'+point_start+'/'+point_end,
                dataType: 'json',
                success: function(data) {
                    $('#distance_edit').val(data[0].distance);
                    $('#standard_time_edit').val(data[0].standard_time);
                    $('#price_per_km_edit').val(data[0].price_per_km);
                    var total_cost = data[0].distance * data[0].price_per_km;
                    $('#total_cost_edit').val(total_cost);
                    $('#id_cost_edit').val(data[0].id_cost);
                }
            });
        }
    </script>
</body>
</html>