<?php 
    
    require "controllers/memoryController.php";
    require "controllers/memoryGetter.php";

    if(!isset($_SESSION['id'])){
        header("location:login.php");
        exit();
    }

    if (isset($_POST['addMemory-btn'])) {
        header("location: add_memory.php");
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Ana Sayfa</title>
</head>

<body >

    <div class="container  pb-3">
        
        <!-- PROFİL KISMI -->
        <div class="card mb-3 text-light bg-primary rounded-5 mx-auto mt-5" style="max-width: 750px;">
            <div class="row">
                
                <div class="col">
                    <div class="card-body">
                        <h2 class="card-title text-dark">Bilgiler</h2>
                        <hr>
                        <h5> <?php echo $_SESSION['name']." ".$_SESSION['surname']    ?> </h5><br>
                        <h5 class="card-text">Mail Adresi: <?php echo $_SESSION['email']?></h5><br>
                        <h5 class="card-text">Telefon Numarası: <?php echo $_SESSION['telephone'] ?></h5><br>
                        <div class='mt-4' style='display:flex;flex-direction:column;justify-content: center;align-items: center;'>
                        <form action='index.php' method='POST'>
                        <button type="submit" name='addMemory-btn' class="btn btn-warning btn-lg">Hatıra Oluştur</button>
                        </form>
                        <br>
                        <a href='index.php?logout=1' class="btn btn-danger btn-lg">Çıkış Yap</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card-body">
                        <h2 class="card-title text-dark">Değerler</h2>
                        <hr>
                        <ul  class='text-center'>
                            <li class='my-3  '><h4>Normal Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Normal' ?>' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Mutlu Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Mutlu' ?>' class="btn btn-light btn-sm text-right"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Üzgün Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Üzgün' ?>' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Korkmuş Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Korkmuş' ?>' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Öfkeli Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Öfkeli' ?>' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Utanmış Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Utanmış' ?>' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Şaşkın Anıların <a style='float: right;' href='index.php?duygu=<?php echo 'Şaşkın' ?>' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                            <li class='my-3'><h4>Bütün Anıların <a style='float: right;' href='index.php' class="btn btn-light btn-sm"><i class="bi bi-arrow-right-circle"></i></a></h4></li>
                                
                        </ul>
                    </div>
                </div>


            </div>
        </div>

        <?php 
        $userCount = $result->num_rows;  
        ?>

        <?php if($userCount==0): ?>
            <div class="alert alert-danger mx-auto" role="alert" style="max-width: 47rem;">
                Kayıt oluşturduğunuz anınız yok.
            </div>
        <?php endif; ?>
        
       <?php while($row=$result->fetch_assoc()): ?>
        <div class="card text-white bg-<?php echo $row['DuyguRenk'] ?> mb-5 mx-auto" style="max-width: 47rem;">
            <div class="card-header"><span style='font-size:25px'><?php echo $row['Baslik'] ?></span></div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['Tarih']." -> ".$row['DuyguEmoji']." ".$row['DuyguDurumu'] ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($row['HatiraIcerik']) ?></p>
                 
                <a href='update_memory.php?update=<?php echo $row['ID'] ?>' class="btn btn-light"><i class="bi bi-pencil-square"></i> Düzenle</a>
                <a onclick="return deleletconfig()" href='index.php?delete=<?php echo $row['ID'] ?>' class="btn btn-light"><i class="bi bi-trash"></i> Sil</a>
                
                
            </div>
        </div>
       <?php endwhile; ?>

       
        
       


    </div>

    <script>
    function deleletconfig(){

    var del=confirm("Silmek istediğinize emin misiniz?");
    
    return del;
    }
    </script>
    
</body>

</html>