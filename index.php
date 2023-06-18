
<?php
  
$json = file_get_contents('data.json');
$json_data = array_values(json_decode($json, true))[0];

?>

<html>
    <head>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <div class="displayContainer" id="displayContainer">
            <div class="containerHead">
                <div class="containerHeading">
                    People Data
                </div>                
                <div class="containerBtn" id="containerBtn">
                    <button type="button">next person</button>
                </div>
            </div> 
            <div>           
            <div class="displayContent" id="displayContent">
                <div class="containerContent">
                    <div class="contentSlno">
                        <div>
                            1
                        </div>                
                    </div>                
                    <div class="contentDisplay">
                        <div class="contentDisplayName">
                            <div class="displayDetailsHead">
                                Name:
                            </div>   
                            <div class="displayDetailsData">
                                <?= $json_data['name'] ?>
                            </div>  
                        </div> 
                        <div class="contentDisplayLocation">
                            <div class="displayDetailsHead">
                                Location:
                            </div>   
                            <div class="displayDetailsData">
                                <?= $json_data['location'] ?>
                            </div>  
                        </div>                
                    </div>
                </div>
            </div>
            <div class="peopleCount">
                currently <spam id="peopleCounter">1</spam> people showing
            </div>   
            <div class="toastMessage">No more people!</div>
        </div>
    </body>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script>
        var count = 0;
        var slno = 1;
        $('#containerBtn').click(function(){
            count++;
            $.getJSON( "data.json", function( json ) {}) 
                .done(function( json ) {
                    if (count < json.length) {
                        var htmlCodeAppend=`<div class="containerContent">
                            <div class="contentSlno">
                                <div>`+(++slno)+`</div></div>                
                                <div class="contentDisplay">
                                    <div class="contentDisplayName">
                                        <div class="displayDetailsHead">
                                            Name:
                                        </div>   
                                        <div class="displayDetailsData">`
                                            +json[count].name+
                                        `</div>  
                                    </div> 
                                    <div class="contentDisplayLocation">
                                        <div class="displayDetailsHead">
                                            Location:
                                        </div>   
                                        <div class="displayDetailsData">`
                                            +json[count].location+
                                        `</div>  
                                    </div></div>
                                </div>`
                        $('#displayContent').append(htmlCodeAppend);
                        $("#peopleCounter").html(slno);
                    } 
                    else {
                        $('.toastMessage').addClass("show").delay(5000).queue(function(next){
                            $(this).removeClass("show");
                            next();
                        });
                    }
                })
                .fail(function( json, textStatus, error ) {
                    var err = textStatus + ", " + error;
                    console.log( "Request Failed: " + err );
                });           
        });
    </script>
</html>