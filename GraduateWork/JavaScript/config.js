/*JQuery - this part of code refers on pages index.php and table.php*/


$(function(){

/*------------------------------
onEvent scroll for DIV Header
------------------------------- */    
    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $("#header").addClass("scrollHeader").removeClass("backgroundHeader");
        } else {
            $("#header").removeClass("scrollHeader").addClass("backgroundHeader");
        }
    });
/*------------------------------
Function Toggle for DIV AboutUs
------------------------------- */

    $(".AU-img").mouseover(function(){
        $(this).animate({"width":"120px","height":"120px"});
    });
    $(".AU-img").mouseleave(function(){
        $(this).animate({"width":"100px","height":"100px"});
    });

/*------------------------------
JQuery - food name and price for MENU section and TABLES.php
------------------------------- */

    $.post("sql_query.php?food", function(response){
        let obj=JSON.parse(response);
        if(obj.data)
        {
            for(el of obj.data)
            {
                switch (el.food_category_id)
                {
                    case "1":
                        let breakfast= $("<div  id='food"+el.food_id+"' class='menu-list' data-name='"+el.food_name+"'  data-txt='"+el.food_id+"' data-price="+el.food_price+" data-category='food'> <div>"+el.food_name+"</div>  <div>"+el.food_price+" дин</div> </div>");

                        let buttonBreakfast= $("<button class='decerase' data-name='"+el.food_name+"' data-category='food'>Умањи</button>");
                        let buttonCommBreakfast=$("<button  class='btn-comment' data-slide='"+el.food_id+"' data-name='"+el.food_name+"'>Коментар</button><br>");
                        let textAreaBreakfast=$("<textarea id='txt"+el.food_id+"' class='textarea' rows='5' cols='50' placeholder='Унесите коментар'></textarea>");
                        
                        $("#menu-description-breakfast").append(breakfast);
                        $("#food-breakfast").append(breakfast).append(buttonBreakfast).append(buttonCommBreakfast).append(textAreaBreakfast);
                    break;
                    case "2":
                        let grill= $("<div id='food"+el.food_id+"' class='menu-list' data-txt='"+el.food_id+"' data-name='"+el.food_name+"' data-price="+el.food_price+" data-category='food'> <div>"+el.food_name+"</div>  <div>"+el.food_price+" дин</div> </div>");
                        
                        let buttonGrill= $("<button class='decerase' data-name='"+el.food_name+"' data-category='food'>Умањи</button>");
                        let buttonCommGrill=$("<button  class='btn-comment' data-slide='"+el.food_id+"' data-name='"+el.food_name+"'>Коментар</button><br>");
                        let textAreaGrill=$("<textarea id='txt"+el.food_id+"' class='textarea' rows='5' cols='50' placeholder='Унесите коментар'></textarea>");

                        $("#menu-description-grill").append(grill);
                        $("#food-grill").append(grill).append(buttonGrill).append(buttonCommGrill).append(textAreaGrill);
                    break;
                    case "3":
                        let salad= $("<div  id='food"+el.food_id+"' class='menu-list' data-name='"+el.food_name+"' data-txt='"+el.food_id+"' data-price="+el.food_price+" data-category='food'> <div>"+el.food_name+"</div>  <div>"+el.food_price+" дин</div> </div>");

                        let buttonSalad= $("<button class='decerase' data-name='"+el.food_name+"' data-category='food'>Умањи</button>");
                        let buttonCommSalad=$("<button  class='btn-comment' data-slide='"+el.food_id+"' data-name='"+el.food_name+"'>Коментар</button><br>");
                        let textAreaSalad=$("<textarea id='txt"+el.food_id+"' class='textarea' rows='5' cols='50' placeholder='Унесите коментар'></textarea>");

                        $("#menu-description-salad").append(salad);
                        $("#food-salad").append(salad).append(buttonSalad).append(buttonCommSalad).append(textAreaSalad);
                    break;
                    case "4":
                        let soup= $("<div  id='food"+el.food_id+"' class='menu-list' data-name='"+el.food_name+"'  data-txt='"+el.food_id+"' data-price="+el.food_price+" data-category='food'> <div>"+el.food_name+"</div>  <div>"+el.food_price+" дин</div> </div>");

                        let buttonSoup= $("<button class='decerase' data-name='"+el.food_name+"' data-category='food'>Умањи</button>");
                        let buttonCommSoup=$("<button  class='btn-comment' data-slide='"+el.food_id+"' data-name='"+el.food_name+"'>Коментар</button><br>");
                        let textAreaSoup=$("<textarea id='txt"+el.food_id+"' class='textarea' rows='5' cols='50' placeholder='Унесите коментар'></textarea>");

                        $("#menu-description-soup").append(soup);
                        $("#food-soup").append(soup).append(buttonSoup).append(buttonCommSoup).append(textAreaSoup);
                }
            }
        }
        $(".btn-comment").click(function(){
            $("#txt"+$(this).data("slide")).slideToggle(500);
            $("#txt"+$(this).data("slide")).val("");
        });
       
    });
       
    $("#grill").click(function(){
        $("#menu-description-grill").slideToggle(1000);
    });
    $("#breakfast").click(function(){
         
        $("#menu-description-breakfast").slideToggle(1000);
    });
    $("#salad").click(function(){
        $("#menu-description-salad").slideToggle(1000);
    });
    $("#soup").click(function(){
        $("#menu-description-soup").slideToggle(1000);
    });

