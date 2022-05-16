<?php
session_start();

?>

<html>
        <head>
                <meta name="google-signin-client_id" content="1042604492585-ba73ota2srgr2phah8l15aa9fv4nbtdb.apps.googleusercontent.com">
                <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
        </head>
        <body>
                <?php
                if(isset($_SESSION['USER_ID'])){
                        ?>
                        <a href="javascript:void(0)" onclick="logout()">Logout</a>
                        <?php
                }else{
                        ?>
                        <div class="g-signin2" data-onsuccess="gmailLogIn"></div>
                        <?php
                }
                ?>
                
                <script>
                
                function logout(){
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut();  
                    jQuery.ajax({
                                url:'logout.php',
                                success:function(result){
                                        window.location.href="index.php";
                                }
                        });
                    
                }
                
                function onLoad(){
                       gapi.load('auth2',function (){
                              gapi.auth2.init();
                       }); 
                }
                
                function gmailLogIn(userInfo){
                        var userProfile=userInfo.getBasicProfile();
                        
                        
                        jQuery.ajax({
                                url:'login_check.php',
                                type:'post',
                                data:'user_id='+userProfile.getId()+'&name='+userProfile.getName()+'&image='+userProfile.getImageUrl()+'&email='+userProfile.getEmail(),
                                success:function(result){
                                        window.location.href="index.php";
                                }
                        });
                }
                </script>
                
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        </body>
</html>

