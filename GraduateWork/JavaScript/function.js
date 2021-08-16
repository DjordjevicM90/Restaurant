
function menulist(){ /*On click drink or food name, write in base --(CONFIG.JS)*/

    $(".menu-list").click(function(){ 
   
        let foodName=$(this).data("name");
        let price=$(this).data("price");
        let orderQuantity="1";
        let comment=$("#txt"+$(this).data("txt")).val();
        let employeeName=$("#session-name").data("name");
        let table=$("#numTable").html();
        let category=$(this).data("category");
        let decerase="incerase";

        $.post("sql_query.php?selectAll-order",function(response){
            let obj=JSON.parse(response);
            for(el of obj.data){
                if(el.order_item==foodName && el.section_id==table && el.order_active==0 && el.order_done==0){
                    let valInputNum=el.order_quantity;
                    let id=el.order_id;
                    if(comment!="") comment+=" / "+el.order_comment;
                          
                    else comment+=el.order_comment;
                        
                    valInputNum++;
                    
                    $.post("sql_query.php?update-order",{id:id,valInputNum:valInputNum, comment:comment, foodName:foodName, table:table, category:category, decerase:decerase},function(response){
                        let obj=JSON.parse(response);
                        if(obj.data==""){  
                            $("#bill").html(obj.error).css("display","block");
                            return false;
                        }
                    });
                    displayOrders(table);      
                    return false;
                }
            } 
            $.post("sql_query.php?insert-order",{foodName:foodName, price:price, orderQuantity:orderQuantity, comment:comment, employeeName:employeeName, table:table, category:category},function(response){
                let obj=JSON.parse(response);
                if(obj.data==""){  
                    $("#bill").html(obj.error).css("display","block");
                    return false;
                }
            });  
            displayOrders(table);          
        });

        $("#txt"+$(this).data("txt")).val("");
        $("#bill").css("display","none");
    });

    $("#btn-delete-list").click(function(){      /* Delete button for all inputs elements in div "#temp-order-name"  */
 
        $("#temp-order-name").html("");
      
    });

    $(".menu-list").mouseover(function(){
        $(this).css("transform","scale(1.1)").css({"background-color": "rgba(204, 204, 204, 0.3)", "-webkit-transition": "all .3s","padding":"5px"})
    });
    $(".menu-list").mouseout(function(){
        $(this).css("transform","scale(1)").css({"background-color": "rgba(204, 204, 204, 0)", "-webkit-transition": "all .3s"});
    });

}   /* end menu-list function */

function decerase(){ /* on click button in food and drinks list decerase that artical for one --(CONFIG.JS)*/
    $(".decerase").click(function(){
        let comment="";
        let foodName=$(this).data("name");
        let table=$("#numTable").html();
        let category=$(this).data("category");
        let decerase="decerase";

        $.post("sql_query.php?selectAll-order",function(response){
            let obj=JSON.parse(response);
            for(el of obj.data){
                if(el.order_item==foodName && el.section_id==table && el.order_active==0){
                    let valInputNum=el.order_quantity;
                    let id=el.order_id;

                    if(comment!="") comment+=" / "+el.order_comment;
                          
                    else comment+=el.order_comment;
                        
                    valInputNum--;
                    
                    $.post("sql_query.php?update-order",{id:id, valInputNum:valInputNum, comment:comment, foodName:foodName, table:table, category:category, decerase:decerase},function(response){
                        let obj=JSON.parse(response);
                        if(obj.data=="remove"){
                            $("[data-name=input1]").remove(); 
                        }
                    });

                    displayOrders(table);   
                    return false;
                }
            } 
        });
    });
}   /* end decerase function */

