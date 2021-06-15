<?php 
    require "controllers/authController.php";

    $memoryTitle = '';
    $memoryDate = '';
    $memoryContent='';


    $memoryFormErrors = array();
    if (isset($_POST['save-btn'])) {
        $memoryTitle=$_POST['memoryTitle'];
        $memoryDate=$_POST['memoryDate'];
        $memoryContent=$_POST['memoryContent'];
        $memoryStatus=$_POST['memoryStatus'];
        

        if($memoryStatus=='Mutlu'){
            $memoryEmojiCode="&#x1F600;";
            $memoryEmojiColor="success";
        }
        else if($memoryStatus=='Normal'){
            $memoryEmojiCode="&#x1F610;";
            $memoryEmojiColor="primary";
        }
        else if($memoryStatus=='Üzgün'){
            $memoryEmojiCode="&#x1F622;";
            $memoryEmojiColor="secondary";
        }
        else if($memoryStatus=='Korkmuş'){
            $memoryEmojiCode="&#x1F628;";
            $memoryEmojiColor="dark";
        }
        else if($memoryStatus=='Öfkeli'){
            $memoryEmojiCode="&#x1F620;";
            $memoryEmojiColor="danger";
        }
        else if($memoryStatus=='Utanmış'){
            $memoryEmojiCode="&#x1F633;";
            $memoryEmojiColor="warning";
        }
        else if($memoryStatus=='Şaşkın'){
            $memoryEmojiCode="&#x1F62E;";
            $memoryEmojiColor="info";
        }

        $memoryDate=date("Y-m-d", strtotime($memoryDate));
        

        if(empty($memoryTitle)){
            $memoryFormErrors['memoryTitle'] = "Başlık boş bırakılamaz";
        }
        if(empty($memoryDate)){
            $memoryFormErrors['memoryDate'] = "Tarih boş bırakılamaz";
        }
        if(empty($memoryContent)){
            $memoryFormErrors['memoryContent'] = "İçerik boş bırakılamaz";
        }

        if(count($memoryFormErrors)===0){
            $sqlMemoryKayit = "INSERT INTO hatiralar (UyeId,HatiraIcerik,Tarih,Baslik,DuyguDurumu,DuyguEmoji,DuyguRenk) values (?,?,?,?,?,?,?)";
            $stmt = $baglanti -> prepare($sqlMemoryKayit);
            $stmt -> bind_param('issssss',$_SESSION['id'],$memoryContent,$memoryDate,$memoryTitle,$memoryStatus,$memoryEmojiCode,$memoryEmojiColor);
            if($stmt->execute()){
                header('location: index.php');
                exit();
               
            }else{
                $errors['db_error'] = 'Veritabanı hatası: kayıt olma başarısız';
            }
        }
        
    }


    

    
    
    
    if(isset($_GET['delete'])){

        $postID=$_GET['delete'];
        $sqlDelete = "DELETE FROM hatiralar where ID=?";
        $stmt = $baglanti -> prepare($sqlDelete);
        $stmt -> bind_param("i",$postID);
        $stmt -> execute();

        header('location: index.php');
        exit();
    }





?>