/*------------------------------
END OF
JQuery - food name and price for MENU section
------------------------------- */

/*------------------------------
JQuery - drinks name and price for TABLES.php page
------------------------------- */  
$.post("sql_query.php?drink", function(response){
   
    let obj=JSON.parse(response);

    if(obj.data){
        for(el of obj.data)
        {           
            switch (el.drinks_category_id)
            {
                case "5":
                    let beerName= $("<div id='drink"+el.drinks_id+"' class='menu-list' data-name='"+el.drinks_name+"' data-txt='"+el.drinks_id+"' data-price="+el.drinks_price+" data-category='drink'> <div>"+el.drinks_name+"</div> <div >"+el.drinks_price+" дин</div> </div>");
                    let buttonbeer= $("<button class='decerase' data-name='"+el.drinks_name+"' data-category='drink'>Умањи</button>");
                    let textAreaBeer= $("<textarea id='txt"+el.drinks_id+"' value='no comment'></textarea>").css("display","none"); //if click any drink beer as comment forward empty string

                    $("#drinks-beer").append(beerName).append(buttonbeer).append(textAreaBeer); 

                break;
                case "6":
                    let whiskeyName= $("<div id='drink"+el.drinks_id+"' class='menu-list'  data-name='"+el.drinks_name+"' data-txt='"+el.drinks_id+"' data-price="+el.drinks_price+" data-category='drink'> <div>"+el.drinks_name+"</div>  <div >"+el.drinks_price+" дин</div> </div>");
                    let buttonWhiskey= $("<button class='decerase' data-name='"+el.drinks_name+"' data-category='drink'>Умањи</button>");
                    let textAreaWhiskey= $("<textarea id='txt"+el.drinks_id+"' value='no comment'></textarea>").css("display","none"); // -||-

                    $("#drinks-whiskey").append(whiskeyName).append(buttonWhiskey).append(textAreaWhiskey);  

                break;
                case "7":
                    let juiceName= $("<div id='drink"+el.drinks_id+"'  class='menu-list'  data-name='"+el.drinks_name+"' data-txt='"+el.drinks_id+"' data-price="+el.drinks_price+" data-category='drink'> <div >"+el.drinks_name+"</div>  <div>"+el.drinks_price+" дин</div> </div>");
                    let buttonJuice= $("<button class='decerase' data-name='"+el.drinks_name+"' data-category='drink'>Умањи</button>");
                    let textAreaJuice= $("<textarea id='txt"+el.drinks_id+"' value='no comment'></textarea>").css("display","none"); // -||-

                    $("#drinks-juice").append(juiceName).append(buttonJuice).append(textAreaJuice); 

                break;
            }
        }      
    } 
    decerase();
    menulist(); 
});


/*------------------------------
END OF
JQuery - drinks name and price for TABLES.php page
------------------------------- */

