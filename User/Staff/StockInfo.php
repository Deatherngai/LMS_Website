<?php
$records = '';
$books = '';
include('../includes/header.php');
$stock = json_decode($_SESSION['LibStock'],true);
$stockList = json_decode($_SESSION['st_books'],true);
$l = count($stock);
$len = count($stockList);
//echo $_SESSION['LibStock'];
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
<script>
console.log("<?=$len;?>");
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Library Stocks</h4>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label>Filter Criteria:</label><br />
                    <label>Subject:</label>
                    <?php
                        $str2 = '<select id="subject" onchange="Criteria()"><option value="null" selected>Please select once subject</option><option value='.$stockList[0]['Subject'].'>'.$stockList[0]['Subject'].'</option>';
                        for($x=1;$x<$len;$x++){
                            if(!strpos($str2,$stockList[$x]['Subject'])){
                                $str2 .= '<option value='.$stockList[$x]['Subject'].'>'.$stockList[$x]['Subject'].'</option>';
                            }
                        }
                        echo $str2.="</select>";
                        ?>
                </div>
                <div id='adult'>
                    <?php
                    $table = '<table><tr><td colspan="7">Sub1</td><tr>';
					$table .= '<tr><td>Book ID</td><td>Book Name</td><td>Author</td><td>ISBN</td><td>Library ID</td><td>Status</td><td></td></tr>';
                    for($x=0;$x<$len;$x++){
                            $table .= '<tr><td>'.$stock[$x]['BID'].'</td>';
                            $table .= '<td>'.$stockList[$x]['BookName_EN'].'</td>';
                            $table .='<td>'.$stockList[$x]['Author'].'</td>';
                            $table .='<td>'.$stockList[$x]['ISBN'].'</td>';
                            $table .='<td>'.$stock[$x]['LID'].'</td>';
                            $table .='<td>'.$stock[$x]['Status'].'</td>';
                            if($stock[$x]['Status'] == "Intact"){
                                $table .='<td><Button onclick="EditStatus(\''.$stock[$x]['BID'].'\',\'Damaged\')">Damaged</Button><Button onclick="EditStatus(\''.$stock[$x]['BID'].'\',\'Violation\')">Violation</Button></td></tr>';
                            }else if($stock[$x]['Status'] == "Damaged" || $stock[$x]['Status'] == "violation"){
                                $table .='<td><Button disabled>Damaged"</Button><Button disabled>Violation</Button></td></tr>';
                            }
                    }
                    $table.='</table>';
                    echo $table;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function EditStatus(BID, status) {
    var url = "../../DBQuery/StockQuery.php?bid=" + BID + "&action=Status_CH&status=" + status;
    window.location.replace(url);
}

function Criteria(){
	var subject = document.getElementById("subject").value;
	const stock = <?php echo $_SESSION['LibStock']; ?>;
	const stockList = <?php echo $_SESSION['st_books']; ?>;
	var table = "";
	let exist = 0;
	table = "<table><tr><td colspan='7'>Sub1</td><tr>";
	table += "<tr><td>Book ID</td><td>Book Name</td><td>Author</td><td>ISBN</td><td>Library ID</td><td>Status</td><td></td></tr>";
	for(let x=0;x<stock.length;x++){
		var item = stockList[x].Subject;
        if(subject == "null"){
            table += '<tr><td>'+stock[x]['BID']+'</td>';
            table += '<td>'+stockList[x]['BookName_EN']+'</td>';
            table +='<td>'+stockList[x]['Author']+'</td>';
            table +='<td>'+stockList[x]['ISBN']+'</td>';
            table +='<td>'+stock[x]['LID']+'</td>';
            table +='<td>'+stock[x]['Status']+'</td>';
            if(stock[x]['Status'] == "Intact"){
                table +='<td><Button onclick="EditStatus(\''+stock[x]['BID']+'\',\'Damaged\')">Damaged</Button><Button onclick="EditStatus(\''+stock[x]['BID']+'\',\'Violation\')">Violation</Button></td></tr>';
            }else if(stock[x]['Status'] == "Damaged" || stock[x]['Status'] == "Violation"){
                table +='<td><Button disabled>Damaged"</Button><Button disabled>Violation</Button></td></tr>';
            }
        }else if(item.includes(subject)){
			exist +=1; 
			table += '<tr><td>'+stock[x]['BID']+'</td>';
            table += '<td>'+stockList[x]['BookName_EN']+'</td>';
            table +='<td>'+stockList[x]['Author']+'</td>';
            table +='<td>'+stockList[x]['ISBN']+'</td>';
            table +='<td>'+stock[x]['LID']+'</td>';
            table +='<td>'+stock[x]['Status']+'</td>';
            if(stock[x]['Status'] == "Intact"){
                table +='<td><Button onclick="EditStatus(\''+stock[x]['BID']+'\',\'Damaged\')">Damaged</Button><Button onclick="EditStatus(\''+stock[x]['BID']+'\',\'Violation\')">Violation</Button></td></tr>';
            }else if(stock[x]['Status'] == "Damaged" || stock[x]['Status'] == "Violation"){
                table +='<td><Button disabled>Damaged"</Button><Button disabled>Violation</Button></td></tr>';
            }
		}
	}
	table+="</table>";
	
	document.getElementById('adult').innerHTML = table;
}
</script>
<?php
include('../../includes/footer.php');
?>