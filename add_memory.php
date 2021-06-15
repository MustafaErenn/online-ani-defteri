<?php 
    require "controllers/memoryController.php";

    if(!isset($_SESSION['id'])){
        header("location:login.php");
        exit();
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
    <title>Hatıra Ekle</title>
</head>

<body>
    <div class="container mt-5">
        <div class="my-2" style='display: flex;justify-content: center;align-items: center;'>
            <h2>Hatıra Ekle</h2>
        </div>
        <?php if(count($memoryFormErrors)>0): ?>
            <div class="alert alert-danger">
            <?php foreach($memoryFormErrors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="add_memory.php" method='POST'>
        <div class="card text-white bg-secondary  mb-3 mx-auto" style="width:75%">
            <div class="card-header m-4">
                <h4>Başlık:</h4>
                <div class="input-group">
                    <span class="input-group-text " id="basic-addon1"><i class="bi bi-file-font-fill"></i></span>
                    <input type="text" name='memoryTitle' class="form-control " placeholder="Başlık" value='<?php echo $memoryTitle ?>' aria-describedby="basic-addon1">
                </div>
                <br>

                <h4>Tarih:</h4>
                <div class="card-title">
                    <div class="input-group">
                        <span class="input-group-text " id="basic-addon1"><i
                                class="bi bi-calendar-date-fill"></i></span>
                        <input type="date" name='memoryDate' class="form-control" placeholder="Tarih" value='<?php echo $memoryDate ?>' >
                    </div>
                </div>
                <br>
                <h4>Duygu Durumu:</h4>
                <select name='memoryStatus' class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
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
                    <textarea maxlength='3000' class="form-control" name='memoryContent' id="floatingTextarea2" style="height: 500px"><?php echo $memoryContent ?></textarea></textarea>
                    <label for="floatingTextarea2"  style='color: black;'>Comments</label>
                </div>

                <div class="mt-3" style='display: flex;justify-content: center;align-items: center;'>
                    <button type="submit" name='save-btn' class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
        </form>


    </div>
</body>

</html>