/*------------------------------
Gallery
------------------------------- */
$.post("admin_query.php?selectAll-images",function(response){
    let obj=JSON.parse(response);
    let n=0;
    if(obj.data){
        
        for(el of obj.data){
            n++;
            let img=$("<div class='parent'><img class='gallery-img' src='images/"+el.gallery_name+"' data-name='"+el.gallery_name+"' data-number='"+n+"'></div>");
            $(".gallery-images").append(img);
           
        }
    }
    n=1;
    let nameImg=$("[data-number='"+n+"']").data("name");
    $("#gallery-first-img").attr("src","images/"+nameImg);
    
    $(".gallery-img").click(function(){
        n=$(this).data("number");
        $("#gallery-first-img")
        .hide().stop()
        .attr("src",$(this).attr("src"))
        .css({"opacity": "0"})
        .show()
        .animate({"opacity":"1"}, 1000);
    });

    $(".next").click(function(){        
        if($(".parent").length == n) n=0;
        n++;
        nameImg=$("[data-number="+n+"]").data("name");
        $("#gallery-first-img")
        .hide()
        .stop()
        .attr("src","images/"+nameImg)
        .css({"opacity": "0"})
        .show()
        .animate({"opacity":"1"}, 1000);  
            
    });

    $(".prev").click(function(){
        n--;       
        if(n<=0) n=$(".parent").length;

        nameImg=$("[data-number="+n+"]").data("name");
        $("#gallery-first-img")
        .hide()
        .stop()
        .attr("src","images/"+nameImg)
        .css({"opacity": "0"})
        .show()
        .animate({"opacity":"1"}, 1000);
    });
});

/*------------------------------
END OF
Gallery
------------------------------- */

/*------------------------------
JQuery - log in for employee_users 
------------------------------- */
    $("#login").click(function(){
        let email=$("#email").val();
        let password=$("#password").val();
        let remember=$("#remember").is(":checked");
        if(remember==true) remember="1";
        else remember="0";

        if(email!="" && password!="")
        {
            $.ajax({
                url: "sql_query.php?login",
                data: {email:email, password:password, remember:remember},
                type: "POST",
                success: function(response){
                    answer=JSON.parse(response);

                    if(answer.error!="")
                    {
                        $("#loginError").text(answer.error);
                    }
                    else
                    {
                        window.location.assign(answer.location);
                    }
                }
            });
        }
        else
        {
            $("#loginError").text("*Попуните сва поља");
        }
    });

/*------------------------------
JQuery - Orders for table 
------------------------------- */

    $(".tables").click(function()
    {
        let x=$(this).attr("id");
        displayOrders(x);
    });  
    
    
/*------------------------------
JQuery - Reservation
------------------------------- */

//for a customer to reserve a table
    $("#btn-reservation").click(function(){ 
        let name=$("#name").val();
        let lastname=$("#lastName").val();
        let email=$("#email").val();
        let phone=$("#phone").val();
        let numcustomer=$("#numCustomer").val();
        let date=$("#date").val();
        let time=$("#time").val();
        let note=$("#note").val();

        if(name!="" && lastname!="" && email!="" && phone!="" && numcustomer!="" && date!="" && time!=""){
             $.post("sql_query.php?reservation",{name:name, lastname:lastname, email:email, phone:phone, numcustomer:numcustomer, date:date, time:time, note:note}, function(response){
                answer=JSON.parse(response);

                if(answer.error!="")
                {
                    $("#output-reservation").text(answer.error);
                }
                else
                {
                    $("#output-reservation").text(answer.data).css("color","green");
                    $(".input-reservation").val("");
                    $("#note").val("");
                }
            });
        }
        else{
            $("#output-reservation").text("Сва поља маркирана са * су обавезна.");
        }
    });

