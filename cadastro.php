<?php
$bloco= ( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1 ;
$link=mysqli_connect("localhost","root","","metastringhini"); 
printf("<!DOCTYPE html>
<html lang='pt-br'>
<head>
<meta charset='UTF-8'>
    <title>MetaStringhini</title>
    <link rel='stylesheet' type='text/css' href='./estilogeral.css'>
</head>");
switch (TRUE){
case ( $bloco==1 ):{

  printf("<center style='margin: 10px auto;'><div class='paralelograma'><h1 style='text-align: center;'>Nova Semana</h1></div></center><center><div>");
  printf("<form action='./cadastro.php' method='get'><table> ");
  printf("<input type='hidden' name='bloco' value='2'>\n");
  printf("<tr><td style='width: 25px;' rowspan='20'></td>"); 
  printf("<tr><td style='width: 25px;' rowspan='20'></td>"); 
  printf("<td><h3 style='margin: 10px auto;'>Dados do escopo da nova semana:</h3>"); 
  printf("<tr><td><label for='escopo'>Nome do escopo:</label> </td>                     <td><input type='text' name='escopo' id='escopo' size='20'></td></tr>"); 
  printf("<tr><td><label for='semana'>Semana de homologação do escopo: </label></td>   <td><input type='week' name='semana' id='semana' ></td></tr>"); 
  printf("<tr><td><label for='ponto_semanal'>Pontos para meta semanal: </label></td>          <td><input type='number' name='ponto_semanal' id='ponto_semanal'></td></tr>"); 
  printf("<tr><td><label for='ponto_diario'>Pontos para meta diária: </label></td>           <td><input type='number' name='ponto_diario' id='ponto_diario'></td></tr>"); 
  printf("<tr><td style='text-align: center;' colspan='2'> <input type='submit' value='Criar' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> ");
  printf("<a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a>");  
  printf("<input type='reset' value='Limpar' class='button01' style='font-size: 16px; height: 30px; width: 100px;'></td>");       
  printf("</tr></td></tr></table>"); 
  printf("</form></div><img src='logoGenerica.png' alt='logo' style='width: 300px; height: 250px;'></center></html> ");

    break;
  }
  case ( $bloco==2 ):
  { 
    $v_no_escopo = isset($_GET["escopo"])?$_GET["escopo"]:null;
    $v_meta_diaria = isset($_GET["ponto_diario"])?$_GET["ponto_diario"]:null;
    $v_meta_semanal = isset($_GET["ponto_semanal"])?$_GET["ponto_semanal"]:null;
    $v_id_semana = isset($_GET["semana"])?$_GET["semana"]:null;
    
    
    if (($v_no_escopo == null)||($v_meta_diaria== null)||($v_meta_semanal== null)||($v_id_semana== null)){
      printf("<center style='margin: 10px auto;'><div class='paralelograma'><h1 style='text-align: center;'>Nova Semana</h1></div></center><center><div>");
    printf("<center><br><br><br><table><tr>");
    printf("<td><h1>Erro ao criar Nova Semana!</h1></td></tr>");
    printf("<td>Verifique se todos os campos foram preenchidos</td></tr>");
    printf("<tr><td style='text-align: center;'><button onclick='history.go(-1)' class='button01' style='font-size: 16px; height: 30px; width: 100px;'>&lArr;</button> ");
    printf("<a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a></td></tr>");
    printf("</table></center>");
      printf("<center><img src='logoGenerica.png' alt='logo' style='width: 300px; height: 250px;'></center></html> ");

    }
    else {
      $cmdsql="INSERT INTO m_semana (idsemana, meta_semana, meta_diaria, no_escopo, pon_feitos) VALUES ('$v_id_semana', $v_meta_semanal, $v_meta_diaria, '$v_no_escopo', 0)";
      $execcmd=mysqli_query($link,$cmdsql);
      printf("<center style='margin: 10px auto;'><div class='paralelograma'><h1 style='text-align: center;'>Nova Semana</h1></div></center><center><div>");
      printf("<center><br><br><br><table><tr>");
      printf("<td><h1>Nova Semana criada com sucesso!</h1></td></tr>");
      printf("<tr><td style='text-align: center;'><button onclick='history.go(-1)' class='button01' style='font-size: 16px; height: 30px; width: 100px;'>&lArr;</button> ");
      printf("<a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a>");
      printf("<a href='homologarpontos.php' style='text-decoration:none; color: inherit;'><input type='button' value='&rArr;' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a></td></tr>");
      printf("</table></center>");
        printf("<center><img src='logoGenerica.png' alt='logo' style='width: 300px; height: 250px;'></center></html> ");
    }

    // TESTADOR ----------------------------------------------------------
    /*$cmdsql='SELECT * FROM m_semana;';
    printf("$reg[idsemana] , $reg[meta_semana] , $reg[meta_diaria] , $reg[no_escopo]");
    $execcmd=mysqli_query($link,$cmdsql);
    printf("Escolha: <select name='idmedico'>\n");
    while ( $rec=mysqli_fetch_array($execcmd) )
    { 
      printf("<option value='$rec[idsemana]'>$rec[no_escopo] ($rec[idsemana])</ioption>");
    }
    printf("</select><br>");*/

    /*$tentativa=TRUE;
    while ( $tentativa )
    {
      mysqli_query($link,"START TRANSACTION");
      mysqli_query($link,$cmdsql);
      if ( mysqli_errno($link)==0 )
      { 
        mysqli_query($link,"COMMIT");
        $mostra=TRUE;
        $tentativa=FALSE;
      }
      else
      {
        $mostra=FALSE; 
        if ( mysqli_errno($link)==1213 ) # Este é o numero do erro DEADLOCK
        { 
          mysqli_query($link,"ROLLBACK");
          $tentativa=TRUE;
        }
        else
        { 
          $mens=mysqli_errno($link)." - ".mysqli_error($link);
          mysqli_query($link,"ROLLBACK");
          $tentativa=FALSE;
        }
      }
    }
    if ( $mostra )
    { 
      printf("<center style='margin: 10px auto;'><div class='paralelograma'><h1 style='text-align: center;'>Nova Semana</h1></div></center><center><div>");
      printf("<center><br><br><br><table><tr>");
      printf("<td><h1>Nova Semana criada com sucesso!</h1></td></tr>");
      printf("<tr><td style='text-align: center;'><a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a>");
      printf("<a href='homologarpontos.php' style='text-decoration:none; color: inherit;'><input type='button' value='&rArr;' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a></td></tr>");
      printf("</table></center>");
        printf("<center><img src='logoGenerica.png' alt='logo' style='width: 300px; height: 250px;'></center></html> ");
    }
    else
    {
    printf("<center style='margin: 10px auto;'><div class='paralelograma'><h1 style='text-align: center;'>Nova Semana</h1></div></center><center><div>");
    printf("<center><br><br><br><table><tr>");
    printf("<td><h1>Erro ao criar Nova Semana!</h1></td></tr>");
    printf("<td>erro: $mens</td></tr>");
    printf("<tr><td style='text-align: center;'><a href='menuprincipal.html' style='text-decoration:none; color: inherit;'><input type='button' value='Menu' class='button01' style='font-size: 16px; height: 30px; width: 100px;'> </a>");
    printf("<button onclick='history.go(-1)' class='button01' style='font-size: 16px; height: 30px; width: 100px;'>&lArr;</icog></button></td></tr>");
    printf("</table></center>");
      printf("<center><img src='logoGenerica.png' alt='logo' style='width: 300px; height: 250px;'></center></html> ");
    }   
*/
    break;
  }

}
printf("</body>\n</html>\n");
?>