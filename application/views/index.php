
<body class="login" style="overflow: hidden;">
    <div id="loading"> 

        <script type = "text/javascript"> 
            document.write("<div id='loading-container'><p id='loading-content'>" +
                           "<img id='loading-graphic' width='16' height='16' src='/CIFramework/public/templete/images/ajax-loader-eeeeee.gif' /> " +
                           "Loading...</p></div>");
        </script> 

    </div> 

    <div class="login-box">
    	<section class="portlet login-box-top">
            <header>
                <h2 class="ac">用户登录</h2>
            </header>
            <section>
                <div class="message info">怡信咨询专家库系统</div>
                    <p style="margin-bottom: 30px">
                        <input type="text" id="name" class="full" value="" name="name" required="required" placeholder="Username" />
                    </p>
                    <p style="margin-bottom: 30px">
                        <input type="password" id="password" class="full" value="" name="password" required="required" placeholder="Password" />
                    </p>
                    
                <footer class="ac">
                    <a  class="button" onclick="loginReset()">Reset Password</a>
                    <a  class="button" onclick="loginUser()">Login</a>
                </footer>
            </section>
    	</section>
	</div>
    <script>
    function loginReset(){
        document.getElementById("name").value="";
	    document.getElementById("password").value="";
    }
    </script>

    <!-- LOADING SCRIPT -->
    <script>
    $(window).load(function(){
        $("#loading").fadeOut(function(){
            $(this).remove();
            $('body').removeAttr('style');
        });
    });
    $(document).ready(function(){
        $.tools.validator.fn("#name", function(input, value) {
            return value!='Username' ? true : {     
                en: "Please complete this mandatory field"
            };
        });
        
        $.tools.validator.fn("#password", function(input, value) {
            return value!='Password' ? true : {     
                en: "Please complete this mandatory field"
            };
        });

        $("#form").validator({ 
            position: 'bottom left', 
            messageClass:'form-error',
            message: '<div><em/></div>' // em element is the arrow
        });
    });
    </script>
    <!-- LOADING SCRIPT -->

</body>
</html>