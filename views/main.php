<?php include($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/views/partials/header.php');
$config = require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/config.php'); ?>

<body>





    <div class="container py-5">

        <div class="card border-success ">
            <div class=" card-header bg-success text-white ">Check-in App</div>

            <div class=" card-body">
                <form>

                    <input type="text" id="search_box" placeholder="Search guest" name="search_box" class="form-control ">

                </form>
                <div class="py-2 table-responsive" id="guestTable">




                    
                </div>
            </div>
        </div>




        <script>
            $(document).ready(function() {
                load_data(1);
                $(document).on('click', '.pagination_link', function() {
                    var page = $(this).attr("id");
                    load_data(page);
                });
                $(document).on('click', '.check', function() {
                    var id = $(this).attr("id");
                    check_guest(id);

                });



                function check_guest(id) {
                    $.ajax({
                        url: "ajax_check.php",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data == "success") {
                                document.getElementById(id).closest('tr').remove();
                                load_data(1);
                            }

                        }
                    });
                }

                function load_data(page, query = '') {
                    $.ajax({
                        url: "fetch.php",
                        method: "POST",
                        data: {
                            page: page,
                            query: query
                        },
                        success: function(data) {
                            $('#guestTable').html(data);
                        }
                    });
                }

                $('#search_box').keyup(function() {
                    var page = "";
                    $(document).on('click', '.pagination_link', function() {
                        var page = $(this).attr("id");
                        var query = $('#search_box').val();
                        load_data(page, query);
                    });

                    var query = $('#search_box').val();
                    load_data(page, query);
                });




            });
        </script>






        <?php include($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/views/partials/footer.php'); ?>