<?php
    //created by masoud niki 

    if(file_exists('jdf.php'))
    {
        require_once(__DIR__.DIRECTORY_SEPARATOR."jdf.php");
    }
    else{
       exec("wget https://raw.githubusercontent.com/masoudniki/Jcal/master/jdf.php --output-document jdf.php");
       require_once(__DIR__.DIRECTORY_SEPARATOR."jdf.php");
    }
   
    
    function getFirstDay(){

        $current_jdate = jdate('Y/m/d', '', '', 'Asia/Tehran', 'en');
        $arr_parts = explode('/', $current_jdate);
        $jYear  = $arr_parts[0];
        $jMonth = $arr_parts[1];
        $jDay   = '01';
        $First_Day_gdate = jalali_to_gregorian($jYear, $jMonth, $jDay, '/');
        $First_Day_gdate_timeStamp=strtotime($First_Day_gdate);
         return @jdate('w', $First_Day_gdate_timeStamp, '', 'Asia/Tehran', 'en');

    }
    function getLastDay(){

        $current_jdate = jdate('Y/m/d', '', '', 'Asia/Tehran', 'en');
        $arr_parts = explode('/', $current_jdate);
        $jYear  = $arr_parts[0];
        $jMonth = $arr_parts[1];
        $jDay   = jdate('t', '', '', 'Asia/Tehran', 'en');
        $Last_Day_gdate = jalali_to_gregorian($jYear, $jMonth, $jDay, '/');
        $Last_Day_gdate_timeStamp=strtotime($Last_Day_gdate);
        return @jdate('w', $Last_Day_gdate_timeStamp, '', 'Asia/Tehran', 'en');

    }

    function create_array(){

        $FirstDay=getFirstDay();
        $LastDay=abs(getLastDay());
        $Days=jdate('t', '', '', 'Asia/Tehran', 'en');
        $Day=jdate('d', '', '', 'Asia/Tehran', 'en');
        $jMonth=jdate('m', '', '', 'Asia/Tehran', 'en');
        $CALC=['Sh','Ye','Do','Se','Ch','Pa','Jo'];
        for($i=0;$i<$FirstDay;++$i){
            $CALC[]=" "." ";
        }
        for($i=1;$i<=$Days;++$i)
        {
            if($i==$Day)
            {
                if($i<10)
                {
                    $CALC[]=" "."\033[32m".$i."\033[37m";
                }
                else{
                    $CALC[]="\033[32m".$i."\033[37m";;
                }
                
                
            }
            else{
                if($i<10)
                {
                    $CALC[]=" ".$i;
                }
                else{
                    $CALC[]=$i;
                }

            }
           
            
           
        }
        for($i=$LastDay;$i<6;++$i)
        {


            $CALC[]=" "." ";
        }
        return $CALC;

    }
    function PrintCalc($CALC){
        MonthAndYearText();

        for($i=1;$i<count($CALC);++$i)
        {
            if(($i)%7==0)
            {
                echo "\033[0;31m".$CALC[$i-1]."\033[0;37m";
                echo "\n";
            }
            else{
                echo $CALC[$i-1];
                echo " "." ";
            }
        }
        echo "\n";

    }
    function MonthAndYearText(){
        $month_year_text=jdate("F-Y", '', '', 'Asia/Tehran', 'en');
        $len=strlen($month_year_text);
        for($i=0;$i<(26-$len)/2;++$i)
        {
            echo " ";
        }
        echo $month_year_text;
        for($i=0;$i<(26-$len)/2;++$i)
        {
            echo " "; 
        }
        echo "\n";    }
    
    PrintCalc(create_array());









?>
