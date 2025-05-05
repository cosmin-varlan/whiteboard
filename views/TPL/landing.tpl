<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WhiteBoard</title>                
        <link rel="stylesheet" href="css/style.css">
    </head>

    <style>
        html{
            min-height:100vh;/* make sure it is at least as tall as the viewport */
            position:relative;
        }
        body{
            height:100vh; /* force the BODY element to match the height of the HTML element */
            margin:0;
        }
        body{
            display:flex;
            background-color: #FB1;
            justify-content:center;
            align-items: center;
        }
    </style>


    <body>
                
        <div id="login" >
            <form action="<?php echo $_SESSION["siteAddress"]; ?>whiteboard/UserController/auth" method="POST">
                <table>
                <tr>
                    <td>E-mail</td>
                    <td><input type="email" name="email"></td>
                </tr>

                <tr>
                    <td>Parola</td>
                    <td><input type="password" name="parola"></td>
                </tr>

                <tr>
                    <td style="text-align:center" colspan="2"><input type="submit" value="Autentificare"></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2"><div onclick="showRegister();">inregistrare</div></td>
                </tr>  
                </table>              
            </form>
        </div>




        <div id="register">
            <form action="<?php echo $_SESSION["siteAddress"]; ?>whiteboard/UserController/register" method="POST">
                <table>
                <tr>
                    <td>Nume</td>
                    <td><input type="text" name="nume"></td>
                </tr>

                <tr>
                    <td>E-mail</td>
                    <td><input type="email" name="email"></td>
                </tr>

                <tr>
                    <td>Parola</td>
                    <td><input type="password" name="parola"></td>
                </tr>

                <tr>
                    <td>Parola(repeta):</td>
                    <td><input type="password" name="parola2"></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2"><input type="submit" value="Inregistreaza"></td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2"><div onclick="showAuth();">autentificare</div></td>
                </tr> 
                </table>                 
            </form>
        </div>

        <script>
            function showAuth(){
                document.getElementById("register").style.display="none";
                document.getElementById("login").style.display="block";
            }
            function showRegister(){
                document.getElementById("login").style.display="none";
                document.getElementById("register").style.display="block";            
            }  
            document.getElementById("register").style.display="none";    
        </script> 
    </body>
</html>