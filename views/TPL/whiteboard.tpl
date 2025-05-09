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
                <form action="{SITEADDRESS}whiteboard/WhiteBoardController/addWhiteBoard" method="POST">  
                    <input type="text" name="wb_topic">
                    <input type="submit" value="+">
                </form>     
                <br>
                {WHITEBOARDS}
            </div>

            <div id="whiteboard">
                <form action="{SITEADDRESS}whiteboard/WhiteBoardController/addMessage" method="POST"> 
                    <input type="hidden" name="whiteboard" value="{WHITEBOARDID}"> 
                    <input type="text" name="message" style="width:90%">
                    <input type="submit" value="Send">
                </form>
                <br>
                {THISWHITEBOARD}
            </div>
        </div>

        
    </body>
</html>