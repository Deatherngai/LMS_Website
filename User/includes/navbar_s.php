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
                    <a class="nav-link active" href="../../index2.php"><img class="icon" src="..\..\static\icons\home.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../../public/AS.php"><img class="icon" src="..\..\static\icons\Book_Search.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../../DBQuery/StaffQuery.php?action=stock"><img class="icon" src="..\..\static\icons\Stock.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../../DBQuery/StaffQuery.php?action=loan"><img class="icon" src="..\..\static\icons\borrow.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../../DBQuery/StaffQuery.php?action=r_records"><img class="icon" src="..\..\static\icons\reserved_records.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../../DBQuery/LibraryQuery.php?action=info"><img class="icon" src="..\..\static\icons\Contact_us.png" /></a>
                </li>
                <li class="nav-item">
                <div class="dropdown">
                        <a class="nav-link active" href="#"><img class="icon" src="..\..\static\icons\report.png" /></a>
                        <div class="dropdown-content">
                            <a href="../../DBQuery/ReportQuery.php?action=report">Book Report List</a>
                            <a href="https://colab.research.google.com/drive/18Q94KrAXt6zc9-PRkhUYjBPaeo1yRu1k?usp=sharing" target="_blank">Write Book Report</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link active" href="#"><img class="icon" src="..\..\static\icons\account.png" /></a>
                        <div class="dropdown-content">
                            <a href="../../DBQuery/StaffQuery.php?action=info">Personal Details</a>
                            <a href="../../public/pw_m.php">Modify Password</a>
                            <a href="../../public/sign_out.php">Sign out</a>
                        </div>
                    </div>
                </li>
        </div>
    </div>
</nav>