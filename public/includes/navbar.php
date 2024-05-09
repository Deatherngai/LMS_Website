<style>
    .icon{
        width:30px;
        height:30px;
    }
    .nav-item{
        margin-left:20px;
    }
    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
  }
  
  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    margin-left: -60px;
  }
  
  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Library Management System</a>
        <button class="navbar-toggler" type="button" id="btn" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="../index.php"><img class="icon" src="..\static\icons\home.png" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./AS.php"><img class="icon" src="..\static\icons\Book_Search.png" /></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link active" href="#"><img class="icon" src="..\static\icons\report.png" /></a>
                        <div class="dropdown-content">
                            <a href="../DBQuery/ReportQuery.php?action=report">Book Report List</a>
                            <a href="https://colab.research.google.com/drive/18Q94KrAXt6zc9-PRkhUYjBPaeo1yRu1k?usp=sharing" target="_blank">Write Book Report</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../DBQuery/LibraryQuery.php?action=info"><img class="icon" src="..\static\icons\Contact_us.png" /></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./sign_in.php"><img class="icon" src="..\static\icons\login.png" /></a>
                </li>
        </div>
    </div>