<?php
$records = '';
$list = '';
$libs = '';
include('../includes/header.php');
?>
<style>
table,
tr,
td,
th {
    border: 1px solid black;
}

tr:nth-child(odd) {
    background: #f0f0f0;
}

tr:nth-child(even) {
    background: #FFF;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Account List</h4>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label>Filter Criteria:</label><br />
                    <label>Account Type:</label>
                    <select id="accType" onchange="Criteria()">
                    <option value="null">Please selecting a account type</option>
                    <?php
                        $member_list = json_decode($_SESSION['member_list'],true);
                        $staff_list = json_decode($_SESSION['staff_list'],true);
                        $admin_list = json_decode($_SESSION['admin_list'],true);
                        $member_un_list = json_decode($_SESSION['member_un_list']);
                        $staff_un_list = json_decode($_SESSION['staff_un_list'],true);
                        $admin_un_list = json_decode($_SESSION['admin_un_list'],true);
                        if(count($member_list)>0){echo '<option value="member_list">Member</option>';}
                        if(count($staff_list)>0){echo '<option value="staff_list">Staff</option>';}
                        if(count($admin_list)>0){echo '<option value="admin_list">Admin</option>';}
                        if(count($member_un_list)>0){echo '<option value="member_un_list">Member (Invalid Account)</option>';}
                        if(count($staff_un_list)>0){echo '<option value="staff_un_list">Staff (Invalid Account)</option>';}
                        if(count($admin_un_list)>0){echo '<option value="admin_un_list">Admin (Invalid Account)</option>';}
                    ?>
                    </select>
                </div><br />
                <div id='adult'>
                    <?php
                    echo ListTable($member_list,"Member");
                    echo ListTable($staff_list,"Staff");
                    echo ListTable($admin_list,"Admin");
                    echo ListTable($member_un_list,"Member (Invalid Account)");
                    echo ListTable($staff_un_list,"Staff (Invalid Account)");
                    echo ListTable($admin_un_list,"Staff (Invalid Account)");
                    function ListTable($list,$table_name){
                        if(count($list)>0){
                            $table = '<table><tr><td colspan="5">'.$table_name.'</td></tr>';
                            $item = 'Member';
                            if (strpos($table_name,  $item) !== false){
                                $table .='<tr><td>Account ID</td><td>Account Type</td><td>User ID</td><td>Status</td></tr>';
                            }else{
                                $table .='<tr><td>Account ID</td><td>Account Type</td><td>Staff ID</td><td>Status</td></tr>';
                            }
                            for($x=0;$x<count($list);$x++){
                                $table .= '<tr><td>'.$list[$x]['AccID'].'</td>';
                                $table .='<td>'.$list[$x]['AccType'].'</td>';
                                if($list[$x]['AccType'] != "member"){
                                    $table .='<td>'.$list[$x]['SID'].'</td>';
                                }else{
                                    $table .='<td>'.$list[$x]['UID'].'</td>';
                                }
                                $table .='<td>'.$list[$x]['Status'].'</td></tr>';
                            }
                            $table.='</table><br />';
                            return $table;
                        }
                    }
                    ?>
                </div>
                <div style="display:none;">
                <div id="member"><?=$_SESSION['member_list'];?></div>
                <div id="staff"><?=$_SESSION['staff_list'];?></div>
                <div id="admin"><?=$_SESSION['admin_list'];?></div>
                <div id="member_un"><?=$_SESSION['member_un_list'];?></div>
                <div id="staff_un"><?=$_SESSION['staff_un_list'];?></div>
                <div id="admin_un"><?=$_SESSION['admin_un_list'];?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function Criteria(){
        var type = document.getElementById('accType').value;
        switch(type){
            case "member_list":
                document.getElementById("adult").innerHTML = '<?=ListTable($member_list,"Member")?>';
                break;
            case "staff_list":
                document.getElementById("adult").innerHTML = '<?=ListTable($staff_list,"Staff")?>';
                break;
            case "admin_list":
                document.getElementById("adult").innerHTML = '<?=ListTable($admin_list,"Admin")?>';
                break;
            case "member_un_list":
                document.getElementById("adult").innerHTML = '<?=ListTable($member_un_list,"Member (Invalid Account)");?>';
                break;
            case "staff_un_list":
                document.getElementById("adult").innerHTML = '<?=ListTable($staff_un_list,"Staff (Invalid Account)");?>';
                break;
            case "admin_un_list":
                document.getElementById("adult").innerHTML = '<?=ListTable($admin_un_list,"Admin (Invalid Account)");?>';
                break;
            default:
                <?php
                $content = "";
                if(count($member_list)>0){ $contrent .= ListTable($member_list,"Member");}
                if(count($staff_list)>0){$contrent .= ListTable($staff_list,"Staff");;}
                if(count($admin_list)>0){$contrent .= ListTable($admin_list,"Admin");}
                if(count($member_un_list)>0){$contrent .= ListTable($member_un_list,"Member (Invalid Account)");}
                if(count($staff_un_list)>0){$contrent .= ListTable($staff_un_list,"Staff (Invalid Account)");}
                if(count($admin_un_list)>0){$contrent .= ListTable($admin_un_list,"Staff (Invalid Account)");}
                ?>
                document.getElementById("adult").innerHTML = '<?=$content;?>';
                break;
        }
    }
</script>
<?php
include('../../includes/footer.php');
?>