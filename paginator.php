<style type="text/css">
    a{
        color: #1ca8c3;
    }
    input{
        margin-top: 10px;
        margin-left: 10px;
    }
    a {
        text-decoration: none;
    }
    td{
        padding: 5px;
        border: 1px solid #dddddd;
    }
    #in-so{
        border: 1px solid #dddddd;
        width: 300px;
        text-align: center;
        padding: 20px;
        color: #1ca8c3;
    }
    hr:last-child{
        border: none;
    }
    #danh-sach{
        float: right;
        padding-right: 10px;
    }
</style>
<form method = "post" action = "">
    <label for="a">Số a</label><input type = "text" name = "a"><br>
    <label for="b">Số b</label><input type = "text" name = "b"><br>
    <label for="c">Số c</label><input type = "text" name = "c"><br>
    <input type = "submit" value = "Hiển thị" name = "submit" style="border: 1px solid #dddddd; background-color: white; margin-left: 40px">
</form>

<?php
function pagination($a, $b, $c, $page_now){
    $mang = array();
    $so = 0;
    $i = 1;
    while ($so < $a) {
        $so = $i * $b;
        $mang[] = $so;
        $i++;
    }
    $tong_trang = sizeof($mang);
    $bat_dau = ($page_now - 1) * $c;
    $ket_thuc = $page_now * $c;
    if($ket_thuc > $tong_trang){
        $ket_thuc = $tong_trang;
    }
    echo '<p><b>Giá trị trên mỗi trang: </b></p>';
    echo '<div id="in-so">';
    for($j = $bat_dau; $j < $ket_thuc; $j++ ){
        echo $mang[$j];
        echo '<br>';
        echo '<hr>';
    }
    echo '</div>';
    echo '<hr>';
    if($tong_trang > 0){
        $list_page = '<table border = "1" style="border: none"><tr>';
        $so_page = ceil($tong_trang / $c);
        if($page_now > 1){
            $page = $page_now - 1;
            $list_page .= '<td><a href = "'."paginator.php".'?page='.$page.'&a='.$a.'&b='.$b.'&c='.$c.'">'.'Prev</a></td>';
        }
        if($so_page > 1){
            for($i = 1; $i <= $so_page; $i++){
                if($i == $page_now){
                    $list_page .= '<td><a href = "'."paginator.php".'?page='.$i.'&a='.$a.'&b='.$b.'&c='.$c.'" style="color: red; font-weight:bold">'.$i.'</a></td>';
                }else{
                    $list_page .= '<td><a href = "'."paginator.php".'?page='.$i.'&a='.$a.'&b='.$b.'&c='.$c.'">'.$i.'</a></td>';
                }
            }
        }
        if($page_now < $so_page){
            $page = $page_now + 1;
            $list_page .= '<td><a href = "'."paginator.php".'?page='.$page.'&a='.$a.'&b='.$b.'&c='.$c.'">'.'Next</a></td>';
        }
        $list_page .= "</tr></table>";
    }
    echo $list_page;
}
if(isset($_POST['submit'])){
    $a = isset ( $_POST["a"] ) ? $_POST["a"] : -1;
    $b = isset ( $_POST["b"] ) ? $_POST["b"] : -1;
    $c = isset ( $_POST["c"] ) ? $_POST["c"] : -1;
}else{
    $a = isset ( $_GET["a"] ) ? intval ( $_GET["a"] ) : -1;
    $b = isset ( $_GET["b"] ) ? intval ( $_GET["b"] ) : -1;
    $c = isset ( $_GET["c"] ) ? intval ( $_GET["c"] ) : -1;
}
$page_now = isset ( $_GET["page"] ) ? intval ( $_GET["page"] ) : 1;
if($page_now == 0){
    $page_now = 1;
}
if($a != -1 && $b != -1 && $c != -1 && $page_now > 0){
    if(is_numeric($a) && is_numeric($b) && is_numeric($c)){
        if((int)$a == floatval($a) && (int)$b == floatval($b) && (int)$c == floatval($c)){
            if($b < $a){
                echo '<div id="danh-sach">';
                echo '<p><b>Danh sách số đã nhập vào</b></p>';
                echo '<p>Số a = '. $a.'</p>';
                echo '<p>Số b = '. $b.'</p>';
                echo '<p>Số c = '. $c.'</p>';
                echo '</div>';
                pagination($a, $b, $c, $page_now);
            }else{
                echo '';
            }
        }else{
            echo '<b>Bạn đã nhập sai giá trị</b>';
        }
    }else {
        echo '<b>Bạn đã nhập sai giá trị</b>';
    }
}


?>