function displayOrders(numTable){ /*Shows all orders from base in div temp-orders --(CONFIG.JS)*/
    $(".tables").css("display","none");
    $(".add-orders").css("display", "block");
    $("#temp-orders").css("display", "block");     
    
    let table="";
    table+="<h3 >Сто бр.</h3>";
    table+="<h3 id='numTable'>"+numTable+"</h3>";
    
    $.post("sql_query.php?order",{numTable:numTable}, function(response)
    {
        let obj=JSON.parse(response);
        let total=0;
        if(obj.data)
        {   
            let z=0;
            let orderName="";

            for(el of obj.data)
            {
                let op1=el.order_price;
                let op2=el.order_quantity;
                let results= op1 * op2 ;
                total+=results;
                z++;
                orderName+="<input type='text'   class='input-field' data-name='input"+z+"' value='"+el.order_item+"'  disabled ><input type='text' class='input-field' data-name='input"+z+"' value='"+el.order_price+" дин' disabled ><input class='input-field' type='text'  data-name='input"+z+"' data-food='"+el.order_item+"' data-table='"+el.section_id+"'  value='"+el.order_quantity+" ком.' disabled><input type='text' data-name='input"+z+"' data-results='calculate' class='input-field' value='"+results+" дин.' disabled><br data-name='input"+z+"'>";

                $("#temp-order-name").html(orderName);
            }  
            $("#total-amount").html("Укупно: "+total+ " дин"); 
        }
      
        $("#btn-save").click(function(){        /*on click this button set colon order_active=1 and show message  */
            $.post("sql_query.php?print-bill",{numTable:numTable},function(response){
                let obj=JSON.parse(response);
                if(obj.data==""){             
                    $("#bill").html(obj.error).css("display","block");
                    return false;
                }
                $("#bill").html(obj.data).css("display","block");
                $("#temp-orders").load(location.href+" #temp-orders>*","");
            }); 
        });  
    });
    $("#title-table").html(table);
}/* end displayOrders function */


function displayStaff(){ /*Shows all employed members from base in div  --(ADMINISTRATOR.JS)*/
    $(".section-adm").css("display","none");
    $("#all-employee").css("display", "block"); 
    $("#data-employee").css("display", "block");
    $(".btn-back").css("display", "block");

    $.post("admin_query.php?select-employee",function(response){
        let obj=JSON.parse(response);
        let staff="";
        if(obj.data){
            for(el of obj.data){
                if(obj.data){
                    staff+="<div class='staff' data-id='"+el.employee_id+"' data-name='"+el.employee_name+"' data-lastname='"+el.employee_lastname+"' data-email='"+el.employee_email+"' data-phone='"+el.employee_phone+"' data-status='"+el.employee_status+"'>"+el.employee_name+" "+el.employee_lastname+" - ("+el.employee_status+")</div>"
                }
            }
        }
        $("#all-employee").html(staff);

        $(".staff").click(function(){
            let id=$("#empId").val($(this).data("id"));
            $("#empName").val($(this).data("name"));
            $("#empLastName").val($(this).data("lastname"));
            $("#empEmail").val($(this).data("email"));
            $("#empPassword").val("");
            $("#empNumber").val($(this).data("phone"));
            $("#empStatus").val($(this).data("status"));
            if(id!="") $("#btn-save-employee").html("Измени корисника");
            else  $("#btn-save-employee").html("Додај корисника");  
        });

    });
}/* end of displayStaff function */

function clean(){
    $("input").val("");
    $("#btn-save-employee").html("Додај корисника"); 
    $("#empStatus").val("0");
    $("#btn-save-item").html("Додај артикал");
    $("#itemStatus").val("0"); 
}

function displayImages(){ /*Shows all images from base  --(ADMINISTRATOR.JS)*/
    $.post("admin_query.php?selectAll-images",function(response){
        let obj=JSON.parse(response);
        img="";
        if(obj.data){
            for(el of obj.data){
                img+="<div class='admin-images'><img src='images/"+el.gallery_name+"' data-name='"+el.gallery_name+"' data-id='"+el.gallery_id+"'></div>";
                $("#all-images").html(img);
                $(".gallery-images").html(img);
            }
        }
        $("img").click(function(){
             $(this).toggleClass("select");  
        });
        
    });

}/* displayImages function */

