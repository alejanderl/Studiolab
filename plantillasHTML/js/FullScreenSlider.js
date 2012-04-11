

// defines a class to manage the slider in the page front
    var sliderFront=function (divID){
        this.divID=divID;
        //add the styles
         $("head ").append('<link type="text/css" rel="stylesheet" href="./css/FullScreenSLider.css" />');
          
        //set the end of the loop
         $(this.divID + " ul").prepend('<li class="black forward"><p>black1</p></div>');
         $(this.divID + " ul").append('<li class="black backward"><p>black2</p></div>');
            this.position_top=($(this.divID).position().top);
          this.element_total=$(this.divID  + " ul li").length;
           this.single_element_width = $(this.divID + " ul li").eq(1).outerWidth();
          this.element_width = this.single_element_width*this.element_total;
          this.element_height = $(this.divID + " ul li").eq(1).outerHeight();
          var _this=this;          
          this.li_index=0;
          console.log (this.single_element_width);
          // match first element as active.
          $(this.divID + " ul li").eq(0).addClass("active");      
          
        
         $(window).resize(function() {           
            _this.rescale ();
            _this.placeControllers ();
            });
          
         this.rescale=function () {
                $(this.divID ).width(this.element_width);             
        }
       
        this.infinite_carrousel=function (){
            
        if ($(this.divID + " ul li").eq(0).position().left<(_this.single_element_width*(-2))){
            first_element=$(this.divID + " ul li").eq(0);
            newPos=$(this.divID + " ul li").eq(0).position().left+$(first_element).width();
            $(_this.divID + " li" ).css({top:0,left:newPos});
            $(this.divID + " ul li").eq(0).remove();
            
            $(this.divID + " ul").append(first_element);
          console.log ("lejos");  
        }
                
            
        }
        
        this.moving=function (where2move) {
            _this.infinite_carrousel();
             distance=where2move*_this.single_element_width;
             //deleting side controllers if correspond
             _this.placeControllers();
             
             $(_this.divID + " li" ).animate({ left :   "+="+distance  }, 1000,function (){
                //$(_this.divID + " li").css("display","none");
                for (i=0;i<_this.element_total;i++){
                    
                    if ((i)>(_this.element_number-2)&&i<(_this.element_number+2)){
                       
                    $(_this.divID + " li:eq("+i+")" ).css("display","true");
                   
                    }
                }
                 
                
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
        $(_this.divID).append('<div id="back-slider" ><p><<</p></div>');
        
        $(_this.divID).append('<div id="advance-slider"><p>>></p></div>');
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
           
            //delete controller in case we are in the top/low limit
            switch (_this.li_index) {
                case 0:
                    
                    $(_this.divID+" div").css("display","block");
                    $(_this.divID+" #back-slider").css("display","none");
                    break;
                case ((_this.element_total-2)):                
                    $(_this.divID+" div").css("display","block");
                    $(_this.divID+" #advance-slider").css("display","none");
                 break;
                
                default:
                    $(_this.divID+" div").css("display","block");
                  break;                
            }    
        //place the contrallers advance slider        
        $(_this.divID+" #back-slider").css("top",this.position_top+"px");
        $(_this.divID+" #advance-slider").css("top",(this.position_top)+"px");       
        $(_this.divID+" #advance-slider").css("left",($(window).width()- ($(_this.divID+" #advance-slider").outerWidth()))+"px");        
        }
                // constructor
        _this.moving(-1);
        this.rescale ();
        this.placeControllers();
    }
   
    
   