<?php
$records = '';
$books = '';
$libs = '';
include('../includes/header.php');
$libs = json_decode($_SESSION['library_all'],true);
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
					<label>Library:</label>
					<?php
					$str = '<select id="library" onchange="Criteria()"><option value="null" selected>Please select once</option>';
					for($i=0;$i<count($libs);$i++){
						if(!strpos($str,$libs[$i]['LID'])){
							$str .= '<option value='.$libs[$i]['LID'].'>'.$libs[$i]['Library'].'</option>'; 
						}
					};
					$str .= '</select><br />';
					echo $str;
                    ?> 
					
                    <label>Subject:</label>
					<?php
					$str2 = '<select id="subject" onchange="Criteria()"><option value="null" selected>Please select once subject</option>';
					for($i=0;$i<count($libs);$i++){
						$books = $libs[$i]['LID'].'_books';
                        $books = json_decode($_SESSION[$books],true);
						for($x=0;$x<count($books);$x++){
							if(!strpos($str2,$books[$x]['Subject'])){
								$str2 .= '<option value='.$books[$x]['Subject'].'>'.$books[$x]['Subject'].'</option>'; 
							}
						};
					}
					$str2 .= '</select><br />';
					echo $str2;
                    ?>
                </div>
                <div id='adult'>
                    <?php
                    for($i=0;$i<count($libs);$i++){
                        $stock = json_decode($_SESSION[$libs[$i]['LID'].'_stock'],true);
                        $books = $libs[$i]['LID'].'_books';
                        $books = json_decode($_SESSION[$books],true);
                        $table = '<table><tr><td colspan="7">'.$libs[$i]['Library'].'</td></tr>';
                        for($x=0;$x<count($books);$x++){
                                $table .= '<tr><td>'.$books[$x]['BookName_EN'].'</td>';
                                $table .='<td>'.$books[$x]['Author'].'</td>';
                                $table .='<td>'.$books[$x]['ISBN'].'</td>';
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
						echo "<br />";
                    }
                    ?>
                </div>
                <div style="display:none;">
                <?php 
                    for($i=0;$i<count($libs);$i++){
                        $stock = $_SESSION[$libs[$i]['LID'].'_stock'];
                        $books = $_SESSION[$libs[$i]['LID'].'_books'];
                        echo '<div id="lib'.$i.'">'.$_SESSION['library_all'].'</div>';
                        echo '<div id="item'.$i.'">'.$stock.'</div>';
                        echo '<div id="books'.$i.'">'.$books.'</div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var str = "item"+"0";
    let t_arr = JSON.parse(document.getElementById(str).innerText);                                                                                                                                                                                                  
    function Criteria(){
        var subject = document.getElementById("subject").value;
        var library = document.getElementById("library").value;
        let arr = [];
        if(!(library === "null")){
            arr = Search_Library(library);
            if(subject === "null"){
                ShowTable(arr);
            }else{
                Search_Subject2(arr,subject);
            }
        }else if(!(subject === "null")){
            Search_Subject(subject);
        }else{
            showAll();
        }
    }
    function Search_Library(lib){
        let n = <?=count($libs);?>;
        let n_arr = [];
        for(let k=0;k<n;k++){
            var item = "item"+k;
            var item2 = "books"+k;
            let book_arr = JSON.parse(document.getElementById(item2).innerText);
            let stock_arr = JSON.parse(document.getElementById(item).innerText);
            let len = book_arr.length;
            for(let b=0;b<len;b++){
                if(stock_arr[b].LID == lib){
                    var str = '{"BID":"'+stock_arr[b].BID+'","BookName_CN":"'+book_arr[b].BookName_CN+'","BookName_EN":"'+book_arr[b].BookName_EN+'","Author":"'+book_arr[b].Author+'","ISBN":"'+book_arr[b].ISBN+'","LID":"'+stock_arr[b].LID+'","Status":"'+stock_arr[b].Status+'","Subject":"'+book_arr[b].Subject+'"}';
                    n_arr.push(JSON.parse(str));
                }
            }
        }
        return n_arr;
    }
    function Search_Subject(subject){
        let n = <?=count($libs);?>;
        let r_arr = [];
        let c_arr = [];
        for(let k=0;k<n;k++){
            var item = "item"+k;
            var item2 = "books"+k;
            let book_arr = JSON.parse(document.getElementById(item2).innerText);
            let stock_arr = JSON.parse(document.getElementById(item).innerText);
            let len = book_arr.length;
            r_arr = [];
            for(let b=0;b<len;b++){
                var item_sub = book_arr[b].Subject;
                if(item_sub.includes(subject)){
                    var str = '{"BID":"'+stock_arr[b].BID+'","BookName_CN":"'+book_arr[b].BookName_CN+'","BookName_EN":"'+book_arr[b].BookName_EN+'","Author":"'+book_arr[b].Author+'","ISBN":"'+book_arr[b].ISBN+'","LID":"'+stock_arr[b].LID+'","Status":"'+stock_arr[b].Status+'","Subject":"'+book_arr[b].Subject+'"}';
                    r_arr.push(JSON.parse(str));
                }
            }
            c_arr.push(r_arr);
        }
        Show2DTable(c_arr);
    }
    function Search_Subject2(arr,subject){
        let n = <?=count($libs);?>;
        let n_arr = [];
        for(let k=0;k<arr.length;k++){
            var item_sub =arr[k].Subject;
            if(item_sub.includes(subject)){
                var str = '{"BID":"'+arr[k].BID+'","BookName_CN":"'+arr[k].BookName_CN+'","BookName_EN":"'+arr[k].BookName_EN+'","Author":"'+arr[k].Author+'","ISBN":"'+arr[k].ISBN+'","LID":"'+arr[k].LID+'","Status":"'+arr[k].Status+'","Subject":"'+arr[k].Subject+'"}';
                n_arr.push(JSON.parse(str));
            }
        }
        ShowTable(n_arr);
    }
    function showAll(){
        let n = <?=count($libs);?>;
        let r_arr = [];
        let c_arr = [];
        for(let k=0;k<n;k++){
            var item = "item"+k;
            var item2 = "books"+k;
            let book_arr = JSON.parse(document.getElementById(item2).innerText);
            let stock_arr = JSON.parse(document.getElementById(item).innerText);
            let len = book_arr.length;
            r_arr = [];
            for(let b=0;b<len;b++){
                var str = '{"BID":"'+stock_arr[b].BID+'","BookName_CN":"'+book_arr[b].BookName_CN+'","BookName_EN":"'+book_arr[b].BookName_EN+'","Author":"'+book_arr[b].Author+'","ISBN":"'+book_arr[b].ISBN+'","LID":"'+stock_arr[b].LID+'","Status":"'+stock_arr[b].Status+'","Subject":"'+book_arr[b].Subject+'"}';
                r_arr.push(JSON.parse(str));
            }
            c_arr.push(r_arr);
        }
        Show2DTable(c_arr);
    }
    function ShowTable(arr){
        var table = "";
        var lib = "";
        if(arr.length > 0){
            let lib_arr = <?=$_SESSION['library_all'];?>;
            for(let i=0;i<lib_arr.length;i++){
                if(arr[0].LID == lib_arr[i].LID){
                    lib = lib_arr[i].Library;
                    i = lib_arr.length+1;
                }
            }
            table += "<table><tr><th colspan='7'>"+lib+"</th></tr>";
            table += "<tr><td>BID</td><td>Book Name</td><td>Author</td><td>ISBN</td><td>LID</td><td>Status</td></tr>";
            for(let k=0;k<arr.length;k++){
                table += "<tr><td>"+arr[k].BID+"</td><td>"+arr[k].BookName_EN+"</td><td>"+arr[k].Author+"</td><td>"+arr[k].ISBN+"</td><td>"+arr[k].LID+"</td><td>"+arr[k].Status+"</td>";
                if(arr[k].Status === "Intact"){
                    table +='<td><Button onclick="EditStatus(\''+arr[k].BID+'\',\'Damaged\')">Damaged</Button><Button onclick="EditStatus(\''+arr[k].BID+'\',\'Violation\')">Violation</Button></td></tr>';
                }else if(arr[k].Status === "Damaged" || arr[k].Status === "violation"){
                    table +='<td><Button disabled>Damaged"</Button><Button disabled>Violation</Button></td></tr>';
                }
            }
            table += "</table>";
        }else{
            table = "<h5>No related Stock records!</h5>";
        }
        document.getElementById("adult").innerHTML = table;
    }
    function Show2DTable(arr){
        var table = "";
        var content = "";
        if(arr.length > 0){
            let lib_arr = <?=$_SESSION['library_all'];?>;
            for(let k=0;k<arr.length;k++){
                if(arr[k].length>0){
                    var lib = "";
                    for(let i=0;i<lib_arr.length;i++){
                        if(arr[k][0].LID == lib_arr[i].LID){
                            lib = lib_arr[i].Library;
                            i = lib_arr.length+1;
                        }
                    }
                    table = "";
                    table += "<table><tr><th colspan='7'>"+lib+"</th></tr>";
                    table += "<tr><td>BID</td><td>Book Name</td><td>Author</td><td>ISBN</td><td>LID</td><td>Status</td></tr>";
                    for(let p=0;p<arr[k].length;p++){
                        table += "<tr><td>"+arr[k][p].BID+"</td><td>"+arr[k][p].BookName_EN+"</td><td>"+arr[k][p].Author+"</td><td>"+arr[k][p].ISBN+"</td><td>"+arr[k][p].LID+"</td><td>"+arr[k][p].Status+"</td>";
                        if(arr[k][p].Status === "Intact"){
                            table +='<td><Button onclick="EditStatus(\''+arr[k][p].BID+'\',\'Damaged\')">Damaged</Button><Button onclick="EditStatus(\''+arr[k][p].BID+'\',\'Violation\')">Violation</Button></td></tr>';
                        }else if(arr[k][p].Status === "Damaged" || arr[k][p].Status === "violation"){
                            table +='<td><Button disabled>Damaged"</Button><Button disabled>Violation</Button></td></tr>';
                        }
                    }
                    table += "</table><br />";
                    content += table;
                }
            }
        }
        document.getElementById("adult").innerHTML = content;
    }

    function EditStatus(BID, status) {
        var url = "../../DBQuery/StockQuery.php?bid=" + BID + "&action=Status_CH_Ad&status=" + status;
        window.location.replace(url);
    }
</script>
<?php
include('../../includes/footer.php');
?>