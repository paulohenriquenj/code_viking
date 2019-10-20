<?php

return <<< html_
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informativo</title>
    <style>
        body {
            height: 100%;
        }

        .content{
            margin-left: 20%; 
            margin-right: 20%; 
            margin-top: 2%; 
            border: 1px black solid;
            
        }
        .header{
            text-align: center;
            border-top: 1px #444 solid;
        }

        .top{
            text-align: center;
            margin-left: 10px;
        }

        .main-content{
            min-height: 400px;
            border-top: 1px #444 solid;
            text-align: justify;
            padding: 15px; 
        }

        .footer{
            border-top: 1px #444 solid;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="top">
        <img src="https://www.anoreg.org.br/site/wp-content/images/logo-anoreg-300.png" alt="Imagem logo anoreg" height="100">
        </div>
        <div class="header">
            <h1>Informativo</h1>    
        </div>

        <div class="main-content">
            $bodyContent
        </div>
        <div class="footer">
            <p>ANOREG/BR: SRTVS Quadra 701, Lote 5, Bloco A, Sala 221 - Centro Empresarial Brasília</p>
        </div>
    </div>
    <div class="remove" style="text-align: center; margin: 15px">
        <button> Enviar informativo </button>
    </div>
</body>
</html>

html_;
