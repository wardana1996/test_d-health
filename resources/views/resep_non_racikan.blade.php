<!DOCTYPE html>
<html>
<head>
    <title>Resep Non Racikan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">
    h2{
        text-align: center;
        font-size:22px;
        margin-bottom:50px;
    }
    body{
        background:#f2f2f2;
    }
    .section{
        margin-top:30px;
        padding:50px;
        background:#fff;
    }
    .pdf-btn{
        margin-top:30px;
    }
</style>  
<body>
	<div class="container">
        <div class="col-md-8 section offset-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Resep Obat Non Racikan</h2>
                </div>
                <div class="panel-body">
                    <div class="main-div">
                        nama obat : {{ $obat['obatalkes_nama'] }}
                        <br>
                        resep : {{ $obat['signa_nama'] }}
                        <br>
                        qty : {{ $obat['qty'] }}
                        <br>
                        <h2>Semoga Lekas Sembuh</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>