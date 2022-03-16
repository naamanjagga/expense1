<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="left" style="float: left; width: 45%;">
        <table>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="category" id="category">
                        <option value="p_s" selected disabled>Please Select</option>
                        <option value="Grocery">Grocery</option>
                        <option value="Veggies">Veggies</option>
                        <option value="Travelling">Travelling</option>
                        <option value="Miscellaneous">Miscellaneous</option>
                    </select><br>
                </td>
            </tr>
            <tr>
                <td>Item:</td>
                <td><input type="text" id="item" ></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="text" id="price" ></td>
            </tr>
        </table><br>

        <div>
            <button id="btn1" onclick="submit()" >Add</button>
            <button id="btn2"  >Update</button>
        </div>
        <p id="total"></p>
    <h3>Grocery</h3>
     <p>The total for Grocery <p id="para1" ></p></p>
    <div id="Grocery"></div>
    <h3>Veggies</h3>
    <p>The total for Veggies <p id="para2" ></p></p>
    <div id="Veggies"></div>
    <h3>Travelling</h3>
    <p>The total for Travelling <p id="para3" ></p></p>
    <div id="Travelling"> </div> 
    <h3>Miscellaneous</h3>
    <p>The total for Miscellaneous <p id="para4" ></p></p>
    <div id="Miscellaneous"></div>
    </div>
    <div id="right" style="float: left; width: 45%;">
        <table>
            <tr>
                <td>source:</td>
                <td><input type="text" id="source" ></td>
            </tr>
            <tr>
                <td>amount:</td>
                <td><input type="text" id="amount" ></td>
            </tr>
        </table>
        <button id="btn3" onclick="amount()" >Add</button>
        <button id="btn4"  >Update</button>
       
        <div id="main" ></div>
        <div>
           <button id="btn5"  >get diff</button><br>
            <h1 id="diff" ></h1>
        </div>
    </div>
 

</body>
</html>
<script>
 
    var grocery = [];
    var Veggies = [];
    var Travelling = [];
    var Miscellaneous = [];
    var income = [];
