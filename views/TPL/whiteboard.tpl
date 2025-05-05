<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WhiteBoard</title>                
    </head>

    <style>
        body{
            background-color: #FB1;            
        }
        #container{
            display:flex;
            justify-content: flex-start;            
        }
        #whiteboard{
            flex-grow:1;
            background-color: RGBA(255,255,255,.3);            
            padding: 10px;
        }
        #whiteboards{
            width:230px; 
            padding: 10px;
        }        
    </style>
    <body>
        <div id="container">
            <div id="whiteboards" >
                <form action="{SITEADDRESS}whiteboard/UserController/addWhiteBoard" method="POST">  
                    <input type="text" name="wb_topic">
                    <input type="submit" value="+">
                </form>     
                <br>
                {WHITEBOARDS}
            </div>

            <div id="whiteboard">
                {THISWHITEBOARD}
            </div>
        </div>

        
    </body>
</html>