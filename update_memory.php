<?php 
    require "controllers/memoryController.php";

    if(!isset($_SESSION['id'])){
        header("location:login.php");
        exit();
    }
    $title = '';
    $date = '';
    $content='';
    
    

    if(isset($_GET['update'])){
        $updatePostID=$_GET['update'];
        
        $sqlGetPost = 'SELECT * FROM hatiralar where ID=? LIMIT 1';
        $stmt = $baglanti -> prepare($sqlGetPost);
        $stmt -> bind_param("i",$updatePostID);
        $stmt->execute();
        $result = $stmt -> get_result();
        $satir=$result->fetch_assoc();
        $title = $satir['Baslik'];
        $date = $satir['Tarih'];
        $content = $satir['HatiraIcerik'];
        

        if($satir['UyeId']!=$_SESSION['id']){
            $stmt -> close();
            header('location: index.php');
            exit();
        }
        

    }

    $memoryUpdateErrors = array();
    if (isset($_POST['update-btn'])) {
        $updateMemoryTitle=$_POST['updateMemoryTitle'];
        $updateMemoryDate=$_POST['updateMemoryDate'];
        $updateMemoryContent=$_POST['updateMemoryContent'];
        $updateMemoryStatus=$_POST['updateMemoryStatus'];
        
        $updatedPostId=$_GET['update'];
        

        $updateMemoryDate=date("Y-m-d", strtotime($updateMemoryDate));
        

        if(empty($updateMemoryTitle)){
            $memoryUpdateErrors['updateMemoryTitle'] = "Başlık boş bırakılamaz";
        }
        if(empty($updateMemoryDate)){
            $memoryUpdateErrors['updateMemoryDate'] = "Tarih boş bırakılamaz";
        }
        if(empty($updateMemoryContent)){
            $memoryUpdateErrors['updateMemoryContent'] = "İçerik boş bırakılamaz";
        }

        if(count($memoryUpdateErrors)===0){
            $sqlUpdateKayit = "UPDATE hatiralar SET  HatiraIcerik=?,Baslik=?,Tarih=?,DuyguDurumu=? where ID=?  ";
            $stmt = $baglanti -> prepare($sqlUpdateKayit);
            $stmt -> bind_param('ssssi',$updateMemoryContent,$updateMemoryTitle,$updateMemoryDate,$updateMemoryStatus,$updatedPostId);
            if($stmt->execute()){
                header('location: index.php');
                exit();
               
            }else{
                $memoryUpdateErrors['db_error'] = 'Veritabanı hatası: kayıt olma başarısız';
            }
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Hatıranı Düzenle</title>
</head>

<body>
    <div class="container mt-5">
        <div class="my-2" style='display: flex;justify-content: center;align-items: center;'>
            <h2>Hatıranı Düzenle</h2>
        </div>
        <?php if(count($memoryUpdateErrors)>0): ?>
            <div class="alert alert-danger">
            <?php foreach($memoryUpdateErrors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="update_memory.php?update=<?php echo $updatePostID ?>" method='POST'>
        <div class="card text-white bg-secondary  mb-3 mx-auto" style="width:75%">
            <div class="card-header m-4">
                <div class="input-group">
                    <span class="input-group-text " id="basic-addon1"><i class="bi bi-file-font-fill"></i></span>
                    <input type="text" name='updateMemoryTitle' class="form-control " placeholder="Başlık" value='<?php echo $title ?>' aria-describedby="basic-addon1">
                </div>
                <br>

                <h4>Tarih</h4>
                <div class="card-title">
                    <div class="input-group">
                        <span class="input-group-text " id="basic-addon1"><i
                                class="bi bi-calendar-date-fill"></i></span>
                        <input type="date" name='updateMemoryDate' class="form-control" placeholder="Tarih" value='<?php echo $date ?>'>
                    </div>
                </div>
                <br>
                <h4>Duygu Durumu:</h4>
                <select name='updateMemoryStatus' class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                    <option  value='Normal'>Normal</option>
                    <option value="Mutlu">Mutlu</option>
                    <option value="Üzgün">Üzgün</option>
                    <option value="Korkmuş">Korkmuş</option>
                    <option value="Öfkeli">Öfkeli</option>
                    <option value="Utanmış">Utanmış</option>
                    <option value="Şaşkın">Şaşkın</option>
                </select>

            </div>

            <div class="card-body mx-4 mt-2">

                <div class="form-floating">
                    <textarea maxlength='3000' class="form-control" name='updateMemoryContent' id="floatingTextarea2" style="height: 500px"><?php echo $content ?></textarea>
                    <label for="floatingTextarea2"  style='color: black;'>Comments</label>
                </div>

                <div class="mt-3" style='display: flex;justify-content: center;align-items: center;'>
                    
                    <button  type="submit" name='update-btn' class="btn btn-primary">Düzenle ve Kaydet</button>
                    
                </div>
            </div>
        </div>
        </form>


    </div>
</body>

</html>