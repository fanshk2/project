<?php 
function SQL_SELECT($sql, $dbms, $id_array="")
{
    global $db;

    $id_array_val = "";
    
    if($dbms=="mysql")
    {
        $query      = mysql_query($sql);
        if(mysql_error($db["connect"]))
        {
            $arr_return = "MYSQL ERROR : " . mysql_error($db["connect"]);
        }
        else
        {
            while($field_info = mysql_fetch_field($query))
            {
                $arr_info["field_info"][$field_info->name] = $field_info->name;
                
                
                
                if($id_array)
                {
                    if($id_array==$field_info->name)
                    {
                        $id_array_val = $field_info->name;
                    }
                }
            }

            $counter = 0;
            while($row = mysql_fetch_array($query))
            {
                foreach($arr_info["field_info"] as $key=>$val)
                {
                    if($id_array)
                    {
                        $arr_return[$row[$id_array_val]][$val] = $row[$val];
                    }
                    else
                    {
                        $arr_return[$counter][$val] = $row[$val];
                    }

                }
                $counter++;
            }

            mysql_free_result($query);
        }
    }
    else if($dbms=="mysqli")
    {
        $query = mysqli_query($db["connect"], $sql);
        if(mysqli_error($db["connect"]))
        {
            $arr_return = "MYSQLI ERROR : " . mysqli_error($db["connect"]);
        }
        else
        {
            while($field_info = mysqli_fetch_field($query))
            {
                $arr_info["field_info"][$field_info->name] = $field_info->name;
                
               
                
                if($id_array)
                {
                    if($id_array==$field_info->name)
                    {
                        $id_array_val = $field_info->name;
                    }
                }
            }

            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                foreach($arr_info["field_info"] as $key=>$val)
                {
                    if($id_array)
                    {
                        $arr_return[$row[$id_array_val]][$val] = $row[$val];
                    }
                    else
                    {
                        $arr_return[$counter][$val] = $row[$val];
                    }
                }
                $counter++;
            }

            mysqli_free_result($query);
        }
    }
    else if($dbms=="pg")
    {
        $query  = pg_query($db["connect"], $sql);
        if(!$query)
        {
            $arr_return = "PG ERROR : " .pg_last_error($db["connect"]);
        }
        else
        {         
            $i = pg_num_fields($query);
            for ($j = 0; $j < $i; $j++) 
            {
                $fieldname = pg_field_name($query, $j);    
                
                $arr_info["field_info"][$fieldname] = $fieldname;
                
                if($id_array)
                {
                    if($id_array==$fieldname)
                    {
                        $id_array_val = $fieldname;
                    }
                }
            }
            
            $counter = 0;
            while($row = pg_fetch_array($query))
            {
                foreach($arr_info["field_info"] as $key=>$val)
                {
                    if($id_array)
                    {
                        $arr_return[$row[$id_array_val]][$val] = $row[$val];
                    }
                    else
                    {
                        $arr_return[$counter][$val] = $row[$val];
                    }

                }
                $counter++;
            }

            pg_free_result($query);
        }
    }
    
    return $arr_return;
}

function SQL_EXECUTE($sql, $dbms)
{
    global $db;

    if($dbms=="mysql")
    {
        $arr_data = explode(";", $sql);

        $success = 0;
        $failed  = 0;

        foreach($arr_data as $key=>$val)
        {
            if(mysql_query($val))
            {
                $success++;
            }
            else
            {
                $failed++;
            }
        }

        $arr_return = "Finished Execute, Success ".$success." data";
        if($failed*1>1)
        {
            $arr_return .= " Failed ".$failed." data";
        }
    }
    else if($dbms=="mysqli")
    {
        if ($db["mysqli"]["connect"]->multi_query($sql) === TRUE) {
            $arr_return = "Successfull";
        } else {
            $arr_return = "Failed";
        }
    }
    else if($dbms=="pg")
    {
        $arr_data = explode(";", $sql);

        $success = 0;
        $failed  = 0;

        foreach($arr_data as $key=>$val)
        {
            if(pg_query($db["connect"], $val))
            {
                $success++;
            }
            else
            {
                $failed++;
            }
        }

        $arr_return = "Finished Execute, Success ".$success." data";
        if($failed*1>1)
        {
            $arr_return .= " Failed ".$failed." data";
        }
    }
    
    return $arr_return;
}

