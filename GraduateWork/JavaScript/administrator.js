/*JQuery - this part of code refers on pages administrator.php*/

$(function(){
/*------------------------------
JQuery - Administrator.php 
------------------------------- */

    /*------------------------------
    JQuery - div - wrapper-employee
    ------------------------------- */
        $(".section-adm").mouseover(function(){
            $(this).css("transform","scale(1.1)").css("transition-timing-function", "linear").css("-webkit-transition", "all .3s");
        });
        $(".section-adm").mouseout(function(){
            $(this).css("transform","scale(1)").css("transition-timing-function", "linear").css("-webkit-transition", "all .3s");
        });


        // JQuery - add or delete employed memeber

        $("#employee-add-delete").click(function(){
            displayStaff();
            $(".btn-back").click(function(){
               back();
               clean();
            });
        });

        // JQuery - on click btn-save-employee add or update employed memeber
        $("#btn-save-employee").click(function(){
            let id=$("#empId").val();
            let name=$("#empName").val();
            let lastName=$("#empLastName").val();
            let email=$("#empEmail").val();
            let password=$("#empPassword").val();
            let phone=$("#empNumber").val();
            let status=$("#empStatus").val();

            if(id==""){
                $.post("admin_query.php?insert-employee",{name:name, lastName:lastName, email:email, password:password, phone:phone, status:status},function(response){
                    let obj=JSON.parse(response);

                    if(obj.data==""){
                        $("#answer").html(obj.error).css("color", "red");
                        return false;
                    } 
                    $("#answer").html(obj.data).css("color", "green");
                });
                displayStaff();
            }
            else{
                $.post("admin_query.php?update-employee",{id:id, name:name, lastName:lastName, email:email, password:password, phone:phone, status:status},function(response){
                    let obj2=JSON.parse(response);

                    if(obj2.data==""){
                        $("#answer").html(obj2.error).css("color", "red");
                        return false;
                    } 
                    $("#answer").html(obj2.data).css("color", "green");
                });
            }
            displayStaff();
        });

        // JQuery - on click btn-delete-employee delete employed memeber
        $("#btn-delete-employee").click(function(){
            let id=$("#empId").val();
            if(id==""){
                $("#answer").html("*Одаберите корисника").css("color", "red");
            }
            else{
                if(!confirm("Желите да обришете корисника?")) return false;
                $.post("admin_query.php?delete-employee",{id:id},function(response){
                    let obj3=JSON.parse(response);
        
                    if(obj3.data==""){
                        $("#answer").html(obj3.error).css("color", "red");
                        return false;
                    } 
                    $("#answer").html(obj3.data).css("color", "green");
        
                })
                displayStaff();
                clean();
            }
        });

        $("#btn-clean-input").click(function(){
            clean();
        });
    /*------------------------------
    JQuery - end of div - wrapper-employee
    ------------------------------- */

    /*------------------------------
    JQuery - div - wrapper-gallery
    ------------------------------- */
        $("#gallery-add-delete").click(function(){
            $("#add-img").css("display","block");
            $(".section-adm").css("display","none");
            $(".btn-back").css("display", "block");
            $("#wrapper-gallery").css("display", "block");

            displayImages();  

            $(".btn-back").click(function(){
                back();
                location.reload(true);
            });
            
            $("#btn-addImg").click(function(){ //add image 
                $.ajax({
                    url: "admin_query.php?add-image",
                    type: "POST",
                    data:  new FormData(document.getElementById('add-img')),
                    contentType: false,
                    processData: false,
                    success: function(response){
                        let obj=JSON.parse(response);
                        
                        if(obj.data) $("#answer-image").html(obj.data);
                        else $("#answer-image").html(obj.error).css("display","block");
                        $("input").val(null); 
                        displayImages();                    
                    }  
                });
            });

            $("#btn-deleteImg").click(function(){ //remove one or more images in same time
                if($(".select").length){
                    $('.select').each(function(){
                        let imgForDelete=($(this).attr('data-id'));
                        let nameImg=($(this).attr('data-name'));
                        $.post("admin_query.php?delete-image",{imgForDelete:imgForDelete, nameImg:nameImg},function(response){
                            let obj4=JSON.parse(response);
            
                            if(obj4.data==""){
                                $("#answer-image").html(obj4.error).css("color", "red");
                                return false;
                            }
                            $("#answer-image").html(obj4.data).css("color", "green");
                        });
                    });
                    $(".select").remove();
                }
                else $("#answer-image").html("Нисте одабрали слику за брисање.");
            });
           
        });
    /*------------------------------
    JQuery - end of div - wrapper-gallery
    ------------------------------- */


    /*------------------------------
    JQuery - div - wrapper-menu
    ------------------------------- */

    $("#menu-add-delete").click(function(){
       
        displayMenu();
        $(".btn-back").click(function(){
            back();
            clean();
         });
    });

    $("#btn-save-item").click(function(){
        let id=$("#itemId").val();
        let name=$("#itemName").val();
        let price=$("#itemPrice").val();
        let category=$("#itemStatus").val();
        let categoryType= $("#itemStatus").find(':selected').data('type');
        
        if(id==""){
            $.post("admin_query.php?insert-item",{name:name, price:price, category:category, categoryType:categoryType},function(response){
                let objitem=JSON.parse(response);

                if(objitem.data==""){
                    $("#answer-menu").html(objitem.error).css("color", "red");
                    return false;
                } 
                $("#answer-menu").html(objitem.data).css("color", "green");
                displayMenu();
            });
        }
        else{
            $.post("admin_query.php?update-item",{id:id, name:name, price:price, category:category, categoryType:categoryType},function(response){
                let objitem=JSON.parse(response);

                if(objitem.data==""){
                    $("#answer-menu").html(objitem.error).css("color", "red");
                    return false;
                } 
                $("#answer-menu").html(objitem.data).css("color", "green");
                displayMenu();
            });         
        }       
        clean(); 
    });

     // JQuery - on click btn-delete-item delete food or drink from menu
     $("#btn-delete-item").click(function(){
        let id=$("#itemId").val();
        let categoryType= $("#itemStatus").find(':selected').data('type');

        if(id==""){
            $("#answer-menu").html("*Одаберите артикал").css("color", "red");
        }
        else{
            if(!confirm("Желите да обришете артикал?")) return false;
            $.post("admin_query.php?delete-item",{id:id, categoryType:categoryType},function(response){
                let objitem=JSON.parse(response);
    
                if(objitem.data==""){
                    $("#answer-menu").html(objitem.error).css("color", "red");
                    return false;
                } 
                $("#answer-menu").html(objitem.data).css("color", "green");
                displayMenu();
            });
            clean();
        }
    });
        
    $("#btn-clean-input-item").click(function(){
        clean();
    });

     /*------------------------------
    JQuery - end of div - wrapper-menu
    ------------------------------- */

    /*------------------------------
    JQuery - div - wrapper-select
    ------------------------------- */
    $("#orders-overview").click(function(){
        $(".section-adm").css("display","none");
        $(".btn-back").css("display", "block");
        $("#wrapper-select").css("display","block");
        $("#all-orders").css("display","block").html("");
        $("#input-header").css("display","flex");

        $("#btn-select").click(function(){
            let select=$("#select").val();
            switch (select){
                case "1":
                    $("#input-header").css("display","flex");
                    $("#all-orders").css("display","block");
                    $("#wrapper-tables-admin").css("display","none");
                    $("#total-amount-admin").css("display","none");

                    $.post("admin_query.php?all-orders",function(response){
                        let obj=JSON.parse(response);
                        let list="";
                        let n=0;
                        if(obj.data){
                            for(el of obj.data){
                                let op1=el.order_price;
                                let op2=el.order_quantity;
                                let results= op1 * op2 ;

                                n++
                                list+="<input type='text' class='list' value='"+n+": "+el.order_item+"' disabled><input type='text' class='list' value='"+el.order_price+" дин.' disabled><input type='text' class='list' value='"+el.order_quantity+" ком.' disabled><input type='text' class='list' data-results='calculate' value='"+results+" дин.' disabled ><input type='text' class='list' value='"+el.employee_name+" (Име запосленог)'disabled><input type='text' class='list' value='"+el.section_name+"' disabled><input type='text' class='list' value='"+el.order_time+" (време)' disabled><br>";
                                
                                $("#all-orders").html(list);
                            }
                        }
                    });
                break;
    
                case "2": 
                    $("#all-orders").css("display","none");
                    $("#wrapper-tables-admin").css("display","flex");
                    $("#input-header").css("display","flex");

                    $(".tables-admin").click(function()
                    {
                        let x=$(this).attr("id");
                        displayOrdersAdmin(x);
                    });  
                break;
    
                case "3":
                    $("#all-orders").css("display","none");
                    $("#wrapper-tables-admin").css("display","none");
                    $("#input-header").css("display","none");
                    $("#total-amount-admin").css("display","none");

                    $.post("admin_query.php?food-admin",function(response){
                        let obj=JSON.parse(response);
        
                        if(obj.data)
                        {   
                            n=0;
                            let list="";
                
                            for(el of obj.data)
                            {                              
                                n++
                                list+="<input type='text' class='list' value='"+n+": "+el.food_name+"' disabled>";
                                list+="<input type='text' class='list' value='"+el.food_price+" дин.' disabled>";
                                list+="<input type='text' class='list' value='"+el.food_quantity+" ком.' disabled><br>";
                                              
                                $("#all-orders").html(list);
                            }  
                        } 
                        $("#all-orders").css("display","block");
                    });
                break;
    
                case "4":
                    $("#all-orders").css("display","none");
                    $("#wrapper-tables-admin").css("display","none");
                    $("#input-header").css("display","none");
                    $("#total-amount-admin").css("display","none");

                    $.post("admin_query.php?drinks-admin",function(response){
                        let obj=JSON.parse(response);
        
                        if(obj.data)
                        {   
                            n=0;
                            let list="";
                
                            for(el of obj.data)
                            {                              
                                n++
                                list+="<input type='text' class='list' value='"+n+": "+el.drinks_name+"' disabled>";
                                list+="<input type='text' class='list' value='"+el.drinks_price+" дин.' disabled>";
                                list+="<input type='text' class='list' value='"+el.drinks_quantity+" ком.' disabled><br>";
                                              
                                $("#all-orders").html(list);
                            }  
                        } 
                        $("#all-orders").css("display","block");
                    });
                break;
            }
        });

        $(".btn-back").click(function(){
            back();
         });
    });
    /*------------------------------
    JQuery - end of div - wrapper-select
    ------------------------------- *

    /*------------------------------
    JQuery - div - wrapper-reservation
    ------------------------------- */
    
    $("#reservation-overview").click(function(){

        $(".section-adm").css("display","none");
        $(".btn-back").css("display", "block");
        $("#wrapper-reservation").css("display","block");

        $.post("admin_query.php?admin-reservation", function(response){
            let obj=JSON.parse(response);
            let n=0;
            let reservation="";
            if(obj.data){
                
                for(el of obj.data){
                    n++
                    //show all reservations that have been deleted
                     reservation+="<div data-delete='res"+n+"'><h4>Резервација бр. "+n+"</h4><div class='rese-data'>Име и презиме: "+el.reservation_name+ " " +el.reservation_lastname+"</div><div class='rese-data'>E-адреса: "+el.reservation_email+"</div> <div class='rese-data'>Телефон: "+el.reservation_phone+"</div> <div class='rese-data'>Бр. гостију: "+el.reservation_num_customer+"</div> <div class='rese-data'>Датум: "+el.reservation_date+"</div> <div class='rese-data'>Време: "+el.reservation_time+"</div> <div class='rese-data'>Напомена: "+el.reservation_note+"</div></div>";
    
                    $("#wrapper-reservation").html(reservation);   
                }
            }
        });

        $(".btn-back").click(function(){
            back();
        });
    });


    /*------------------------------
    JQuery - div - wrapper-statistics
    ------------------------------- */
        $("#employee-statistics").click(function(){
            $(".section-adm").css("display","none");
            $("#all-orders").css("display","none");
            $(".btn-back").css("display", "block");
            $(".all-statistics").css("display","block");

            $(".btn-back").click(function(){
                back();
            });
        });
    /*------------------------------
    JQuery - end of div - wrapper-statistics
    ------------------------------- */
    
 
/*------------------------------
END OF
JQuery - Administrator.php  
------------------------------- */

});/*End of JQuery */