//administrator and assistant to confirm a reservation

    $.post("sql_query.php?all-reservation", function(response){
        let obj=JSON.parse(response);
        let n=0;
        if(obj.data){

            for(el of obj.data){
                n++
                //show all reservations that have not been deleted
                let reservation=$("<div data-delete='res"+n+"'><h4>Резервација бр. "+n+"</h4><div class='rese-data'>Име и презиме: "+el.reservation_name+ " " +el.reservation_lastname+"</div><div class='rese-data'>E-адреса: "+el.reservation_email+"</div> <div class='rese-data'>Телефон: "+el.reservation_phone+"</div> <div class='rese-data'>Бр. гостију: "+el.reservation_num_customer+"</div> <div class='rese-data'>Датум: "+el.reservation_date+"</div> <div class='rese-data'>Време: "+el.reservation_time+"</div> <div class='rese-data'>Напомена: "+el.reservation_note+"</div></div>");

                if(el.reservation_confirm!=1)
                {
                    //if reservation not confirm then show regural button
                    let buttonCon=$("<button id='btn-confirm"+n+"' class='button-res' data-id='"+el.reservation_id+"' data-email='"+el.reservation_email+"' data-delete='res"+n+"'>Потврди резервацију</button>");
                    let buttonDel=$("<button  class='button-del' data-id='"+el.reservation_id+"' data-email='"+el.reservation_email+"'  data-delete='res"+n+"'>Обриши резервацију</button><hr data-delete='res"+n+"'>");
                    $("#wrapper-res-employee").append(reservation).append(buttonCon).append(buttonDel);

                    setInterval(exclMarkShow);
                    setInterval(exclMarkHide);
                }
                else
                {
                    //if reservation confirm then show confirm button set on disabled and change it his html
                    let buttonCon=$("<button id='btn-confirm"+n+"' class='button-res' data-id='"+el.reservation_id+"' data-email='"+el.reservation_email+"' data-delete='res"+n+"' disabled>Потврђена резервација</button>");
                    let buttonDel=$("<button  class='button-del' data-id='"+el.reservation_id+"' data-email='"+el.reservation_email+"' data-delete='res"+n+"'>Обриши резервацију</button><hr data-delete='res"+n+"'>");

                    $("#wrapper-res-employee").append(reservation).append(buttonCon).append(buttonDel);
                    

                    //show all confirm reservetions for staff
                    let reservationStaff=$("<h4>Резервација бр. "+n+"</h4><div class='rese-data'>Име и презиме: "+el.reservation_name+ " " +el.reservation_lastname+"</div> <div class='rese-data'>Бр. гостију: "+el.reservation_num_customer+"</div> <div class='rese-data'>Датум: "+el.reservation_date+"</div> <div class='rese-data'>Време: "+el.reservation_time+"</div> <div class='rese-data'>Напомена: "+el.reservation_note+"</div> <hr>");

                    $("#wrapper-res-staff").append(reservationStaff);
                   
                }
            }
        }

        //button for confirm reservetion 
        $(".button-res").click(function(){
            let nameid=$(this).data("id");
            let id=$(this).attr("id");
            let empname=$("#session-name").data("name");
            let email=$(this).data("email");

            $.post("sql_query.php?confirm",{nameid:nameid,empname:empname,email:email},function(response){
                let obj=JSON.parse(response);

                if(obj.data==""){
                    $("#wrapper-res-employee").append(obj.error);
                    return false;  
                }
                $("#"+id).html("Потврђена резервација").attr("disabled","disabled");       
            });
        });

        //button for delete reservetion
        $(".button-del").click(function(){
            let id=$(this).data("id");
            let deleteRes=$(this).data("delete");
            let empname=$("#session-name").data("name");
            let email=$(this).data("email");
            
            $.post("sql_query.php?delete-reservation",{id:id,empname:empname,email:email},function(response){
                let obj=JSON.parse(response);

                if(obj.data==""){
                    $("#wrapper-res-employee").append(obj.error);
                    return false;  
                }

                $("[data-delete="+deleteRes+"]").remove();  

            });       
        });
    });

//end of administrator and assistant to confirm a reservation
  
//show all food orders for the cook
    $.post("sql_query.php?cook", function(response){
        let obj=JSON.parse(response);
        let n=0;
        if(obj.data){
            for(el of obj.data){
                n++;
                let cookOrder=$("<div data-delete="+n+"><h4 >"+el.section_name+"</h4><div class='cook'>Назив јела: "+el.order_item+ "</div><div class='cook'>"+el.order_quantity+" ком.</div> <div class='cook'>Коментар: "+el.order_comment+"</div> <div class='cook'>Vreme: "+el.order_time+"</div></div>");

                let button=$("<button class='btn-done' data-delete="+n+" data-id="+el.order_id+">Готово</button><hr data-delete="+n+">");

                $("#cook-allOrders").append(cookOrder).append(button); 

            }
        }
        $(".btn-done").click(function(){
            let id=$(this).data("id");
            let deleteEl=$(this).data("delete");

            $.post("sql_query.php?cook-delete",{id:id},function(response){
                let obj=JSON.parse(response);

                if(obj.data==""){
                    $("#cook-allOrders").append(obj.error);
                    return false;  
                }

                $("[data-delete="+deleteEl+"]").remove();
            });
        });
        
        
    });

}); /*End of JQuery */
