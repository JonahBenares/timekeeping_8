<?php include("header.php");?>
<script src="scripts/jquery.min.js"></script>
        <!-- /navbar -->
        <div class="wrapper">
            <div id="loader" style = "display:none">
                <figure class="one">Please Wait</figure>
                <figure class="two">loading</figure>
            </div>
            <div id="contents">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="content">                          
                                <div class="module">
                                    <div class="module-head">
                                        <h2>
                                            UPLOAD FILE                                                                  
                                        </h2>                                    
                                    </div>
                                    <div class="module-body" >
                                        <form method="POST" action = "import.php" enctype="multipart/form-data">
                                            <span>Drag file to the box for upload or click to select files</span>  
                                            <input type="file" name="csv" id="csv" class="dropzone">
                                            <button type="submit" name = "csv" id = "submitButton" class="btn btn-success btn-w" >Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {    
                $("#submitButton").click(function (e) {  
                    if (($("#csv").val() == "")) { 
                        alert("File field must not be empty!");  
                    }
                    else {  
                        $('#contents').hide();
                        document.getElementById("loader").style.display = "block";
                        $.ajax({  
                            type: "POST",   
                            dataType: "json",  
                            success: function (msg) {  
                                setTimeout(function () {
                                    $('#loader').html(msg);
                                }, 2000);  
                            },  
                        }); 
                    }   
                });  
            });
        </script>
        <?php include('footer.php')?>
