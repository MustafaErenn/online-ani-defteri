<?php 

    session_start();

    require "config/config.php";

        $userName='';
        $userSurname='';
        $userTelephone='';
        $userPassword='';
        $userEmail='';

    $errors = array();
    if (isset($_POST['register-btn'])) {
        $userName=$_POST['userName'];
        $userSurname=$_POST['userSurname'];
        $userTelephone=$_POST['userTelephone'];
        $userPassword=$_POST['userPassword'];
        $userEmail=$_POST['userEmail'];

        if(empty($userName)){
            $errors['userName'] = "İsim boş bırakılamaz";
        }
        if(empty($userSurname)){
            $errors['userSurname'] = "Soyisim boş bırakılamaz";
        }
        if(empty($userEmail)){
            $errors['userEmail'] = "Eposta boş bırakılamaz";
        }
        if(empty($userTelephone)){
            $errors['userTelephone'] = "Telefon boş bırakılamaz";
        }
        if(empty($userPassword)){
            $errors['userPassword'] = "Şifre boş bırakılamaz";
        }
        
        $emailQuery = "SELECT * FROM uyeler where Eposta=? LIMIT 1";
        $stmt = $baglanti -> prepare($emailQuery);
        $stmt -> bind_param('s',$userEmail);
        $stmt->execute();
        $result = $stmt -> get_result();
        $userCount = $result->num_rows; 
        $stmt -> close();

        if($userCount>0){
            $errors['userEmail'] = 'Bu Eposta mevcut';
        }

        if(count($errors)===0){
            $userPassword = hash('sha256', $userPassword); 

            $sqlKayit = "INSERT INTO uyeler (Ad,Soyad,Eposta,Sifre,Telefon) values (?,?,?,?,?)";
            $stmt = $baglanti -> prepare($sqlKayit);
            $stmt -> bind_param('sssss',$userName,$userSurname,$userEmail,$userPassword,$userTelephone);
            if($stmt->execute()){
                $user_id = $baglanti->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['name'] = $userName ;
                $_SESSION['surname'] = $userSurname ;
                $_SESSION['email'] = $userEmail ;
                $_SESSION['telephone'] = $userTelephone ;
                
                header('location: index.php');
                exit();
               
            }else{
                $errors['db_error'] = 'Veritabanı hatası: kayıt olma başarısız';
            }
        }


    }

    if (isset($_POST['login-btn'])) {

        $userEmail=$_POST['userEmail'];
        $userPassword=$_POST['userPassword'];

        
        if(empty($userEmail)){
            $errors['userEmail'] = "Eposta boş bırakılamaz";
        }
        if(empty($userPassword)){
            $errors['userPassword'] = "Şifre boş bırakılamaz";
        }

        $sqlGiris = "SELECT * FROM uyeler where Eposta=? LIMIT 1";
        $stmt = $baglanti->prepare($sqlGiris);
        $stmt -> bind_param('s',$userEmail);
        $stmt -> execute();
        $result = $stmt->get_result();
        $userCount = $result->num_rows;
        $user = $result->fetch_assoc();

        if($userCount!==0){
            if(count($errors)===0){
                $userPassword = hash('sha256', $userPassword); 
                if($userPassword=== $user['Sifre']){
                    
                    $_SESSION['id'] = $user['ID'];
                    $_SESSION['name'] = $user['Ad'] ;
                    $_SESSION['surname'] = $user['Soyad'] ;
                    $_SESSION['email'] = $user['Eposta'] ;
                    $_SESSION['telephone'] = $user['Telefon'] ;
                    header('location: index.php');
                    exit();
            }else{
                $errors['login_fail'] = 'Böyle bir kullanıcı bulunamadı';
            }
            }
        }else{
            $errors['usernotfound'] = "Böyle bir kullanıcı bulunamadı";
        }
        
        

        



    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['email']);
        unset($_SESSION['telephone']);
        
        header('location: login.php');
        exit();
    }


    


?>