function amount() {
    var source = document.getElementById("source").value;
    var amount = parseInt(document.getElementById("amount").value);
    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'income',
            source: source,
            amount: amount
        },
        success:function(data) {
            income = JSON.parse(data);
            calculate(income);
            display5(income);
            
        }
    })
}
var diff = 0;
function calculate(array){
    var T_amount = 0;
    for(var i=0; i<array.length ;i++) {
        T_amount += parseInt(array[i][1]);
    }
    diff = T_amount
    difference()
}
var diff_1 = 0;
function calculate1(){
    var T_amount1 = 0;
    for(var i=0; i<grocery.length ;i++) {
        T_amount1 += parseInt(grocery[i][1]);
    }
    diff_1 = T_amount1
    document.getElementById("para1").innerHTML = T_amount1;
}
var diff_2 = 0;
function calculate2(){
    var T_amount2 = 0;
    for(var i=0; i<Veggies.length ;i++) {
        T_amount2 += parseInt(Veggies[i][1]);
    }
    diff_2 = T_amount2
    document.getElementById("para2").innerHTML = T_amount2;
}
var diff_3 = 0;
function calculate3(){
    var T_amount3 = 0;
    for(var i=0; i<Travelling.length ;i++) {
        T_amount3 += parseInt(Travelling[i][1]);
    }
    diff_3 = T_amount3
    document.getElementById("para3").innerHTML = T_amount3;
}
var diff_4 = 0;
function calculate4(){
    var T_amount4 = 0;
    for(var i=0; i<Miscellaneous.length ;i++) {
        T_amount4 += parseInt(Miscellaneous[i][1]);
    }
    diff_4 = T_amount4
    document.getElementById("para4").innerHTML = T_amount4;
}
function submit(){
    var category = document.getElementById("category").value;
    var item = document.getElementById("item").value;
    var price = document.getElementById("price").value;

    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'add',
            category: category,
            item: item,
            price: price
        },
        success:function(data){
            switch(category) {
                    case 'Grocery':
                        grocery = JSON.parse(data);
                        display1(grocery);
                        break;
                    case 'Veggies':
                        Veggies = JSON.parse(data);
                        display2(Veggies);
                        break;
                    case 'Travelling':
                        Travelling = JSON.parse(data);
                        display3(Travelling);
                        break;
                    case 'Miscellaneous':
                        Miscellaneous = JSON.parse(data);
                        display4(Miscellaneous);
                        break;
            }
            
           
           
        }
    })
}
var u_id1;
function edit1(row){
        $('#btn1').hide();
        $('#btn2').show();
        for (var i = 0; i < grocery.length; i++) {
             if(i == row){
                 u_id1 = i;
                $('#category').val("Grocery");
                $('#item').val(grocery[i][0]);
                $('#price').val(grocery[i][1]);
                  $('#btn2').on('click' ,function() {
                    $('#btn2').hide();
                    $('#btn1').show();
                      var u_category = $('#category').val();
                      var u_item = $('#item').val();
                      var u_price = $('#price').val();
                    $.ajax({
                     url: 'post.php',
                     type: 'post',
                     datatype: 'json',
                     data: {
                         action: 'edit1',
                         u_category: u_category,
                         u_item1: u_item,
                         u_price1: u_price,
                         edit1: u_id1
                     },
                     success:function(data){
                       grocery = JSON.parse(data);
                       display1(grocery);

                   }
                  })
                })
             }
        }
    }
    var u_id2;
    function edit2(row){
        $('#btn1').hide();
        $('#btn2').show();
        for (var i = 0; i < Veggies.length; i++) {
             if(i == row){
                 u_id2 = i;
                $('#category').val("Veggies");
                $('#item').val(Veggies[i][0]);
                $('#price').val(Veggies[i][1]);
                  $('#btn2').on('click' ,function() {
                    $('#btn2').hide();
                    $('#btn1').show();
                    var u_category = $('#category').val();
                      var u_item = $('#item').val();
                      var u_price = $('#price').val();
                    $.ajax({
                     url: 'post.php',
                     type: 'post',
                     datatype: 'json',
                     data: {
                         action: 'edit2',
                         u_category: u_category,
                         u_item2: u_item,
                         u_price2: u_price,
                         edit2: u_id2
                     },
                     success:function(data){
                       Veggies = JSON.parse(data);
                       display2(Veggies);
                   }
                  })
                })
             }
        }
    }
    var u_id3;
    function edit3(row){
        $('#btn1').hide();
        $('#btn2').show();
        for (var i = 0; i < Travelling.length; i++) {
             if(i == row){
                u_id3 = row
                $('#category').val("Travelling");
                $('#item').val(Travelling[i][0]);
                $('#price').val(Travelling[i][1]);
                  $('#btn2').on('click' ,function() {
                    $('#btn2').hide();
                    $('#btn1').show();
                    var u_category = $('#category').val();
                      var u_item = $('#item').val();
                      var u_price = $('#price').val();
                    $.ajax({
                     url: 'post.php',
                     type: 'post',
                     datatype: 'json',
                     data: {
                         action: 'edit3',
                         u_category: u_category,
                         u_item3: u_item,
                         u_price3: u_price,
                         edit3: u_id3
                     },
                     success:function(data){
                       Travelling = JSON.parse(data);
                       display3(Travelling);
                   }
                  })
                })
             }
        }
    }
    var u_id4
    function edit4(row){
        $('#btn1').hide();
        $('#btn2').show();
        for (var i = 0; i < Miscellaneous.length; i++) {
             if(i == row){
                u_id4 = row
                $('#category').val("Miscellaneous");
                $('#item').val(Miscellaneous[i][0]);
                $('#price').val(Miscellaneous[i][1]);
                  $('#btn2').on('click' ,function() {
                    $('#btn2').hide();
                    $('#btn1').show();
                    var u_category = $('#category').val();
                      var u_item = $('#item').val();
                      var u_price = $('#price').val();
                    $.ajax({
                     url: 'post.php',
                     type: 'post',
                     datatype: 'json',
                     data: {
                         action: 'edit4',
                         u_category: u_category,
                         u_item4: u_item,
                         u_price4: u_price,
                         edit4: u_id4
                     },
                     success:function(data){
                       Miscellaneous = JSON.parse(data);
                       display4(Miscellaneous);
                   }
                  })
                })
             }
        }
    }
