﻿<?php

$name = 'Black-Host';
$siteDomain = 'black-host.eu';
$url = 'https://black-host.eu/';
$cdnUrl = $url.'assets/style/';
$picUrl = $url.'assets/images/';

$emailBody = '
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
      html{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
      }
      body{
        font-family: "Nunito", sans-serif;
        padding: 0;
        margin: 0;
        width: 100%;
      }
      div.content{
        box-shadow: 0 10px 25px rgba(60, 72, 88, 0.15);
        width: 50%;
        min-width: 320px;
        border-radius: 6px;
        margin: auto;
        background-color: white;
      }
      a{
        text-decoration: none;
      }
      table.brand{
        margin: auto;
        width: 100%;
        background-color: #f8f9fc;
        text-align: center;
      }
      table.brand tr td img{
        height: 160px;
      }
      @media (max-device-width: 768px) {
        table.brand tr td img{
          height: 128px;
        }
      }
      table.content{
        text-align: left;
        padding: 8px 32px;
      }
      table.content h1{
        font-size: 24px;
        color: #161c2d;
      }
      table.content p{
        color: #8492a6;
        font-size: 18px;
      }
      .button{
        background-color: #6254FE;
        border-radius: 6px;
        color: white;
        padding: 8px 20px;
        box-shadow: 0 3px 5px 0 rgb(212, 47, 47, 1);
        font-weight: bolder;
        font-size: 18px;
      }
      .button:hover{
        background-color: #6254FE;
      }
      table.footer{
        background-color: #f8f9fc;
        width: 100%;
        padding: 16px;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
      }
      table.footer tr{
        margin: auto;
        text-align: center;
      }
      table.footer a{
        color: #8492a6;
        font-size: 18px;
      }
    </style>

  </head>
  <body>

    <div class="content">
      <table class="brand">
        <tr>
          <td>
            <img src="https://cdn.black-host.eu/logo/logo-text-primary.png" draggable="false" width="400">
          </td>
        </tr>
      </table>
'.$mailContent.'
      <table class="footer">
        <tr>
          <td>
            <a href="https://cp.black-host.eu/tickets">Support</a> <a href="https://dsc.gg/black-host">Discord</a> <a href="https://cp.black-host.eu/datenschutz">Datenschutz</a><br>
            © 2020 - 2022 Black-Host.eu
          </td>
        </tr>
      </table>

    </div>

  </body>
</html>
';