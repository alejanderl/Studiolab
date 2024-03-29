

// defines a class to manage the slider in the page front
var sliderFront = function (divID,time,stoptime) {
         "use strict";
	 this.time=time;
	 this.stoptime=stoptime;
         this.divID = divID;
	 //set the end of the loop 
         var _this = this;  
	 //$(this.divID + " ul").prepend('<li class="black forward"></div>');
         //$(this.divID + " ul").append('<div class="clearfix"></div>');
	 first_element=$(_this.divID + " ul ").html();
	 if(2<$(this.divID  + " ul li").length&&$(this.divID  + " ul li").length<4){
		    $(_this.divID + " ul").append(first_element);
		    $(_this.divID + " ul").append(first_element);
		    $(_this.divID + " ul").append(first_element);
		}else  if(2<$(this.divID  + " ul li").length&&$(this.divID  + " ul li").length<7){
			$(_this.divID + " ul").append(first_element);
	 }
	 var first_element="";                
         $(this.divID ).append('<div class="clearfix"></div>');
         this.position_top = ($(this.divID).position().top);
         this.element_total = $(this.divID  + " ul li").length;
         this.single_element_width = $(this.divID + " ul li").eq(1).outerWidth();
         this.element_width = this.single_element_width*this.element_total;
         this.element_height = $(this.divID + " ul li").eq(1).outerHeight();
	 this.li_index = 0;       
        // match first element as active.
         $(this.divID + " ul li").eq(0).addClass("active");      
              
         $(window).resize(function() {           
            _this.rescale ();
            _this.placeControllers ();
            });
        
        this.rescale=function () {
        $(this.divID).width(this.element_width);
        }
       
        this.infinite_carrousel = function (where2){
		
            for (var i=0;i<_this.element_total-2;i++){
                if ($(_this.divID + " ul li").eq(0).position().left<(_this.single_element_width*(-1))&&where2<0){
                        
                    var first_element=$(_this.divID + " ul li").eq(0);
                    var newPos=$(_this.divID + " ul li").eq(0).position().left+$(this.divID + " ul li").eq(0).width()-24;
                    $(_this.divID + " li" ).css({top:0,left:newPos});
                    $(_this.divID + " ul li").eq(0).remove();
                    $(_this.divID + " ul").append(first_element);
                   
                }else if ($(_this.divID + " ul li").eq(0).position().left>-500&&where2>0){
                   
                    var last_element = $(_this.divID + " ul li").eq(_this.element_total-1);
                      $(_this.divID + " ul li").eq(_this.element_total-1).remove();
                    
                    
                    $(_this.divID + " ul").prepend(last_element);
                    
                   
                    var newPos = $(_this.divID + " ul li").eq(0).position().left-($(_this.divID + " ul li").eq(0).width()+40);
                    $(_this.divID + " li" ).css({top:0,left:newPos});
                }
                
            }
                
           
        }
       
        
        this.moving=function (where2move) {
            
             var distance = where2move*_this.single_element_width;
             //deleting side controllers if correspond
	      where2move = where2move ;
             _this.placeControllers();
             
               var time=_this.time;
            $(_this.divID + " li" ).animate().stop();
             
              _this.infinite_carrousel(where2move);
             $(_this.divID + " li" ).animate({ left :   "+="+distance  }, time,"easeInOutCubic",function (){
               
             
                 
                
             });
             
            // match  element as active.
             $(this.divID + " ul li").eq(_this.li_index).removeClass("active");
             $(this.divID + " ul li").eq(_this.li_index+(-1*where2move)).addClass("active");
             var listItem = $('li.active');
             _this.li_index = $(this.divID + " ul li").index(listItem);
             _this.placeControllers();
            
        }
        
        
       //center the slider in the window screen
        
        //add the UI controllers
        $(_this.divID).append('<div id="back-slider" class="controller" ><div class="arrow"></div></div>');
        
        $(_this.divID).append('<div id="advance-slider" class="controller"><div class="arrow"></div></div>');
        // add functionality to the controllers
        $(_this.divID+" #advance-slider").on("click",function (){           
            _this.moving(-1);
        })
        
       $(_this.divID+" #back-slider").click(function (){            
            _this.moving(1);
        })
       
        $(_this.divID+" .forward").on("click",function (){
            _this.moving(2-_this.element_total);
            
        });
                $(_this.divID+" .backward").on("click",function (){
            _this.moving(_this.element_total-2);
            
           
            
        });
        
        
                
                
        
         
        this.placeControllers=function (){
           
       //place the contrallers advance slider        
        $(_this.divID+" #back-slider").css("top",this.position_top+"px");
        $(_this.divID+" #advance-slider").css("top",(this.position_top)+"px");       
        $(_this.divID+" #advance-slider").css("left",($(window).width()- ($(_this.divID+" #advance-slider").outerWidth()))+"px");        
        }
                // constructor

        _this.moving(-1);
        this.rescale ();
        this.placeControllers();
        //$(this.divID + " ul li").toggle("slow");
        $(this.divID + " ul li").css("display","block");
         $(_this.divID + " .controller").fadeOut(1000);
        this.mover=function () {           
            _this.moviendo="";
            clearInterval (_this.moviendo);
            _this.moviendo=setInterval(function(){_this.moving(-1)},_this.time+_this.stoptime);
        }
        this.mover ();
        $(_this.divID).on("mouseenter",function (){
            clearInterval (_this.moviendo);
            $(_this.divID + " .controller").fadeIn(400);
           
        });
        $(_this.divID ).on("mouseleave",function (){
           _this.mover ();
           $(_this.divID + " .controller").fadeOut(400);
           
            
        });
    }
   
    
   