<?php
   session_start();
   //session_destroy();
   if(!isset($_SESSION['grocery'])){
    $_SESSION['grocery'] = array();
   }
   if(!isset($_SESSION['veggies'])){
    $_SESSION['veggies'] = array();
   }
   if(!isset($_SESSION['travelling'])){
    $_SESSION['travelling'] = array();
   }
   if(!isset($_SESSION['mis'])){
    $_SESSION['mis'] = array();
   }
   if(!isset($_SESSION['income'])){
    $_SESSION['income'] = array();
   }
?>
<?php
    if(isset($_POST['action']) && $_POST['action'] == 'add'){
        switch($_POST['category']) {
            case 'Grocery':
                $array = array($_POST['item'] ,$_POST['price']);
                array_push($_SESSION['grocery'] ,$array);
                echo json_encode($_SESSION['grocery']);
                break;
            case 'Veggies':
                $array = array($_POST['item'] ,$_POST['price']);
                array_push($_SESSION['veggies'] ,$array);
                echo json_encode($_SESSION['veggies']);
                break;
            case 'Travelling':
                $array = array($_POST['item'] ,$_POST['price']);
                array_push($_SESSION['travelling'] ,$array);
                echo json_encode($_SESSION['travelling']);
                break;
            case 'Miscellaneous':
                $array = array($_POST['item'] ,$_POST['price']);
                array_push($_SESSION['mis'] ,$array);
                echo json_encode($_SESSION['mis']);
                break;
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'del1'){
        array_splice($_SESSION['grocery'],$_POST['row'],1);
        echo json_encode($_SESSION['grocery']);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'del2'){
        array_splice($_SESSION['veggies'],$_POST['row'],1);
        echo json_encode($_SESSION['veggies']);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'del3'){
        array_splice($_SESSION['travelling'],$_POST['row'],1);
        echo json_encode($_SESSION['travelling']);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'del4'){
        array_splice($_SESSION['mis'],$_POST['row'],1);
        echo json_encode($_SESSION['mis']);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'del5'){
        array_splice($_SESSION['income'],$_POST['row'],1);
        echo json_encode($_SESSION['income']);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'edit1'){
       if($_POST['u_category'] == 'Grocery') {
        $array1 = array($_POST['u_item1'] ,$_POST['u_price1']);
        array_splice($_SESSION['grocery'][$_POST['edit1']],0,2,$array1);
        echo json_encode($_SESSION['grocery']);
       }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'edit2'){
        if($_POST['u_category'] == 'Veggies') {
        $array2 = array($_POST['u_item2'] ,$_POST['u_price2']);
        array_splice($_SESSION['veggies'][$_POST['edit2']],0,2,$array2);
        echo json_encode($_SESSION['veggies']);
        }
    }
    // if(isset($_POST['action']) && $_POST['action'] == 'edit3'){
       
    //     if($_POST['u_category'] == 'Travelling') {
    //     $array3 = array($_POST['u_item3'] ,$_POST['u_price3']);
    //     array_splice($_SESSION['travelling'][$_POST['edit3']],0,2,$array3);
    //     echo json_encode($_SESSION['travelling']);
    //     }
    // }
    if(isset($_POST['action']) && $_POST['action'] == 'edit3'){
        if($_POST['u_category'] == 'Travelling') {
        $array3 = array($_POST['u_item3'] ,$_POST['u_price3']);
        array_splice($_SESSION['travelling'][$_POST['edit3']],0,2,$array3);
        echo json_encode($_SESSION['travelling']);
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'edit4'){
        if($_POST['u_category'] == 'Miscellaneous') {
        $array4 = array($_POST['u_item4'] ,$_POST['u_price4']);
        array_splice($_SESSION['mis'][$_POST['edit4']],0,2,$array4);
        echo json_encode($_SESSION['mis']);
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'edit5'){
        $array4 = array($_POST['new_source'] ,$_POST['new_amount']);
        array_splice($_SESSION['income'][$_POST['row']],0,1,$array4);
        echo json_encode($_SESSION['income']);
    }
    if(isset($_POST['action']) && $_POST['action'] == 'income'){
        $income_array = array( $_POST['source'] , $_POST['amount'] );
          array_push( $_SESSION['income'] ,$income_array);
        echo json_encode($_SESSION['income']);
    }
    
?>