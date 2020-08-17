<?php include('views/partials/header.php');
$config = require('config.php'); ?>

<body>





    <div class="container py-5">

        <div class="card border-success ">
            <div class=" card-header bg-success text-white ">Check-in App</div>

            <div class=" card-body">
                <form>

                    <input type="text" id="search_box" placeholder="Search guest" name="search_box" class="form-control">
                    
                            <select style="margin-top:9px; width:60px;"  id='limit' onchange="change();"  name="limit">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        
                
                </form>

                <div class="py-2 table-responsive" id="guestTable">
                    <label>Total Records <?php echo $total_data;  ?>
                </label>
                   
                    <table class="table table-hover ">
                        <thead class="bg-secondary">
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Action</th>
                        </thead>

                        <?php if ($total_data > 0) {

                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['surname'] ?></td>
                                    <td><button onclick="check($(this).attr('id'));" class="btn btn-success" id="<?php echo $row['id'] ?>">Check</button></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="3" align="center">No Data Found</td>
                            </tr>
                        <?php } ?>

                    </table>



                    <?php $total_links = ceil($total_data / $limit);
                    for ($i = 1; $i <= $total_links; $i++) {
                    ?>
                        <span class='pagination_link px-2' style='cursor:pointer; padding:6px; border:1px solid green;' id=<?php echo $i; ?> ><?php echo $i; ?></span>
                    <?php } ?>




                </div>

            </div>

        </div>




        <script>

            function check (id){
                var search=$('#search_box').val();
                var limit=$('#limit').val();
               var id=id;
               $.ajax({
                   url:"guest",
                   method:"POST",
                   data:{
                       id:id,
                       limit:limit,
                       search:search
                   },
                   success:function(data){
                    $('#guestTable').html($(data).find('#guestTable'));
                   }
               });



            }
          
            

            $('#search_box').keyup(function() {
                var query = "?search_box=" + $('#search_box').val();
                 query=query +'&limit=' + $('#limit').val();

                $.ajax({
                    url: query,
                    method: "GET",
                    success: function(data) {

                        $('#guestTable').html($(data).find('#guestTable'));
                    }

                });

            });



           function change(){
            
                path='?limit=' + $("#limit").val();
                if($('#search_box').val()!=''){
                    path =path+ "&search_box=" + $('#search_box').val();
                        
                }
                $.ajax({
                    url:path,
                    method:"GET",
                    success: function(data) {
                        $('#guestTable').html($(data).find('#guestTable'));
                    }
                });

    }


           
           
           
            $(document).on('click', '.pagination_link', function() {
                var path="?page="+ $(this).attr("id"); 
                if($('#search_box').val()!=''){
                   
                    path=path +'&search_box=' +$('#search_box').val();    
                }
                
                    path=path +'&limit=' + $('#limit').val();    
                $.ajax({
                    url:path,
                    method:"GET",
                    success: function(data) {
                        $('#guestTable').html($(data).find('#guestTable'));
                    }
                });

            });


        </script>






        <?php include('views/partials/footer.php'); ?>