function del1(x) {
    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'del1',
            row: x
        },
        success:function(data){
            grocery = JSON.parse(data)
            display1(grocery)
        }
    })
}
function del2(x) {
    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'del2',
            row: x
        },
        success:function(data){
            Veggies = JSON.parse(data)
            display2(Veggies)
        }
    })
}
function del3(x) {
    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'del3',
            row: x
        },
        success:function(data){
            Travelling = JSON.parse(data)
            display3(Travelling)
        }
    })
}
function del4(x) {
    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'del4',
            row: x
        },
        success:function(data){
            Miscellaneous = JSON.parse(data)
            display4(Miscellaneous)
        }
    })
}
function del5(x) {
    $.ajax({
        url: 'post.php',
        type: 'post',
        datatype: 'json',
        data: {
            action: 'del5',
            row: x
        },
        success:function(data){
            income = JSON.parse(data)
            display5(income)
            calculate(income)
            difference()
        }
    })
}
var id ;
function edit5(x) {
    $('#btn3').hide();
    $('#btn4').show();
    for(var i =0; i < income.length ;i++ ){
        if(i == x){
             id = x;
        
            $('#source').val(income[i][0]);
            $('#amount').val(income[i][1]);
            $('#btn4').on('click', function() {
                $('#btn3').hide()
                $('#btn4').show();
                var new_source = $('#source').val();
                var new_amount = $('#amount').val();
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    datatype: 'json',
                    data: {
                        action: 'edit5',
                        new_source: new_source,
                        new_amount: new_amount,
                        row: id
                    },
                    success:function(data){
                        income = JSON.parse(data)
                        display5(income)
                        calculate();
                    }
                })
            })
        }

    }
}
function display1(array){
   var html = '<table>'
   for(var i =0; i < array.length ;i++ ){
       html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td><button onclick="edit1('+i+')" >Edit</td></button><td><button onclick="del1('+i+')" id="del'+ i +'">Delete</button></td></tr>'
   }
   html += '</table>';
   document.getElementById("Grocery").innerHTML = html;
   calculate1();
   difference()
}
function display2(array){
    var html = '<table>'
   for(var i =0; i < array.length ;i++ ){
       html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td><button onclick="edit2('+i+')" >Edit</td></button><td><button onclick="del2('+i+')" id="dele'+ i +'">Delete</button></td></tr>'
   }
   html += '</table>'
   document.getElementById("Veggies").innerHTML = html;
   calculate2();
   difference()
}
function display3(array){
    var html = '<table>'
   for(var i =0; i < array.length ;i++ ){
       html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td><button onclick="edit3('+i+')" >Edit</td></button><td><button onclick="del3('+i+')" id="delet'+ i +'">Delete</button></td></tr>'
   }
   html += '</table>'
   document.getElementById("Travelling").innerHTML = html;
   calculate3();
   difference()
}
function display4(array){
    var html = '<table>'
   for(var i =0; i < array.length ;i++ ){
       html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td><button onclick="edit4('+i+')" >Edit</td></button><td><button onclick="del4('+i+')" id="delete'+ i +'">Delete</button></td></tr>'
   }
   html += '</table>'
   document.getElementById("Miscellaneous").innerHTML = html;
   calculate4();
   difference()
}
function display5(array){
    var html = '<table>'
   for(var i =0; i < array.length ;i++ ){
       html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td><button onclick="edit5('+i+')" id="e'+ i +'">Edit</td></button><td><button onclick="del5('+i+')" id="delete'+ i +'">Delete</button></td></tr>'
   }
   html += '</table>'
   difference()
   document.getElementById("main").innerHTML = html;
}
function difference() {
    var new_v = 0;
    new_v =diff_1 + diff_2 + diff_3 + diff_4;
    var naman=0;
    naman = diff - new_v;
        document.getElementById("diff").innerHTML = naman;
    }
</script>