<?php 

    
$sqlGetMemories = "SELECT * FROM hatiralar WHERE UyeId=?";
$stmt = $baglanti -> prepare($sqlGetMemories);
$stmt -> bind_param('s',$_SESSION['id']);
$stmt -> execute();
$result = $stmt->get_result();

if(isset($_GET['duygu'])){
    $duygu=$_GET['duygu'];
    $sqlGetMemories = "SELECT * FROM hatiralar WHERE UyeId=? and DuyguDurumu=?";
    $stmt = $baglanti -> prepare($sqlGetMemories);
    $stmt -> bind_param('ss',$_SESSION['id'],$duygu);
    $stmt -> execute();
    $result = $stmt->get_result();

    
}

?>