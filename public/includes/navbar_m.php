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
                    <a class="nav-link active" href="../index2.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../public/AS.php">Advanced Search</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link active" href="#">Loan Record</a>
                        <div class="dropdown-content">
                            <a href="../DBQuery/LoanRecordQuery.php?action=record">Current Loan record</a>
                            <a href="../DBQuery/LoanRecordQuery.php?action=history">Loan History</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../DBQuery/LibraryQuery.php?action=info">Contact US</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link active" href="#">Account</a>
                        <div class="dropdown-content">
                            <a href="./AccInfo.php">Personal Details</a>
                            <a href="./pw_m.php">Modify Password</a>
                            <a href="./sign_out.php">Sign out</a>
                        </div>
                    </div>
                </li>
        </div>
    </div>
</nav>