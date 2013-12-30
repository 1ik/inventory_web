<!-- Bootstrap core JavaScript -->

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
</script>
<script src="<?php echo base_url(); ?>assets/selectpicker/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dp/css/datepicker.css" />
<script src="<?php echo base_url(); ?>assets/dp/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/utils.js"></script>
</body>
</html>