function SQL_CLOSE($dbms)
{
    global $db; 
    
    if($dbms=="mysql")
    {
        mysql_close($db["connect"]);
    }
    else if($dbms=="mysqli")
    {
        mysqli_close($db["connect"]);
    }
    else if($dbms=="pg")
    {
        pg_close($db["connect"]);
    }
}


function where_array($list_array, $kolom, $type="in")
{
    $where = "";
    if($type=="in")
    {
        if(count($list_array)*1>0)
        {

                foreach($list_array as $key=>$val)
                {
                    if($where == "")
                    {
                        $where .= " AND (".$kolom." = '".$val."' ";
                    }
                    else
                    {
                        $where .= " OR ".$kolom." = '".$val."' ";
                    }
                }

                if($where)
                {
                    $where .= ")";
                }


        }
    }
    else if($type=="not in")
    {
        if(count($list_array)*1>0)
        {
                foreach($list_array as $key=>$val)
                if($where == "")
                {
                    $where .= " AND (".$kolom." != '".$val."' ";
                }
                else
                {
                    $where .= " AND ".$kolom." != '".$val."' ";
                }

                if($where)
                {
                    $where .= ")";
                }
        }
    }

    return $where;
}

function save_char($char)
{
    $char1 = '"';
    $return = trim(mysql_real_escape_string($char));

    return $return;
}

function echo_array($q)
{
    echo "<pre>";
    print_r($q);
    echo "</pre>";
}

function get_counter_int_a($db_name,$tbl_name,$pk,$limit=100)
{
    $q = "
              SELECT
                  ".$db_name.".".$tbl_name.".".$pk."
              FROM
                  ".$db_name.".".$tbl_name."
              ORDER BY
                  ".$db_name.".".$tbl_name.".".$pk."*1 DESC
              LIMIT 0,".$limit."
      ";
      $qry_id = mysql_query($q);
      $jml_data = mysql_num_rows($qry_id);

      $no = true;
      while($r_id = mysql_fetch_object($qry_id))
      {
          if($no)
          {
              $id = $r_id->$pk;
              $no = false;
          }

          $arr_data["list_id"][$r_id->$pk] = $r_id->$pk;
      }

      $prev_id = 0;

      if($jml_data!=0)
      {
          foreach($arr_data["list_id"] as $list_id=>$val)
          {
              if($prev_id*1!=0)
              {
                  if( ($prev_id-1) != $val)
                  {
                      $id = $val;
                      break;
                  }
              }
              $prev_id = $val;
          }
      }
      else
      {
          $id = 0;
      }
      $id = ($id*1) + 1;

      return $id;
}

function get_counter_int($dbms,$tbl_name,$pk,$limit=100)
{
      $sql = "
              SELECT
                  ".$tbl_name.".".$pk."
              FROM
                  ".$tbl_name."
              ORDER BY
                  ".$tbl_name.".".$pk."*1 DESC
              LIMIT 0,".$limit."
      ";
      $arr_data["last"] = SQL_SELECT($sql, $dbms);
      
      if(is_array($arr_data["last"]))
      {
        $jml_data = count($arr_data["last"]);    
      }
      else
      {
          $jml_data = 0;
      }
      
      $no = true;
      if(is_array($arr_data["last"]))
      {
          foreach($arr_data["last"] as $key=>$val)
          {
              if($no)
              {
                  $id = $arr_data["last"][$key][$pk];
                  $no = false;
              }     
          }
      }

      $prev_id = 0;

      if($jml_data!=0)
      {
          foreach($arr_data["list_id"] as $list_id=>$val)
          {
              if($prev_id*1!=0)
              {
                  if( ($prev_id-1) != $val)
                  {
                      $id = $val;
                      break;
                  }
              }
              $prev_id = $val;
          }
      }
      else
      {
          $id = 0;
      }
      $id = ($id*1) + 1;

      return $id;
}

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function parsedate($str)
{
    $return = "";
    // 1988-03-10

    if($str!="")
    {
        $exp_str = explode("-",$str);
        $return = mktime(0,0,0, $exp_str[1], $exp_str[2], $exp_str[0]);

        return $return;
    }

    return $return;
}

