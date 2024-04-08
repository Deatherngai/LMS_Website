<style>
    .icon{
        width:30px;
        height:30px;
    }
    .nav-item{
        margin-left:20px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="../index2.php"><img class="icon" src="..\static\icons\home.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./AS.php"><img class="icon" src="''\static\icons\Book_Search.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./DBQuery/LibraryQuery.php?action=AllStock"><img class="icon" src="..\static\icons\Stock.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../DBQuery/LibraryQuery.php?action=loan_all"><img class="icon" src="..\static\icons\borrow.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../DBQuery/AccountQuery.php?action=AM"><img class="icon" src="..\..\static\icons\Acc_List.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../DBQuery/LibraryQuery.php?action=info"><img class="icon" src="..\static\icons\Contact_us.png" /></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link active" href="#"><img class="icon" src="..\static\icons\account.png" /></a>
                        <div class="dropdown-content">
                            <a href="./pw_m.php">Modify Password</a>
                            <a href="./sign_out.php">Sign out</a>
                        </div>
                    </div>
                </li>
        </div>
    </div>
</nav>