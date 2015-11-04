<html>
<head>
<title>Login</title>

<script type="text/javascript"> function setfocus() { document.forms[0].username.focus() } </script> 

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="./style/styleLogin.css" rel="stylesheet" type="text/css" media="all" /> 
</head>



<body onload=setfocus()>

<form action="login.php" method="post"><br>

                <div id="loginLabel">
                     Login here
                </div>        
                     <input class="loginInput" type="submit" name="Submit" value="Login">                    
 
                <div id="usernameLabel">
                     Username
                </div>
                     <input class="usernameInput" name="username" type="text" id="username" >

                <div id="passwordLabel">
                     Password 
                </div>
                     <input class="passwordInput" name="password" type="password" id="password" >

           <div id="hintText">
                 Hint !!!<br>
                 User Name &nbsp;=&nbsp;&nbsp;test<br>
                 Password &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;test
           </div>

</form>

</body>
</html>