function format_show_date($date)
{
    $return = "";
    if($date)
    {
        $exp_date = explode("-",$date);
        $return = $exp_date[2]."-".$exp_date[1]."-".$exp_date[0];
    }

    return $return;
}

function format_show_datetime($date)
{
    if($date)
    {
        $exp_date = explode(" ",$date);
        $return = format_show_date($exp_date[0])." ".$exp_date[1];
    }
    else
    {
        $return = "";
    }

    return $return;
}

function save_int($int, $type="")
{
  $first  = trim(str_replace("`", "", $int));

  if($type=="ind")
  {
      $second = str_replace(".", "", $first);
  }
  else
  {
      $second = str_replace(",", "", $first);
  }

  return $second;
}

function format_save_date($date)
{
  if($date!="")
  {
      if(strlen($date)*1==10)
      {
        $return = substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2);
      }
      else
      {
          $arr_date_explode = explode("-", $date);
          
          $return = sprintf("%04s", $arr_date_explode[2])."-".sprintf("%02s", $arr_date_explode[1])."-".sprintf("%02s", $arr_date_explode[0]);
      }
  }
  else
  {
      $return = "";
  }
  return $return;
}

function format_save_datetime($date)
{
  if($date!="")
  {
      $tanggal = substr($date, 0, 10);
      $jam = substr($date, 10, 10);

      $return = substr($tanggal, 6, 4)."-".substr($tanggal, 3, 2)."-".substr($tanggal, 0, 2)." ".$jam;
  }
  else
  {
      $return = "";
  }
  return $return;
}

function save_link_name($nilai)
{
    $return = strtolower($nilai);
    $return = save_char($return);
    $return = str_replace(" ", "-", $return);
    
    return $return;
}

function format_number($nilai,$decimal=0,$point=".",$thousands=",", $type_data="")
{
    if($type_data=="ind")
    {
        if($nilai*1!=0)
        {
            $return = number_format($nilai, $decimal, ",", ".");
        }
        else
        {
            $return = "";
        }
    }
    else
    {
        if($nilai*1!=0)
        {
            $return = number_format($nilai, $decimal, $point, $thousands);
        }
        else
        {
            $return = "";
        }
    }

    return $return;
}

function encrypt_url($string) {
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}

function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}

function secure_key($type, $origin)
{
    if($type=="encrypt")
    {
        $return = encrypt_url($origin);  
    }
    else if($type=="decrypt")
    {
        $return = decrypt_url($origin);
    }
    
    return $return;
} 


function search_keyword($v_keyword, $arr_keyword)
{
    $exp_keyword = explode(" ",$v_keyword);
    $jml_keyword = count($exp_keyword)-1;
    $jml_kolom   = count($arr_keyword);

    $where_keyword = "";
    for($key=0;$key<=$jml_keyword;$key++)
    {
        $i = 0;
        $where_keyword .= " AND ( ";
        foreach($arr_keyword as $val)
        {
            $where_keyword .= $val." LIKE '%".$exp_keyword[$key]."%' OR ";
            $i++;

            if($i==$jml_kolom)
            {
                $where_keyword = substr($where_keyword,0,-3);
            }
        }
        $where_keyword .= " ) ";
    }
    $where_keyword  = substr($where_keyword,0,-4);



    $where_keyword .= ")";

    //echo $where_keyword;
    return $where_keyword;
}

function search_keyword_or($v_keyword, $arr_keyword)
{
    $exp_keyword = explode(" ",$v_keyword);
    $jml_keyword = count($exp_keyword)-1;
    $jml_kolom   = count($arr_keyword);

    $where_keyword = "";
    $where_keyword .= " AND ( ";
    for($key=0;$key<=$jml_keyword;$key++)
    {
        $i = 0;

        foreach($arr_keyword as $val)
        {
            $where_keyword .= $val." LIKE '%".$exp_keyword[$key]."%' OR ";
            $i++;
        }

    }
    $where_keyword = substr($where_keyword,0,-3);
    $where_keyword .= " ) ";
    //$where_keyword  = substr($where_keyword,0,-4);

    //$where_keyword .= ")";

    //echo $where_keyword;
    return $where_keyword;
}



?>