function displayMenu(){ /*Shows all items from food and drinks tables   --(ADMINISTRATOR.JS)*/
    $(".section-adm").css("display","none");
    $(".wrapper-menu-btn").css("display", "block"); 
    $("#data-menu").css("display", "block");
    $(".btn-back").css("display", "block");

    $.post("sql_query.php?food",function(response){
        let obj=JSON.parse(response);
        let item="";
        if(obj.data){
            for(el of obj.data){
                if(obj.data){
                    item+="<div class='staff' data-id='"+el.food_id+"' data-name='"+el.food_name+"' data-price='"+el.food_price+"' data-status='"+el.food_category_id+"'>"+el.food_name+" "+el.food_price+"</div>"
                }
            }
        }
        $("#all-menu").html(item);

        $(".staff").click(function(){
            let id=$("#itemId").val($(this).data("id"));
            $("#itemName").val($(this).data("name"));
            $("#itemPrice").val($(this).data("price"));
            $("#itemStatus").val($(this).data("status"));
            if(id!="") $("#btn-save-item").html("Измени артикал");
            else  $("#btn-save-item").html("Додај артикал");  
        });
         
    });

    $.post("sql_query.php?drink",function(response){
        let obj=JSON.parse(response);
        let item="";
        if(obj.data){
            for(el of obj.data){
                if(obj.data){
                    item+="<div class='staff' data-id='"+el.drinks_id+"' data-name='"+el.drinks_name+"' data-price='"+el.drinks_price+"' data-status='"+el.drinks_category_id+"'>"+el.drinks_name+" "+el.drinks_price+"</div>"
                }
            }
        }
        $("#all-menu-drinks").html(item);
        
        $(".staff").click(function(){
            let id=$("#itemId").val($(this).data("id"));
            $("#itemName").val($(this).data("name"));
            $("#itemPrice").val($(this).data("price"));
            $("#itemStatus").val($(this).data("status"));
            if(id!="") $("#btn-save-item").html("Измени артикал");
            else  $("#btn-save-item").html("Додај артикал");  
        });
    });

}/* end of displayMenu function */

function displayOrdersAdmin(numTable){

    $("#all-orders").css("display", "block");
    
    $.post("admin_query.php?order-tables-admin",{numTable:numTable}, function(response)
    {
        let obj=JSON.parse(response);
        let total=0;
        if(obj.data)
        {   
            let n=0;
            let list="";
            for(el of obj.data)
            {
                let op1=el.order_price;
                let op2=el.order_quantity;
                let results= op1 * op2 ;

                total+=results;

                n++

                list+="<input type='text' class='list' value='"+n+": "+el.order_item+"' disabled><input type='text' class='list' value='"+el.order_price+" дин.' disabled><input type='text' class='list' value='"+el.order_quantity+" ком.' disabled><input type='text' class='list' data-results='calculate' value='"+results+" дин.' disabled ><input type='text' class='list' value='"+el.employee_name+" (Име запосленог)'disabled><input type='text' class='list' value='"+el.section_name+"' disabled><input type='text' class='list' value='"+el.order_time+" (време)' disabled><br>";

                $("#all-orders").html(list);
            }  
        } 
        $("#total-amount-admin").html("Укупна зарада за овај сто износи: "+total+ " дин").css("padding","40px").css("display","block");        
    });     
}

function back(){
        $(".section-adm").css("display","block");
        $("#all-employee").css("display", "none");
        $("#data-employee").css("display", "none");
        $("#answer").html("");
        $("#wrapper-gallery").css("display", "none");    
        $(".admin-images").css("display", "none");
        $("#answer-image").css("display", "none");
        $("#answer-image").html("");
        $(".wrapper-menu-btn").css("display", "none");
        $("#data-menu").css("display", "none");
        $("#answer-menu").html("");
        $(".all-statistics").css("display", "none");
        $(".btn-back").css("display", "none");
        $("#wrapper-select").css("display","none");
        $("#input-header").css("display","none");
        $(".list").css("display","none");
        $("#wrapper-tables-admin").css("display","none");
        $("#all-orders").css("display","none");
        $("#wrapper-reservation").css("display","none");
        $("#total-amount-admin").css("display","none");
}

function exclMarkShow() {
    $(".excl-mark").fadeIn(1000); 
    
 }
 function exclMarkHide() {
      $(".excl-mark").fadeOut(1000);
 }