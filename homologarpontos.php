<?php
$bloco= ( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;
$pon_acum_switch= ( ISSET($_REQUEST['pon_acumulado']) ) ? $_REQUEST['pon_acumulado'] : 0 ;
$link=mysqli_connect("localhost","root","","metastringhini"); 
if($pon_acum_switch==0){$pon_acum=0;}else{$pon_acum=$_REQUEST['pon_acumulado'];}


printf("<!DOCTYPE html>
<html lang='pt-br'>
<head>
   
          
          
    <meta charset='UTF-8'>
    <title>Meta Calculator</title>
    <link rel='stylesheet' type='text/css' href='./estilogeral.css'>
</head>");
switch (TRUE){
  case ( $bloco==1 ):{
    printf("<body>  
  <center style='margin: 10px auto;'>
  <div class='paralelograma'><h1 style='text-align: center;'>Homologar Pontos</h1></div><br> </center>
  <center><div>
  <form action='./homologarpontos.php' method='get'>
    <table>
        <tr> 
            <tr><td colspan='2' style='text-align: center '> ");
            $cmdsql="SELECT * From m_semana";
            $execcmd=mysqli_query($link,$cmdsql);            
            printf("<input type='hidden' name='bloco' value='2'>\n");
            printf("<h2><form action='homologarpontos.php' method='get'>");
            printf("Selecione a Semana: <select name='idsemana' class='button01' style='font-size: 18px; height: 25px; width: 130px;  color: black'>\n");
            while ( $rec=mysqli_fetch_array($execcmd) )
            { 
              printf("<option value='$rec[idsemana]' >$rec[idsemana]</option> ");
            }
            printf("</select>");
            printf(" <button type='submit' name='btenvio' value='2' class='button01'  style='font-size: 19px; height: 25px; width: 50px;'>&radic;</button>");
            printf("</form></h2>"); 
            printf("<tr><td colspan='3'><hr></td></tr>    ");
            printf("<td style='text-align: center;' colspan='2'>
            <a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a>
            <a href='cadastro.php' style='text-decoration:none; color: inherit;'><input type='button' value='Nova Semana' class='button01' style='font-size: 16px; height: 30px; width: 150px;'> </a>
            </td>
              </tr>  
            </td>
        </tr>
    </table>
</form>
  </div>
</center>  ");
break;
}
case ( $bloco==2 ):
{ 

  printf("<body>   

  <center style='margin: 10px auto;'>
  <div class='paralelograma'><h1 style='text-align: center;'>Homologar Pontos</h1></div><br> </center>
  <center><div>
  <form action='./homologarpontos.php' method='get'>
    <table>
        <tr> 
            <tr><td colspan='2' style='text-align: center '> ");
            
            
            if(isset($_GET['btn-add'])){  
                  $cmdsql="UPDATE m_semana SET pon_feitos=$_REQUEST[pontos_adiciona]+$_REQUEST[pontos_adiciona2]+pon_feitos WHERE idsemana='$_REQUEST[idsemana]'";
                  $execcmd=mysqli_query($link,$cmdsql); 
                  $pon_acum+=intval($_REQUEST['pontos_adiciona'])+intval($_REQUEST['pontos_adiciona2']);            
            }
            
            $cmdsql="SELECT * From m_semana where idsemana='$_REQUEST[idsemana]'";
            $reg=mysqli_fetch_array(mysqli_query($link,$cmdsql));
            $porc_semana=intval((intval($reg['pon_feitos']*100))/intval($reg['meta_semana']));
            $porc_diaria=intval(($pon_acum*100)/intval($reg['meta_diaria']));
            
            printf("<input type='hidden' name='pon_acumulado' value='$pon_acum'>");  
            printf("<input type='hidden' name='bloco' value='2'>\n");  
            printf("<input type='hidden' name='idsemana' value='$_REQUEST[idsemana]'>\n");     
            printf("<h2>$reg[no_escopo]</h2></td></tr>                         
            <tr><td colspan='2'><hr></td></tr>  
            <tr><td colspan='2'><h3 style='margin: 10px auto;'>Pontos Semanal:</h3></td></tr>
            <tr><td>Pontos acumulados na semana:</td>        <td>$reg[pon_feitos] / $reg[meta_semana]</td></tr>
            <tr><td colspan='2'><div class='barra'> <div style='text-align: center; width: $porc_semana")?>%<?php printf("'>$porc_semana%c</div> </div></td></tr>
                        
            <tr><td colspan='3'><hr></td></tr>               

            <tr><td colspan='2'><h3 style='margin: 10px auto;'>Pontos Diário:</h3></td></tr>
            <tr></td><td> <input type='submit' name='btn-add' value='&radic;' class='button01' style='font-size: 14px; height: 20px; width: 30px;'></td></tr>
            <tr><td>Meta diária:</td>   <td>$pon_acum / $reg[meta_diaria]</td></tr>
            <tr><td colspan='2'><div class='barra'> <div style='text-align: center; width: $porc_diaria", 37)?>%  <?php printf("'>$porc_diaria%c</div> </div></td></tr>
            
            <tr><td colspan='3'><hr></td></tr>               

            <tr><td colspan='2'><h3 style='margin: 10px auto;'>Atualizar Pontos:</h3></td></tr>
            <tr><td><label for='pontos_adiciona'>Pontos:</label></td>   
              <td><input type='number' name='pontos_adiciona' id='pontos_adiciona' style='-webkit-transform: skew(-20deg); height: 17px; width: 50px;'><input type='number' name='pontos_adiciona2' id='pontos_adiciona' style='-webkit-transform: skew(-20deg); height: 17px; width: 50px;'> 
              <input type='submit' name='btn-add' value='&radic;' class='button01' style='font-size: 16px; height: 20px; width: 30px;'> <input type='reset' value='&Chi;' class='button01' style='font-size: 14px; height: 20px; width: 30px;'> </td></tr>
            <tr>
            <tr><td colspan='3'><hr></td></tr>  
            <td style='text-align: center;' colspan='2'>
            <a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a>
            <a href='cadastro.php' style='text-decoration:none; color: inherit;'><input type='button' value='Nova Semana' class='button01' style='font-size: 16px; height: 30px; width: 150px;'> </a>
           </td>
              </tr>  
            </td>
        </tr>
    </table>
</form>
  </div>
</center>  ", 37);
  break;
}
}
printf(" </body></html>");
?>