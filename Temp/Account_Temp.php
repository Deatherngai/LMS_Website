<?php
$action = "";
$url="";
$accounts = '';
session_start();
if($_SERVER['REQUEST_METHOD']=="GET"){
    $action = $_GET['action'];
    switch($action){
        case "SignIn":
            $login = $_GET['sign'];
            if ($login == "true") {
                $_SESSION['login'] = 'true';
                $_SESSION['Account'] = $_GET['Account'];
                $acc = json_decode($_GET['Account'],true);
                $_SESSION['AccType'] = $acc[0]['AccType'];
                $url = "Location:../index2.php";
            } else {
                $_SESSION['login2'] = 'false';
                $url = "Location:../public/sign_in.php";
            }
            break;
        case "Info":
            $url = '';
            break;
        case "Up_pw":
            $url;
            break;
        case "AM":
            $accounts = json_decode($_GET['accounts'],true);
            DivideType($accounts);
            $url = 'Location:../User/Admin/account_list.php';
            break;
        case "reserve": 
            $login = $_GET['sign'];
            if ($login == "true") {
                $_SESSION['Account'] = $_GET['Account'];
                $acc = json_decode($_GET['Account'],true);
                $_SESSION['AccType'] = $acc[0]['AccType'];
                $url = "Location:../public/Reserve.php";
            } else {
                $_SESSION['login'] = 'false';
                $url = "Location:../public/sign_in.php?action2=reserve";
            }
            break;
        default:
        ;
    }
    header($url);
}

function DivideType($accounts){
    $member = array();
    $staff = array();
    $admin = array();
    //invalid Account 
    $member_un = array();
    $staff_un = array();
    $admin_un = array();
    $len = count($accounts);
    for($x=0;$x<$len;$x++){
        switch($accounts[$x]['Status']){
            case 'valid':
                switch($accounts[$x]['AccType']){
                    case 'admin':
                        $acc = '{"AccID":"'.$accounts[$x]['AccID'].'","AccType":"'.$accounts[$x]['AccType'].'","Password":"'.$accounts[$x]['Password'].'",';
                        $acc .= '"SID":"'.$accounts[$x]['SID'].'","Status":"'.$accounts[$x]['Status'].'"}';
                        array_push($admin,$acc);
                        break;
                    case 'staff':
                        $acc = '{"AccID":"'.$accounts[$x]['AccID'].'","AccType":"'.$accounts[$x]['AccType'].'","Password":"'.$accounts[$x]['Password'].'",';
                        $acc .= '"SID":"'.$accounts[$x]['SID'].'","Status":"'.$accounts[$x]['Status'].'"}';
                        array_push($staff,$acc);
                        break;
                    default:
                        $acc = '{"AccID":"'.$accounts[$x]['AccID'].'","AccType":"'.$accounts[$x]['AccType'].'","Password":"'.$accounts[$x]['Password'].'",';
                        $acc .= '"UID":"'.$accounts[$x]['UID'].'","Status":"'.$accounts[$x]['Status'].'"}';
                        array_push($member,$acc);
                        break;
                }
                break;
            default:
                switch($accounts[$x]['AccType']){
                    case 'admin':
                        $acc = '{"AccID":"'.$accounts[$x]['AccID'].'","AccType":"'.$accounts[$x]['AccType'].'","Password":"'.$accounts[$x]['Password'].'",';
                        $acc .= '"SID":"'.$accounts[$x]['SID'].'","Status":"'.$accounts[$x]['Status'].'"}';
                        array_push($admin_un,$acc);
                        break;
                    case 'staff':
                        $acc = '{"AccID":"'.$accounts[$x]['AccID'].'","AccType":"'.$accounts[$x]['AccType'].'","Password":"'.$accounts[$x]['Password'].'",';
                        $acc .= '"SID":"'.$accounts[$x]['SID'].'","Status":"'.$accounts[$x]['Status'].'"}';
                        array_push($staff_un,$acc);
                        break;
                    default:
                        $acc = '{"AccID":"'.$accounts[$x]['AccID'].'","AccType":"'.$accounts[$x]['AccType'].'","Password":"'.$accounts[$x]['Password'].'",';
                        $acc .= '"UID":"'.$accounts[$x]['UID'].'","Status":"'.$accounts[$x]['Status'].'"}';
                        array_push($member_un,$acc);
                        break;
                }
                break;
        }
    }
    $_SESSION['member_list'] = '['.implode(',',$member).']';
    $_SESSION['staff_list'] = '['.implode(',',$staff).']';
    $_SESSION['admin_list'] = '['.implode(',',$admin).']';
    $_SESSION['member_un_list'] = '['.implode(',',$member_un).']';
    $_SESSION['staff_un_list'] = '['.implode(',',$staff_un).']';
    $_SESSION['admin_un_list'] = '['.implode(',',$admin_un).']';
}
?>
